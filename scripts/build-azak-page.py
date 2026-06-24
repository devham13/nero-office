#!/usr/bin/env python3
"""Build page-ai-zayavki-avito-cian-klassifaidy.php from handoff fragments."""
from __future__ import annotations

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
HANDOFF = ROOT / ".cursor/nero-network-handoff.md"
OUT = ROOT / "wordpress/page-ai-zayavki-avito-cian-klassifaidy.php"

handoff = HANDOFF.read_text(encoding="utf-8")

alina_start = handoff.find('<section class="nero-ai-hero azak-hero-klassifaidy"')
alina_end = handoff.find("=== БОРИС (БЛОК СТАТЬИ, НЕ HERO) ===")
alina_block = handoff[alina_start:alina_end].strip()
alina_block = re.sub(r"\n## Чеклист отличий.*", "", alina_block, flags=re.S)
alina_block = re.sub(r"\n## Передача Наташе.*", "", alina_block, flags=re.S)

boris_match = re.search(
    r"```html\n(<section id=\"ai-zayavki-avito-cian-klassifaidy-boris-block\".*?</section>)\n```",
    handoff,
    re.S,
)
boris_block = boris_match.group(1) if boris_match else ""

# Hero CTA placeholders → PHP (keep structure, Natasha/Yura wire env in PHP)
alina_block = alina_block.replace(
    '<a class="nero-ai-btn nero-ai-btn-primary" href="#cta-final">Собрать заявки в одну воронку</a>',
    '<a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>',
)

