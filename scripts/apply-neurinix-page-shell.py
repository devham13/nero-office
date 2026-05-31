#!/usr/bin/env python3
"""Rebuild page templates using vnedrenie reference (bootstrap + floating header)."""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
REF = ROOT / "wordpress" / "page-vnedrenie-ai-obrabotka-zayavok-s-sayta.php"


def copy_obrabotka() -> None:
    text = REF.read_text(encoding="utf-8")
    text = text.replace(
        "Template Name: Внедрение AI — обработка заявок с сайта",
        "Template Name: AI-обработка заявок с сайта",
    )
    text = text.replace(
        "slug: vnedrenie-ai-obrabotka-zayavok-s-sayta",
        "slug: ai-obrabotka-zayavok-s-sayta",
    )
    out = ROOT / "wordpress" / "page-ai-obrabotka-zayavok-s-sayta.php"
    out.write_text(text, encoding="utf-8")
    print(f"Wrote {out} ({out.stat().st_size} bytes)")


def rebuild_kvalifikaciya() -> None:
    monolith = (ROOT / "wordpress" / "page-ai-kvalifikaciya-lidov.php").read_text(encoding="utf-8")
    start = monolith.find('<section class="nero-ai-section nero-ai-section-tight ai-kvalifikaciya-intro"')
    script_start = monolith.find("<script>", start)
    if start < 0 or script_start < 0:
        raise SystemExit("Could not extract kvalifikaciya body from monolith")
    body = monolith[start:script_start].strip() + "\n</main>"
    # Drop duplicate inline styles in intro — use design-reference classes only
    body = re.sub(r"<style>[\s\S]*?</style>\s*", "", body, count=0)

    ref = REF.read_text(encoding="utf-8")
    head_end = ref.find("<main id=\"primary\"")
    tail_start = ref.find("</main>")
    footer = ref[tail_start:]

    header = """<?php
/**
 * Template Name: AI-квалификация лидов
 * Description: AI-квалификация лидов перед передачей менеджеру — Neurinix longread.
 */

$page_seo_title = 'AI-квалификация лидов: скоринг и статусы до передачи в CRM';
$page_seo_description = 'AI-квалификация лидов: скоринг, статусы MQL/SQL и передача в CRM. Внедрение под ключ для отдела продаж.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\\n";
    echo '<meta property="og:type" content="article" />' . "\\n";
}, 1);

$brand = get_bloginfo('name') ?: 'AI-автоматизация';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит воронки лидов';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#audit';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение под ключ';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#vnedrenie';

$nero_ai_header_links = [
    ['label' => 'Что такое', 'href' => '#akl-chto-takoe'],
    ['label' => 'Скоринг', 'href' => '#akl-ai-lid-skoring'],
    ['label' => 'CRM', 'href' => '#akl-integraciya-crm'],
    ['label' => 'Внедрение', 'href' => '#akl-vnedrenie-pod-klyuch'],
    ['label' => 'Стоимость', 'href' => '#akl-stoimost'],
    ['label' => 'FAQ', 'href' => '#akl-faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$theme_dir = get_stylesheet_directory();
require $theme_dir . '/nero-ai-floating-header.inc.php';

?>

<style>
<?php nero_ai_echo_theme_styles(); ?>
</style>

"""

    hero = """
<main id="primary" class="site-main nero-ai-home-page" role="main" tabindex="-1">

  <section class="nero-ai-hero" id="lead-qualify-hero" aria-labelledby="hero-kval-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai квалификация лидов</p>
        <h1 id="hero-kval-title">AI-квалификация лидов <span class="nero-ai-gradient-text">без ручного разбора входящих</span></h1>
        <p class="nero-ai-hero-lead">Скоринг, статусы hot/warm/cold и передача в CRM только подготовленного лида — менеджер подключается к сделке, а не к сортировке мусора.</p>
        <ul class="nero-ai-badges" aria-label="Ключевые параметры">
          <li class="nero-ai-badge">MQL / SQL</li>
          <li class="nero-ai-badge">amoCRM · Битрикс24</li>
          <li class="nero-ai-badge">BANT / MEDDIC</li>
          <li class="nero-ai-badge">Human-in-the-loop</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: скоринг и CRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">скоринг · демо</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>Квалификация лида</h3><span class="nero-ai-live-pill">live</span></div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Score</span><strong data-nero-count="72" data-nero-suffix="">0</strong><small>HOT порог</small></div>
              <div class="nero-ai-metric"><span>Шум</span><strong>−40%</strong><small>нецелевые</small></div>
              <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>поля + теги</small></div>
              <div class="nero-ai-metric"><span>Handoff</span><strong>4 мин</strong><small>vs 22 мин</small></div>
            </div>
            <div class="nero-ai-task-stream">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">IN</span><div><strong>Заявка</strong><span>сигналы</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Скоринг</strong><span>hot/warm/cold</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Карточка</strong><span>summary</span></div><span class="nero-ai-status">новое</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

"""

    # body starts with intro section — fix closing: monolith may end with </div> not </main>
    if not body.rstrip().endswith("</main>"):
        body = body.rstrip()
        if body.endswith("</div>"):
            body = body[: body.rstrip().rfind("</div>")] + "\n</main>"

    # Strip old canvas boris blocks with heavy scripts — keep boris static card if present
    body = re.sub(
        r"<section[^>]*boris-lead-crm-flow-canvas[\s\S]*?</section>\s*",
        "",
        body,
        flags=re.I,
    )
    body = re.sub(r"<script>[\s\S]*?lead-scoring-matrix[\s\S]*?</script>\s*", "", body, flags=re.I)
    body = re.sub(r"<script>[\s\S]*?ai-kvalifikaciya-lidov-hero-canvas[\s\S]*?</script>\s*", "", body, flags=re.I)

    out_text = header + hero + body + "\n" + footer
  # fix duplicate </main>
    out_text = re.sub(r"</main>\s*</main>", "</main>", out_text)

    out = ROOT / "wordpress" / "page-ai-kvalifikaciya-lidov.php"
    out.write_text(out_text, encoding="utf-8")
    print(f"Wrote {out} ({out.stat().st_size} bytes)")


def main() -> None:
    if not REF.is_file():
        raise SystemExit(f"Missing reference: {REF}")
    copy_obrabotka()
    rebuild_kvalifikaciya()
    theme = ROOT / "wordpress-theme"
    theme.mkdir(exist_ok=True)
    for name in ("page-ai-obrabotka-zayavok-s-sayta.php", "page-ai-kvalifikaciya-lidov.php"):
        src = ROOT / "wordpress" / name
        (theme / name).write_text(src.read_text(encoding="utf-8"), encoding="utf-8")
        print(f"Synced wordpress-theme/{name}")


if __name__ == "__main__":
    main()
