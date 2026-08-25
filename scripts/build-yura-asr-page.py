#!/usr/bin/env python3
"""Assemble page-ai-scenarii-reels.php from handoff blocks for Yura."""

from __future__ import annotations

import re
from pathlib import Path

ROOT = Path("/workspace")
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"
OUT_DIR = ROOT / "wordpress-theme"
OUT_FILE = OUT_DIR / "page-ai-scenarii-reels.php"

SLUG = "ai-scenarii-reels"
TITLE = "AI-сценарии Reels под ключ: генерация и внедрение для бизнеса"
DESCRIPTION = (
    "Внедряем AI-конвейер сценариев Reels: нейросеть собирает структуры роликов "
    "из оффера, болей ЦА и SEO-тем. Пакет на месяц, хуки и CTA. "
    "Получите 10 сценариев под вашу нишу."
)

STEP3_OLD = (
    "<p>Выгрузка в Google Sheets, Notion, amoCRM, Bitrix24. "
    "Make.com / n8n: триггер «новая SEO-тема» → сценарий → задача в CRM.</p>"
)
STEP3_NEW = (
    "<p>Выгрузка в Google Sheets, Notion, amoCRM, Bitrix24. "
    "Make.com / n8n: триггер «новая SEO-тема» → сценарий → задача в CRM. "
    "Для полноценной <a href=\"/vnedrenie-ai-amocrm/\">интеграции AI с amoCRM под ключ</a> "
    "сценарии можно связать с воронкой сделок и задачами менеджеров.</p>"
)

INTERNAL_LINK_PARA = (
    '<p class="nero-ai-reveal" style="margin-top:20px">'
    "Когда Reels или Shorts приводят заявку, следующий шаг — не потерять её в почте: "
    '<a href="/vnedrenie-ai-obrabotka-email-crm/">AI-обработку входящей почты в CRM</a> '
    "можно подключить в тот же контур автоматизации.</p>"
)

ROI_OLD = (
    "<p>91% бизнесов в видеомаркетинге. Short-form — #1 ROI у 49% маркетологов. "
    "Salesforce: AI-агенты — <strong>−36%</strong> на content creation.</p>"
)
ROI_NEW = (
    "<p>91% бизнесов в видеомаркетинге. Short-form — #1 ROI у 49% маркетологов. "
    "На фоне <a href=\"/kpmg-claude-vnedrenie-ai-276-tysyach/\">масштабного внедрения AI в бизнес</a> "
    "у крупных компаний сценарии Reels — быстрый модуль с видимым результатом; "
    "Salesforce: AI-агенты — <strong>−36%</strong> на content creation.</p>"
)

MODULE_OLD = (
    "<p>1) SEO-контент → темы. 2) AI-сценарии Reels → охват. "
    "3) CRM + AI-агенты → заявки. Закрывает «внедрение ai решений» без полной IT-трансформации.</p>"
)
MODULE_NEW = (
    "<p>1) SEO-контент → темы. 2) AI-сценарии Reels → охват. "
    "3) CRM + AI-агенты → заявки. На этапе учёта и документооборота помогает "
    '<a href="/ai-1c-erp/">AI-агент для 1С и ERP</a>. '
    "Закрывает «внедрение ai решений» без полной IT-трансформации.</p>"
)


def extract_natasha_html(handoff: str) -> str:
    start = handoff.index("### Полный HTML\n\n") + len("### Полный HTML\n\n")
    end = handoff.index("\n## Передача пайплайну\n", start)
    return handoff[start:end].strip()


def apply_internal_links(html: str) -> str:
    html = html.replace(STEP3_OLD, STEP3_NEW)
    html = html.replace(
        "      <!-- INTERNAL-LINKS:INSERT -->",
        f"      {INTERNAL_LINK_PARA}",
    )
    html = html.replace(ROI_OLD, ROI_NEW)
    html = html.replace(MODULE_OLD, MODULE_NEW)
    if "<!-- INTERNAL-LINKS:INSERT -->" in html:
        raise RuntimeError("INTERNAL-LINKS marker still present")
    return html


PRIMARY_CTA_PHP = (
    '<a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"'
    '<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>'
)

SECONDARY_CTA_PHP = (
    '<a href="<?php echo esc_url($secondary_cta_url); ?>">'
    '<?php echo esc_html($secondary_cta_label); ?></a>'
)

CTA2_ASIDE_PATTERN = re.compile(
    r'<aside class="nero-ai-cta-inline nero-ai-card nero-ai-reveal" aria-label="Обучение и внедрение AI">.*?</aside>',
    re.S,
)
CTA2_ASIDE_PHP = (
    '<aside class="nero-ai-cta-inline nero-ai-card nero-ai-reveal" aria-label="Обучение и внедрение AI">\n'
    "  <p>Если вы только начинаете <strong>внедрение AI в бизнес</strong>, сценарии Reels — "
    "быстрый модуль с видимым результатом за дни. Для системного освоения автоматизации "
    "и контент-конвейеров — "
    f"{SECONDARY_CTA_PHP}.</p>\n"
    "</aside>"
)