PHP_HEAD = r'''<?php
/**
 * Template Name: AI-агент для заявок с Авито, Циан и классифайдов: внедрение под ключ
 * Slug: ai-zayavki-avito-cian-klassifaidy
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для заявок с Авито, Циан: внедрение под ключ';
$page_seo_description = 'Внедряем AI-агента для заявок с Авито, Циан и классифайдов: единая воронка лидов, диалог с клиентом, сделка в CRM без потерь в мессенджерах. Кейсы, цены, аудит.';

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

$brand               = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Собрать заявки в одну воронку';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по AI-автоматизации';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#';

$nero_ai_header_links = [
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'CRM',          'href' => '#integraciya-crm'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(['nero-ai-longread-ui-compat.css']); ?>

<style>
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

.azak-hero-klassifaidy {
  min-height: 100vh;
  min-height: 100dvh;
  position: relative;
}

.azak-content{
  --azak-bg:#050711;--azak-bg2:#080b17;
  --azak-text:#e6edf7;--azak-muted:#9aa8bd;--azak-soft:#c7d2e5;--azak-heading:#fff;
  --azak-border:rgba(255,255,255,.10);
  --azak-primary:#79f2ff;--azak-violet:#8b5cf6;--azak-green:#22c55e;
  --azak-avito:#00aaff;--azak-cian:#0468ff;--azak-youla:#ff4081;
  --azak-btn-from:#2563eb;--azak-btn-to:#7c3aed;
  --azak-container:1220px;--azak-r:18px;--azak-r-lg:24px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--azak-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.azak-content *,.azak-content *::before,.azak-content *::after{box-sizing:border-box;}
.azak-content a{color:inherit;}
.azak-content p{color:var(--azak-muted);line-height:1.72;margin:0 0 1em;text-align:left!important;}
.azak-content p:last-child{margin-bottom:0;}
.azak-content h2,.azak-content h3,.azak-content h4{color:var(--azak-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.azak-content strong{color:var(--azak-soft);}
.azak-content ul,.azak-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.azak-content ul li,.azak-content ol li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--azak-muted);font-size:14.5px;line-height:1.65;text-align:left!important;}
.azak-content ul li::before{content:'›';position:absolute;left:0;color:var(--azak-primary);font-weight:700;}
.azak-content ol{counter-reset:azak-ol;}
.azak-content ol li{counter-increment:azak-ol;padding-left:28px;}
.azak-content ol li::before{content:counter(azak-ol) '.';position:absolute;left:0;color:var(--azak-primary);font-weight:700;}
.azak-cnt{width:min(var(--azak-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.azak-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.azak-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.azak-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.azak-sh.azak-left{margin-left:0;text-align:left;}
.azak-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.azak-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;text-align:left!important;}
.azak-sh.azak-left p{margin-left:0;}
.azak-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--azak-primary);margin-bottom:14px;}
.azak-gt{background:linear-gradient(92deg,#fff 0%,var(--azak-primary) 44%,var(--azak-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.azak-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.azak-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.azak-intro-text{position:relative;padding-left:20px;text-align:left!important;}
.azak-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--azak-primary),var(--azak-violet));}
.azak-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--azak-muted);margin-bottom:1em;}
.azak-intro-text p:last-child{margin-bottom:0;color:var(--azak-soft);}
.azak-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.azak-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.azak-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--azak-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.azak-kpi-card .kl{font-size:11px;font-weight:600;color:var(--azak-muted);line-height:1.4;}
.azak-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
@media(max-width:900px){.azak-intro-grid{grid-template-columns:1fr;gap:36px;}.azak-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:600px){.azak-intro-kpi{grid-template-columns:1fr 1fr;}}
.azak-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.azak-toc,.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.azak-toc a,.ym-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--azak-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--azak-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.azak-toc a:hover,.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--azak-primary);background:rgba(121,242,255,.08);}
.azak-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--azak-border);border-radius:var(--azak-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);}
.azak-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.azak-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:768px){.azak-grid-2,.azak-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.azak-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.azak-grid-3{grid-template-columns:1fr;}}
.azak-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--azak-r);padding:26px;margin-bottom:14px;}
.azak-scenario:last-child{margin-bottom:0;}
.azak-scenario h3{font-size:17px;margin-bottom:8px;}
.azak-scenario p{font-size:14.5px;margin:0 0 .6em;text-align:left!important;}
.azak-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.azak-table{width:100%;border-collapse:collapse;font-size:14px;}
.azak-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--azak-primary);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap;}
.azak-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--azak-text);vertical-align:top;text-align:left!important;}
.azak-table tr:last-child td{border-bottom:none;}
.azak-table tr:hover td{background:rgba(255,255,255,.03);}
.azak-code{background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px 18px;font-family:ui-monospace,monospace;font-size:13px;color:var(--azak-soft);overflow-x:auto;margin:20px 0;text-align:left!important;}
.azak-timeline{position:relative;padding-left:40px;}
.azak-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--azak-primary),var(--azak-violet));opacity:.35;border-radius:2px;}
.azak-tl-item{position:relative;margin-bottom:32px;}
.azak-tl-item:last-child{margin-bottom:0;}
.azak-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--azak-primary);box-shadow:0 0 0 4px rgba(121,242,255,.2);}
.azak-tl-item h3{font-size:17px;margin-bottom:8px;}
.azak-tl-item p{font-size:14.5px;margin:0;text-align:left!important;}
.azak-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
@media(max-width:900px){.azak-case-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.azak-case-grid{grid-template-columns:1fr;}}
.azak-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;}
.azak-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--azak-green);margin-bottom:10px;}
.azak-case-card h3{font-size:16px;margin-bottom:14px;}
.azak-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.azak-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.azak-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--azak-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;text-align:left!important;}
.azak-faq-q::after{content:'▾';font-size:13px;color:var(--azak-primary);flex-shrink:0;transition:transform .25s;}
.azak-faq-item.open .azak-faq-q::after{transform:rotate(180deg);}
.azak-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--azak-muted);line-height:1.72;text-align:left!important;}
.azak-faq-item.open .azak-faq-a{max-height:600px;padding:0 24px 20px;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--azak-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;text-align:left!important;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--azak-btn-from),var(--azak-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--azak-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--azak-primary)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-zayavki-avito-cian-klassifaidy-page" role="main" tabindex="-1">

'''

PHP_TAIL = r'''
  <!-- INTERNAL-LINKS:INSERT -->
  <!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
document.querySelectorAll('.azak-faq-q').forEach(function(q){
  q.addEventListener('click',function(){
    var item=q.closest('.azak-faq-item');
    if(item) item.classList.toggle('open');
  });
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

CONTENT = r'''
<div class="azak-content">

