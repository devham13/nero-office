#!/usr/bin/env python3
"""Сборка page-ai-dlya-stroitelstva.php и блока Наташи в handoff."""

from __future__ import annotations

import re
from pathlib import Path

ROOT = Path("/workspace")
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"
OUT_PHP = ROOT / "wordpress-theme/page-ai-dlya-stroitelstva.php"


def extract_codeblock_after(text: str, marker: str) -> str:
    idx = text.index(marker)
    rest = text[idx:]
    m = re.search(r"```html\n(.*?)```", rest, re.DOTALL)
    if not m:
        raise ValueError(f"No html block after {marker!r}")
    return m.group(1).strip()


def php_header() -> str:
    return r'''<?php
/**
 * Template Name: AI для строительства: заявки, сметы и контроль под ключ
 * Description: Внедрение AI-ассистента для строительной компании — квиз, бриф, предварительная смета, CRM.
 */

declare(strict_types=1);

$page_seo_title       = 'AI для строительства: заявки, сметы и контроль под ключ';
$page_seo_description = 'Внедрим AI-ассистента для строительной компании: уточнение заявок, квиз-бриф и предварительная смета. Интеграция с CRM, кейсы, цены от 180 тыс. ₽. Собрать AI-квиз.';

add_filter(
    'document_title_parts',
    static function (array $parts) use ($page_seo_title): array {
        $parts['title'] = $page_seo_title;
        return $parts;
    },
    20
);

add_action(
    'wp_head',
    static function () use ($page_seo_title, $page_seo_description): void {
        echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
    },
    1
);

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

'''


