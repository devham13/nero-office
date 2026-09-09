#!/usr/bin/env python3
"""Generate page-ai-proizvodstvo-kontrol-prostoi.php for Natasha pipeline."""
import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
OUT = ROOT / "wordpress-theme" / "page-ai-proizvodstvo-kontrol-prostoi.php"

alina = (ROOT / ".cursor/nero-network-fragments/alina.md").read_text(encoding="utf-8")
boris = (ROOT / ".cursor/nero-network-fragments/boris.md").read_text(encoding="utf-8")
hero_html = re.search(r"```html\n(.*?)\n```", alina, re.DOTALL).group(1)
boris_html = re.search(r"```html\n(.*?)\n```", boris, re.DOTALL).group(1)

PHP_HEAD = r'''<?php
/**
 * Template Name: AI для производства: сменные задания и контроль простоев
 * Description: SEO-лендинг — внедрение AI-агента для малого производства: сменные задания, фиксация простоев, отчёт руководителю без Excel.
 */

$page_seo_title       = 'AI для производства: сменные задания и контроль простоев';
$page_seo_description = 'Внедрение AI-агента для малого производства: сменные задания, фиксация простоев в реальном времени, отчёт руководителю без Excel. Аудит потерь, интеграция с 1С.';

add_filter( 'document_title_parts', static function ( array $parts ) use ( $page_seo_title ): array {
	$parts['title'] = $page_seo_title;
	return $parts;
}, 20 );

add_action( 'wp_head', static function () use ( $page_seo_title, $page_seo_description ): void {
	echo '<meta name="description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $page_seo_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $page_seo_description ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '" />' . "\n";
	echo '<meta property="og:type" content="article" />' . "\n";
}, 1 );

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
	['label' => 'Как работает',    'href' => '#kak-rabotaet'],
	['label' => 'Сменные задания', 'href' => '#smennie-zadaniya'],
	['label' => 'Простои и OEE',   'href' => '#prostoi-oee'],
	['label' => 'Интеграции',      'href' => '#integracii'],
	['label' => 'Этапы',           'href' => '#etapy'],
	['label' => 'Стоимость',       'href' => '#cena-roi'],
	['label' => 'FAQ',             'href' => '#faq'],
	['label' => 'Найти простои',   'href' => '#cta'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs( $primary_cta_url );
$secondary_cta_label = getenv( 'SECONDARY_CTA_LABEL' ) ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url   = getenv( 'SECONDARY_CTA_URL' ) ?: '';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if ( ! is_readable( $nero_ai_floating ) ) {
	require dirname( __DIR__ ) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
	require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles( [ 'nero-ai-longread-ui-compat.css' ] ); ?>

<style>
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}
.apk-hero-prostoi{min-height:100vh;min-height:100dvh;position:relative}
.apk-content{--apk-bg:#050711;--apk-bg2:#080b17;--apk-surface:rgba(255,255,255,.072);--apk-text:#e6edf7;--apk-muted:#9aa8bd;--apk-soft:#c7d2e5;--apk-heading:#fff;--apk-border:rgba(255,255,255,.10);--apk-accent:#79f2ff;--apk-amber:#f59e0b;--apk-green:#22c55e;--apk-violet:#8b5cf6;--apk-btn-from:#06b6d4;--apk-btn-to:#7c3aed;--apk-shadow:0 24px 72px rgba(0,0,0,.4);--apk-r:18px;--apk-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--apk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.apk-content *,.apk-content *::before,.apk-content *::after{box-sizing:border-box}
.apk-content a{color:inherit;text-decoration:none}
.apk-content p{color:var(--apk-muted);line-height:1.72;margin:0 0 1em}
.apk-content p:last-child{margin-bottom:0}
.apk-content h2,.apk-content h3,.apk-content h4{color:var(--apk-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apk-content strong{color:var(--apk-soft)}
.apk-content ul,.apk-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.apk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apk-muted);font-size:14.5px;line-height:1.65}
.apk-content ul li::before{content:'›';position:absolute;left:0;color:var(--apk-accent);font-weight:700}
.apk-content ol.apk-ol{counter-reset:apkli}
.apk-content ol.apk-ol li{counter-increment:apkli;padding-left:28px}
.apk-content ol.apk-ol li::before{content:counter(apkli);color:var(--apk-accent);font-weight:800;font-size:12px;left:0;width:20px;text-align:center}
.apk-cnt{width:min(var(--apk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apk-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apk-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apk-sh.apk-left{margin-left:0;text-align:left}
.apk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apk-sh.apk-left p{margin-left:0}
.apk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-accent);margin-bottom:14px}
.apk-gt{background:linear-gradient(92deg,#fff 0%,var(--apk-accent) 44%,var(--apk-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important}
.apk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apk-intro-text{position:relative;padding-left:20px;text-align:left!important}
.apk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet))}
.apk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--apk-muted);margin-bottom:1em}
.apk-intro-text p:last-child{margin-bottom:0;color:var(--apk-soft)}
.apk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px)}
.apk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.apk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apk-muted);line-height:1.4}
.apk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.apk-intro-grid{grid-template-columns:1fr;gap:36px}.apk-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.apk-intro-kpi{grid-template-columns:1fr 1fr}}
.apk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.apk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.apk-toc a{display:inline-block;padding:9px 18px;background:var(--apk-surface);border:1px solid var(--apk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apk-muted);transition:border-color .2s,color .2s,background .2s}
.apk-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--apk-accent);background:rgba(121,242,255,.08)}
.apk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apk-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s}
.apk-card:hover{border-color:rgba(121,242,255,.28);transform:translateY(-2px)}
.apk-callout{border-left:3px solid var(--apk-accent);padding:18px 22px;background:rgba(121,242,255,.06);border-radius:0 14px 14px 0;margin:24px 0}
.apk-callout p{margin:0;color:var(--apk-soft)}
.apk-quote{border-left:3px solid var(--apk-violet);padding:20px 24px;background:rgba(139,92,246,.08);border-radius:0 16px 16px 0;margin:24px 0;font-style:italic;color:var(--apk-soft)}
.apk-quote cite{display:block;margin-top:10px;font-style:normal;font-size:13px;color:var(--apk-muted)}
.apk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.apk-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.apk-grid-2,.apk-grid-3{grid-template-columns:1fr}}
@media(max-width:960px){.apk-grid-3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apk-grid-3{grid-template-columns:1fr}}
.apk-steps{display:grid;gap:12px;margin:24px 0}
.apk-step{display:flex;gap:14px;align-items:flex-start;padding:16px 18px;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px}
.apk-step-num{flex-shrink:0;width:32px;height:32px;border-radius:50%;background:rgba(121,242,255,.12);color:var(--apk-accent);font-weight:800;font-size:14px;display:flex;align-items:center;justify-content:center}
.apk-step strong{color:var(--apk-heading);display:block;margin-bottom:4px}
.apk-step span{font-size:14px;color:var(--apk-muted)}
.apk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.apk-table{width:100%;border-collapse:collapse;font-size:14px}
.apk-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apk-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25);white-space:nowrap}
.apk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apk-text);vertical-align:top}
.apk-table tr:last-child td{border-bottom:none}
.apk-table tr:hover td{background:rgba(255,255,255,.03)}
.apk-timeline{position:relative;padding-left:40px}
.apk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--apk-accent),var(--apk-violet));opacity:.35;border-radius:2px}
.apk-tl-item{position:relative;margin-bottom:32px}
.apk-tl-item:last-child{margin-bottom:0}
.apk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--apk-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.apk-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.apk-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.apk-case-grid{grid-template-columns:1fr}}
.apk-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s}
.apk-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px)}
.apk-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apk-green);margin-bottom:10px}
.apk-case-card h3{font-size:16px;margin-bottom:14px}
.apk-calc{background:rgba(15,23,42,.6);border:1px solid rgba(121,242,255,.15);border-radius:16px;padding:24px;font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:13px;color:var(--apk-soft);line-height:1.7;margin:20px 0;white-space:pre-wrap}
.apk-checklist{display:grid;gap:10px}
.apk-check{display:flex;gap:10px;align-items:flex-start;font-size:14.5px;color:var(--apk-muted)}
.apk-check-yes::before{content:'✓';color:var(--apk-green);font-weight:800}
.apk-check-no::before{content:'✗';color:var(--apk-amber);font-weight:800}
.apk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apk-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none}
.apk-faq-q::after{content:'▾';font-size:13px;color:var(--apk-accent);flex-shrink:0;transition:transform .25s}
.apk-faq-item.open .apk-faq-q::after{transform:rotate(180deg)}
.apk-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--apk-muted);line-height:1.72}
.apk-faq-item.open .apk-faq-a{max-height:600px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s}
.ym-btn:hover{transform:translateY(-2px)}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--apk-btn-from),var(--apk-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(6,182,212,.35)}
.ym-link--accent{color:var(--apk-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}
.nero-ai-delay-2{transition-delay:.24s}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page apk-prostoi-page" role="main" tabindex="-1">
'''

