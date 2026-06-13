#!/usr/bin/env python3
"""Generate page-vnedrenie-ai-dlya-kliniki.php template."""
from pathlib import Path

OUT = Path(__file__).resolve().parents[1] / "wordpress-theme" / "page-vnedrenie-ai-dlya-kliniki.php"

PHP = r'''<?php
/**
 * Template Name: AI-администратор для клиники: внедрение под ключ
 * Description: SEO-лендинг — AI для клиники: запись, вопросы, напоминания 24/7.
 */

$page_seo_title       = 'AI для клиники под ключ: администратор, запись, напоминания';
$page_seo_description = 'AI для клиники: запись пациентов, ответы на вопросы и напоминания 24/7. Снижаем нагрузку на регистратуру. Расчёт потерь от пропущенных обращений.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta name="keywords" content="ai для клиники, внедрение ai для клиники, ai для клиники под ключ, ai администратор клиники, ai запись пациентов, ai напоминания пациентам" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
	['label' => 'Боли', 'href' => '#boli'],
	['label' => 'Как работает', 'href' => '#kak-rabotaet'],
	['label' => 'Этапы', 'href' => '#etapy'],
	['label' => 'Кейсы', 'href' => '#keisy'],
	['label' => 'Стоимость', 'href' => '#ceny'],
	['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
	$nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Посчитать потери клиники';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url = '#kak-rabotaet';

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
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vkln-content{
  --vkln-bg:#050711;--vkln-text:#e6edf7;--vkln-muted:#9aa8bd;--vkln-soft:#c7d2e5;--vkln-heading:#fff;
  --vkln-border:rgba(255,255,255,.10);--vkln-accent:#2dd4bf;--vkln-teal:#14b8a6;--vkln-violet:#8b5cf6;--vkln-green:#22c55e;
  --vkln-btn-from:#2563eb;--vkln-btn-to:#7c3aed;--vkln-r:18px;--vkln-r-lg:24px;--vkln-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vkln-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vkln-content *,.vkln-content *::before,.vkln-content *::after{box-sizing:border-box}
.vkln-content p{color:var(--vkln-muted);line-height:1.72;margin:0 0 1em}
.vkln-content h2,.vkln-content h3,.vkln-content h4{color:var(--vkln-heading);letter-spacing:-.04em;margin:0 0 .7em}
.vkln-content strong{color:var(--vkln-soft)}
.vkln-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.vkln-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vkln-muted);font-size:14.5px;line-height:1.65}
.vkln-content ul li::before{content:'›';position:absolute;left:0;color:var(--vkln-accent);font-weight:700}
.vkln-cnt{width:min(var(--vkln-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vkln-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vkln-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vkln-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vkln-sh.vkln-left{margin-left:0;text-align:left}
.vkln-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vkln-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vkln-sh.vkln-left p{margin-left:0}
.vkln-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(45,212,191,.08);border:1px solid rgba(45,212,191,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vkln-accent);margin-bottom:14px}
.vkln-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vkln-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vkln-intro-text{position:relative;padding-left:20px}
.vkln-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vkln-accent),var(--vkln-violet))}
.vkln-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vkln-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center}
.vkln-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--vkln-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.vkln-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vkln-muted);line-height:1.4}
@media(max-width:900px){.vkln-intro-grid{grid-template-columns:1fr;gap:36px}.vkln-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.vkln-intro-kpi{grid-template-columns:1fr 1fr}}
.vkln-pain-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vkln-pain-grid{grid-template-columns:1fr}}
.vkln-pain-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:28px 24px;text-align:center;transition:border-color .2s,transform .2s}
.vkln-pain-card:hover{border-color:rgba(45,212,191,.35);transform:translateY(-2px)}
.vkln-pain-num{font-size:clamp(32px,4vw,48px);font-weight:900;color:var(--vkln-accent);letter-spacing:-.04em;line-height:1;margin-bottom:10px}
.vkln-pain-card p{font-size:14px;margin:0}
.vkln-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vkln-border);border-radius:var(--vkln-r-lg);padding:26px;backdrop-filter:blur(16px)}
.vkln-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.vkln-grid-2{grid-template-columns:1fr}}
.vkln-flow{display:flex;flex-direction:column;gap:14px}
.vkln-flow-step{display:grid;grid-template-columns:48px 1fr;gap:16px;padding:20px 22px;background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;transition:border-color .2s,transform .2s}
.vkln-flow-step:hover{border-color:rgba(45,212,191,.35);transform:translateX(4px)}
.vkln-flow-num{width:48px;height:48px;border-radius:12px;background:rgba(45,212,191,.12);border:1px solid rgba(45,212,191,.25);display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--vkln-accent);font-size:18px}
.vkln-flow-step h3{font-size:17px;margin-bottom:6px}
.vkln-flow-step p{font-size:14px;margin:0}
.vkln-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.vkln-table{width:100%;border-collapse:collapse;font-size:14px}
.vkln-table th{padding:13px 16px;text-align:left;background:rgba(45,212,191,.1);color:var(--vkln-accent);font-weight:700;border-bottom:1px solid rgba(45,212,191,.25)}
.vkln-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vkln-text);vertical-align:top}
.vkln-table tr:last-child td{border-bottom:none}
.vkln-timeline{position:relative;padding-left:40px}
.vkln-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vkln-accent),var(--vkln-violet));opacity:.35;border-radius:2px}
.vkln-tl-item{position:relative;margin-bottom:32px}
.vkln-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vkln-accent);box-shadow:0 0 0 4px rgba(45,212,191,.2)}
.vkln-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vkln-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vkln-case-grid{grid-template-columns:1fr}}
.vkln-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vkln-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vkln-green);margin-bottom:10px}
.vkln-callout{background:rgba(45,212,191,.08);border:1px solid rgba(45,212,191,.25);border-radius:16px;padding:24px 28px;margin:24px 0}
.vkln-callout p{margin:0;font-size:15px;color:var(--vkln-soft)}
.vkln-compare{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:24px}
@media(max-width:768px){.vkln-compare{grid-template-columns:1fr}}
.vkln-shield{display:flex;gap:20px;align-items:flex-start}
.vkln-shield-icon{font-size:40px;flex-shrink:0}
.vkln-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vkln-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vkln-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vkln-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.vkln-faq-q::after{content:'▾';font-size:13px;color:var(--vkln-accent);flex-shrink:0;transition:transform .25s}
.vkln-faq-item.open .vkln-faq-q::after{transform:rotate(180deg)}
.vkln-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--vkln-muted);line-height:1.72}
.vkln-faq-item.open .vkln-faq-a{max-height:600px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(45,212,191,.12),rgba(139,92,246,.1));border:1px solid rgba(45,212,191,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(45,212,191,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(45,212,191,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vkln-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--vkln-btn-from),var(--vkln-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35)}
.ym-link--accent{color:var(--vkln-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-dlya-kliniki-page" role="main" tabindex="-1">

<section class="nero-ai-hero" id="hero" aria-labelledby="hero-kliniki-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai для клиники</p>
      <h1 id="hero-kliniki-title">AI-администратор для клиники: <span class="nero-ai-gradient-text">внедрение записи, вопросов и напоминаний под ключ</span></h1>
      <p class="nero-ai-hero-lead">Принимаем звонки и сообщения 24/7, записываем пациентов и снижаем нагрузку на регистратуру — чтобы вы не теряли обращения, когда администраторы не успевают отвечать</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Запись 24/7</li>
        <li class="nero-ai-badge">WhatsApp/Telegram/MAX</li>
        <li class="nero-ai-badge">МИС/CRM</li>
        <li class="nero-ai-badge">Напоминания</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet"><?php echo esc_html($secondary_cta_label); ?></a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: AI-администратор клиники">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Клиника · контактный центр</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title"><h3>AI-регистратура</h3><span class="nero-ai-live-pill">онлайн</span></div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>Входящих</span><strong>47</strong><small>сегодня</small></div>
            <div class="nero-ai-metric"><span>Пропущено</span><strong>3</strong><small>−14%</small></div>
            <div class="nero-ai-metric"><span>Записей AI</span><strong>31</strong><small>через бота</small></div>
            <div class="nero-ai-metric"><span>No-show</span><strong>12%</strong><small>цель</small></div>
          </div>
          <div class="nero-ai-task-stream">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">📞</span><div><strong>Звонок</strong><span>запись к терапевту</span></div><span class="nero-ai-status">МИС</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">💬</span><div><strong>WhatsApp</strong><span>подтверждение визита</span></div><span class="nero-ai-status">готово</span></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">🔔</span><div><strong>Напоминание</strong><span>за 2 ч до приёма</span></div><span class="nero-ai-status">отправлено</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vkln-content">

<section class="vkln-intro nero-ai-section" aria-label="Введение">
  <div class="vkln-cnt nero-ai-container">
    <div class="vkln-intro-grid nero-ai-reveal">
      <div class="vkln-intro-text">
        <p class="nero-ai-eyebrow">Лонгрид · ai для клиники</p>
        <p><strong>Коротко:</strong> AI-администратор для клиники — это связка голосового и текстового AI с МИС и CRM, которая принимает звонки и сообщения 24/7, записывает пациентов, отвечает на типовые вопросы и отправляет напоминания. Nero Network внедряет такие системы под ключ: от аудита контактных точек до интеграции с вашей МИС и расчёта потерь от пропущенных обращений.</p>
        <p>Пациент звонит в понедельник утром — линия занята. Пишет в WhatsApp — ответ через два часа. К вечеру он уже записан в соседнюю клинику. Внедрение AI для клиники в 2026 году — проектная автоматизация контактного центра: запись, вопросы, напоминания и эскалация к живому администратору в одном контуре.</p>
      </div>
      <div class="vkln-intro-kpi" aria-label="Ключевые метрики">
        <div class="vkln-kpi-card"><div class="kv">14–17%</div><div class="kl">пропущенных обращений</div></div>
        <div class="vkln-kpi-card"><div class="kv">18–20%</div><div class="kl">no-show в городах</div></div>
        <div class="vkln-kpi-card"><div class="kv">42%</div><div class="kl">не могут дозвониться</div></div>
        <div class="vkln-kpi-card"><div class="kv">24/7</div><div class="kl">запись без выходных</div></div>
      </div>
    </div>
  </div>
</section>

<section class="vkln-section" id="boli">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <span class="vkln-eyebrow">Боли клиник</span>
      <h2>Почему клиники теряют пациентов, когда администраторы не успевают отвечать</h2>
      <p>Пропущенные звонки, медленные ответы в мессенджерах и no-show — три скрытые статьи потерь регистратуры.</p>
    </div>
    <div class="vkln-pain-grid nero-ai-reveal">
      <article class="vkln-pain-card nero-ai-pain-card"><div class="vkln-pain-num">14–17%</div><p>Пропущенных звонков и сообщений в пиковые часы — пациент уходит к конкуренту (MedБизнес, 2024)</p></article>
      <article class="vkln-pain-card nero-ai-pain-card"><div class="vkln-pain-num">18–20%</div><p>No-show без напоминаний — пустые слоты и простой кабинета (ProDoctorov, 2023)</p></article>
      <article class="vkln-pain-card nero-ai-pain-card"><div class="vkln-pain-num">42%</div><p>Пациентов называют сложность дозвона главным барьером при выборе клиники (Dialog Health, 2025)</p></article>
    </div>
    <div class="vkln-card nero-ai-reveal" style="margin-top:32px">
      <h3>Пропущенные звонки и no-show</h3>
      <p>Норма эффективного колл-центра — ответ <strong>до 20 секунд</strong> и доля пропущенных <strong>менее 5%</strong>. Пиковая нагрузка совпадает с рабочим днём пациентов: утро понедельника, обед, вечер после 18:00. Автоматические напоминания снижают неявки <strong>на 25%</strong> (BMJ Open, Rothwell et al., 2016).</p>
      <p><strong>Расчёт потерь от пропущенных пациентов</strong> — оценка упущенной выручки из-за неотвеченных звонков, медленных ответов и no-show. Лид-магнит «<strong>Посчитать потери клиники</strong>» переводит боль в конкретные цифры для собственника и главврача.</p>
    </div>
  </div>
</section>

<div class="vkln-cnt">
<div class="ym-cta-block ym-cta-block--primary" id="cta-poteri">
  <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Узнайте, сколько пациентов теряет ваша клиника</p>
    <p class="ym-cta-block__sub">Рассчитаем упущенную выручку от пропущенных звонков, медленных ответов в мессенджерах и no-show — бесплатно, на основе ваших цифр. Первый шаг перед внедрением AI-администратора.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Посчитать потери клиники</a>
  </div>
</div>
</div>

<section class="vkln-section vkln-section-alt" id="chto-takoe-ai">
  <div class="vkln-cnt">
    <div class="vkln-sh vkln-left nero-ai-reveal">
      <span class="vkln-eyebrow">Определение</span>
      <h2>Что такое AI-администратор для клиники</h2>
      <p>Не IVR и не чат-бот 2019 года — AI-агент с RAG, интеграцией с МИС и мультиканальностью.</p>
    </div>
    <div class="vkln-card nero-ai-reveal">
      <p><strong>AI-администратор для клиники</strong> — AI-агент на базе LLM с RAG по базе знаний клиники, интегрированный с расписанием МИС через API, телефонией и мессенджерами. Разработчики пилота ЛЭТИ/ИТМО указывают: система <strong>не выполняет диагностических функций</strong> (CTA.ru).</p>
      <p>Каналы: <strong>телефон</strong>, WhatsApp Business, Telegram, MAX, виджет сайта. Сценарий «пропущенный звонок → сообщение в мессенджер» закрывает классическую дыру воронки.</p>
    </div>
    <div class="vkln-table-wrap nero-ai-reveal" style="margin-top:28px">
      <table class="vkln-table" aria-label="Сравнение AI-администратора, IVR и чат-бота">
        <thead><tr><th>Критерий</th><th>IVR</th><th>Чат-бот 2019</th><th>AI-администратор</th></tr></thead>
        <tbody>
          <tr><td>Естественная речь</td><td>Нет</td><td>Ограничено</td><td>Да</td></tr>
          <tr><td>Запись в МИС в реальном времени</td><td>Редко</td><td>Часто нет</td><td>Да</td></tr>
          <tr><td>Голос + мессенджеры</td><td>Только голос</td><td>Только текст</td><td>Оба</td></tr>
          <tr><td>Напоминания с кнопками</td><td>Нет</td><td>Иногда</td><td>Да</td></tr>
          <tr><td>Эскалация к человеку</td><td>По кнопке</td><td>Редко</td><td>Human-in-the-loop</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- БОРИС: визуальный блок после 2-го H2 -->
<section id="vnedrenie-ai-dlya-kliniki-boris-block" class="bkl-root" aria-label="Анимация: мультиканальные обращения пациентов → AI → МИС → напоминания">
<style>
#vnedrenie-ai-dlya-kliniki-boris-block.bkl-root{padding:60px 0 72px;background:#f0fdfa}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-cnt{max-width:1160px;margin:0 auto;padding:0 20px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-card{display:grid;grid-template-columns:42% 58%;border-radius:24px;overflow:hidden;box-shadow:0 8px 48px rgba(15,23,42,.13),0 0 0 1.5px rgba(20,184,166,.18);min-height:520px}
@media(max-width:960px){#vnedrenie-ai-dlya-kliniki-boris-block .bkl-card{grid-template-columns:1fr;min-height:auto}}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-lft{background:#fff;padding:48px 40px;display:flex;flex-direction:column;justify-content:center}
@media(max-width:600px){#vnedrenie-ai-dlya-kliniki-boris-block .bkl-lft{padding:32px 24px}}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-ey{display:inline-flex;align-items:center;gap:7px;font-size:11px;font-weight:700;letter-spacing:.11em;text-transform:uppercase;color:#0d9488;margin:0 0 15px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-ey::before{content:'';display:inline-block;width:20px;height:2px;background:#14b8a6;border-radius:1px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-h3{font-size:25px;font-weight:800;color:#0f172a;line-height:1.3;margin:0 0 22px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-ul{list-style:none;margin:0 0 26px;padding:0;display:flex;flex-direction:column;gap:10px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14.5px;line-height:1.5;color:#334155}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(20,184,166,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0d9488;margin-top:1px;font-style:normal}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-pills{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:22px}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-pl-t{background:rgba(20,184,166,.08);color:#0f766e;border:1.5px solid rgba(20,184,166,.22)}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-pl-b{background:rgba(59,130,246,.08);color:#1d4ed8;border:1.5px solid rgba(59,130,246,.22)}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-foot{font-size:13.5px;color:#64748b;font-style:italic;margin:0}
#vnedrenie-ai-dlya-kliniki-boris-block .bkl-rgt{background:linear-gradient(145deg,#042f2e 0%,#0f172a 55%,#042f2e 100%);position:relative;overflow:hidden;min-height:400px}
@media(max-width:960px){#vnedrenie-ai-dlya-kliniki-boris-block .bkl-rgt{min-height:380px}}
#bkl-clinic-flow-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="bkl-cnt">
<div class="bkl-card">
  <div class="bkl-lft">
    <span class="bkl-ey">Мультиканальный контур</span>
    <h3 class="bkl-h3">От звонка и мессенджера до слота в МИС и напоминания пациенту</h3>
    <ul class="bkl-ul">
      <li><span class="bkl-ic">📞</span>Пациент звонит или пишет — AI отвечает менее чем за 3 секунды</li>
      <li><span class="bkl-ic">🗓</span>Свободные слоты подтягиваются из МИС в реальном времени</li>
      <li><span class="bkl-ic">✓</span>Запись фиксируется, пациент получает подтверждение в канале</li>
      <li><span class="bkl-ic">🔔</span>За 24 ч и 2 ч — напоминание с кнопкой подтверждения</li>
    </ul>
    <div class="bkl-pills">
      <span class="bkl-pl bkl-pl-t">Telegram · MAX · WhatsApp</span>
      <span class="bkl-pl bkl-pl-g">−70% нагрузки КЦ</span>
      <span class="bkl-pl bkl-pl-b">72% конверсия в запись</span>
    </div>
    <p class="bkl-foot">Дальше разберём, как AI принимает обращения 24/7 →</p>
  </div>
  <div class="bkl-rgt">
    <canvas id="bkl-clinic-flow-canvas" aria-label="Анимация: каналы обращений пациента проходят через AI-хаб в расписание МИС и исходящие напоминания" role="img"></canvas>
  </div>
</div>
</div>
<script>
(function(){
  'use strict';
  var cv = document.getElementById('bkl-clinic-flow-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    teal:'#2dd4bf', tealD:function(a){return 'rgba(45,212,191,'+a+')';},
    blue:'#60a5fa', green:'#4ade80', violet:'#a78bfa',
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)', line:'rgba(255,255,255,.08)',
    card:'rgba(255,255,255,.07)', cardBdr:'rgba(255,255,255,.12)'
  };

  var channels = [
    {icon:'📞', label:'Звонок', x:0, y:0, phase:0},
    {icon:'💬', label:'WhatsApp', x:0, y:0, phase:1.2},
    {icon:'✈', label:'Telegram', x:0, y:0, phase:2.4},
    {icon:'M', label:'MAX', x:0, y:0, phase:3.6}
  ];

  var packets = [];
  var reminders = [];
  var misSlots = [false, false, true, false, true, false];
  var booked = 0;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ctx.fillStyle=fill;ctx.fill()}
    if(stroke){ctx.strokeStyle=stroke;ctx.lineWidth=lw||1.5;ctx.stroke()}
  }

  function spawnPacket(ch){
    packets.push({ch:ch, t:0, x:ch.x, y:ch.y, phase:'in', alpha:0});
  }

  function layout(){
    var leftX = W*0.08, hubX = W*0.42, misX = W*0.72, remX = W*0.88;
    var startY = H*0.18, gap = (H*0.55)/3;
    channels.forEach(function(ch,i){
      ch.x = leftX; ch.y = startY + i*gap;
    });
    return {leftX:leftX, hubX:hubX, hubY:H*0.45, misX:misX, misY:H*0.32, remX:remX, remY:H*0.62, gap:gap, startY:startY};
  }

  function drawChannel(ch, pulse){
    rr(ch.x-4, ch.y-18, 88, 36, 10, C.card, C.cardBdr, 1);
    ctx.font='14px system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillStyle=C.text;
    ctx.fillText(ch.icon+' '+ch.label, ch.x+8, ch.y+4);
    var pulseR = 3+Math.sin(frame*0.08+ch.phase)*2;
    ctx.beginPath();ctx.arc(ch.x+78, ch.y, pulseR, 0, Math.PI*2);
    ctx.fillStyle=C.teal;ctx.fill();
  }

  function drawHub(L, pulse){
    var r = 36+pulse*4;
    var g = ctx.createRadialGradient(L.hubX,L.hubY,0,L.hubX,L.hubY,r*2);
    g.addColorStop(0, C.tealD(0.25)); g.addColorStop(1, 'rgba(45,212,191,0)');
    ctx.fillStyle=g;ctx.beginPath();ctx.arc(L.hubX,L.hubY,r*1.5,0,Math.PI*2);ctx.fill();
    rr(L.hubX-r, L.hubY-r, r*2, r*2, r*0.4, '#0f766e', C.teal, 2);
    ctx.fillStyle='#fff';ctx.font='bold 14px system-ui,sans-serif';ctx.textAlign='center';ctx.textBaseline='middle';
    ctx.fillText('AI', L.hubX, L.hubY-4);
    ctx.font='10px system-ui,sans-serif';ctx.fillStyle=C.muted;
    ctx.fillText('администратор', L.hubX, L.hubY+14);
  }

  function drawMis(L){
    rr(L.misX-8, L.misY-12, 120, H*0.5, 12, C.card, C.tealD(0.35), 1.5);
    ctx.fillStyle=C.teal;ctx.font='bold 11px system-ui,sans-serif';ctx.textAlign='left';
    ctx.fillText('МИС · расписание', L.misX, L.misY+4);
    var slotH = 22, slotGap = 6;
    for(var i=0;i<6;i++){
      var sy = L.misY+18+i*(slotH+slotGap);
      var booked = misSlots[i];
      rr(L.misX, sy, 104, slotH, 6, booked?C.tealD(0.2):'rgba(255,255,255,.04)', booked?C.tealD(0.4):C.cardBdr, 1);
      ctx.fillStyle=booked?C.green:C.muted;
      ctx.font='9px system-ui,sans-serif';
      ctx.fillText((booked?'10:':'10:')+((i+1)*10)+' · '+(booked?'занято':'свободно'), L.misX+8, sy+14);
    }
  }

  function drawReminders(L){
    reminders.forEach(function(rm){
      ctx.globalAlpha = Math.min(1, rm.alpha);
      rr(L.remX-50, rm.y-12, 100, 28, 8, C.tealD(0.15), C.tealD(0.35), 1);
      ctx.fillStyle=C.teal;ctx.font='10px system-ui,sans-serif';ctx.textAlign='center';
      ctx.fillText('🔔 '+rm.label, L.remX, rm.y+4);
      ctx.globalAlpha=1;
    });
  }

  function tickPackets(L){
    if(frame % 90 === 0){
      var ch = channels[Math.floor(Math.random()*channels.length)];
      spawnPacket(ch);
    }
    packets = packets.filter(function(pk){
      pk.t += 0.018;
      if(pk.phase==='in'){
        pk.x += (L.hubX - pk.x)*0.06;
        pk.y += (L.hubY - pk.y)*0.06;
        pk.alpha = Math.min(1, pk.alpha+0.05);
        if(Math.hypot(pk.x-L.hubX, pk.y-L.hubY)<12){
          pk.phase='mis';
          var freeIdx = misSlots.indexOf(false);
          if(freeIdx>=0){misSlots[freeIdx]=true;booked++;}
        }
      } else if(pk.phase==='mis'){
        pk.x += (L.misX+50 - pk.x)*0.05;
        pk.y += (L.misY+40 - pk.y)*0.05;
        if(Math.hypot(pk.x-(L.misX+50), pk.y-(L.misY+40))<14){
          pk.phase='rem';
          reminders.push({y:L.remY+reminders.length*34, label:'за 2 ч', alpha:0});
        }
      } else {
        pk.x += (L.remX - pk.x)*0.04;
        pk.y += (L.remY - pk.y)*0.04;
        if(pk.t>3) return false;
      }
      ctx.globalAlpha=pk.alpha;
      ctx.beginPath();ctx.arc(pk.x,pk.y,5,0,Math.PI*2);ctx.fillStyle=C.teal;ctx.fill();
      ctx.globalAlpha=1;
      return pk.t<4;
    });
    reminders.forEach(function(rm){rm.alpha=Math.min(1,rm.alpha+0.03);});
    if(reminders.length>4) reminders.shift();
    if(frame % 400 === 0 && booked>0){
      misSlots = misSlots.map(function(){return Math.random()>0.5});
      booked=0; reminders=[];
    }
  }

  function drawLines(L){
    ctx.strokeStyle=C.line;ctx.lineWidth=1;ctx.setLineDash([4,6]);
    channels.forEach(function(ch){
      ctx.beginPath();ctx.moveTo(ch.x+88,ch.y);ctx.lineTo(L.hubX-36,L.hubY);ctx.stroke();
    });
    ctx.beginPath();ctx.moveTo(L.hubX+36,L.hubY);ctx.lineTo(L.misX-8,L.misY+40);ctx.stroke();
    ctx.beginPath();ctx.moveTo(L.misX+112,L.misY+80);ctx.lineTo(L.remX-50,L.remY);ctx.stroke();
    ctx.setLineDash([]);
  }

  function loop(){
    frame++;
    var L = layout();
    var pulse = Math.sin(frame*0.06);
    ctx.clearRect(0,0,W,H);
    drawLines(L);
    channels.forEach(function(ch){drawChannel(ch,pulse)});
    drawHub(L,pulse);
    drawMis(L);
    tickPackets(L);
    drawReminders(L);
    ctx.fillStyle=C.muted;ctx.font='11px system-ui,sans-serif';ctx.textAlign='left';
    ctx.fillText('Поток: обращение → AI → МИС → напоминание', 14, H-14);
    requestAnimationFrame(loop);
  }
  loop();
})();
</script>
</section>

<section class="vkln-section" id="kak-rabotaet">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <span class="vkln-eyebrow">Архитектура</span>
      <h2>Как AI принимает звонки и сообщения 24/7</h2>
      <p>Agentic AI с human-in-the-loop: рутина — машине, сложные кейсы — администратору.</p>
    </div>
    <div class="vkln-flow nero-ai-reveal">
      <div class="vkln-flow-step nero-ai-flow-step"><div class="vkln-flow-num">1</div><div><h3>Входящее обращение</h3><p>Пациент звонит или пишет — AI отвечает <strong>менее чем за 3 секунды</strong>, определяет интент: запись, вопрос, перенос, жалоба.</p></div></div>
      <div class="vkln-flow-step nero-ai-flow-step"><div class="vkln-flow-num">2</div><div><h3>Запись в МИС</h3><p>Уточнение специализации → свободные слоты из МИС → 2–3 варианта → ФИО и телефон → фиксация + подтверждение.</p></div></div>
      <div class="vkln-flow-step nero-ai-flow-step"><div class="vkln-flow-num">3</div><div><h3>FAQ без диагностики</h3><p>RAG по прайсу, адресам, подготовке к анализам — <strong>без медицинских рекомендаций</strong>.</p></div></div>
      <div class="vkln-flow-step nero-ai-flow-step"><div class="vkln-flow-num">4</div><div><h3>Эскалация</h3><p>«Красные флаги» (острая боль, жалоба, запрос диагноза) → мгновенная передача живому администратору или дежурному врачу.</p></div></div>
      <div class="vkln-flow-step nero-ai-flow-step"><div class="vkln-flow-num">5</div><div><h3>Дашборд метрик</h3><p>Пропущенные, конверсия в запись, доля эскалаций — прозрачная аналитика для руководителя клиники.</p></div></div>
    </div>
    <div class="vkln-card nero-ai-reveal" style="margin-top:28px">
      <p>Автоматизация через AI для клиники на первом этапе закрывает <strong>60–90%</strong> типовых переписок и звонков. IBM: к 2028 году <strong>≥70%</strong> клиентов начнут путь в сервисе с conversational AI.</p>
    </div>
  </div>
</section>

<section class="vkln-section vkln-section-alt" id="zapis">
  <div class="vkln-cnt">
    <div class="vkln-sh vkln-left nero-ai-reveal">
      <h2>Запись пациентов и управление расписанием через AI</h2>
      <p><strong>Ai запись пациентов</strong> работает только при синхронизации с МИС в реальном времени.</p>
    </div>
    <div class="vkln-grid-2 nero-ai-reveal">
      <div class="vkln-card"><h3>Подбор слота, перенос и отмена</h3><p>Пациент называет удобное время — агент проверяет окна врача, длительность приёма, филиал и правила клиники. Перенос и отмена обновляют статус в МИС.</p></div>
      <div class="vkln-card"><h3>Синхронизация с расписанием</h3><p>Renovatio, Медиалог, Инфоклиника, Medesk, YCLIENTS, 1С:Медицина — типовые стеки. Кейс «ВЕРАМЕД»: <strong>72%</strong> конверсия в запись (Chatme.ai).</p></div>
    </div>
  </div>
</section>

<section class="vkln-section" id="otvety">
  <div class="vkln-cnt">
    <div class="vkln-sh vkln-left nero-ai-reveal">
      <h2>Ответы на типовые вопросы пациентов без диагностики</h2>
    </div>
    <div class="vkln-grid-2 nero-ai-reveal">
      <div class="vkln-card"><h3>Что отвечает AI</h3><ul><li>Стоимость услуг и акции</li><li>Адрес, парковка, график работы</li><li>Подготовка к анализам, УЗИ</li><li>Документы для первичного визита, ДМС</li></ul></div>
      <div class="vkln-card"><h3>Что AI не делает</h3><ul><li>Не ставит диагноз и не рекомендует лечение</li><li>Не комментирует результаты анализов</li><li>При симптомах — к врачу или экстренная эскалация</li></ul></div>
    </div>
  </div>
</section>

<section class="vkln-section vkln-section-alt" id="napominaniya">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <h2>Напоминания пациентам и снижение no-show</h2>
      <p>Исходящие за 24 ч и 2 ч до визита с кнопками «подтвердить / отменить / перенести».</p>
    </div>
    <div class="vkln-table-wrap nero-ai-reveal nero-ai-kpi-grid">
      <table class="vkln-table" aria-label="KPI напоминаний до и после пилота">
        <thead><tr><th>Метрика</th><th>До внедрения</th><th>Цель после пилота 30 дней</th></tr></thead>
        <tbody>
          <tr><td>Доля no-show</td><td>18–20%</td><td>снижение на 20–30%</td></tr>
          <tr><td>Ручной обзвон</td><td>100% записей</td><td>−50–70%</td></tr>
          <tr><td>Время ответа</td><td>минуты / пропуск</td><td>&lt; 20 сек</td></tr>
          <tr><td>Конверсия в запись</td><td>зависит от канала</td><td>60–72%</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal" style="text-align:center;margin-top:20px">Кейс «Клиника Фомина»: конверсия в ответ <strong>69,3%</strong>, <strong>59,8%</strong> подтвердили приём; нагрузка на КЦ <strong>−70%</strong> (Дмитрий Главацкий, Chatme.ai).</p>
  </div>
</section>

<section class="vkln-section" id="etapy">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <span class="vkln-eyebrow">Под ключ</span>
      <h2>Внедрение AI для клиники под ключ: этапы и сроки</h2>
    </div>
    <div class="vkln-table-wrap nero-ai-reveal nero-ai-process-list">
      <table class="vkln-table" aria-label="Таймлайн внедрения">
        <thead><tr><th>Этап</th><th>Срок</th><th>Результат</th></tr></thead>
        <tbody>
          <tr><td>Аудит контактных точек</td><td>3–5 дней</td><td>Карта потерь, приоритет канала</td></tr>
          <tr><td>Карта интеграций</td><td>1 неделя</td><td>API МИС, ВАТС, мессенджеры, 152-ФЗ</td></tr>
          <tr><td>MVP одного канала</td><td>2 недели</td><td>Запись + FAQ + эскалация</td></tr>
          <tr><td>Модуль напоминаний</td><td>1 неделя</td><td>Исходящие 24 ч + 2 ч</td></tr>
          <tr><td>Пилот и доработка</td><td>30 дней</td><td>KPI, обучение, масштаб</td></tr>
        </tbody>
      </table>
    </div>
    <div class="vkln-timeline nero-ai-reveal" style="margin-top:40px">
      <div class="vkln-tl-item"><div class="vkln-tl-dot"></div><h3>Аудит контактных точек</h3><p>Карта каналов, доля пропущенных, no-show, текущая МИС/CRM, скрипты администраторов.</p></div>
      <div class="vkln-tl-item"><div class="vkln-tl-dot"></div><h3>Пилот на одном направлении</h3><p>30 дней на стоматологии или диагностике — замер KPI, доработка формулировок.</p></div>
      <div class="vkln-tl-item"><div class="vkln-tl-dot"></div><h3>Запуск и обучение</h3><p>Панель эскалации, обновление базы знаний, чтение дашборда ROI.</p></div>
    </div>
  </div>
</section>

<div class="vkln-cnt">
<aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Команда хочет понять AI до старта пилота?</p>
    <p class="ym-cta-block__sub">Перед внедрением AI-администратора полезно разобраться в сценариях, human-in-the-loop и интеграции с МИС — это ускоряет согласование с главврачом и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
  </div>
</aside>
</div>

<section class="vkln-section vkln-section-alt" id="integracii">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <h2>Интеграция AI для клиники с CRM, МИС и телефонией</h2>
    </div>
    <div class="vkln-grid-2 nero-ai-reveal">
      <div class="vkln-card"><h3>Типовые стеки</h3><ul><li><strong>МИС:</strong> Renovatio, Медиалог, Инфоклиника, Medesk, YCLIENTS</li><li><strong>Телефония:</strong> Mango Office, UIS, МТТ, SIP</li><li><strong>CRM:</strong> amoCRM, Битрикс24 — если МИС не ведёт воронку</li></ul></div>
      <div class="vkln-card"><h3>Что в карточке пациента</h3><p>ФИО, телефон, врач и слот, источник обращения, статус подтверждения, история диалога. ПДн — по 152-ФЗ, серверы в РФ.</p></div>
    </div>
  </div>
</section>

<section class="vkln-section" id="keisy">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <span class="vkln-eyebrow">Кейсы</span>
      <h2>Кейсы и примеры внедрения AI для клиники</h2>
    </div>
    <div class="vkln-case-grid">
      <div class="vkln-case-card nero-ai-reveal"><div class="vkln-case-tag">Сеть · WhatsApp</div><h3>Клиника Фомина</h3><p>WhatsApp-подтверждение + МИС: −70% нагрузки на КЦ, 59,8% подтверждений.</p></div>
      <div class="vkln-case-card nero-ai-reveal nero-ai-delay-1"><div class="vkln-case-tag">ВЕРАМЕД · Renovatio</div><h3>Запись через бот</h3><p>72% конверсия в успешную запись за первый месяц.</p></div>
      <div class="vkln-case-card nero-ai-reveal nero-ai-delay-2"><div class="vkln-case-tag">MAX · 2026</div><h3>Else Digital</h3><p>61% новых записей через бот, −54% нагрузки call-центра.</p></div>
      <div class="vkln-case-card nero-ai-reveal"><div class="vkln-case-tag">Медиалог</div><h3>Юсуповская больница</h3><p>Запись, перенос, напоминания — до −72% нагрузки на персонал.</p></div>
      <div class="vkln-case-card nero-ai-reveal nero-ai-delay-1"><div class="vkln-case-tag">Пилот · ЛЭТИ/ИТМО</div><h3>Стоматология Рязань</h3><p>24/7 мессенджеры + сайт, RAG, МИС — без диагностики.</p></div>
      <div class="vkln-case-card nero-ai-reveal nero-ai-delay-2"><div class="vkln-case-tag">WhatsApp · CRM</div><h3>Частная клиника</h3><p>NextBot: до 90% переписок без администратора + Битрикс24.</p></div>
    </div>
    <blockquote class="vkln-card nero-ai-reveal" style="margin-top:28px;font-style:italic">«Благодаря боту снизили нагрузку на контакт-центр на более чем 70%» — Дмитрий Главацкий, «Клиника Фомина».</blockquote>
  </div>
</section>

<section class="vkln-section vkln-section-alt" id="ceny">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <h2>Стоимость, ROI и расчёт потерь от пропущенных обращений</h2>
      <p>Ориентир проектного чека Nero Network: <strong>250–800 тыс. ₽</strong> за внедрение под ключ.</p>
    </div>
    <div class="vkln-callout nero-ai-reveal">
      <p><strong>Потери от пропущенных обращений</strong> ≈ (обращения в день × рабочие дни × % пропущенных × % конверсии × средний чек) + (записи в месяц × % no-show × средний чек). При 40 обращениях, 15% пропущенных, 30% конверсии и чеке 5 000 ₽ — десятки тысяч рублей в месяц только на «не взяли трубку».</p>
    </div>
    <div class="vkln-compare nero-ai-reveal">
      <div class="vkln-card"><h3>SaaS (15–30 тыс. ₽/мес.)</h3><p>Быстрый старт в одном мессенджере. MedАссист, Saile, Stexa AI — узкий функционал.</p></div>
      <div class="vkln-card"><h3>Кастом Nero Network</h3><p>Голос + все мессенджеры + ваша МИС + MAX + аналитика потерь + on-prem при необходимости.</p></div>
    </div>
  </div>
</section>

<div class="vkln-cnt">
<div class="ym-cta-block ym-cta-block--dual" id="cta-roi">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Посчитайте окупаемость AI-администратора для вашей клиники</p>
    <p class="ym-cta-block__sub">Ориентир внедрения под ключ — 250–800 тыс. ₽. На расчёте потерь сравним месячную утечку на пропущенных обращениях с бюджетом проекта и предложим архитектуру под вашу МИС.</p>
    <div class="ym-cta-block__actions">
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Посчитать потери клиники</a>
      <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary">Частые вопросы</a>
    </div>
  </div>
</div>
</div>

<section class="vkln-section" id="bezopasnost">
  <div class="vkln-cnt">
    <div class="vkln-sh vkln-left nero-ai-reveal">
      <h2>Безопасность, персональные данные и медицинская тайна</h2>
    </div>
    <div class="vkln-card nero-ai-reveal">
      <div class="vkln-shield">
        <span class="vkln-shield-icon" aria-hidden="true">🛡</span>
        <div>
          <p>Обработка ПДн — <strong>152-ФЗ</strong>. Первичная обработка на серверах в РФ. YandexGPT, GigaChat или self-hosted в контуре клиента. Закон об ИИ: информировать пациента об использовании ИИ.</p>
          <h3 style="margin-top:20px">Что AI не делает</h3>
          <ul><li>Не ставит диагноз и не рекомендует лечение</li><li>Не комментирует результаты анализов</li><li>При симптомах — запись к врачу или экстренная эскалация</li></ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vkln-section vkln-section-alt" id="faq">
  <div class="vkln-cnt">
    <div class="vkln-sh nero-ai-reveal">
      <span class="vkln-eyebrow">FAQ</span>
      <h2>Частые вопросы о внедрении AI для клиники</h2>
    </div>
    <div class="vkln-faq nero-ai-faq nero-ai-reveal">
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько времени занимает запуск?</div><div class="vkln-faq-a"><p>MVP одного канала — 2–3 недели после аудита; полный контур с голосом, мессенджерами и напоминаниями — 6–10 недель с пилотом.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Заменит ли AI администраторов полностью?</div><div class="vkln-faq-a"><p>Нет. AI закрывает рутину; администраторы — для сложных кейсов, конфликтов и контроля качества. По кейсам — 50–70% снижение нагрузки на рутину.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Какие каналы поддерживаются?</div><div class="vkln-faq-a"><p>Телефон (SIP/ВАТС), Telegram, WhatsApp Business API, MAX, VK, виджет сайта. Набор выбирается на аудите.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Как считается окупаемость?</div><div class="vkln-faq-a"><p>Метрики пилота: пропущенные обращения, конверсия в запись, no-show, время ответа. Плюс калькулятор потерь до старта.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Нужна ли медицинская лицензия на AI-администратора?</div><div class="vkln-faq-a"><p>Нет — при условии, что система не оказывает медицинские услуги и не ставит диагнозы. Это административная автоматизация.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Что если у нас нестандартная МИС?</div><div class="vkln-faq-a"><p>Аудит API до контракта. При отсутствии API — промежуточный слой (n8n/Make + webhook) или приоритетный канал «заявка + перезвон».</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Чем кастом Nero Network отличается от SaaS?</div><div class="vkln-faq-a"><p>SaaS — быстрый старт, фиксированный функционал. Кастом — голос + несколько мессенджеров + ваша МИС + MAX + аналитика потерь.</p></div></div>
      <div class="vkln-faq-item"><div class="vkln-faq-q" tabindex="0" role="button" aria-expanded="false">Безопасны ли данные пациентов?</div><div class="vkln-faq-a"><p>При архитектуре в контуре РФ, согласии пациента и без передачи ПДн в зарубежные модели — да. Базовое требование проекта.</p></div></div>
    </div>
  </div>
</section>

<div class="vkln-cnt">
<div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
  <div class="ym-cta-block__body">
    <p class="ym-cta-block__headline">Готовы перестать терять пациентов на пропущенных звонках?</p>
    <p class="ym-cta-block__sub">Аудит контактных точек → MVP на одном канале → пилот 30 дней с замером KPI. AI-администратор под вашу МИС, каналы и юридические требования 152-ФЗ.</p>
    <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Посчитать потери клиники</a>
  </div>
</div>
</div>

</div><!-- /.vkln-content -->

<script>
(function(){
  document.querySelectorAll('.vkln-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.vkln-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.vkln-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.vkln-faq-q');
        if(q) q.setAttribute('aria-expanded','false');
      });
      if(!isOpen){ item.classList.add('open'); btn.setAttribute('aria-expanded','true'); }
    });
    btn.addEventListener('keydown', function(e){
      if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}
    });
  });
})();
</script>
<script>
(function(){
  'use strict';
  var root = document.querySelector('.vkln-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){ entry.target.classList.add('nero-ai-active'); observer.unobserve(entry.target); }
      });
    }, {rootMargin:'0px 0px -40px 0px', threshold:0.08});
    items.forEach(function(el){ observer.observe(el); });
  } else {
    items.forEach(function(el){ el.classList.add('nero-ai-active'); });
  }
})();
</script>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

OUT.write_text(PHP, encoding='utf-8')
print(f"Written {OUT} ({OUT.stat().st_size} bytes)")