def page_css() -> str:
    return r'''<style>
body.nero-ai-landing #masthead,
body.nero-ai-landing .site-header,
body.nero-ai-landing header.site-header,
body.nero-ai-landing #mobile-header { display: none !important; }
body.nero-ai-landing { padding-top: 0 !important; }

.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,
nav[aria-label="Хлебные крошки"],
.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,
.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}

#primary,.site-main,.site-content,#content,.content-area{
  padding-top:0!important;margin-top:0!important;
}

.astr-content{
  --astr-bg:#050711;--astr-bg2:#080b17;
  --astr-text:#e6edf7;--astr-muted:#9aa8bd;--astr-soft:#c7d2e5;--astr-heading:#fff;
  --astr-border:rgba(255,255,255,.10);--astr-accent:#f59e0b;--astr-cyan:#79f2ff;
  --astr-green:#22c55e;--astr-violet:#8b5cf6;
  --astr-btn-from:#f59e0b;--astr-btn-to:#fde68a;
  --astr-container:1220px;--astr-r:18px;--astr-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--astr-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.astr-content *,.astr-content *::before,.astr-content *::after{box-sizing:border-box;}
.astr-content a{color:inherit;}
.astr-content p{color:var(--astr-muted);line-height:1.72;margin:0 0 1em;}
.astr-content p:last-child{margin-bottom:0;}
.astr-content h2,.astr-content h3,.astr-content h4{color:var(--astr-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.astr-content strong{color:var(--astr-soft);}
.astr-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.astr-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--astr-muted);font-size:14.5px;line-height:1.65;}
.astr-content ul li::before{content:'›';position:absolute;left:0;color:var(--astr-accent);font-weight:700;}
.astr-cnt{width:min(var(--astr-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.astr-section,.nero-ai-section.astr-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.astr-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.astr-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.astr-sh.astr-left{margin-left:0;text-align:left;}
.astr-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.astr-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.astr-sh.astr-left p{margin-left:0;}
.astr-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--astr-accent);margin-bottom:14px;}
.astr-def{background:rgba(255,255,255,.04);border-left:3px solid var(--astr-cyan);padding:16px 20px;border-radius:0 12px 12px 0;margin:20px 0;font-size:14.5px;}
.astr-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.astr-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.astr-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.astr-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--astr-accent),var(--astr-cyan));}
.astr-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--astr-muted);margin-bottom:1em;}
.astr-intro-text p:last-child{margin-bottom:0;color:var(--astr-soft);}
.astr-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.astr-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px);}
.astr-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--astr-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.astr-kpi-card .kl{font-size:11px;font-weight:600;color:var(--astr-muted);line-height:1.4;}
.astr-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.astr-intro-grid{grid-template-columns:1fr;gap:36px;}.astr-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.astr-intro-kpi{grid-template-columns:1fr 1fr;}}
.astr-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.astr-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.astr-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--astr-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--astr-muted);text-decoration:none;transition:border-color .2s,color .2s,background .2s;}
.astr-toc a:hover{border-color:rgba(245,158,11,.42);color:var(--astr-accent);background:rgba(245,158,11,.08);}
.astr-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--astr-border);border-radius:var(--astr-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.astr-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.astr-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.astr-grid-2,.astr-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.astr-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.astr-grid-3{grid-template-columns:1fr;}}
.astr-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--astr-r);padding:26px;margin-bottom:14px;}
.astr-scenario:last-child{margin-bottom:0;}
.astr-scenario h3{font-size:17px;margin-bottom:8px;}
.astr-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.astr-table{width:100%;border-collapse:collapse;font-size:14px;}
.astr-table th{padding:13px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--astr-accent);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25);white-space:nowrap;}
.astr-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--astr-text);vertical-align:top;}
.astr-table tr:last-child td{border-bottom:none;}
.astr-table tr:hover td{background:rgba(255,255,255,.03);}
.astr-compare-table th:nth-child(3){background:rgba(34,197,94,.12);color:var(--astr-green);}
.astr-compare-table td:nth-child(3){color:#bbf7d0;}
.astr-flow-diagram{background:#0a0e1c;border:1px solid rgba(121,242,255,.15);border-radius:14px;padding:24px 28px;margin:24px 0;font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;font-size:13px;line-height:1.7;color:var(--astr-cyan);overflow-x:auto;white-space:pre;}
.astr-case-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:20px;}
@media(max-width:768px){.astr-case-grid{grid-template-columns:1fr;}}
.astr-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:22px;}
.astr-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--astr-green);margin-bottom:10px;}
.astr-price-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.astr-price-grid{grid-template-columns:1fr;}}
.astr-price-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px;text-align:center;}
.astr-price-card.featured{border-color:rgba(245,158,11,.4);background:linear-gradient(180deg,rgba(245,158,11,.1),rgba(255,255,255,.04));}
.astr-price-card h3{font-size:18px;margin-bottom:8px;}
.astr-price-card .price{font-size:28px;font-weight:900;color:var(--astr-accent);margin:12px 0;}
.astr-timeline{position:relative;padding-left:40px;}
.astr-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--astr-accent),var(--astr-cyan));opacity:.35;}
.astr-tl-item{position:relative;margin-bottom:32px;}
.astr-tl-item:last-child{margin-bottom:0;}
.astr-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--astr-accent);box-shadow:0 0 0 4px rgba(245,158,11,.2);}
.astr-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.astr-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.astr-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--astr-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.astr-faq-q::after{content:'▾';font-size:13px;color:var(--astr-accent);flex-shrink:0;transition:transform .25s;}
.astr-faq-item.open .astr-faq-q::after{transform:rotate(180deg);}
.astr-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--astr-muted);line-height:1.72;}
.astr-faq-item.open .astr-faq-a{max-height:800px;padding:0 24px 20px;}
.astr-kviz-demo{background:rgba(255,255,255,.04);border:1px solid rgba(245,158,11,.2);border-radius:20px;padding:32px;margin-top:24px;}
.astr-kviz-steps{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;}
.astr-kviz-step{padding:8px 14px;border-radius:999px;font-size:12px;font-weight:700;border:1px solid rgba(255,255,255,.12);color:var(--astr-muted);}
.astr-kviz-step.active{background:rgba(245,158,11,.15);border-color:rgba(245,158,11,.35);color:var(--astr-accent);}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(139,92,246,.1));border:1px solid rgba(245,158,11,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,158,11,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--astr-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--astr-btn-from),var(--astr-btn-to));color:#1a1200!important;box-shadow:0 8px 32px rgba(245,158,11,.25);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--astr-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--astr-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>
'''