<section class="azak-intro" id="vvedenie">
  <div class="azak-cnt">
    <div class="azak-intro-grid nero-ai-reveal">
      <div class="azak-intro-text">
        <p><strong>Коротко:</strong> Nero Network внедряет task-specific AI-агента, который принимает заявки с Авито, Циан, Юла и других классифайдов, ведёт первичный диалог, квалифицирует лид и создаёт сделку в CRM — без потерь между мессенджерами площадок и вашей воронкой.</p>
        <p>Единая воронка лидов из классифайдов — когда все обращения с Avito, Циан, Юла попадают в одну CRM с едиными правилами маршрутизации, SLA и аналитикой по источникам.</p>
      </div>
      <div class="azak-intro-kpi" aria-label="KPI воронки классифайдов">
        <div class="azak-kpi-card"><div class="kv">12 сек</div><div class="kl">Первый ответ AI</div><div class="ks">speed-to-lead</div></div>
        <div class="azak-kpi-card"><div class="kv">3</div><div class="kl">Площадки в одной CRM</div><div class="ks">Avito · Циан · Юла</div></div>
        <div class="azak-kpi-card"><div class="kv">402</div><div class="kl">Чек-лист Avito API</div><div class="ks">тариф до старта</div></div>
        <div class="azak-kpi-card"><div class="kv">4–6</div><div class="kl">Недель внедрения</div><div class="ks">под ключ</div></div>
      </div>
    </div>
  </div>
</section>

<div class="azak-toc-outer">
  <div class="azak-cnt">
    <nav class="ym-toc azak-toc nero-ai-reveal nero-ai-delay-1" aria-label="Оглавление страницы">
      <a href="#pochemu-teryautsya">Почему теряются</a>
      <a href="#chto-takoe-ai-agent">Что такое AI-агент</a>
      <a href="#kak-rabotaet">Как работает</a>
      <a href="#integraciya-crm">CRM</a>
      <a href="#scenarii-nishi">Ниши</a>
      <a href="#etapy">Внедрение</a>
      <a href="#ceny">Стоимость</a>
      <a href="#keisy">Кейсы</a>
      <a href="#faq">FAQ</a>
    </nav>
  </div>
</div>

<section class="azak-section" id="pochemu-teryautsya">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Проблема</span>
      <h2>Почему заявки с Авито, Циан и других классифайдов теряются</h2>
      <p>Заявки приходят из разных площадок — и уже на этом этапе начинается хаос. Менеджер открывает ЛК Авито, переключается в чат Циан, проверяет Юлу, параллельно отвечает в WhatsApp и Telegram.</p>
    </div>
    <div class="nero-ai-reveal nero-ai-delay-1">
      <p><strong>Определение:</strong> единая воронка лидов из классифайдов — это когда все обращения с Avito, Циан, Юла и смежных площадок попадают в одну CRM-систему с едиными правилами маршрутизации, SLA и аналитикой по источникам.</p>

      <h3>Типичные точки потерь: площадка → мессенджер → CRM</h3>
      <ol>
        <li><strong>Задержка первого ответа.</strong> Клиент написал в чат Авито в 19:00, менеджер увидел утром.</li>
        <li><strong>Ручное копирование.</strong> Сообщение остаётся в мессенджере площадки, сделка в CRM не создаётся.</li>
        <li><strong>«Универсальный диспетчер».</strong> Клиент попадает не к агенту объекта — теряет доверие (кейс АН «Итака»).</li>
        <li><strong>Конкуренция за одного клиента.</strong> Несколько менеджеров видят одно обращение в разных вкладках.</li>
      </ol>
      <p>По данным Циан.Журнал (апрель 2026), в АН «Итака» <strong>в январе 2026 обращений в чатах впервые стало больше, чем звонков</strong>.</p>

      <h3>Карта потерь по источникам лидов</h3>
      <p><strong>Лид-магнит Nero Network:</strong> «Карта потерь по источникам лидов» — чек-лист, который показывает, на каком шаге теряется каждый канал.</p>
      <div class="azak-table-wrap">
        <table class="azak-table">
          <thead><tr><th>Этап</th><th>Где ломается</th><th>Что измерять</th></tr></thead>
          <tbody>
            <tr><td>Площадка → webhook</td><td>Нет API / неверный тариф Avito (402)</td><td>% сообщений без доставки в систему</td></tr>
            <tr><td>Webhook → первый ответ</td><td>Нет AI, менеджер офлайн</td><td>Время первого ответа (мин)</td></tr>
            <tr><td>Диалог → квалификация</td><td>Нет скрипта, «оставьте телефон»</td><td>% лидов без бюджета/срока</td></tr>
            <tr><td>Квалификация → CRM</td><td>Нет интеграции</td><td>% чатов без сделки</td></tr>
            <tr><td>CRM → менеджер</td><td>Нет SLA, нет эскалации</td><td>% лидов без контакта &gt; N часов</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <aside class="ym-cta-block ym-cta-block--primary nero-ai-reveal" id="cta-karta-poter">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Узнайте, где теряются заявки с классифайдов</p>
        <p class="ym-cta-block__sub">Бесплатная «Карта потерь по источникам лидов»: покажем, на каком шаге между Авито, Циан, Юла и CRM уходит каждый канал — и что можно автоматизировать уже на аудите.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </aside>
  </div>