PHP_TAIL = r'''
<!-- INTERNAL-LINKS:INSERT -->
<!-- SCHEMA-MARKUP:INSERT -->

</main>

<script>
(function(){
  document.querySelectorAll('.apk-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.apk-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.apk-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.apk-faq-q');
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
  var root = document.querySelector('.apk-prostoi-page') || document.querySelector('.apk-content');
  if (!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php if ( getenv( 'AD_BANNER_URL' ) && getenv( 'AD_BANNER_IMAGE_URL' ) ) : ?>
<div class="apk-ad-banner" style="text-align:center;padding:24px 0 40px;">
  <a href="<?php echo esc_url( getenv( 'AD_BANNER_URL' ) ); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url( getenv( 'AD_BANNER_IMAGE_URL' ) ); ?>" width="970" height="90" alt="<?php echo esc_attr( getenv( 'AD_BANNER_ALT' ) ?: 'Реклама' ); ?>" loading="lazy" decoding="async" style="max-width:100%;height:auto;border-radius:12px;">
  </a>
</div>
<?php endif; ?>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
'''

CONTENT = r'''
<div class="apk-content">

  <section class="apk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="apk-cnt">
      <div class="apk-intro-grid nero-ai-reveal">
        <div class="apk-intro-text">
          <p class="apk-eyebrow">Производство · ai производство контроль</p>
          <p>На малом производстве план и факт расходятся каждый день: сменные задания меняют в WhatsApp, простой замечают через два часа, а отчёт руководителю собирают вручную из Excel и чатов. <strong>AI-агент для производства</strong> закрывает обе боли в одном контуре: выдаёт и обновляет задания, фиксирует простои в момент события и формирует отчёт без ручного сбора данных.</p>
          <p>Nero Network внедряет <strong>ai производство контроль</strong> под ключ — с human-in-the-loop, чтобы вы получили эффект, а не очередной «цифровой эксперимент».</p>
        </div>
        <div class="apk-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="apk-kpi-card"><div class="kv">30–70%</div><div class="kl">OEE на российских предприятиях</div><div class="ks">отраслевые обзоры 2026</div></div>
          <div class="apk-kpi-card"><div class="kv">50%</div><div class="kl">времени станков — потери</div><div class="ks">не только поломки</div></div>
          <div class="apk-kpi-card"><div class="kv">47 мин</div><div class="kl">типичный простой до алерта</div><div class="ks">без AI-контура</div></div>
          <div class="apk-kpi-card"><div class="kv">2–5 мин</div><div class="kl">фиксация с AI-агентом</div><div class="ks">целевой KPI пилота</div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="apk-toc-outer">
    <div class="apk-cnt">
      <nav class="apk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#zachem-ai">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#agentic-ai">Agentic AI</a>
        <a href="#smennie-zadaniya">Сменные задания</a>
        <a href="#prostoi-oee">Простои и OEE</a>
        <a href="#integracii">Интеграции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#etapy">Этапы</a>
        <a href="#cena-roi">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Найти простои</a>
      </nav>
    </div>
  </div>

  <section class="apk-section" id="zachem-ai">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Главное ядро</span>
        <h2>Зачем производству AI-агент: ручные задания и поздние простои</h2>
        <p><strong>Определение:</strong> AI-агент для сменных заданий и контроля простоев — прикладной слой поверх уже существующих процессов цеха. Он не заменяет 1С, MES и мастера, а собирает данные по смене, обновляет задания при изменении плана и готовит сводку для руководителя.</p>
      </div>
      <p class="nero-ai-reveal">На российских предприятиях <strong>OEE часто составляет 30–70%</strong> при мировом классе 80–85%. До <strong>50% рабочего времени станков</strong> уходит на потери, не связанные с поломками. Малые цеха живут в Excel, бумажных нарядах и групповых чатах — разрыв между планом и фактом закрывается в конце смены, когда стоимость часа простоя уже списана.</p>
      <div class="apk-callout nero-ai-reveal"><p><strong>Коротко:</strong> если задачи меняются вручную, а простои фиксируются поздно — <strong>ai для производства</strong> с фокусом на смену и контроль даёт измеримый эффект быстрее, чем трёхлетняя «цифровая трансформация».</p></div>
      <div class="apk-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apk-card">
          <h3>Почему Excel и чаты на смене не работают</h3>
          <ul>
            <li>07:45 — план в Excel, часть заданий устарела ещё вчера</li>
            <li>11:00 — простой 40 минут, никто не зафиксировал</li>
            <li>16:00 — входящая смена не знает, что не закрыто</li>
            <li>18:30 — отчёт собирают из трёх чатов</li>
          </ul>
          <p>Excel не шлёт алерт. Чат не считает OEE. Бумажный наряд не перестраивается при срыве поставки.</p>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Сколько стоят незафиксированные простои</h3>
          <p><strong>Формула:</strong> стоимость потерь = часы простоя × стоимость часа простоя.</p>
          <p>Если час простоя стоит <strong>500–3 000 ₽</strong>, а в месяц «теряется» <strong>5–20 скрытых часов</strong> — это <strong>2 500–60 000 ₽</strong> на одном рабочем центре.</p>
          <p><strong>25–30%</strong> планового фонда времени уходит на простои — часто как «норма».</p>
        </div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Было</th><th>Стало с AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Простой узнали через 2 часа</td><td>Алерт за 2–5 минут</td></tr>
            <tr><td>Задания в 3 чатах</td><td>Единая очередь в Telegram</td></tr>
            <tr><td>Отчёт собирают 45 минут</td><td>Сводка генерируется автоматически</td></tr>
            <tr><td>OEE «примерно 60%»</td><td>OEE-лайт с декомпозицией потерь</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="kak-rabotaet">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Сменный контур</span>
        <h2>Как AI-агент работает на смене: от задания до отчёта руководителю</h2>
        <p><strong>ai сменные задания</strong> и <strong>ai контроль простоев</strong> в одном агенте — единый контур: план → исполнение → отклонения → отчёт → передача смены.</p>
      </div>
      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card">
          <h3>Сбор данных без ручного ввода</h3>
          <p>1С:УНФ, КА, ERP · Google Sheets · Telegram · датчики (опционально). Утром агент формирует пакет заданий — мастер подтверждает одной кнопкой.</p>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Фиксация простоев в реальном времени</h3>
          <p>При простое &gt;15 мин — запрос причины из справочника, классификация, эскалация: 2 мин → мастер, 5 мин → руководитель.</p>
        </div>
        <div class="apk-card nero-ai-delay-2">
          <h3>Автоматический отчёт</h3>
          <p>OEE-лайт, топ-3 потери, briefing для входящей смены — в Telegram или на дашборд без «собери в конце дня».</p>
        </div>
      </div>
      <div class="apk-card nero-ai-reveal" style="margin-top:28px;">
        <h3>5 шагов работы агента на смене</h3>
        <div class="apk-steps">
          <div class="apk-step"><span class="apk-step-num">1</span><div><strong>Утро</strong><span>пакет сменных заданий с подтверждением мастера</span></div></div>
          <div class="apk-step"><span class="apk-step-num">2</span><div><strong>Смена</strong><span>фиксация старт/стоп операций</span></div></div>
          <div class="apk-step"><span class="apk-step-num">3</span><div><strong>Простой</strong><span>запрос причины + эскалация</span></div></div>
          <div class="apk-step"><span class="apk-step-num">4</span><div><strong>Отклонение</strong><span>перестановка заданий с утверждением</span></div></div>
          <div class="apk-step"><span class="apk-step-num">5</span><div><strong>Конец смены</strong><span>отчёт + briefing входящей смене</span></div></div>
        </div>
      </div>
      <!-- INTERNAL-LINKS:INSERT -->
      BORIS_PLACEHOLDER
    </div>
  </section>

  <section class="apk-section" id="agentic-ai">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Agentic AI</span>
        <h2>Agentic AI на производстве: автономность с проверкой человеком</h2>
        <p><strong>Agentic AI</strong> — системы, которые планируют шаги, собирают данные и выполняют цепочку действий. На производстве это <strong>bounded agent</strong> с обязательной проверкой человека.</p>
      </div>
      <div class="apk-quote nero-ai-reveal">
        <p>«Most agentic AI projects right now are early stage experiments or proof of concepts that are mostly driven by hype and are often misapplied»</p>
        <cite>— Anushree Verma, Gartner, 25.06.2025</cite>
      </div>
      <p class="nero-ai-reveal">По прогнозу Gartner, <strong>более 40% проектов agentic AI будут отменены к концу 2027</strong>. Вывод для владельца цеха: продавать нужно не «автономный завод», а <strong>агент с human-in-the-loop</strong>.</p>
      <div class="apk-grid-2 nero-ai-reveal" style="margin-top:28px;">
        <div class="apk-card">
          <h3>Человек обязателен</h3>
          <ul>
            <li>подтверждение сменных заданий и перестановок</li>
            <li>финальная классификация нестандартных простоев</li>
            <li>технологические решения при браке и авариях</li>
            <li>юридическая и производственная ответственность</li>
          </ul>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Агент делает сам</h3>
          <ul>
            <li>сбор контекста из 1С, таблиц, чатов</li>
            <li>формирование очереди заданий</li>
            <li>классификацию типовых причин простоев</li>
            <li>генерацию отчётов и briefing смены</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="smennie-zadaniya">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Сменные задания</span>
        <h2>Сменные задания без хаоса: выдача, обновление, контроль исполнения</h2>
      </div>
      <div class="apk-grid-3 nero-ai-reveal">
        <div class="apk-card"><h3>Мебельная фабрика</h3><p>Заказы в 1С:УНФ, сдельные наряды. AI: утренний пакет → перестановка при срыве поставки → фиксация «нет материала».</p></div>
        <div class="apk-card nero-ai-delay-1"><h3>Пищевое производство</h3><p>35% простоев — смена материалов (кейс «Камский»). AI фиксирует простой, классифицирует, связывает с планом смены.</p></div>
        <div class="apk-card nero-ai-delay-2"><h3>Универсальный цех</h3><p>План в Excel, факт — устно. Telegram-бот → очередь операций → эскалация → сравнение смен.</p></div>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th>Роль</th><th>Было</th><th>С AI-агентом</th></tr></thead>
          <tbody>
            <tr><td>Диспетчер</td><td>Собирает потребности вручную</td><td>Агент читает заказы из 1С, диспетчер корректирует</td></tr>
            <tr><td>Мастер</td><td>Раздаёт задания, не выходит в цех</td><td>Подтверждает пакет, управляет отклонениями</td></tr>
            <tr><td>Исполнитель</td><td>Отмечает «сделал» в чате</td><td>Фиксирует старт/стоп в боте</td></tr>
            <tr><td>Руководитель</td><td>Ждёт отчёт в конце дня</td><td>Получает сводку и OEE-лайт автоматически</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="prostoi-oee">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">KPI и OEE</span>
        <h2>Контроль простоев и OEE: KPI, которые видит руководитель</h2>
        <p><strong>OEE = Доступность × Производительность × Качество</strong>. Для российских предприятий 65–75% — хорошая отправная точка; цель 75–80% за год.</p>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Метрика</th><th>Что показывает</th><th>Как помогает AI-агент</th></tr></thead>
          <tbody>
            <tr><td>OEE</td><td>Общая эффективность</td><td>Автосбор факта по смене</td></tr>
            <tr><td>MTBF / MTTR</td><td>Наработка / восстановление</td><td>Паттерны до отказа, эскалация</td></tr>
            <tr><td>Длительность простоев</td><td>Топ КПЭ ТОиР</td><td>Мгновенная фиксация</td></tr>
            <tr><td>План/факт смены</td><td>Выполнение заданий</td><td>Очередь + статусы</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-card nero-ai-reveal" style="margin-top:28px;">
        <h3>Карта потерь производства как старт аудита</h3>
        <p><strong>Лид-магнит Nero Network — «Карта потерь производства»</strong> — экспресс-аудит за 1–2 дня: обход цеха, оценка стоимости часа простоя, топ-3 причин, рекомендация пилотного участка. Выход — PDF + план пилота.</p>
      </div>
      <aside class="ym-cta-block ym-cta-block--primary" id="cta-karta-poter">
        <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта потерь производства — бесплатный аудит за 1–2 дня</p>
          <p class="ym-cta-block__sub">Обойдём цех, зафиксируем точки простоев и оценим стоимость часа остановки. На выходе — PDF «Карта потерь» и рекомендация пилотного участка без обязательств по внедрению.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </aside>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="integracii">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Интеграции</span>
        <h2>Интеграции без большого IT-бюджета: 1С, MES, таблицы, Telegram</h2>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Источник</th><th>Пилот (4–8 недель)</th><th>Тираж</th></tr></thead>
          <tbody>
            <tr><td>Telegram</td><td>Бот для мастера и исполнителей</td><td>Расширение на все смены</td></tr>
            <tr><td>Google Sheets / Excel</td><td>План смены, справочник простоев</td><td>Миграция в 1С</td></tr>
            <tr><td>1С:УНФ / КА / ERP</td><td>Чтение заказов и операций</td><td>Двусторонняя синхронизация</td></tr>
            <tr><td>n8n / Make</td><td>Оркестрация триггеров</td><td>Масштабирование правил</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="apk-table">
          <thead><tr><th></th><th>Excel / чаты</th><th>MES «на миллионы»</th><th>AI-агент Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Стоимость входа</td><td>0 ₽</td><td>5–80 млн ₽</td><td>500 тыс.–2 млн ₽</td></tr>
            <tr><td>Фиксация простоев</td><td>Поздняя</td><td>В реальном времени</td><td>В реальном времени + AI-аналитика</td></tr>
            <tr><td>Срок внедрения</td><td>—</td><td>6–18 месяцев</td><td>4–8 недель пилот</td></tr>
            <tr><td>Human-in-the-loop</td><td>—</td><td>Зависит от MES</td><td>По умолчанию</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="apk-section" id="dlya-kogo">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: малое производство, цеха, мебель, пищевка</h2>
      </div>
      <div class="apk-grid-2 nero-ai-reveal">
        <div class="apk-card">
          <h3>Где AI-агент даёт быстрый эффект</h3>
          <div class="apk-checklist">
            <div class="apk-check apk-check-yes">Цех 10–50 человек с ручной диспетчеризацией</div>
            <div class="apk-check apk-check-yes">2+ рабочих центра с перекидыванием заданий</div>
            <div class="apk-check apk-check-yes">План в 1С, Excel или Google Sheets</div>
            <div class="apk-check apk-check-yes">Руководитель хочет OEE-лайт без MES</div>
          </div>
        </div>
        <div class="apk-card nero-ai-delay-1">
          <h3>Где нужен оператор-контролёр</h3>
          <div class="apk-checklist">
            <div class="apk-check apk-check-no">Нет владельца процесса — «внедрим AI, а дальше сами»</div>
            <div class="apk-check apk-check-no">Данные о простоях никогда не фиксировались</div>
            <div class="apk-check apk-check-no">Ожидание «цифрового директора завода»</div>
          </div>
          <p style="margin-top:14px;">В этих случаях начните с <strong>Карты потерь</strong> — иногда проблема в процессе, а не в технологии.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="etapy">
    <div class="apk-cnt">
      <div class="apk-sh apk-left nero-ai-reveal">
        <span class="apk-eyebrow">Под ключ</span>
        <h2>Внедрение AI-агента под ключ: этапы от аудита до запуска на смене</h2>
      </div>
      <div class="apk-card nero-ai-reveal">
        <div class="apk-timeline">
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Аудит «Карта потерь» (1–2 дня)</h3><p>Как выдаются задания, карта точек фиксации простоев, оценка стоимости часа, топ-3 причин. Выход: PDF + рекомендация пилотного участка.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Пилот на одной линии (4–8 недель)</h3><p>1С / таблица / Telegram. AI-агент: задания, простои, эскалация, отчёт. KPI в договоре. Чек Nero Network 500 тыс.–2 млн ₽.</p></div>
          <div class="apk-tl-item"><div class="apk-tl-dot"></div><h3>Масштабирование и обучение мастеров</h3><p>Расширение на второй цех / смену, датчики (опционально), 2–3 сессии обучения — Telegram уже на телефоне.</p></div>
        </div>
      </div>
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением AI на производстве полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С — это ускоряет согласование с мастерами и IT. Посмотрите <a href="<?php echo esc_url( $secondary_cta_url ); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $secondary_cta_label ); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <section class="apk-section" id="cena-roi">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Коммерция</span>
        <h2>Стоимость, сроки и окупаемость</h2>
        <p>Ориентир чека <strong>500 тыс.–2 млн ₽</strong>. Для пилота на одном участке — от 500 000 ₽.</p>
      </div>
      <div class="apk-table-wrap nero-ai-reveal">
        <table class="apk-table">
          <thead><tr><th>Компонент</th><th>Что входит</th></tr></thead>
          <tbody>
            <tr><td>Аудит «Карта потерь»</td><td>Обход цеха, PDF, рекомендации</td></tr>
            <tr><td>Разработка AI-агента</td><td>Модули заданий, простоев, эскалации, отчётности</td></tr>
            <tr><td>Интеграции</td><td>1С, Telegram, таблицы, n8n</td></tr>
            <tr><td>Пилот 4–8 недель</td><td>Запуск на одном участке, KPI</td></tr>
          </tbody>
        </table>
      </div>
      <div class="apk-calc nero-ai-reveal">Потери в месяц = часы простоя × стоимость часа × кол-во центров
Экономия = (сокращение часов простоя на 20–40%) × стоимость часа
Окупаемость = стоимость пилота / экономия в месяц

Пример: 10 ч × 1 500 ₽/час = 15 000 ₽/мес. Сокращение на 30% = 4 500 ₽/мес.
На 3–5 участках — окупаемость за 6–18 месяцев.</div>
    </div>
  </section>

  <section class="apk-section apk-section-alt" id="keisy">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">Кейсы</span>
        <h2>Примеры внедрения и кейсы</h2>
      </div>
      <div class="apk-case-grid nero-ai-reveal">
        <div class="apk-case-card"><div class="apk-case-tag">Мебель</div><h3>Задачи в WhatsApp → единый контур</h3><p>18 человек. AI читает 1С:УНФ, перестановка кнопкой мастера. Время перестройки — с 40–60 мин до 5–10 мин.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">Пищевка</div><h3>Простой через 2 часа → алерт за минуты</h3><p>Линия упаковки. Исполнитель отмечает простой в боте, через 15 мин — эскалация мастеру. Топ причин за неделю без ручного сбора.</p></div>
        <div class="apk-case-card"><div class="apk-case-tag">Универсальный цех</div><h3>Передача смены без потери задач</h3><p>Briefing: незакрытые операции, критичные простои, приоритеты. По аналогии с Oxmaint — снижение «потери задач» до 8%.</p></div>
      </div>
    </div>
  </section>

  <section class="apk-section" id="faq">
    <div class="apk-cnt">
      <div class="apk-sh nero-ai-reveal">
        <span class="apk-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI на производстве</h2>
      </div>
      <div class="apk-faq nero-ai-reveal">
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли свой IT-отдел?</div><div class="apk-faq-a">Нет для пилота. Nero Network берёт разработку и интеграцию. На стороне заказчика нужен владелец процесса — мастер или производственный директор.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как связать с 1С и ERP?</div><div class="apk-faq-a">Агент читает документы через API или ODBC. Поддерживаются 1С:УНФ, КА, ERP. Агент — надстройка, не замена 1С.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Чем agentic AI отличается от «просто дашборда»?</div><div class="apk-faq-a">Дашборд показывает цифры. Agentic AI собирает данные, предлагает действия, генерирует отчёты. Критические решения — за человеком.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики на станках?</div><div class="apk-faq-a">Нет для старта. Фиксация через Telegram-бот или планшет. Датчики — опция на этапе тиража.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Работает ли без 1С?</div><div class="apk-faq-a">Да. План смены можно вести в Google Sheets или Excel — агент подключится к таблице.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Кто отвечает, если AI ошибся?</div><div class="apk-faq-a">Агент не меняет план без подтверждения мастера. Ответственность — за человеком. Все действия логируются.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как соблюдается 152-ФЗ?</div><div class="apk-faq-a">Yandex GPT / GigaChat в облаке или on-premise. На тираже — развёртывание в контуре заказчика.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени до первого результата?</div><div class="apk-faq-a">Карта потерь — 1–2 дня. Пилот на участке — 4–8 недель до рабочего контура на смене.</div></div>
        <div class="apk-faq-item"><div class="apk-faq-q" role="button" tabindex="0" aria-expanded="false">Как заказать аудит и внедрение?</div><div class="apk-faq-a">Оставьте заявку с CTA «Найти простои» — проведём экспресс-аудит и подготовим «Карту потерь производства».</div></div>
      </div>
    </div>
  </section>

  <section class="apk-section" id="cta" style="background:linear-gradient(135deg,rgba(121,242,255,.08),rgba(139,92,246,.08));">
    <div class="apk-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашем производстве</p>
          <p class="ym-cta-block__sub">Задачи меняются вручную. Простои фиксируются поздно. <strong>Nero Network</strong> внедряет AI-агент для производства под ключ — с human-in-the-loop, интеграцией с 1С и Telegram. Первый шаг — бесплатная «Карта потерь производства»: обход цеха, оценка стоимости часа простоя, топ-3 причин.</p>
          <a href="<?php echo esc_url( $primary_cta_url ); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        </div>
      </div>
    </div>
  </section>

</div>
'''

content = CONTENT.replace("BORIS_PLACEHOLDER", boris_html)

full = PHP_HEAD + hero_html + "\n\n" + content + PHP_TAIL
OUT.parent.mkdir(parents=True, exist_ok=True)
OUT.write_text(full, encoding="utf-8")
print(f"Written {OUT} ({len(full)} bytes)")