def content_html() -> str:
    return r'''
<div class="astr-content">

  <section class="astr-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="astr-cnt">
      <div class="astr-intro-grid nero-ai-reveal">
        <div class="astr-intro-text">
          <p class="astr-eyebrow">Лонгрид · AI для строительства</p>
          <p><strong>Коротко:</strong> AI для строительства в 2026 году — это не робот на стройплощадке, а связка квиза на сайте, диалогового ассистента с базой расценок компании и интеграций с CRM. Nero Network внедряет такой контур под ключ: от уточнения заявки до предварительной сметы и контроля объекта.</p>
          <p>Ремонтные и строительные компании с оборотом 3–50 млн ₽/мес теряют лиды на этапе «заявка → смета». Связка <strong>квиз + AI + CRM</strong> сокращает цикл с часов до минут — финальный расчёт остаётся за сметчиком.</p>
        </div>
        <div class="astr-intro-kpi" aria-label="Ключевые метрики воронки">
          <div class="astr-kpi-card"><div class="kv">22%</div><div class="kl">строительных компаний уже используют ИИ</div><div class="ks">Минстрой / Yandex Cloud</div></div>
          <div class="astr-kpi-card"><div class="kv">56%</div><div class="kl">хотят ИИ-агентов для офисной рутины</div><div class="ks">Сбер, май 2026</div></div>
          <div class="astr-kpi-card"><div class="kv">3 ч</div><div class="kl">ручная смета на объект</div><div class="ks">до автоматизации</div></div>
          <div class="astr-kpi-card"><div class="kv">5 мин</div><div class="kl">предварительная вилка с AI</div><div class="ks">типовой объект</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="astr-toc-outer">
    <div class="astr-cnt">
      <nav class="astr-toc" aria-label="Оглавление статьи">
        <a href="#zachem">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#integracii">Интеграции</a>
        <a href="#kontrol">Контроль</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#etapy">Внедрение</a>
        <a href="#faq">FAQ</a>
        <a href="#kviz">AI-квиз</a>
      </nav>
    </div>
  </div>

  <section class="astr-section" id="zachem">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">Боль и решение</span>
        <h2>Зачем строительной компании AI-ассистент</h2>
      </div>

      <div class="astr-def nero-ai-reveal"><strong>AI-ассистент для строительной компании</strong> — программный модуль на базе LLM, который ведёт диалог с клиентом, собирает бриф, считает предварительную смету по прайсу компании и передаёт структурированную карточку лида в CRM. Человек проверяет расчёт после замера.</div>

      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Боль: заявки без уточнений и долгие сметы</h3>
          <ul>
            <li><strong>Заявка приходит неполной</strong> — менеджер тратит 15–40 минут на уточнения</li>
            <li><strong>Предварительная смета готовится часами</strong> — сметчик вручную тратит 2,5–3 часа (<a href="https://simplysmeta.ru/" target="_blank" rel="noopener noreferrer">ПРОСТОСМЕТА</a>)</li>
            <li><strong>Заявки теряются вне рабочего времени</strong> — ночью и в сезон лиды остывают</li>
          </ul>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Что меняется после внедрения AI</h3>
          <div class="astr-table-wrap">
            <table class="astr-table astr-compare-table">
              <thead><tr><th>Показатель</th><th>Ручной процесс</th><th>С AI-ассистентом</th></tr></thead>
              <tbody>
                <tr><td>Время первого ответа</td><td>2–24 часа</td><td>1–3 минуты, 24/7</td></tr>
                <tr><td>Время предварительной сметы</td><td>2–4 часа</td><td>3–10 минут</td></tr>
                <tr><td>Полнота брифа</td><td>30–50%</td><td>80–95%</td></tr>
                <tr><td>Ночные заявки</td><td>Потеря</td><td>Автоквалификация</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:20px;">По опросу Сбера (май 2026) <strong>56%</strong> российских организаций хотят ИИ-агентов для офисной рутины; составление смет — <strong>6-е место</strong> среди приоритетов (<a href="https://www.cnews.ru/news/line/2026-05-29_56_rossijskih_kompanij_hotyat" target="_blank" rel="noopener noreferrer">CNews</a>). Минстрой: <strong>22%</strong> строительных компаний уже используют ИИ (<a href="https://yandex.cloud/ru/blog/posts/2025/04/technologies-in-construction" target="_blank" rel="noopener noreferrer">Yandex Cloud</a>).</p>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="kak-rabotaet">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Воронка</span>
        <h2>Как работает AI-квиз: от заявки до предварительной сметы</h2>
        <p>Три узла: уточнение заявки → сбор брифа → предварительная смета и передача менеджеру.</p>
      </div>

      <div class="astr-def nero-ai-reveal"><strong>AI-квиз для строительства</strong> — многошаговая форма (7–12 шагов), где каждый ответ запускает уточняющие вопросы, а на выходе система формирует бриф и предварительную вилку стоимости по прайсу компании.</div>

      <div class="astr-grid-3 nero-ai-reveal">
        <div class="astr-scenario">
          <h3>Уточнение заявки на сайте</h3>
          <p>AI задаёт структурированные вопросы: тип объекта, площадь, состояние, тип работ, зоны, сроки, бюджет, контакт. October Group: «ИИ-боты эволюционируют от FAQ к <strong>первой линии продаж</strong>».</p>
        </div>
        <div class="astr-scenario nero-ai-delay-1">
          <h3>Сбор брифа через квиз</h3>
          <p>Квиз работает по веткам: косметика, капиталка, дом под ключ — разные сценарии. Стартап «Пазл Дом» (ИТМО): смета за ~6,5 секунды, 3000+ пользователей.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-2">
          <h3>Предварительная смета и CRM</h3>
          <p>RAG-база из прайса → вилка «от — до» → PDF «Предварительное КП» → карточка в amoCRM/Битрикс24. Сметчик верифицирует после замера за 15–30 минут.</p>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:16px;text-align:center;font-size:13px;color:#64748b;"><strong>Важно:</strong> AI-смета — коммерческое предложение, не официальный расчёт по ГЭСН/ФЕР. Документы к договору подписывает аттестованный сметчик.</p>

      <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-kviz">
        <div class="ym-cta-block__icon" aria-hidden="true">🏗️</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Хотите AI-квиз с предварительной сметой для вашей компании?</p>
          <p class="ym-cta-block__sub">Разберём ваши заявки, прайс и воронку CRM — покажем, как квиз уточняет бриф и считает вилку стоимости за минуты. Бесплатная консультация, без обязательств.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- BORIS_BLOCK -->

  <section class="astr-section" id="scenarii">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Ниши</span>
        <h2>Сценарии AI для ремонта и строительства</h2>
      </div>
      <div class="astr-grid-3 nero-ai-reveal">
        <div class="astr-scenario">
          <h3>Ремонт квартир и офисов</h3>
          <p>AI закрывает типовые 70–80% заявок: косметика, капиталка, отделка новостроек. <strong>AI расчёт стоимости ремонта</strong> по площади и классу материалов. Отличие кастомного внедрения: ваш прайс, ваш бренд, ваш квиз.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-1">
          <h3>Строительство домов и коттеджей</h3>
          <p>В ИЖС AI собирает «биометрию объекта»: фундамент, коробка, инженерия. «Пазл Дом» сократил согласование ипотеки с 2–3 недель до 22 часов.</p>
        </div>
        <div class="astr-scenario nero-ai-delay-2">
          <h3>Инженерные и подрядные работы</h3>
          <p>AI-квиз уточняет мощность, протяжённость трасс, тип оборудования. Смета по справочнику работ с привязкой к нормо-часам бригад.</p>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="integracii">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">CRM и каналы</span>
        <h2>Интеграция AI с CRM и мессенджерами</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>amoCRM, Bitrix24 и учётные системы</h3>
          <p><strong>Интеграция AI для строительства с CRM</strong> — обязательный элемент. Автоматически передаётся: контакт, бриф, предварительная смета, саммари диалога, статус воронки, тег квалификации. Поддержка: amoCRM, Битрикс24, выгрузка из 1С.</p>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Telegram, WhatsApp и сайт-виджет</h3>
          <p>AI-ассистент в Telegram, WhatsApp Business API, VK и виджете на WordPress. Менеджер получает уведомление: «Новый лид: капремонт, 68 м², вилка 1,2–1,6 млн ₽».</p>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section" id="kontrol">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">После договора</span>
        <h2>Контроль проектов и документов с AI</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Статусы объектов и напоминания</h3>
          <p><strong>AI контроль проектов</strong> — чек-лист этапов, напоминания бригадиру и клиенту, фото-отчёты через бот, дашборд для руководителя. Модуль подключается как upsell после базового пакета «квиз + смета + CRM».</p>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Документы, акты и сметные таблицы</h3>
          <p>Генерация шаблонов актов и КС-2/КС-3, сверка фактических объёмов с предварительной сметой. Capital Group: пилоты ИИ в тендерной документации — измерение → масштаб.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="keisy">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Доказательства</span>
        <h2>Кейсы внедрения AI в строительстве</h2>
        <p>Российские референсы для ориентира. Для бригады 5–10 человек: до — ~4 часа на заявку; после — ~25 минут активного времени команды.</p>
      </div>

      <div class="astr-case-grid nero-ai-reveal">
        <div class="astr-case-card"><div class="astr-case-tag">ГК «Самолёт»</div><h3>LLM для ВОР и смет</h3><p>До −85% времени на ВОР, до −30% на расчёт себестоимости. <a href="https://yandex.cloud/ru/blog/posts/2025/04/technologies-in-construction" target="_blank" rel="noopener noreferrer">Yandex Cloud</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">Пазл Дом · ИТМО</div><h3>AI-ассистент ИЖС</h3><p>Смета за ~6,5 сек.; ипотека: с 2–3 нед. до 22 ч. <a href="https://www.cnews.ru/news/line/2026-04-20_startap_magistranta_itmo" target="_blank" rel="noopener noreferrer">CNews</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">October Group</div><h3>AI LAB: боты первой линии</h3><p>Структурированная передача брифа менеджеру. <a href="https://www.cnews.ru/articles/2026-02-24_pochemu_developery_stanovyatsya_ai-kompaniyami" target="_blank" rel="noopener noreferrer">CNews</a></p></div>
        <div class="astr-case-card"><div class="astr-case-tag">Международный контекст</div><h3>Agitech · Boon AI</h3><p>AI quantity takeoff за &lt;30 мин вместо 2–3 дней; обработано 66 000+ страниц чертежей.</p></div>
      </div>

      <div class="astr-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="astr-table">
          <thead><tr><th>Метрика</th><th>Как измерять</th></tr></thead>
          <tbody>
            <tr><td>Время первого ответа</td><td>От заявки до первого содержательного ответа</td></tr>
            <tr><td>Время предварительной сметы</td><td>От полного брифа до отправки вилки</td></tr>
            <tr><td>Конверсия заявка → замер</td><td>% лидов, дошедших до выезда</td></tr>
            <tr><td>Нагрузка на сметчика</td><td>Часы на типовые расчёты в неделю</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="astr-section" id="ceny">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Коммерция</span>
        <h2>Стоимость внедрения AI для строительства</h2>
        <p><strong>AI для строительства под ключ</strong> от Nero Network: аудит → квиз → ассистент → интеграции → запуск. Ориентир <strong>180–600 тыс. ₽</strong>.</p>
      </div>

      <div class="astr-price-grid nero-ai-reveal">
        <div class="astr-price-card">
          <h3>Старт</h3>
          <div class="price">от 180 тыс. ₽</div>
          <p>Квиз + AI-бриф + CRM (1 канал)</p>
        </div>
        <div class="astr-price-card featured">
          <h3>Бизнес</h3>
          <div class="price">300–450 тыс. ₽</div>
          <p>+ мессенджеры + предварительная смета + 2 CRM-интеграции</p>
        </div>
        <div class="astr-price-card">
          <h3>Полный</h3>
          <div class="price">до 600 тыс. ₽</div>
          <p>+ контроль объектов + дашборд + сопровождение 3 мес.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под вашу строительную компанию</p>
          <p class="ym-cta-block__sub">Ориентир 180–600 тыс. ₽ за внедрение под ключ. На консультации оценим каналы заявок, объём смет и интеграции с CRM — бесплатно.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="etapy">
    <div class="astr-cnt">
      <div class="astr-sh astr-left nero-ai-reveal">
        <span class="astr-eyebrow">Под ключ</span>
        <h2>Как внедрить AI для строительства: этапы под ключ</h2>
        <p>Базовый пакет — 3–4 недели: аудит → квиз + ассистент → интеграции → калибровка.</p>
      </div>

      <div class="astr-card nero-ai-reveal">
        <div class="astr-timeline">
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Аудит заявок и смет (неделя 1)</h3><p>Карта каналов, шаблоны смет, этапы воронки, типовые вопросы клиентов. Результат — ТЗ на квиз и список веток сценариев.</p></div>
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Сборка квиза и обучение ассистента (недели 2–3)</h3><p>Многошаговая форма с ветками, LLM + RAG из прайса, tool-calling для расчёта, PDF «Предварительное КП», тест на 10–15 реальных сценариях.</p></div>
          <div class="astr-tl-item"><div class="astr-tl-dot"></div><h3>Запуск и сопровождение (неделя 4+)</h3><p>CRM-коннектор, A/B тест вопросов, калибровка вилки по 20–30 сметам, модерация AI 2–4 недели, обучение менеджеров.</p></div>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта проекта?</p>
          <p class="ym-cta-block__sub">Перед внедрением квиза и ассистента полезно разобраться в промптах, RAG и human-in-the-loop. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a> — это ускоряет согласование ТЗ и снижает риски на этапе пилота.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="astr-section" id="arhitektura">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Архитектура</span>
        <h2>Архитектура решения: как устроен AI-ассистент</h2>
      </div>
      <div class="astr-flow-diagram nero-ai-reveal" aria-label="Схема контура Nero Network">Сайт / Telegram / WhatsApp
        ↓
   AI-квиз (7–12 вопросов)
        ↓
   LLM-агент + RAG (прайс, типовые сметы)
        ↓
   Калькулятор предварительной сметы
        ↓
   PDF/Excel «Предварительное КП» + дисклеймер
        ↓
   amoCRM / Битрикс24 (лид + бриф + файл)
        ↓
   Уведомление менеджеру (Telegram / email)
        ↓
   Сметчик верифицирует после замера → финальное КП</div>

      <div class="astr-table-wrap nero-ai-reveal">
        <table class="astr-table">
          <thead><tr><th>Компонент</th><th>Варианты</th></tr></thead>
          <tbody>
            <tr><td>AI-модель</td><td>OpenAI GPT-4o/Agents, Claude, YandexGPT/GigaChat (152-ФЗ)</td></tr>
            <tr><td>RAG-база</td><td>Google Sheets, Notion, PDF прайсы → векторное хранилище</td></tr>
            <tr><td>CRM</td><td>amoCRM, Битрикс24, 1С (номенклатура)</td></tr>
            <tr><td>Мессенджеры</td><td>Telegram, WhatsApp Business API, VK</td></tr>
            <tr><td>Автоматизация</td><td>n8n, Make.com — маршрутизация, напоминания</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="dlya-kogo">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит и для кого нет</h2>
      </div>
      <div class="astr-grid-2 nero-ai-reveal">
        <div class="astr-card">
          <h3>Подходит</h3>
          <ul>
            <li>Ремонтные компании и бригады (3–50 человек)</li>
            <li>Строители домов и коттеджей (ИЖС)</li>
            <li>Отделочные и инженерные подрядчики</li>
            <li>Бизнес с потоком заявок с сайта, Авито, ЦИАН, VK</li>
            <li>Компании, где сметчик — узкое горлышко воронки</li>
          </ul>
        </div>
        <div class="astr-card nero-ai-delay-1">
          <h3>Не подходит (пока)</h3>
          <ul>
            <li>Девелоперы с BIM и сотнями позиций ВОР</li>
            <li>Компании без прайса и типовых смет</li>
            <li>Бизнес с 1–2 заявками в месяц</li>
            <li>Ожидание официальной сметы по ГЭСН/ФЕР в один клик</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="astr-section" id="faq">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">FAQ</span>
        <h2>FAQ по AI для строительных компаний</h2>
      </div>
      <div class="astr-faq nero-ai-reveal" id="astr-faq-list">
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Насколько точна предварительная смета?</div><div class="astr-faq-a">AI-смета даёт ориентировочную вилку на основе прайса и ответов квиза. Точность на типовых объектах — порядка 80–85%. Финальный расчёт после замера всегда делает сметчик. В каждом КП — дисклеймер: не является официальным сметным документом по ГЭСН/ФЕР.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли CRM для старта?</div><div class="astr-faq-a">Желательна, но не обязательна на этапе пилота. Минимальный контур — квиз + AI + email/Telegram-уведомление. CRM подключается на 2–3 неделе внедрения.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Сроки внедрения</div><div class="astr-faq-a">Базовый пакет — 3–4 недели: аудит (1 нед.) → квиз + ассистент (1–2 нед.) → интеграции + запуск (1 нед.) → калибровка. Расширенный пакет с контролем объектов — до 6 недель.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">AI для строительства для малого бизнеса — реально?</div><div class="astr-faq-a">Да. Пакет «Старт» от 180 тыс. ₽ рассчитан на бригаду 3–10 человек. Окупаемость считается через экономию времени сметчика и рост конверсии заявка → замер.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">152-ФЗ и данные в облаке?</div><div class="astr-faq-a">Для компаний с требованиями к хранению данных — варианты GigaChat/YandexGPT и on-prem развёртывание. Обсуждается на этапе аудита.</div></div>
        <div class="astr-faq-item"><div class="astr-faq-q" role="button" tabindex="0" aria-expanded="false">Чем Nero Network отличается от Constract.io и ПРОСТОСМЕТА?</div><div class="astr-faq-a">SaaS-сметчики считают по своим расценкам и не закрывают воронку (заявки, CRM, мессенджеры). Nero собирает кастомный контур под ваш бренд и процессы — квиз, AI, CRM, контроль.</div></div>
      </div>
    </div>
  </section>

  <section class="astr-section astr-section-alt" id="kviz">
    <div class="astr-cnt">
      <div class="astr-sh nero-ai-reveal">
        <span class="astr-eyebrow">Демо</span>
        <h2>Соберите AI-квиз для вашего типа объекта</h2>
        <p>Посмотрите, как ассистент уточняет заявку и формирует предварительную смету — три шага демо-воронки.</p>
      </div>
      <div class="astr-kviz-demo nero-ai-reveal">
        <div class="astr-kviz-steps" aria-hidden="true">
          <span class="astr-kviz-step active">1. Тип объекта</span>
          <span class="astr-kviz-step">2. Площадь и работы</span>
          <span class="astr-kviz-step">3. Вилка стоимости</span>
        </div>
        <p><strong>Шаг 1:</strong> Клиент выбирает «Квартира 68 м² · капитальный ремонт» — AI ветвит сценарий вопросов по зонам и срокам.</p>
        <p><strong>Шаг 2:</strong> Система подставляет расценки из RAG-базы вашего прайса, не из чужого калькулятора.</p>
        <p><strong>Шаг 3:</strong> Клиент видит вилку 1,2–1,6 млн ₽ с дисклеймером; карточка лида уходит в amoCRM со статусом «требует проверки сметчиком».</p>
        <div style="margin-top:24px;text-align:center;">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Собрать AI-квиз</a>
        </div>
      </div>
      <p class="nero-ai-reveal" style="margin-top:28px;text-align:center;max-width:720px;margin-left:auto;margin-right:auto;"><strong>Итог:</strong> Nero Network внедряет AI-ассистент для строительной компании под ключ за 3–4 недели. Ориентир бюджета — <strong>180–600 тыс. ₽</strong>.</p>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->
'''