</section>

<section class="azak-section azak-section-alt" id="chto-takoe-ai-agent">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Решение</span>
      <h2>Что такое AI-агент для обработки заявок с классифайдов</h2>
      <p><strong>AI заявки Авито</strong> — это не «бот с шаблонными фразами». Речь о программном слое между мессенджерами площадок и CRM.</p>
    </div>
    <div class="nero-ai-reveal nero-ai-delay-1">
      <ul>
        <li>принимает сообщения с Avito, Циан, Юла;</li>
        <li>отвечает по существу вопроса с контекстом объявления;</li>
        <li>задаёт 2–4 уточняющих вопроса (бюджет, срок, регион, формат);</li>
        <li>создаёт/обновляет сделку в amoCRM, Bitrix24 или другой CRM;</li>
        <li>передаёт менеджеру «горячий» лид с саммари, а не сырой чат.</li>
      </ul>

      <h3>Чем AI-менеджер Авито отличается от автоответчика</h3>
      <div class="azak-table-wrap">
        <table class="azak-table">
          <thead><tr><th>Критерий</th><th>Автоответчик</th><th>AI-менеджер Avito</th></tr></thead>
          <tbody>
            <tr><td>Контекст объявления</td><td>Нет</td><td>Да: цена, категория, регион</td></tr>
            <tr><td>Квалификация</td><td>«Оставьте телефон»</td><td>BANT-lite: бюджет, срок, intent</td></tr>
            <tr><td>CRM</td><td>Часто вручную</td><td>Автосоздание сделки + поля</td></tr>
            <tr><td>Скоринг</td><td>Нет</td><td>hot / warm / cold / spam</td></tr>
            <tr><td>Эскалация</td><td>Нет</td><td>Передача человеку по правилам</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Task-specific AI agent для источников трафика (Gartner 2026)</h3>
      <p>Gartner прогнозирует: к концу 2026 года <strong>40% enterprise-приложений</strong> получат task-specific AI agents. Для классифайдов: один агент = один процесс «лид с площадки → квалификация → сделка в CRM».</p>
      <p><strong>Баланс ожиданий:</strong> более 40% agentic AI-проектов могут быть отменены к 2027 — поэтому проектируем агента под конкретную воронку с измеримыми метриками.</p>
    </div>
  </div>
</section>

BORIS_PLACEHOLDER

<section class="azak-section" id="kak-rabotaet">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Архитектура</span>
      <h2>Как работает AI на Авито, Циан и других площадках</h2>
      <p><strong>AI обработка заявок Авито</strong> и <strong>автоматизация заявок Циан</strong> строятся на одной архитектуре.</p>
    </div>
    <div class="azak-code nero-ai-reveal">Клиент → чат площадки → webhook (&lt; 2 сек ACK) → AI-диалог → CRM-сделка → менеджер</div>

    <h3 class="nero-ai-reveal nero-ai-delay-1">Приём заявки и первичный диалог</h3>
    <ol class="nero-ai-reveal nero-ai-delay-1">
      <li>Клиент пишет в чат по объявлению на Avito, Циан или Юле.</li>
      <li>Площадка отправляет webhook на middleware. Для Avito: ответ <strong>200 OK ≤ 2 секунд</strong>.</li>
      <li>AI отправляет первый ответ <strong>по существу вопроса</strong> — не «оставьте телефон» сразу.</li>
    </ol>

    <h3>Уточнение потребности и квалификация лида</h3>
    <p>AI задаёт 2–4 вопроса по BANT-lite: бюджет, срок, формат, регион. На выходе — structured JSON: intent, budget, timeline, score, status (hot/warm/cold/spam).</p>

    <h3>Создание сделки и задач в CRM</h3>
    <ul>
      <li>создаёт или обновляет сделку с UTM/источником (Avito / Циан / Юла);</li>
      <li>заполняет custom fields: ai_summary, ai_score, platform_chat_url;</li>
      <li>ставит задачу менеджеру при score ≥ threshold;</li>
      <li>эскалирует человеку при негативе, торге, юридически значимых вопросах.</li>
    </ul>
  </div>
