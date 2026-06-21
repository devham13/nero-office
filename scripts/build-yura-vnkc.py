#!/usr/bin/env python3
"""Assemble page-vnedrenie-ai-kontakt-centr.php for Yura publication."""
from __future__ import annotations

import re
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
HANDOFF = ROOT / ".cursor" / "nero-network-handoff.md"
OUT = ROOT / "wordpress" / "page-vnedrenie-ai-kontakt-centr.php"

TITLE = "AI для контакт-центра: внедрение и настройка под ключ"
DESCRIPTION = (
    "Внедрим AI для контакт-центра: маршрутизация обращений, подсказки оператору и автоответы. "
    "Снизим нагрузку на операторов и затраты поддержки. Бесплатный аудит нагрузки колл-центра."
)
TEMPLATE_NAME = "AI для контакт-центра: внедрение и настройка под ключ"

FAQ_ENTITIES = [
    (
        "Как внедрить ai контакт центр?",
        "Пошагово: (1) аудит нагрузки и топ интентов; (2) выбор 1–2 сценариев для пилота; "
        "(3) интеграция с CRM и каналом (чат/голос); (4) RAG по базе знаний; "
        "(5) запуск с human-in-the-loop; (6) замер AHT, FCR, deflection; "
        "(7) масштаб на омниканал. Nero Network ведёт проект под ключ от аудита до прода.",
    ),
    (
        "Сколько стоит ai контакт центр?",
        "Ориентир: 500 тыс.–4 млн ₽ в зависимости от каналов, интеграций и числа сценариев. "
        "Пилот на чате — ближе к нижней границе; омниканал с голосом, copilot и QA — к верхней. "
        "Точную смету даёт аудит нагрузки с прогнозом ROI.",
    ),
    (
        "AI заменит операторов?",
        "Нет — разгрузит от рутины. Сбер закрывает 65% обращений AI, но 35% — люди. "
        "Klarna вернула humans на сложные кейсы. ОТП показал рост продаж +3,3 п.п. — "
        "операторы фокусируются на конверсии, а не на FAQ. Цель — снизить нагрузку, не сократить штат без плана.",
    ),
    (
        "Можно ли ai контакт центр с CRM amoCRM / Bitrix24?",
        "Да. Типовая интеграция: статус заказа, карточка клиента, post-call саммари, теги. "
        "AI-агент дергает API CRM; copilot подставляет данные в ответ. "
        "Связанные материалы: внедрение AI в amoCRM, AI для 1С.",
    ),
    (
        "ai контакт центр под ключ или самостоятельно — что выбрать?",
        "Самостоятельно — если есть in-house ML/интеграторы и время 3–6 месяцев. "
        "Под ключ — если нужен результат за 2–6 недель на пилоте без найма команды. "
        "Гибрид Nero: ваша телефония + наш AI-слой.",
    ),
    (
        "Какие задачи решает ai контакт центр?",
        "Маршрутизация, автоответы, copilot оператору, речевая аналитика, auto-QA, post-call automation в CRM. "
        "Полный список — в таблице сценариев выше.",
    ),
    (
        "Как заказать ai контакт центр консультация?",
        "Оставьте заявку на аудит нагрузки контакт-центра — бесплатный первичный разбор топ интентов "
        "и потенциала deflection. CTA: Снизить нагрузку.",
    ),
]


def extract_between(text: str, start: str, end: str) -> str:
    i = text.index(start)
    j = text.index(end, i)
    return text[i:j]


def extract_natasha_html(handoff: str) -> str:
    marker = "**Размер HTML:**"
    end_marker = "\n\n## Передача пайплайну"
    chunk = extract_between(handoff, marker, end_marker)
    lines = chunk.split("\n", 1)
    return lines[1].lstrip("\n") if len(lines) > 1 else ""


def internal_links_html() -> str:
    return (
        "Типовые CRM-связки мы оформляем отдельными проектами: "
        '<a href="/vnedrenie-ai-amocrm/">внедрение AI-агента в amoCRM</a> '
        "(post-call в сделку и задачи менеджеру), "
        '<a href="/ai-1c-erp/">AI-агент для 1С и ERP</a> '
        "(заявки и документы из диалога) и "
        '<a href="/vnedrenie-ai-obrabotka-email-crm/">автоматизация входящей почты в CRM</a> '
        "(омниканальный email рядом с голосом и чатом)."
    )