def php_footer() -> str:
    return r'''
<script>
(function(){
  document.querySelectorAll('.astr-faq-q').forEach(function(q){
    function toggle(){
      var item=q.parentElement;
      var open=item.classList.contains('open');
      document.querySelectorAll('.astr-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.astr-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');q.setAttribute('aria-expanded','true');}
    }
    q.addEventListener('click',toggle);
    q.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();toggle();}});
  });
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''


def main() -> None:
    handoff_text = HANDOFF.read_text(encoding="utf-8")
    hero = extract_codeblock_after(handoff_text, "## HTML-фрагмент hero")
    boris = extract_codeblock_after(handoff_text, "**ВНИМАНИЕ для Наташи:** блок содержит")

    body = content_html().replace("<!-- BORIS_BLOCK -->", boris)

    php = (
        php_header()
        + page_css()
        + '\n<main id="primary" class="site-main nero-ai-home-page ai-dlya-stroitelstva-page astr-page" role="main" tabindex="-1">\n\n'
        + hero
        + "\n\n"
        + body
        + "\n</main>\n\n"
        + php_footer()
    )

    OUT_PHP.parent.mkdir(parents=True, exist_ok=True)
    OUT_PHP.write_text(php, encoding="utf-8")

    # HTML для handoff (без PHP-обёртки header/footer, но с main)
    html_for_handoff = (
        page_css()
        + '\n<main id="primary" class="site-main nero-ai-home-page ai-dlya-stroitelstva-page astr-page" role="main" tabindex="-1">\n\n'
        + hero
        + "\n\n"
        + body.replace("<?php echo esc_url($primary_cta_url); ?>", "${PRIMARY_CTA_URL}")
        .replace("<?php echo $primary_cta_attrs; ?>", ' target="_blank" rel="noopener noreferrer"')
        .replace("<?php echo esc_html($primary_cta_label); ?>", "${PRIMARY_CTA_LABEL}")
        .replace("<?php echo esc_url($secondary_cta_url); ?>", "${SECONDARY_CTA_URL}")
        .replace("<?php echo esc_html($secondary_cta_label); ?>", "${SECONDARY_CTA_LABEL}")
        + "\n</main>\n"
    )

    natasha_block = f"""
=== НАТАША (HTML СТРАНИЦЫ) ===
Статус: ✅ ГОТОВО
SLUG: ai-dlya-stroitelstva
ВНИМАНИЕ: контент содержит <script> и <canvas> — при публикации обернуть в <!-- wp:html -->

## Структура страницы
- `#hero` — Hero Алины (`.nero-ai-hero.astr-hero-stroy`, canvas `astr-stroy-hero-canvas`)
- `#intro` — введение (лид слева + KPI-чипы справа)
- `.astr-toc` — оглавление по центру
- `#zachem` — Зачем строительной компании AI-ассистент
- `#kak-rabotaet` — Как работает AI-квиз + CTA `#cta-kviz`
- `#ai-dlya-stroitelstva-boris-block` — блок Бориса (canvas `bst-quiz-estimate-canvas`)
- `#scenarii` — Сценарии (+ `<!-- INTERNAL-LINKS:INSERT -->`)
- `#integracii`, `#kontrol`, `#keisy`, `#ceny` (+ `#cta-ceny`), `#etapy` (+ `#cta-obuchenie`)
- `#arhitektura`, `#dlya-kogo`, `#faq`, `#kviz` (демо-квиз)
- `<!-- SCHEMA-MARKUP:INSERT -->` перед `</main>`

## Полный HTML

```html
{html_for_handoff.strip()}
```

## Передача пайплайну
SLUG: ai-dlya-stroitelstva
JSON-LD готовит **schema-markup** после Наташи; оставь `<!-- SCHEMA-MARKUP:INSERT -->` перед `</main>`.
Внутренние ссылки готовит **internal-linker** после schema-markup; оставь `<!-- INTERNAL-LINKS:INSERT -->` в теле лонгрида (1–2 места).
При пересборке проверяй, что ссылки из internal-linker вставлены **естественно** и не ломают текст.
Контент содержит <script> (hero engine + Борис + reveal + FAQ) и <canvas> (2 шт.: hero + Борис).

## Передача Юре
SLUG: ai-dlya-stroitelstva
Файл шаблона: `wordpress-theme/page-ai-dlya-stroitelstva.php`
ВНИМАНИЕ: контент содержит `<script>` и `<canvas>` — публикация через SSH/SCP как `page-ai-dlya-stroitelstva.php` в активную тему; обернуть в `<!-- wp:html -->` при необходимости.
ПАЙПЛАЙН: Наташа готов → следующий шаг: schema-markup → internal-linker → Юра
"""

    if "=== НАТАША (HTML СТРАНИЦЫ) ===" in handoff_text:
        handoff_text = re.sub(
            r"\n=== НАТАША \(HTML СТРАНИЦЫ\) ===.*",
            natasha_block.strip(),
            handoff_text,
            flags=re.DOTALL,
        )
    else:
        handoff_text = handoff_text.rstrip() + "\n" + natasha_block.strip() + "\n"

    HANDOFF.write_text(handoff_text, encoding="utf-8")

    size = OUT_PHP.stat().st_size
    print(f"OK: {OUT_PHP} ({size} bytes)")


if __name__ == "__main__":
    main()