</section>

<section class="azak-section azak-section-alt" id="integraciya-crm">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Интеграции</span>
      <h2>Интеграция с CRM: amoCRM, Bitrix24 и другие</h2>
      <p><strong>AI заявки Авито интеграция CRM</strong> — CRM остаётся системой учёта; AI — надстройка.</p>
    </div>

    <h3>Маршрутизация лидов по источнику (Авито / Циан / Юла)</h3>
    <div class="azak-table-wrap nero-ai-reveal">
      <table class="azak-table">
        <thead><tr><th>Площадка</th><th>Доступ к API</th><th>Стоимость API</th><th>Ключевые ограничения</th></tr></thead>
        <tbody>
          <tr><td><strong>Avito</strong></td><td>Тарифы «Базовый», «Расширенный», «Максимальный»</td><td>Платная подписка с API мессенджера</td><td>Без подписки — <strong>402</strong> на read/write</td></tr>
          <tr><td><strong>Циан</strong></td><td>Агентства, риелторы, застройщики</td><td><strong>Бесплатно</strong></td><td>ACCESS KEY в ЛК или import@cian.ru</td></tr>
          <tr><td><strong>Юла</strong></td><td>Только <strong>бизнес-аккаунт</strong></td><td>По договору</td><td>Токен у персонального менеджера Юлы</td></tr>
        </tbody>
      </table>
    </div>

    <h3>Поля сделки, теги и SLA по площадкам</h3>
    <ul class="nero-ai-reveal">
      <li><strong>Источник:</strong> avito / cian / youla / auto_ru / drom</li>
      <li><strong>ID объявления и ссылка на чат площадки</strong></li>
      <li><strong>AI-score</strong> (0–100) и статус hot/warm/cold/spam</li>
      <li><strong>AI-summary</strong> — краткое саммари диалога</li>
      <li><strong>Время первого ответа</strong> — для дашборда «карта потерь»</li>
    </ul>
  </div>
</section>

<section class="azak-section" id="scenarii-nishi">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Ниши</span>
      <h2>Сценарии по нишам: недвижимость, авто, услуги, аренда</h2>
    </div>
    <div class="azak-grid-3">
      <div class="azak-scenario nero-ai-reveal">
        <h3>Агентства недвижимости и застройщики</h3>
        <p><strong>AI агент Циан</strong> — приоритетный канал: бесплатный API, глубокая интеграция чатов. Модель «Итака»: AI обрабатывает типовые запросы, профильный агент подключается к экспертизе по объекту.</p>
      </div>
      <div class="azak-scenario nero-ai-reveal nero-ai-delay-1">
        <h3>Автодилеры и сервисы</h3>
        <p>На Avito и Auto.ru AI квалифицирует: марка/модель, бюджет, trade-in, срок покупки. Кейс «Логема»: <strong>+25% скорость сбора лидов</strong>.</p>
      </div>
      <div class="azak-scenario nero-ai-reveal nero-ai-delay-2">
        <h3>Локальные услуги и мастера</h3>
        <p>Быстрый ответ на «сколько стоит» и «когда можете», сбор адреса и срока, создание сделки в CRM. Кейс «А-Мебель»: единое окно Avito, Юлы и сайта в Bitrix24.</p>
      </div>
    </div>
  </div>
</section>