def fix_integracii_paragraph(html: str) -> str:
    insert = internal_links_html()
    pattern = (
        r"(<p><strong>ai контакт центр с CRM</strong> — обязательная связка: amoCRM, Bitrix24, retailCRM, 1С\. "
        r"После диалога — post-call: саммари, теги, задача менеджеру\. )"
        r"<!-- INTERNAL-LINKS:INSERT -->\s*"
        r"Связка с другими внедрениями Nero:.*?</p>"
    )
    return re.sub(pattern, r"\1" + insert + "</p>", html, flags=re.DOTALL)


def php_header() -> str:
    return f"""<?php
/**
 * Template Name: {TEMPLATE_NAME}
 * Description: SEO-лендинг — внедрение AI в контакт-центр. Кейсы, интеграции, цены. Аудит нагрузки бесплатно.
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
    ['label' => 'Задачи', 'href' => '#zadachi'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Стоимость', 'href' => '#stoimost'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {{
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Снизить нагрузку';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Какие задачи решает AI';
$secondary_cta_url = '#zadachi';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {{
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
}} else {{
    require $nero_ai_floating;
}}

?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

"""


def php_schema_block() -> str:
    faq_lines = []
    for q, a in FAQ_ENTITIES:
        q_esc = q.replace("'", "\\'")
        a_esc = a.replace("'", "\\'")
        faq_lines.append(
            f"\t\t[ '@type' => 'Question', 'name' => '{q_esc}', "
            f"'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '{a_esc}' ] ],"
        )
    faq_php = "\n".join(faq_lines)

    return f"""
<?php
$vnkc_page_url = trailingslashit( get_permalink() );
$vnkc_site_url = trailingslashit( home_url( '/' ) );
$vnkc_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnkc_schema   = [
\t'@context' => 'https://schema.org',
\t'@graph'   => [
\t\t[
\t\t\t'@type' => 'Organization',
\t\t\t'@id'   => $vnkc_site_url . '#organization',
\t\t\t'name'  => $vnkc_brand,
\t\t\t'url'   => $vnkc_site_url,
\t\t],
\t\t[
\t\t\t'@type'     => 'WebSite',
\t\t\t'@id'       => $vnkc_site_url . '#website',
\t\t\t'url'       => $vnkc_site_url,
\t\t\t'name'      => $vnkc_brand,
\t\t\t'publisher' => [ '@id' => $vnkc_site_url . '#organization' ],
\t\t],
\t\t[
\t\t\t'@type'       => 'WebPage',
\t\t\t'@id'         => $vnkc_page_url . '#webpage',
\t\t\t'url'         => $vnkc_page_url,
\t\t\t'name'        => $page_seo_title,
\t\t\t'description' => $page_seo_description,
\t\t\t'isPartOf'    => [ '@id' => $vnkc_site_url . '#website' ],
\t\t\t'about'       => [ '@id' => $vnkc_site_url . '#organization' ],
\t\t],
\t\t[
\t\t\t'@type' => 'BreadcrumbList',
\t\t\t'@id'   => $vnkc_page_url . '#breadcrumb',
\t\t\t'itemListElement' => [
\t\t\t\t[ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnkc_site_url ],
\t\t\t\t[ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnkc_page_url ],
\t\t\t],
\t\t],
\t\t[
\t\t\t'@type'       => 'Service',
\t\t\t'@id'         => $vnkc_page_url . '#service',
\t\t\t'name'        => $page_seo_title,
\t\t\t'description' => $page_seo_description,
\t\t\t'url'         => $vnkc_page_url,
\t\t\t'provider'    => [ '@id' => $vnkc_site_url . '#organization' ],
\t\t],
\t\t[
\t\t\t'@type' => 'FAQPage',
\t\t\t'@id'   => $vnkc_page_url . '#faq',
\t\t\t'mainEntity' => [
{faq_php}
\t\t],
\t\t],
\t],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnkc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\\n";
?>

"""


def php_footer() -> str:
    return """
<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
"""


def main() -> None:
    handoff = HANDOFF.read_text(encoding="utf-8")
    html = extract_natasha_html(handoff)
    html = fix_integracii_paragraph(html)
    html = html.replace("<!-- SCHEMA-MARKUP:INSERT -->", php_schema_block().strip())

    php = php_header() + html + php_footer()
    OUT.write_text(php, encoding="utf-8")
    print(f"Wrote {OUT} ({len(php)} chars)")


if __name__ == "__main__":
    main()
