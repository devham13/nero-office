#!/usr/bin/env python3
"""Убирает старый amo-sticky-nav/hero и подключает канонический nero-ai shell."""

from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]

HERO_BLOCK = r'''
  <section class="nero-ai-hero" id="hero" aria-labelledby="hero-amocrm-title">
    <div class="nero-ai-container nero-ai-hero-grid">
      <div class="nero-ai-hero-copy nero-ai-reveal">
        <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai amocrm</p>
        <h1 id="hero-amocrm-title">AI-агент для amoCRM: <span class="nero-ai-gradient-text">автоматизация продаж под ключ</span></h1>
        <p class="nero-ai-hero-lead">Внедрим AI в вашу amoCRM — сделки создаются сами, задачи ставятся автоматически, менеджеры только продают</p>
        <ul class="nero-ai-badges" aria-label="Ключевые возможности">
          <li class="nero-ai-badge">Сделки в CRM</li>
          <li class="nero-ai-badge">Задачи авто</li>
          <li class="nero-ai-badge">Итоги звонков</li>
          <li class="nero-ai-badge">Воронка 24/7</li>
        </ul>
        <div class="nero-ai-btn-row">
          <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"><?php echo esc_html($primary_cta_label); ?></a>
          <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
        </div>
      </div>
      <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI и amoCRM">
        <div class="nero-ai-dashboard-shell">
          <div class="nero-ai-window-top">
            <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
            <span class="nero-ai-window-title">amoCRM · демо</span>
          </div>
          <div class="nero-ai-window-body">
            <div class="nero-ai-dashboard-title"><h3>AI-операционный центр</h3><span class="nero-ai-live-pill">онлайн</span></div>
            <div class="nero-ai-metrics-grid">
              <div class="nero-ai-metric"><span>Лиды</span><strong>24</strong><small>входящих</small></div>
              <div class="nero-ai-metric"><span>Ответ</span><strong>5 сек</strong><small>первичный</small></div>
              <div class="nero-ai-metric"><span>CRM</span><strong>auto</strong><small>сделки</small></div>
              <div class="nero-ai-metric"><span>Рутина</span><strong>−38%</strong><small>меньше</small></div>
            </div>
            <div class="nero-ai-task-stream">
              <div class="nero-ai-task"><span class="nero-ai-task-icon">IN</span><div><strong>Заявка</strong><span>сайт / мессенджер</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">AI</span><div><strong>Квалификация</strong><span>скоринг лида</span></div><span class="nero-ai-status">готово</span></div>
              <div class="nero-ai-task"><span class="nero-ai-task-icon">CRM</span><div><strong>Сделка</strong><span>задача менеджеру</span></div><span class="nero-ai-status">новое</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
'''

BOOTSTRAP_PHP = '''
$brand = get_bloginfo('name') ?: getenv('SITE_BRAND') ?: get_bloginfo('name');
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Аудит amoCRM';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: '#cta';
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии AI', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;
'''

FLOATING_HEADER_PHP = '''
$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
'''

KADENCE_HIDE_CSS = '''
/* Скрыть шапку Kadence — используем nero-ai-floating-header как на главной */
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header {
  display: none !important;
}
body.nero-ai-landing {
  padding-top: 0 !important;
}
'''


def migrate(path: Path) -> None:
    text = path.read_text(encoding='utf-8')

    if 'amo-sticky-nav' not in text:
        print('Already migrated or no amo-sticky-nav found')
        return

    # Bootstrap before get_header()
    text = text.replace(
        'get_header();',
        BOOTSTRAP_PHP + '\nget_header();\n' + FLOATING_HEADER_PHP,
        1,
    )

    # Theme styles via bootstrap helper
    text = text.replace(
        '<style>\n/* =====================================================\n   VNA PAGE — GLOBAL RESETS',
        '<?php nero_ai_echo_theme_styles(); ?>\n\n<style>\n' + KADENCE_HIDE_CSS + '\n/* =====================================================\n   VNA PAGE — GLOBAL RESETS',
        1,
    )

    # Main wrapper class
    text = text.replace(
        '<main id="primary" class="site-main vnedrenie-ai-amocrm-page"',
        '<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-amocrm-page"',
        1,
    )

    # Remove old hero block (nav + canvas hero)
    text = re.sub(
        r'<!-- ========= АЛИНА: HERO BLOCK START ========= -->.*?<!-- ========= АЛИНА: HERO BLOCK END ========= -->',
        '<!-- HERO: nero-ai shell (канонический дизайн главной) -->' + HERO_BLOCK,
        text,
        flags=re.DOTALL,
    )

    # Remove canvas animation + sticky nav JS
    text = re.sub(
        r'<!-- ====================================================\s+HERO ANIMATION ENGINE \(АЛИНА\).*?</script>\s*',
        '',
        text,
        flags=re.DOTALL,
    )

    # Theme scripts before footer
    if 'nero_ai_echo_theme_scripts' not in text:
        text = text.replace(
            '<?php get_footer(); ?>',
            '<?php nero_ai_echo_theme_scripts(); ?>\n<?php get_footer(); ?>',
            1,
        )

    path.write_text(text, encoding='utf-8')
    print(f'Migrated: {path}')


if __name__ == '__main__':
    target = Path(sys.argv[1]) if len(sys.argv) > 1 else ROOT / 'wordpress/page-vnedrenie-ai-amocrm.php'
    migrate(target)