<section class="azak-section azak-section-alt" id="etapy">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">Процесс</span>
      <h2>Внедрение AI заявки Авито под ключ: этапы и сроки</h2>
      <p>Типовой проект: <strong>4–6 недель</strong> с измеримым результатом на каждом этапе.</p>
    </div>
    <div class="azak-timeline nero-ai-reveal">
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>Аудит источников и API площадок</h3><p>Чек-лист Avito (402), Циан ACCESS KEY, Юла бизнес-аккаунт, CRM-схема, 152-ФЗ. Результат — «Карта потерь» и ТЗ.</p></div>
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>Настройка сценариев и интеграции</h3><p>Middleware, коннекторы площадок, AI Orchestrator, CRM Adapter, human handoff, дашборд аналитики.</p></div>
      <div class="azak-tl-item"><span class="azak-tl-dot"></span><h3>AI заявки Авито без программиста vs под ключ</h3>
        <div class="azak-table-wrap">
          <table class="azak-table">
            <thead><tr><th>Подход</th><th>Плюсы</th><th>Минусы</th><th>Когда выбирать</th></tr></thead>
            <tbody>
              <tr><td>No-code (Albato, Make)</td><td>Быстрый MVP</td><td>Нет глубокой квалификации</td><td>Тест на Avito</td></tr>
              <tr><td>Агрегатор (Wazzup, i2crm)</td><td>Зеркало чатов в CRM</td><td>Нет AI-слоя</td><td>Только «единое окно»</td></tr>
              <tr><td><strong>Под ключ (Nero Network)</strong></td><td>Avito+Циан+Юла, AI, CRM</td><td>4–6 недель, 150–450 тыс. ₽</td><td>Коммерческая воронка</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <aside class="ym-cta-block ym-cta-block--secondary nero-ai-reveal" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Хотите разобраться в AI-автоматизации сами?</p>
        <p class="ym-cta-block__sub">Если команда хочет понимать n8n, промпты, webhooks классифайдов и human-in-the-loop до старта проекта — посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>. Это помогает быстрее принимать решения на этапе пилота.</p>
      </div>
    </aside>
  </div>
</section>

<section class="azak-section" id="ceny">
  <div class="azak-cnt">
    <div class="azak-sh azak-left nero-ai-reveal">
      <span class="azak-eyebrow">ROI</span>
      <h2>Стоимость, ROI и окупаемость</h2>
    </div>
    <h3>Из чего складывается цена внедрения (ориентир 150–450 тыс. ₽)</h3>
    <div class="azak-table-wrap nero-ai-reveal">
      <table class="azak-table">
        <thead><tr><th>Статья</th><th>Что входит</th></tr></thead>
        <tbody>
          <tr><td>Аудит и ТЗ</td><td>Карта потерь, чек-лист API, схема воронки</td></tr>
          <tr><td>Middleware + коннекторы</td><td>Avito, Циан, Юла, webhook-инфраструктура</td></tr>
          <tr><td>AI-слой</td><td>Промпты, база знаний, скоринг, guardrails</td></tr>
          <tr><td>CRM-интеграция</td><td>Поля, роботы, маршрутизация, SLA</td></tr>
          <tr><td><strong>Отдельно:</strong> тариф Avito с API</td><td>Не входит в стоимость внедрения</td></tr>
        </tbody>
      </table>
    </div>
    <h3>Метрики: скорость ответа, конверсия, доля потерянных лидов</h3>
    <ul>
      <li><strong>Speed-to-lead</strong> — цель: секунды/минуты, не часы.</li>
      <li><strong>Конверсия чат → сделка</strong> — до и после внедрения.</li>
      <li>Ориентиры: «Логема» +25% скорость; «Итака» — чаты обогнали звонки.</li>
    </ul>
  </div>
</section>