def fix_cta_links(html: str) -> str:
    html = re.sub(
        r'<a class="nero-ai-btn nero-ai-btn-primary" href="[^"]*"(?: target="_blank" rel="noopener noreferrer")?>[^<]*</a>',
        PRIMARY_CTA_PHP,
        html,
    )
    html = CTA2_ASIDE_PATTERN.sub(CTA2_ASIDE_PHP, html, count=1)
    return html


SCHEMA_PHP = """<?php
$asr_page_url = trailingslashit( get_permalink() );
$asr_site_url = trailingslashit( home_url( '/' ) );
$asr_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$asr_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $asr_site_url . '#organization',
      'name'  => $asr_brand,
      'url'   => $asr_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $asr_site_url . '#website',
      'url'       => $asr_site_url,
      'name'      => $asr_brand,
      'publisher' => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $asr_page_url . '#webpage',
      'url'         => $asr_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $asr_site_url . '#website' ],
      'about'       => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $asr_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $asr_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $asr_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $asr_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $asr_page_url,
      'provider'    => [ '@id' => $asr_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $asr_page_url . '#faq',
      'mainEntity' => [
        [ '@type' => 'Question', 'name' => 'Нужен ли программист для внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Нет для стартового пакета: сценарии в Google Sheets / Notion. CRM-интеграция и Make/n8n — опционально.' ] ],
        [ '@type' => 'Question', 'name' => 'Сколько сценариев в месяц реально снимать?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'При batch-формате: 10–20 роликов за 1 съёмочный день. Реалистично для эксперта: 12–20 роликов/мес при 3–5 в неделю.' ] ],
        [ '@type' => 'Question', 'name' => 'Подходят ли сценарии для YouTube Shorts?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Да. Один пакет адаптируется: Reels, VK Клипы, Shorts — разная длина и темп из одной базы.' ] ],
        [ '@type' => 'Question', 'name' => 'Можно ли заказать только генерацию без внедрения?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Можно пакет генерации без CRM. Полное внедрение включает бриф, редактуру, выгрузку и инструкцию.' ] ],
        [ '@type' => 'Question', 'name' => 'ИИ пишет шаблонно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Без брифа — да. С брифом, болями, SEO-темами и редактурой — структура AI + конкретика вашего бизнеса.' ] ],
        [ '@type' => 'Question', 'name' => 'Instagram в РФ ограничен — зачем Reels?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Пакет мультиплатформенный: VK Клипы (52 млн MAU) и Shorts (41 млн) из одной сценарной базы.' ] ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $asr_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\\n";
?>"""


def insert_schema_php(html: str) -> str:
    html = html.replace("<!-- SCHEMA-MARKUP:INSERT -->", SCHEMA_PHP)
    if "<!-- SCHEMA-MARKUP:INSERT -->" in html:
        raise RuntimeError("SCHEMA-MARKUP marker still present")
    return html


def build_php(body_html: str) -> str:
    return f"""<?php
/**
 * Template Name: {TITLE}
 * Description: {DESCRIPTION}
 */

$page_seo_title       = '{TITLE}';
$page_seo_description = '{DESCRIPTION}';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {{
\t$parts['title'] = $page_seo_title;
\treturn $parts;
}}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {{
\techo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\\n";
\techo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\\n";
\techo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\\n";
\techo '<meta property="og:type" content="article" />' . "\\n";
}}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Пакет', 'href' => '#paket'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {{
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Получить сценарии';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Внедрение AI в бизнес';
$secondary_cta_url = '#vnedrenie-ai';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {{
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
}} else {{
    require $nero_ai_floating;
}}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

{body_html}

<?php get_footer(); ?>
"""


def main() -> None:
    handoff = HANDOFF.read_text(encoding="utf-8")
    html = extract_natasha_html(handoff)
    html = apply_internal_links(html)
    html = fix_cta_links(html)
    html = insert_schema_php(html)
    php = build_php(html)

    OUT_DIR.mkdir(parents=True, exist_ok=True)
    OUT_FILE.write_text(php, encoding="utf-8")

    checks = [
        ('id="primary"', 'main#primary'),
        ('ai-scenarii-reels-page', 'slug-page class'),
        ('asr-reels-hero-canvas', 'hero canvas'),
        ('$asr_schema', 'PHP JSON-LD'),
        ('/vnedrenie-ai-amocrm/', 'internal link amoCRM'),
        ('/ai-1c-erp/', 'internal link 1C'),
        ('esc_url($primary_cta_url)', 'dynamic primary CTA'),
    ]
    for needle, label in checks:
        if needle not in php:
            raise RuntimeError(f"Missing {label}: {needle}")

    print(f"Built {OUT_FILE} ({len(php)} bytes)")


if __name__ == "__main__":
    main()