<section class="azak-section azak-section-alt" id="keisy">
  <div class="azak-cnt">
    <div class="azak-sh nero-ai-reveal">
      <span class="azak-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения</h2>
    </div>
    <div class="azak-case-grid">
      <div class="azak-case-card nero-ai-reveal">
        <div class="azak-case-tag">Недвижимость</div>
        <h3>АН «Итака» + Циан API</h3>
        <p>Глубокая интеграция чатов Циан в CRM. В январе 2026 чатов стало больше, чем звонков. Урок: гибрид AI + человек.</p>
      </div>
      <div class="azak-case-card nero-ai-reveal nero-ai-delay-1">
        <div class="azak-case-tag">E-commerce</div>
        <h3>«А-Мебель» — Avito, Юла, сайт → B24</h3>
        <p>Единое окно заявок, автоматическое распределение, передача в 1С. До внедрения — «17 вкладок».</p>
      </div>
      <div class="azak-case-card nero-ai-reveal nero-ai-delay-2">
        <div class="azak-case-tag">B2B услуги</div>
        <h3>«Логема» — Avito + Bitrix24</h3>
        <p>+25% скорость сбора лидов; обработка быстрее на 1 час, взаимодействие — на 2 часа.</p>
      </div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:24px;text-align:left!important;"><em>Примечание:</em> публичных кейсов с AI-агентом на Avito+Циан+CRM одновременно пока мало — опираемся на проверенные интеграционные кейсы + проектную модель Nero Network.</p>
  </div>
</section>

<section class="azak-section" id="faq">
  <div class="azak-cnt">
    <div class="azak-sh nero-ai-reveal">
      <span class="azak-eyebrow">FAQ</span>
      <h2>FAQ: AI для заявок с классифайдов</h2>
    </div>
    <div class="azak-faq nero-ai-reveal">
      <div class="azak-faq-item"><div class="azak-faq-q">Что будет, если на Avito нет платной подписки с API мессенджера?</div><div class="azak-faq-a">Без подписки read/write возвращает <strong>402</strong>. Полноценный AI-агент требует платного тарифа — отдельная строка бюджета до старта.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Можно ли обойтись без программиста?</div><div class="azak-faq-a">Для одного канала и зеркалирования — да (Albato, Make). Для AI под ключ с несколькими площадками — нужна проектная интеграция.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">AI заявки Авито под ключ или самостоятельно?</div><div class="azak-faq-a">Самостоятельно — если тестируете один канал. Под ключ — если нужна единая воронка Avito + Циан + Юла с CRM и картой потерь.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Заменит ли AI менеджера?</div><div class="azak-faq-a">Нет. AI — speed-to-lead и квалификация. Человек — торг, показы, юридические нюансы.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Как подключить Циан?</div><div class="azak-faq-a">ACCESS KEY в ЛК или запрос на import@cian.ru. API бесплатен для агентств и застройщиков.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Нужен ли бизнес-аккаунт на Юле?</div><div class="azak-faq-a">Да. API только для бизнес-аккаунта; токен выдаёт персональный менеджер Юлы.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Заблокируют ли аккаунт за бота?</div><div class="azak-faq-a">При официальном API — нет. Эмуляция браузера — нарушение правил Avito.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Как соблюдается 152-ФЗ?</div><div class="azak-faq-a">YandexGPT или GigaChat для хранения данных в РФ. OpenAI/Claude — через прокси с согласованной политикой ПДн.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">Сколько времени занимает внедрение?</div><div class="azak-faq-a">Типовой проект: 4–6 недель — аудит, разработка, пилот и QA.</div></div>
      <div class="azak-faq-item"><div class="azak-faq-q">У нас только Avito / только Циан — имеет смысл?</div><div class="azak-faq-a">Да. Архитектура модульная: старт с одного канала, подключение остальных без переписывания.</div></div>
    </div>

    <aside class="ym-cta-block ym-cta-block--dual nero-ai-reveal" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Собрать заявки в одну воронку</p>
        <p class="ym-cta-block__sub">Nero Network проводит аудит источников лидов и внедряет AI-агента для заявок с Авито, Циан и классифайдов под ключ: от проверки API и тарифов до сделки в CRM и дашборда «карта потерь». Ориентир бюджета — 150–450 тыс. ₽.</p>
        <div class="ym-cta-block__actions">
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
          <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Как проходит внедрение →</a>
        </div>
      </div>
    </aside>
  </div>
</section>

</div>
'''

content = CONTENT.replace("BORIS_PLACEHOLDER", boris_block)

full = PHP_HEAD + alina_block + "\n\n" + content + PHP_TAIL
OUT.write_text(full, encoding="utf-8")
print(f"Wrote {OUT} ({len(full)} chars)")
