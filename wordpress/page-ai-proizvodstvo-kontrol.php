<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев: внедрение под ключ
 * Description: SEO-лендинг — AI производство контроль, сменные задания, контроль простоев.
 */

$page_seo_title       = 'AI производство контроль: агент для сменных заданий под ключ';
$page_seo_description = 'Внедрение AI-агента для сменных заданий и контроля простоев на производстве. Фиксация отклонений в реальном времени, отчёт руководителю. Под ключ — от 500 тыс. ₽.';

add_filter('document_title_parts', static function (array $parts) use ($page_seo_title): array {
    $parts['title'] = $page_seo_title;
    return $parts;
}, 20);

add_action('wp_head', static function () use ($page_seo_title, $page_seo_description): void {
    echo '<meta name="description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($page_seo_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($page_seo_description) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
    echo '<meta property="og:type" content="article" />' . "\n";
}, 1);

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Простои',      'href' => '#bole'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Стоимость',    'href' => '#ceny'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как работает';
$secondary_cta_url   = '#kak-rabotaet';
$secondary_training_url = getenv('SECONDARY_CTA_URL') ?: '';
$ad_banner_url       = getenv('AD_BANNER_URL') ?: '';
$ad_banner_image_url = getenv('AD_BANNER_IMAGE_URL') ?: '';
$ad_banner_alt       = getenv('AD_BANNER_ALT') ?: 'Реклама';

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
.apkc-content{--apkc-primary:#79f2ff;--apkc-accent:#8b5cf6;--apkc-warn:#f59e0b;--apkc-danger:#fb7185;--apkc-green:#22c55e;--apkc-bg:#050711;--apkc-surface:rgba(255,255,255,.072);--apkc-text:#e6edf7;--apkc-muted:#9aa8bd;--apkc-soft:#c7d2e5;--apkc-heading:#fff;--apkc-border:rgba(255,255,255,.10);--apkc-r:18px;--apkc-r-lg:24px;--apkc-container:1220px;background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);color:var(--apkc-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden}
.apkc-content *,.apkc-content *::before,.apkc-content *::after{box-sizing:border-box}
.apkc-content a{color:inherit;text-decoration:none}
.apkc-content p{color:var(--apkc-muted);line-height:1.72;margin:0 0 1em}
.apkc-content h2,.apkc-content h3,.apkc-content h4{color:var(--apkc-heading);letter-spacing:-.045em;margin:0 0 .7em}
.apkc-content strong{color:var(--apkc-soft)}
.apkc-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.apkc-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--apkc-muted);font-size:14.5px;line-height:1.65}
.apkc-content ul li::before{content:'›';position:absolute;left:0;color:var(--apkc-primary);font-weight:700}
.apkc-cnt{width:min(var(--apkc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.apkc-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.apkc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.apkc-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.apkc-sh.apkc-left{margin-left:0;text-align:left}
.apkc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.apkc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.apkc-sh.apkc-left p{margin-left:0}
.apkc-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--apkc-primary);margin-bottom:14px}
.apkc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.apkc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.apkc-intro-text{position:relative;padding-left:20px}
.apkc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--apkc-primary),var(--apkc-accent))}
.apkc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.apkc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.apkc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center}
.apkc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--apkc-heading)}
.apkc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--apkc-muted)}
.apkc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.apkc-intro-grid{grid-template-columns:1fr}.apkc-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.apkc-intro-kpi{grid-template-columns:1fr 1fr}}
.apkc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.ym-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.ym-toc a{display:inline-block;padding:9px 18px;background:var(--apkc-surface);border:1px solid var(--apkc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--apkc-muted)}
.ym-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--apkc-primary)}
.apkc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--apkc-border);border-radius:var(--apkc-r-lg);padding:26px}
.apkc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.apkc-grid-3{grid-template-columns:1fr}}
.apkc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0}
.apkc-table{width:100%;border-collapse:collapse;font-size:14px}
.apkc-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--apkc-primary);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.apkc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--apkc-text);vertical-align:top}
.apkc-flow{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin:28px 0}
@media(max-width:900px){.apkc-flow{grid-template-columns:1fr 1fr}}
@media(max-width:520px){.apkc-flow{grid-template-columns:1fr}}
.apkc-flow-step{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:20px 16px}
.apkc-flow-step .num{font-size:11px;font-weight:800;color:var(--apkc-primary);letter-spacing:.1em;margin-bottom:8px}
.apkc-flow-step h3{font-size:15px;margin-bottom:6px}
.apkc-flow-step p{font-size:13px;margin:0}
.apkc-scenario{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:var(--apkc-r);padding:26px;margin-bottom:14px}
.apkc-process-item{display:grid;grid-template-columns:56px 1fr;gap:20px;padding:22px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:16px;margin-bottom:12px}
.apkc-process-num{font-size:28px;font-weight:900;color:var(--apkc-primary);opacity:.7}
.apkc-int-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:14px;margin:24px 0}
.apkc-int-chip{padding:16px;border-radius:14px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);text-align:center;font-weight:700;color:var(--apkc-soft)}
.apkc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.apkc-case-grid{grid-template-columns:1fr}}
.apkc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.apkc-case-tag{font-size:11px;font-weight:700;text-transform:uppercase;color:var(--apkc-green);margin-bottom:10px}
.apkc-kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin:24px 0}
@media(max-width:768px){.apkc-kpi-grid{grid-template-columns:1fr 1fr}}
.apkc-kpi-box{padding:20px;border-radius:16px;background:rgba(139,92,246,.1);border:1px solid rgba(139,92,246,.25);text-align:center}
.apkc-kpi-box strong{display:block;font-size:clamp(22px,3vw,32px);color:#fff}
.apkc-quote{border-left:3px solid var(--apkc-accent);padding:16px 20px;margin:24px 0;background:rgba(139,92,246,.06);border-radius:0 14px 14px 0;font-style:italic;color:var(--apkc-soft)}
.apkc-highlight{background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.25);border-radius:24px;padding:clamp(32px,5vw,48px)}
.apkc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.apkc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.apkc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--apkc-heading);cursor:pointer;display:flex;justify-content:space-between;gap:16px}
.apkc-faq-q::after{content:'▾';color:var(--apkc-primary)}
.apkc-faq-item.open .apkc-faq-q::after{transform:rotate(180deg)}
.apkc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease}
.apkc-faq-item.open .apkc-faq-a{max-height:800px;padding:0 24px 20px}
.apkc-pain{color:var(--apkc-danger)!important}
.apkc-warn-mark{color:var(--apkc-warn)!important}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;text-align:center;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3)}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(121,242,255,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--apkc-muted);font-size:15px;margin:0 auto 22px;max-width:600px}
.ym-btn{display:inline-flex;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important}
.ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important}
.ym-link--accent{color:var(--apkc-primary)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.apkc-hero-erp{min-height:100vh;min-height:100dvh;position:relative;display:flex;align-items:center;padding:clamp(80px,12vh,120px) 0}
.apkc-hero-erp .nero-ai-live-pill{display:inline-flex;align-items:center;gap:7px;padding:6px 9px;border-radius:999px;background:rgba(34,197,94,.10);color:#bbf7d0;font-size:12px;font-weight:800}
.apkc-hero-erp .nero-ai-live-pill::before{content:'';width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 6px rgba(34,197,94,.14);animation:apkcPulse 1.6s infinite}
@keyframes apkcPulse{0%,100%{transform:scale(.86);opacity:.65}50%{transform:scale(1);opacity:1}}
.apkc-hero-erp .apkc-dash-canvas-wrap{position:relative;height:clamp(160px,22vw,220px);margin:0 0 12px;border-radius:18px;overflow:hidden;border:1px solid rgba(121,242,255,.14);background:radial-gradient(ellipse at 50% 40%,rgba(121,242,255,.08),rgba(6,10,24,.9) 70%)}
.apkc-hero-erp #apkc-hero-shift-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
.apkc-callout{padding:18px 22px;border-radius:14px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.25);margin:20px 0;font-size:14.5px;color:var(--apkc-soft)}
.apkc-callout--benchmark{background:rgba(139,92,246,.08);border-color:rgba(139,92,246,.25)}
.apkc-def-block{padding:24px 28px;border-radius:18px;background:rgba(121,242,255,.06);border:1px solid rgba(121,242,255,.2);margin:24px 0}
.apkc-def-block ol{margin:12px 0 0;padding-left:20px;color:var(--apkc-muted)}
.apkc-def-block ol li{margin-bottom:8px;line-height:1.65}
[data-nero-tooltip]{position:relative;cursor:help}
[data-nero-tooltip]::after{content:attr(data-nero-tooltip);position:absolute;bottom:calc(100% + 8px);left:50%;transform:translate(-50%,4px);padding:8px 12px;border-radius:10px;background:#0f172a;color:#e2e8f0;font-size:11px;font-weight:600;line-height:1.4;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .2s,transform .2s;z-index:5;border:1px solid rgba(121,242,255,.25)}
[data-nero-tooltip]:hover::after,[data-nero-tooltip]:focus-visible::after{opacity:1;transform:translate(-50%,0)}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-proizvodstvo-kontrol-page" role="main" tabindex="-1">

<!-- === ALINA (HERO) === -->
<section class="nero-ai-hero apkc-hero-erp" id="hero" aria-labelledby="apkc-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · производство и смены</p>
      <h1 id="apkc-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">под ключ</span></h1>
      <p class="nero-ai-hero-lead">Смена под контролем: AI фиксирует отклонения и простои в момент события — до того, как они превратятся в потери. Не «чёрный ящик», а проверяемый контроль: человек подтверждает критичные решения, руководитель видит картину в реальном времени.</p>
      <ul class="nero-ai-badges" aria-label="Ключевые теги">
        <li class="nero-ai-badge">Сменные задания</li><li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Human-in-the-loop</li><li class="nero-ai-badge">1С / MES</li>
        <li class="nero-ai-badge">Telegram</li><li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает агент</a>
      </div>
    </div>
    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Пульт контроля смены">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-агента · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title"><h3>Пульт контроля смены</h3><span class="nero-ai-live-pill">онлайн</span></div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric" data-nero-tooltip="AI фиксирует остановку в момент события, не в конце недели" tabindex="0"><span>Простои за смену</span><strong>47 мин</strong></div>
            <div class="nero-ai-metric" data-nero-tooltip="План vs факт — агент предлагает перестановку заданий" tabindex="0"><span>Отклонения</span><strong>3</strong></div>
            <div class="nero-ai-metric" data-nero-tooltip="Оценка по данным смены · демо" tabindex="0"><span>OEE смены</span><strong>82%</strong></div>
            <div class="nero-ai-metric" data-nero-tooltip="Критичный простой ушёл директору в Telegram" tabindex="0"><span>Эскалация</span><strong>1</strong></div>
          </div>
          <div class="apkc-dash-canvas-wrap" aria-hidden="false">
            <canvas id="apkc-hero-shift-canvas" role="img" aria-label="Анимация: загрузка рабочих центров, простой на РЦ-2 и динамика OEE смены"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task"><span class="nero-ai-task-icon">🟠</span><div><strong>РЦ-2 · простой 12 мин</strong><span>нет материала</span></div></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">🟢</span><div><strong>Перестановка задания</strong><span>подтверждено мастером</span></div></div>
            <div class="nero-ai-task"><span class="nero-ai-task-icon">🔵</span><div><strong>Отчёт смены</strong><span>готов к отправке</span></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
(function(){
'use strict';
var cv=document.getElementById('apkc-hero-shift-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||400;cv.height=p.clientHeight||200;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var bars=[{x:.12,h:.55,label:'РЦ-1',ok:1},{x:.42,h:.38,label:'РЦ-2',ok:0},{x:.72,h:.62,label:'РЦ-3',ok:1}];
function loop(){
  frame++;
  ctx.clearRect(0,0,W,H);
  ctx.fillStyle='rgba(6,10,24,.4)';ctx.fillRect(0,0,W,H);
  var bw=W*0.14,bh0=H*0.55,by=H*0.78;
  bars.forEach(function(b,i){
    var pulse=b.ok?0.04*Math.sin(frame*0.06+i):0;
    var h=(b.h+pulse)*bh0;
    var x=b.x*W;
    ctx.fillStyle=b.ok?'rgba(34,197,94,.75)':'rgba(245,158,11,.85)';
    if(!b.ok){ctx.shadowColor='rgba(245,158,11,.4)';ctx.shadowBlur=12;}
    ctx.beginPath();ctx.roundRect(x,by-h,bw,h,6);ctx.fill();ctx.shadowBlur=0;
    ctx.fillStyle='#94a3b8';ctx.font='10px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText(b.label,x+bw/2,by+14);
  });
  ctx.strokeStyle='rgba(121,242,255,.5)';ctx.lineWidth=2;ctx.beginPath();
  for(var i=0;i<=W;i+=4){
    var t=(i/W*6+frame*0.03)%6;
    var y=H*0.28+Math.sin(t)*H*0.08+(bars[1].ok?0:Math.sin(frame*0.1)*3);
    i===0?ctx.moveTo(i,y):ctx.lineTo(i,y);
  }
  ctx.stroke();
  ctx.fillStyle='#79f2ff';ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
  ctx.fillText('OEE смены · 82%',12,18);
  requestAnimationFrame(loop);
}
if(document.fonts&&document.fonts.ready)document.fonts.ready.then(loop);else loop();
})();
</script>

<div class="apkc-content">

<section class="apkc-intro nero-ai-section" id="vvedenie">
  <div class="apkc-cnt">
    <div class="apkc-intro-grid nero-ai-reveal">
      <div class="apkc-intro-text">
        <p class="apkc-eyebrow">Лонгрид · ai производство контроль</p>
        <p><strong>Коротко:</strong> AI производство контроль — это проверяемый AI-агент на смене, а не автономный «завод без людей». Он формирует сменные задания, фиксирует отклонения и простои в момент события, эскалирует критичные остановки и собирает отчёт по смене. Человек остаётся в контуре решений — human-in-the-loop. Nero Network внедряет такой агент под ключ для малого производства: цеха, мебель, пищевка.</p>
      </div>
      <div class="apkc-intro-kpi" aria-label="Ключевые ориентиры">
        <div class="apkc-kpi-card" data-nero-tooltip="Международный ориентир ISA" tabindex="0"><div class="kv">5–20%</div><div class="kl">потери от незамеченных простоев</div><div class="ks">ISA / TWI</div></div>
        <div class="apkc-kpi-card" data-nero-tooltip="Целевая скорость фиксации на пилоте" tabindex="0"><div class="kv">Минуты</div><div class="kl">фиксация простоя</div><div class="ks">не «конец недели»</div></div>
        <div class="apkc-kpi-card" data-nero-tooltip="Ориентир внедрения под ключ" tabindex="0"><div class="kv">500 тыс.–2 млн ₽</div><div class="kl">внедрение под ключ</div><div class="ks">продуктовая матрица</div></div>
        <div class="apkc-kpi-card" data-nero-tooltip="Пилот на одной смене" tabindex="0"><div class="kv">3–4 недели</div><div class="kl">пилот на смене</div><div class="ks">этап 1</div></div>
      </div>
    </div>
  </div>
</section>

<div class="apkc-toc-outer"><div class="apkc-cnt">
  <nav class="ym-toc" aria-label="Оглавление">
    <a href="#bole">Простои</a><a href="#kak-rabotaet">Как работает</a><a href="#dlya-kogo">Для кого</a>
    <a href="#etapy">Внедрение</a><a href="#integracii">Интеграции</a><a href="#ceny">Цена</a>
    <a href="#keisy">Кейсы</a><a href="#agentic-ai">Agentic AI</a><a href="#faq">FAQ</a>
  </nav>
</div></div>

<section class="apkc-section apkc-section-alt" id="bole">
  <div class="apkc-cnt">
    <div class="apkc-sh apkc-left nero-ai-reveal">
      <span class="apkc-eyebrow">Боль ЦА</span>
      <h2>Почему на производстве теряют деньги, когда простои фиксируются <span class="apkc-warn-mark">поздно</span></h2>
      <p>На большинстве малых производств контроль простоев устроен так: мастер держит задания в голове или на бумажке, операторы сообщают об остановках устно, а в конце недели кто-то переносит цифры в Excel. Руководитель узнаёт о потерях, когда уже поздно — перераспределить людей, заказать материал или остановить повторяющуюся поломку нельзя.</p>
    </div>
    <p class="nero-ai-reveal apkc-pain"><strong>Типичная боль:</strong> задачи меняются вручную, простои фиксируются поздно. Мастер — бутылочное горлышко: до 40% его времени уходит не на управление, а на поиск деталей и согласования (кейс KOBLIK GROUP до цифровизации сменных заданий, 1С Awards).</p>
    <p class="nero-ai-reveal">По оценке ISA (TWI Institute), незапланированные простои съедают <strong>5–20% годовой производительности</strong>. Российские обзоры таблиц потерь дают ориентир <strong>8–15%</strong> производственного времени на внеплановые остановки (Inner.su — не госстатистика). Для расчёта «карты потерь» встречаются иллюстративные <strong>5 000–10 000 ₽/час</strong> простоя высокопроизводительного оборудования.</p>
    <div class="apkc-callout nero-ai-reveal"><strong>Оговорка (ориентир / пилот):</strong> официальной росстатистики потерь малого производства в рублях не найдено. Мы не обещаем «гарантированный ROI 300%» — считаем экономику через пилот: стоимость часа простоя × часы, которые перестали быть невидимыми.</div>
    <div class="apkc-table-wrap nero-ai-reveal">
      <table class="apkc-table">
        <thead><tr><th>Способ учёта</th><th>Когда видны простои</th><th>Алерт руководителю</th><th>Перестановка при сбое</th></tr></thead>
        <tbody>
          <tr><td>Бумага / устно</td><td class="apkc-pain">Конец смены или недели</td><td>Нет</td><td>Нет</td></tr>
          <tr><td>Excel</td><td class="apkc-pain">Когда успели внести</td><td>Нет</td><td>Нет</td></tr>
          <tr><td>MES-lite</td><td>В течение смены</td><td>Частично (дашборд)</td><td>По правилам, без reasoning</td></tr>
          <tr><td><strong>AI-агент Nero Network</strong></td><td><strong>В момент события</strong></td><td><strong>Telegram / отчёт</strong></td><td><strong>С подтверждением мастера</strong></td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal">Пока простой не зафиксирован, вы теряете не только время станка, но и шанс <strong>найти простои</strong> — увидеть повторяющиеся причины и закрыть их до конца месяца.</p>
  </div>
</section>


<section id="apkc-boris-shift-block" class="apkc-boris-root" aria-label="Анимация: AI-агент фиксирует простои и переставляет сменные задания на цеху">
<style>
#apkc-boris-shift-block.apkc-boris-root{padding:56px 0 64px;background:#f8fafc}
#apkc-boris-shift-block .apkc-boris-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#apkc-boris-shift-block .apkc-boris-card{display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);min-height:500px}
@media(max-width:1023px){#apkc-boris-shift-block .apkc-boris-card{grid-template-columns:1fr;min-height:auto}}
#apkc-boris-shift-block .apkc-boris-lft{padding:40px 36px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid #e2e8f0}
@media(max-width:1023px){#apkc-boris-shift-block .apkc-boris-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}}
#apkc-boris-shift-block .apkc-boris-ey{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#0369a1;margin:0 0 14px}
#apkc-boris-shift-block .apkc-boris-ey::before{content:'';width:18px;height:2px;background:#0369a1;border-radius:1px}
#apkc-boris-shift-block .apkc-boris-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#apkc-boris-shift-block .apkc-boris-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#apkc-boris-shift-block .apkc-boris-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#apkc-boris-shift-block .apkc-boris-ic{flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(3,105,161,.1);display:flex;align-items:center;justify-content:center;font-size:11px;color:#0369a1;margin-top:1px;font-style:normal}
#apkc-boris-shift-block .apkc-boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#apkc-boris-shift-block .apkc-boris-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#apkc-boris-shift-block .apkc-boris-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#apkc-boris-shift-block .apkc-boris-pl-o{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22)}
#apkc-boris-shift-block .apkc-boris-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22)}
#apkc-boris-shift-block .apkc-boris-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#apkc-boris-shift-block .apkc-boris-rgt{position:relative;background:linear-gradient(135deg,#f0f9ff 0%,#e0f2fe 28%,#fef3c7 72%,#f8fafc 100%);min-height:440px;overflow:hidden}
@media(max-width:1023px){#apkc-boris-shift-block .apkc-boris-rgt{min-height:380px}}
#apkc-boris-shift-monitor-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>
<div class="apkc-boris-cnt">
  <div class="apkc-boris-card">
    <div class="apkc-boris-lft">
      <span class="apkc-boris-ey">Смена в реальном времени</span>
      <h3 class="apkc-boris-h3">Простой на РЦ-2 — агент фиксирует, классифицирует и эскалирует директору</h3>
      <ul class="apkc-boris-ul">
        <li><span class="apkc-boris-ic">1</span>Оператор нажимает «Простой» — агент стартует таймер и запрашивает причину</li>
        <li><span class="apkc-boris-ic">2</span>NLP-классификация: нет материала, поломка, переналадка, нет персонала</li>
        <li><span class="apkc-boris-ic">3</span>План vs факт: агент предлагает перестановку заданий на соседний РЦ</li>
        <li><span class="apkc-boris-ic">✓</span>Мастер подтверждает — human-in-the-loop; критичное уходит в Telegram</li>
      </ul>
      <div class="apkc-boris-pills">
        <span class="apkc-boris-pl apkc-boris-pl-o">12 мин простой</span>
        <span class="apkc-boris-pl apkc-boris-pl-g">подтверждено</span>
        <span class="apkc-boris-pl apkc-boris-pl-b">Telegram → директор</span>
      </div>
      <p class="apkc-boris-foot">Дальше — как работает AI-агент на смене по шагам →</p>
    </div>
    <div class="apkc-boris-rgt">
      <canvas id="apkc-boris-shift-monitor-canvas" aria-label="Анимация: рабочие центры цеха, сменные задания, фиксация простоя и эскалация в Telegram" role="img"></canvas>
    </div>
  </div>
</div>
<script>
(function(){
'use strict';
var cv=document.getElementById('apkc-boris-shift-monitor-canvas');
if(!cv)return;
var ctx=cv.getContext('2d'),W=0,H=0,frame=0;
function resize(){var p=cv.parentElement;if(!p)return;cv.width=p.clientWidth||640;cv.height=p.clientHeight||480;W=cv.width;H=cv.height;}
window.addEventListener('resize',resize);resize();
var C={floor:'#e2e8f0',rc:'#cbd5e1',rcActive:'#38bdf8',rcDown:'#f59e0b',rcDownGlow:'rgba(245,158,11,.35)',task:'#22c55e',taskGlow:'rgba(34,197,94,.25)',alert:'#fb7185',ink:'#0f172a',muted:'#64748b',tg:'#0ea5e9',pill:'#fff'};
var rcs=[{x:.15,y:.55,w:.18,h:.22,label:'РЦ-1',status:'ok'},{x:.41,y:.55,w:.18,h:.22,label:'РЦ-2',status:'down'},{x:.67,y:.55,w:.18,h:.22,label:'РЦ-3',status:'ok'}];
var tasks=[{x:.08,y:.25,t:0,label:'Задание A'},{x:.35,y:.22,t:40,label:'Задание B'},{x:.62,y:.28,t:80,label:'Задание C'}];
var pulse=0,alertLife=0;
function drawRC(rc,down){
  var x=rc.x*W,y=rc.y*H,w=rc.w*W,h=rc.h*H;
  if(down){ctx.fillStyle=C.rcDownGlow;ctx.beginPath();ctx.roundRect(x-6,y-6,w+12,h+12,14);ctx.fill();}
  ctx.fillStyle=down?C.rcDown:C.rcActive;
  ctx.strokeStyle=down?'#d97706':'#0284c7';ctx.lineWidth=2;
  ctx.beginPath();ctx.roundRect(x,y,w,h,10);ctx.fill();ctx.stroke();
  ctx.fillStyle='#fff';ctx.font='bold 13px Inter,sans-serif';ctx.textAlign='center';
  ctx.fillText(rc.label,x+w/2,y+h/2+5);
  if(down){ctx.fillStyle='#fff';ctx.font='bold 10px Inter,sans-serif';ctx.fillText('ПРОСТОЙ',x+w/2,y+h/2+22);}
}
function drawTask(t,idx){
  var phase=(frame*0.02+t)%200;
  var tx=(0.1+phase/200*0.75)*W;
  var ty=t.y*H+Math.sin(frame*0.05+idx)*4;
  ctx.fillStyle=C.taskGlow;ctx.beginPath();ctx.arc(tx,ty,14,0,Math.PI*2);ctx.fill();
  ctx.fillStyle=C.task;ctx.beginPath();ctx.arc(tx,ty,8,0,Math.PI*2);ctx.fill();
  ctx.fillStyle=C.ink;ctx.font='10px Inter,sans-serif';ctx.textAlign='center';ctx.fillText(t.label,tx,ty-16);
}
function drawTelegram(){
  var bx=W*0.72,by=H*0.08,bw=120,bh=52;
  pulse=0.5+0.5*Math.sin(frame*0.08);
  ctx.globalAlpha=0.15+pulse*0.15;ctx.fillStyle=C.tg;ctx.beginPath();ctx.roundRect(bx-4,by-4,bw+8,bh+8,16);ctx.fill();ctx.globalAlpha=1;
  ctx.fillStyle=C.pill;ctx.strokeStyle=C.tg;ctx.lineWidth=2;ctx.beginPath();ctx.roundRect(bx,by,bw,bh,12);ctx.fill();ctx.stroke();
  ctx.fillStyle=C.tg;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='left';
  ctx.fillText('Telegram',bx+10,by+18);ctx.font='10px Inter,sans-serif';ctx.fillStyle=C.muted;
  ctx.fillText('РЦ-2 · 12 мин',bx+10,by+34);
}
function loop(){
  frame++;
  ctx.clearRect(0,0,W,H);
  ctx.fillStyle=C.floor;ctx.fillRect(0,H*0.48,W,H*0.52);
  for(var i=0;i<3;i++){ctx.strokeStyle=C.rc;ctx.lineWidth=1;ctx.beginPath();ctx.moveTo(0,H*0.48+i*18);ctx.lineTo(W,H*0.48+i*18);ctx.stroke();}
  tasks.forEach(function(t,i){drawTask(t,i);});
  rcs.forEach(function(rc){drawRC(rc,rc.status==='down');});
  drawTelegram();
  if(frame%180===0)alertLife=60;
  if(alertLife>0){
    alertLife--;
    ctx.fillStyle='rgba(251,113,133,.12)';ctx.fillRect(W*0.38,H*0.38,W*0.24,28);
    ctx.fillStyle=C.alert;ctx.font='bold 11px Inter,sans-serif';ctx.textAlign='center';
    ctx.fillText('Эскалация директору',W*0.5,H*0.38+18);
  }
  requestAnimationFrame(loop);
}
if(document.fonts&&document.fonts.ready)document.fonts.ready.then(loop);else loop();
})();
</script>
</section>


<section class="apkc-section" id="kak-rabotaet">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal">
      <span class="apkc-eyebrow">Продукт</span>
      <h2>Что такое AI производство контроль и как работает агент на смене</h2>
    </div>
    <div class="apkc-def-block nero-ai-reveal">
      <p><strong>AI производство контроль</strong> — надстройка над процессами цеха, а не замена MES «с нуля» и не абстрактный чат-бот. AI-агент:</p>
      <ol>
        <li>Формирует и обновляет <strong>сменные задания</strong> из плана (<a href="/ai-1c-erp/" style="color:var(--apkc-primary);text-decoration:underline;text-underline-offset:3px">1С и ERP с AI-агентом</a>, MES-lite или ручной ввод мастера).</li>
        <li>Собирает <strong>факт смены</strong> — планшеты, Telegram, терминалы, датчики, ручные отметки.</li>
        <li>Ведёт <strong>контроль простоев</strong>: фиксирует остановку и классифицирует причину.</li>
        <li>Формирует <strong>отчёт руководителю</strong> — сводка, топ-потери, рекомендации; критичное — в мессенджер.</li>
      </ol>
      <p style="margin-top:14px;margin-bottom:0">AI собирает данные по смене, фиксирует отклонения и формирует отчёт руководителю — <strong>внедрение под ключ</strong>, ориентир <strong>500 тыс.–2 млн ₽</strong>.</p>
    </div>
    <div class="apkc-flow nero-ai-reveal">
      <div class="apkc-flow-step"><div class="num">01</div><h3>Утро смены</h3><p>План из 1С/MES → задания на планшеты или в Telegram</p></div>
      <div class="apkc-flow-step"><div class="num">02</div><h3>Во время смены</h3><p>Кнопка «Простой» + причина; датчик Modbus подтверждает факт</p></div>
      <div class="apkc-flow-step"><div class="num">03</div><h3>Отклонение</h3><p>Перестановка заданий — мастер подтверждает или отклоняет</p></div>
      <div class="apkc-flow-step"><div class="num">04</div><h3>Эскалация</h3><p>Простой дольше N минут → Telegram директору с оценкой потерь</p></div>
      <div class="apkc-flow-step"><div class="num">05</div><h3>Отчёт</h3><p>Топ-3 простоя, OEE, рекомендации на следующую смену</p></div>
    </div>
    <div class="apkc-card nero-ai-reveal">
      <h3>Сбор данных по смене — задания, отклонения, простои</h3>
      <p><strong>Утро смены.</strong> Агент получает план из 1С/MES → раскладывает задания по РЦ и исполнителям → отправляет на планшеты или в Telegram. Паттерн как у KOBLIK «Завод на автопилоте», но поверх цифровой базы — <strong>agentic-слой</strong> с анализом отклонений.</p>
      <p><strong>Во время смены.</strong> Оператор отмечает старт и финиш. При остановке — кнопка «Простой» и причина (или голос/чат). Датчик Modbus <strong>подтверждает</strong> факт, но не заменяет человека в классификации.</p>
      <p><strong>При отклонении.</strong> Агент сравнивает план и факт. Отставание выше порога — предлагает перестановку, уведомляет мастера. <strong>Мастер подтверждает или отклоняет</strong> — без автономных необратимых действий.</p>
    </div>
    <div class="apkc-card nero-ai-reveal" style="margin-top:16px">
      <h3>Отчёт руководителю в реальном времени — human-in-the-loop</h3>
      <p>Gartner: <strong>более 40% agentic AI-проектов</strong> будут отменены к 2027 из‑за затрат, неясного ROI и слабого контроля рисков. Ответ Nero Network — <strong>semiautomatic human-in-the-loop</strong> (IEEE / Manufacturing Dive): человек валидирует нештатные сценарии; критичные действия логируются и требуют подтверждения.</p>
      <p>На заводе Bosch agentic AI на планшете ускоряет диагностику поломок — оператор подтверждает действия агента. У Nero Network фокус шире: <strong>все типы простоев + сменные задания + отчёт директору</strong> для цеха из 5–20 РЦ.</p>
    </div>
  </div>
</section>

<section class="apkc-section apkc-section-alt" id="dlya-kogo">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Сегменты</span><h2>Для кого подходит внедрение AI для производства</h2>
    <p>Продукт для <strong>малого производства</strong> — цеха, мебель, пищевка. Там, где нет штатного IT-директора, но есть измеримая боль: <strong>ai производство контроль для малого бизнеса</strong>, а не презентация для enterprise.</p></div>
    <div class="apkc-grid-3 nero-ai-reveal">
      <div class="apkc-card"><h3>🪑 Малые цеха и мебельное производство</h3><p>Мелкосерийка живёт переналадками: фасады, кромки, программы ЧПУ. На Дмитровском мебельном комбинате — 1С-БАЗИС: автосменные задания и загрузка (sapr.ru). Планирование есть, <strong>AI-контроля простоев в реальном времени</strong> — нет.</p><p><strong>Сценарий:</strong> утром агент собирает заказы из 1С → задания на раскрой и кромление → при задержке материала на РЦ-2 предлагает переставить бригаду → директор видит простой в Telegram, не в пятничном Excel.</p></div>
      <div class="apkc-card"><h3>🥩 Пищевое производство и контроль смен</h3><p>На крупных площадках (Черкизово + MES) — сквозная прослеживаемость. Малый цех пищевки: санитарные остановки, смена сырья, короткие партии. Нужны <strong>классификация причин простоя</strong> и отчёт по смене, а не многомесячный MES-проект.</p><p><strong>Сценарий:</strong> оператор фиксирует «мойка линии» или «нет сырья»; агент не даёт потерять 40 минут «между делом»; в конце смены — топ-причин и «заказать X до вторника».</p></div>
      <div class="apkc-card"><h3>⚙️ Универсальный малый цех (5–15 РЦ)</h3><p>Металлообработка, сборка, упаковка. <strong>Цифровые сменные задания</strong> без AI уже доступны (MESlite от <strong>60 000 ₽</strong>, Планол — запуск <strong>за неделю</strong>). Следующий шаг — <strong>AI-слой</strong>: reasoning при отклонениях, NLP-классификация, отчёт на естественном языке.</p></div>
    </div>
  </div>
</section>

<section class="apkc-section" id="etapy">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Под ключ</span><h2>Внедрение AI агентов в бизнес-процессы производства под ключ</h2>
    <p>Внедрение ai в бизнес-процессы производства — проект с измеримыми этапами, а не бесконечный «пилот ради пилота». Так снижается риск попасть в прогноз Gartner об отмене agentic-проектов.</p>
    <p class="nero-ai-reveal">Смежный контур — когда заявки приходят по почте и попадают в CRM до планирования смены: <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--apkc-primary);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> на отдельной посадочной.</p></div>
    <div class="apkc-table-wrap nero-ai-reveal">
      <table class="apkc-table">
        <thead><tr><th>Этап</th><th>Срок</th><th>Содержание</th><th>Результат</th></tr></thead>
        <tbody>
          <tr><td><strong>0. Аудит и «Карта потерь»</strong></td><td>1–2 недели</td><td>Обход цеха, точки сбора данных, «слепые зоны»</td><td>Лид-магнит + ТЗ</td></tr>
          <tr><td><strong>1. Пилот на одном участке</strong></td><td>3–4 недели</td><td>Планшеты/Telegram, ввод простоев, отчёт смены</td><td>Фиксация простоя — <strong>минуты</strong></td></tr>
          <tr><td><strong>2. Интеграция</strong></td><td>4–8 недель</td><td>1С/ERP, опционально Modbus, MES-lite</td><td>Заказ → задание → факт</td></tr>
          <tr><td><strong>3. Agentic-слой</strong></td><td>2–4 недели</td><td>Приоритеты, эскалация, рекомендации — с подтверждением</td><td>Human-in-the-loop в продакшене</td></tr>
          <tr><td><strong>4. Масштабирование</strong></td><td>по плану</td><td>Другие участки, OEE, база причин для ML</td><td>Тираж без потери контроля</td></tr>
        </tbody>
      </table>
    </div>
    <div class="apkc-card nero-ai-reveal" style="margin-top:20px">
      <h3>Сроки и что входит во внедрение ai производство контроль под ключ</h3>
      <ul>
        <li>Справочники: РЦ, операции, причины простоев (10–20 категорий), стоимость часа простоя.</li>
        <li>Интерфейс смены: PWA на планшете или Telegram Mini App — <strong>без обязательных промышленных терминалов</strong>.</li>
        <li>AI-агент: пересчёт приоритетов, NLP-классификация, отчёт, паттерны («каждый вторник простой на РЦ-3 из‑за материала»).</li>
        <li>Интеграция 1С:ERP, УНФ, КА; обучение мастера и директора; <strong>4–8 недель</strong> модерации рекомендаций AI на пилоте.</li>
      </ul>
      <p><strong>ai производство контроль без программиста</strong> со стороны заказчика — интеграцию делает Nero Network.</p>
    </div>
    <?php if ($secondary_training_url && $secondary_training_url !== '#' && strpos($secondary_training_url, 'placeholder') === false): ?>
    <div class="ym-cta-block ym-cta-block--secondary nero-ai-reveal">
      <p class="ym-cta-block__sub">Команда хочет разобраться в agentic AI до старта? <a class="ym-link--accent" href="<?php echo esc_url($secondary_training_url); ?>" target="_blank" rel="noopener noreferrer">Обучение по внедрению AI</a></p>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="apkc-section apkc-section-alt" id="integracii">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Техника</span><h2>Интеграция AI производство контроль с ERP, MES, 1С и CRM</h2>
    <p>Интеграция строится поверх того, что уже есть в цехе — принцип <strong>«MES-lite + AI-агент»</strong>, а не замена всей системы.</p>
    <p class="nero-ai-reveal">Опциональная связка с CRM — для статусов заказов и эскалаций: см. <a href="/vnedrenie-ai-amocrm/" style="color:var(--apkc-primary);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a> как соседний сценарий продаж и заявок.</p></div>
    <div class="apkc-table-wrap nero-ai-reveal">
      <table class="apkc-table">
        <thead><tr><th>Система</th><th>Роль</th><th>Подключение</th></tr></thead>
        <tbody>
          <tr><td><strong>1С:ERP / УНФ / КА</strong></td><td>Заказы, номенклатура, выпуск</td><td>REST/OData</td></tr>
          <tr><td><strong>MES-lite</strong> (MESlite, INTEKEY, Планол, ПС:MES)</td><td>Сменные задания, OEE, брак</td><td>API; агент <strong>поверх</strong></td></tr>
          <tr><td><strong>CRM</strong></td><td>Заявки, статусы</td><td>Опционально</td></tr>
          <tr><td><strong>Датчики</strong></td><td>Подтверждение остановки</td><td>Modbus → шлюз → API</td></tr>
          <tr><td><strong>Telegram</strong></td><td>Алерты, подтверждения, мини-формы</td><td>Бот для директора и мастера</td></tr>
        </tbody>
      </table>
    </div>
    <div class="apkc-scenario nero-ai-reveal">
      <h3>Планшеты на смене, датчики, Telegram-уведомления</h3>
      <p><strong>Планшеты.</strong> PWA на смене — как KOBLIK: задание и факт. AI добавляет <strong>анализ отклонений</strong>, не только форму.</p>
      <p><strong>Telegram.</strong> Для малого производства — часто <strong>первый дашборд директора</strong>: простой выше порога — сообщение с контекстом; перестановка — кнопкой в боте. Отдельный BI на старте не обязателен.</p>
      <p><strong>Датчики — опционально.</strong> Agentic AI работает лучше при связанных данных ERP/MES (Deloitte, Altimetrik). <strong>Старт без датчиков возможен:</strong> ручной ввод + планшет/Telegram; Modbus — этап 2.</p>
      <p><strong>AI-модель:</strong> Claude / GPT / YandexGPT; on-premise при требованиях безопасности. Оркестрация — n8n / Make.</p>
    </div>
  </div>
</section>

<section class="apkc-section" id="ceny">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Коммерция</span><h2>Сколько стоит AI для контроля простоев и сменных заданий</h2>
    <p>Вопрос «сколько стоит ai производство контроль» зависит от глубины интеграции и числа участков — не от «лицензии на нейросеть».</p>
    <p><strong>Ориентир Nero Network:</strong> <strong>500 тыс.–2 млн ₽</strong> — аудит, пилот, интеграция с 1С, agentic-слой, обучение.</p></div>
    <div class="apkc-table-wrap nero-ai-reveal">
      <table class="apkc-table">
        <thead><tr><th>Уровень</th><th>Ориентир</th><th>Источник</th></tr></thead>
        <tbody>
          <tr><td>Пилот на одном участке</td><td>150 000–500 000 ₽</td><td>chimitdorzhi.tech, 2027</td></tr>
          <tr><td>Сквозная автоматизация</td><td>от 700 000 ₽</td><td>тот же</td></tr>
          <tr><td><strong>Nero Network под ключ</strong></td><td><strong>500 000–2 000 000 ₽</strong></td><td>продуктовая матрица</td></tr>
          <tr><td>MES-lite без AI</td><td>от 60 000 ₽</td><td>MESlite</td></tr>
          <tr><td>Компьютерное зрение</td><td>от 1 500 000 ₽</td><td>тот же</td></tr>
        </tbody>
      </table>
    </div>
    <p class="nero-ai-reveal"><strong>ai производство контроль цена:</strong> одна линия + Telegram — ближе к нижней границе; несколько участков + 1С:ERP + датчики — к верхней.</p>
    <div class="apkc-callout apkc-callout--benchmark nero-ai-reveal"><strong>Формула ROI (ориентир / benchmark):</strong><br>Эффект пилота ≈ (стоимость часа простоя × сокращённые часы видимых простоев) − затраты на внедрение.<br>Отраслевые <strong>ориентиры</strong> снижения незапланированных простоев — <strong>15–43%</strong> (Customertimes, Applied Sciences, Bosch) — <strong>benchmark, не гарантия</strong>. ~95% ROI-positive деплойментов predictive maintenance при готовности данных (Customertimes).</div>
    <div class="ym-cta-block ym-cta-block--dual nero-ai-reveal">
      <h3 class="ym-cta-block__headline">Узнать смету под ваш цех</h3>
      <p class="ym-cta-block__sub">Ориентир 500 тыс.–2 млн ₽. Точная цифра — после бесплатной «Карты потерь».</p>
      <div class="ym-cta-block__actions"><a class="ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a></div>
    </div>
  </div>
</section>

<section class="apkc-section apkc-section-alt" id="keisy">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Доверие</span><h2>Кейсы и примеры внедрения AI-агента на производстве</h2>
    <p>Прямых публичных кейсов «AI-агент + сменные задания + контроль простоев» на малом производстве в РФ <strong>не найдено</strong>. Ниже — смежные внедрения и международные паттерны; они показывают готовность рынка и место продукта Nero Network.</p></div>
    <div class="apkc-case-grid nero-ai-reveal">
      <div class="apkc-case-card"><div class="apkc-case-tag">смежный кейс</div><h3>KOBLIK GROUP</h3><p>5 заводов: 1С:ERP + планшеты, автосменные задания. Заявлено: простои ≤5%, производительность +40%, поиск деталей −90% (1С Awards). <em>Цифровая база — наш AI-слой поверх.</em></p></div>
      <div class="apkc-case-card"><div class="apkc-case-tag">смежный кейс</div><h3>MBS Group «Оптимизатор расписания»</h3><p>ИИ-агент в 1С:ERP, 20+ РЦ, переналадки −25–50%. <em>Отличие Nero Network — оперативный контроль смены и простоев, не только план «на завтра».</em></p></div>
      <div class="apkc-case-card"><div class="apkc-case-tag">международный</div><h3>Bosch Shopfloor Agent</h3><p>Agentic AI на планшете, human-in-the-loop, экономия простоев (~€850 000/год на завод, Bosch).</p></div>
      <div class="apkc-case-card"><div class="apkc-case-tag">международный</div><h3>Керамика, Applied Sciences 2025</h3><p>Agentic AI + human oversight: незапланированные простои −43%, окупаемость 1,6 года.</p></div>
      <div class="apkc-case-card"><div class="apkc-case-tag">конкурентный контекст</div><h3>MES-lite</h3><p>MESlite, INTEKEY, Планол — сменные задания и OEE <strong>без agentic AI</strong> и отчёта на естественном языке.</p></div>
    </div>
    <p class="nero-ai-reveal" style="margin-top:24px;text-align:center"><strong>ai производство контроль примеры внедрения</strong> для вашей отрасли фиксируем на <strong>пилоте</strong> — это этап 1, а не маркетинговая выдумка.</p>
  </div>
</section>

<section class="apkc-section" id="agentic-ai">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">Тренд 2026</span><h2>Agentic AI в 2026: почему важен контроль результата, а не автономия «вслепую»</h2></div>
    <div class="apkc-table-wrap nero-ai-reveal">
      <table class="apkc-table">
        <thead><tr><th>Факт</th><th>Источник</th></tr></thead>
        <tbody>
          <tr><td><strong>&gt;40%</strong> agentic AI-проектов отменят к <strong>2027</strong></td><td>Gartner, 25.06.2025</td></tr>
          <tr><td>К <strong>2028</strong>: <strong>33%</strong> enterprise-приложений с agentic AI</td><td>Gartner</td></tr>
          <tr><td>К <strong>2026</strong>: <strong>40%</strong> apps с task-specific AI agents (было &lt;5% в 2025)</td><td>Gartner, 26.08.2025</td></tr>
          <tr><td>Текущее состояние — <strong>«semiautomatic human-in-the-loop»</strong></td><td>IEEE / Manufacturing Dive</td></tr>
        </tbody>
      </table>
    </div>
    <div class="apkc-card nero-ai-reveal" style="margin-top:20px">
      <h3>Прогноз Gartner — отмена проектов без измеримого контроля</h3>
      <p><strong>Позиция Nero Network:</strong> не спорить с Gartner — использовать прогноз как аргумент для правильной архитектуры (на enterprise-масштабе те же риски разбирали в материале про <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--apkc-primary);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a>). Agentic-слой на смене должен логировать каждое решение; требовать подтверждения на критичных действиях; давать <strong>измеримый отчёт</strong> после каждой смены; начинаться с <strong>пилота на одной смене</strong>, а не с «автономного завода».</p>
    </div>
    <div class="apkc-quote nero-ai-reveal">«Most agentic AI projects right now are early stage experiments… often misapplied» — Anushree Verma, Gartner</div>
    <p class="nero-ai-reveal" style="text-align:center">Так <strong>ai производство контроль</strong> становится ответом на хайп, а не его копией.</p>
  </div>
</section>

<section class="apkc-section apkc-section-alt" id="karta-poter">
  <div class="apkc-cnt">
    <div class="apkc-highlight nero-ai-reveal">
      <span class="apkc-eyebrow">Лид-магнит</span>
      <h2>Карта потерь производства — бесплатный аудит простоев</h2>
      <p>Перед внедрением ai производство контроль — диагностика, а не закупка «нейросети».</p>
      <p><strong>Лид-магнит «Карта потерь производства»</strong> (результат аудита 1–2 недели):</p>
      <ul>
        <li>Рабочие центры и «слепые зоны» учёта</li>
        <li>Справочник причин простоев</li>
        <li><strong>Стоимость часа простоя</strong> по участкам</li>
        <li>Карта: где простой фиксируется сразу, где — «когда мастер вспомнит»</li>
      </ul>
      <p>Инструмент из практики OEE и таблиц потерь (Inner.su, TWI) — <strong>привязанный к вашему цеху</strong>. Основа для ТЗ и пилота.</p>
    </div>
    <div class="ym-cta-block ym-cta-block--primary nero-ai-reveal">
      <div class="ym-cta-block__icon">📊</div>
      <h3 class="ym-cta-block__headline">Найти простои на вашем производстве</h3>
      <p class="ym-cta-block__sub">Бесплатный аудит: карта потерь, слепые зоны учёта, ТЗ на пилот — 1–2 недели.</p>
      <div class="ym-cta-block__actions"><a class="ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a></div>
      <p style="margin-top:14px;font-size:14px;color:var(--apkc-muted)">Не «купить AI» — <strong>увидеть</strong>, сколько вы теряете незамеченным.</p>
    </div>
  </div>
</section>

<section class="apkc-section apkc-section-alt" id="faq">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal"><span class="apkc-eyebrow">GEO</span><h2>FAQ: как внедрить ai производство контроль</h2></div>
    <div class="apkc-faq">
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли внедрить AI без программистов?</div>
      <div class="apkc-faq-a"><p>Да, со стороны заказчика. Интеграцию 1С, настройку агента и agentic-слой выполняет Nero Network. Нужен контакт — мастер или директор производства.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Как считается ROI от сокращения простоев?</div>
      <div class="apkc-faq-a"><p>На пилоте фиксируем время от простоя до записи, часы по причинам, стоимость часа × часы. Отраслевые ориентиры 15–43% — только benchmark, не обещание.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-агент отличается от цифровых сменных заданий?</div>
      <div class="apkc-faq-a"><p>MES-lite выдаёт план по правилам. AI-агент добавляет пересчёт приоритетов при сбое, NLP-классификацию, эскалацию и отчёт на естественном языке.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить ai производство контроль по шагам?</div>
      <div class="apkc-faq-a"><p>1. Карта потерь (аудит). 2. Пилот 3–4 недели. 3. Интеграция 1С/MES. 4. Agentic-слой. 5. Масштабирование.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько длится внедрение?</div>
      <div class="apkc-faq-a"><p>Пилот — 3–4 недели; полный контур — ориентир 2–4 месяца.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли для малого бизнеса?</div>
      <div class="apkc-faq-a"><p>Да — основной сегмент: 5–20 РЦ, Telegram вместо тяжёлого MES, опора на 1С:УНФ/КА.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли датчики и SCADA?</div>
      <div class="apkc-faq-a"><p>Нет для старта. Ручной ввод + планшет достаточны. Modbus — этап 2.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Что если уже есть 1С или MES-lite?</div>
      <div class="apkc-faq-a"><p>Агент надстраивается поверх существующих систем — не заменяет их.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Где посмотреть кейсы?</div>
      <div class="apkc-faq-a"><p>Прямых публичных кейсов ниши мало — показываем смежные внедрения и ваш пилот как первый измеримый кейс.</p></div>
    </div>
    <div class="apkc-faq-item nero-ai-reveal">
      <div class="apkc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит ai производство контроль?</div>
      <div class="apkc-faq-a"><p>Ориентир Nero Network: 500 тыс.–2 млн ₽. Точная смета — после «Карты потерь».</p></div>
    </div>
    </div>
  </div>
</section>

<section class="apkc-section" id="zakazat">
  <div class="apkc-cnt">
    <div class="apkc-sh nero-ai-reveal" style="margin-bottom:32px">
      <span class="apkc-eyebrow">Следующий шаг</span>
      <h2>Заказать внедрение AI производство контроль для вашей компании</h2>
      <p>Если <strong>задачи меняются вручную, простои фиксируются поздно</strong> — вы не управляете производством. Вы <strong>расплачиваетесь</strong> за каждый незамеченный час.</p>
      <p>Nero Network — <strong>разработка и интеграция ai производство контроль</strong> в ваш контур: 1С, MES-lite, планшеты, Telegram — <strong>под ключ</strong>, с пилотом на одной смене и human-in-the-loop. Без обещания «автономного завода за месяц».</p>
    </div>
    <div class="ym-cta-block ym-cta-block--footer-final nero-ai-final-cta nero-ai-reveal">
      <h2 class="ym-cta-block__headline">Запустить пилот на одной смене</h2>
      <p class="ym-cta-block__sub">3–4 недели, human-in-the-loop, измеримый отчёт по первой смене.</p>
      <ol style="text-align:left;max-width:520px;margin:0 auto 24px;color:var(--apkc-muted);padding-left:20px">
        <li><strong>Найти простои</strong> — старт аудита.</li>
        <li>Получить <strong>«Карту потерь производства»</strong> и ТЗ на пилот.</li>
        <li>Запустить <strong>ai производство контроль под ключ</strong> с измеримым отчётом по первой смене.</li>
      </ol>
      <div class="ym-cta-block__actions"><a class="ym-btn ym-btn--accent" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a></div>
      <p style="margin-top:16px;font-size:14px;color:var(--apkc-muted)">Ориентир инвестиций <strong>500 тыс.–2 млн ₽</strong>; точная смета — после «Карты потерь».</p>
    </div>
  </div>
</section>

</div><!-- .apkc-content -->

<?php if ($ad_banner_url && $ad_banner_image_url): ?>
<div class="apkc-cnt" style="padding:24px 0 48px;text-align:center">
  <a href="<?php echo esc_url($ad_banner_url); ?>" target="_blank" rel="noopener noreferrer">
    <img src="<?php echo esc_url($ad_banner_image_url); ?>" alt="<?php echo esc_attr($ad_banner_alt); ?>" width="970" height="90" loading="lazy" style="max-width:100%;height:auto">
  </a>
</div>
<?php endif; ?>

  <!-- INTERNAL-LINKS: inserted inline — #kak-rabotaet, #etapy, #integracii, #agentic-ai -->
  <?php
  $apkc_page_url = trailingslashit( get_permalink() );
  $apkc_site_url = trailingslashit( home_url( '/' ) );
  $apkc_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
      [
        '@type' => 'Organization',
        '@id'   => $apkc_site_url . '#organization',
        'name'  => $brand,
        'url'   => $apkc_site_url,
      ],
      [
        '@type'     => 'WebSite',
        '@id'       => $apkc_site_url . '#website',
        'url'       => $apkc_site_url,
        'name'      => $brand,
        'publisher' => [ '@id' => $apkc_site_url . '#organization' ],
      ],
      [
        '@type'      => 'WebPage',
        '@id'        => $apkc_page_url . '#webpage',
        'url'        => $apkc_page_url,
        'name'       => "AI-агент для сменных заданий и контроля простоев: под ключ",
        'description'=> "Внедрение AI-агента для сменных заданий и контроля простоев на производстве. Фиксация отклонений в реальном времени, отчёт руководителю. Под ключ — от 500 тыс. ₽.",
        'isPartOf'   => [ '@id' => $apkc_site_url . '#website' ],
        'about'      => [ '@id' => $apkc_site_url . '#organization' ],
      ],
      [
        '@type'           => 'BreadcrumbList',
        '@id'             => $apkc_page_url . '#breadcrumb',
        'itemListElement' => [
          [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $apkc_site_url ],
          [ '@type' => 'ListItem', 'position' => 2, 'name' => "AI-агент для сменных заданий и контроля простоев: под ключ", 'item' => $apkc_page_url ],
        ],
      ],
      [
        '@type'       => 'Service',
        '@id'         => $apkc_page_url . '#service',
        'name'        => "AI-агент для сменных заданий и контроля простоев: под ключ",
        'description' => "Внедрение AI-агента для сменных заданий и контроля простоев на производстве. Фиксация отклонений в реальном времени, отчёт руководителю. Под ключ — от 500 тыс. ₽.",
        'url'         => $apkc_page_url,
        'provider'    => [ '@id' => $apkc_site_url . '#organization' ],
      ],
      [
        '@type'      => 'FAQPage',
        '@id'        => $apkc_page_url . '#faq',
        'mainEntity' => [
          [ '@type' => 'Question', 'name' => "Можно ли внедрить AI без программистов?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Да, со стороны заказчика. Интеграцию 1С, настройку агента и agentic-слой выполняет Nero Network. Нужен контакт — мастер или директор производства." ] ],
          [ '@type' => 'Question', 'name' => "Как считается ROI от сокращения простоев?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "На пилоте фиксируем время от простоя до записи, часы по причинам, стоимость часа × часы. Отраслевые ориентиры 15–43% — только benchmark, не обещание." ] ],
          [ '@type' => 'Question', 'name' => "Чем AI-агент отличается от цифровых сменных заданий?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "MES-lite выдаёт план по правилам. AI-агент добавляет пересчёт приоритетов при сбое, NLP-классификацию, эскалацию и отчёт на естественном языке." ] ],
          [ '@type' => 'Question', 'name' => "Как внедрить ai производство контроль по шагам?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "1. Карта потерь (аудит). 2. Пилот 3–4 недели. 3. Интеграция 1С/MES. 4. Agentic-слой. 5. Масштабирование." ] ],
          [ '@type' => 'Question', 'name' => "Сколько длится внедрение?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Пилот — 3–4 недели; полный контур — ориентир 2–4 месяца." ] ],
          [ '@type' => 'Question', 'name' => "Подходит ли для малого бизнеса?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Да — основной сегмент: 5–20 РЦ, Telegram вместо тяжёлого MES, опора на 1С:УНФ/КА." ] ],
          [ '@type' => 'Question', 'name' => "Нужны ли датчики и SCADA?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Нет для старта. Ручной ввод + планшет достаточны. Modbus — этап 2." ] ],
          [ '@type' => 'Question', 'name' => "Что если уже есть 1С или MES-lite?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Агент надстраивается поверх существующих систем — не заменяет их." ] ],
          [ '@type' => 'Question', 'name' => "Где посмотреть кейсы?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Прямых публичных кейсов ниши мало — показываем смежные внедрения и ваш пилот как первый измеримый кейс." ] ],
          [ '@type' => 'Question', 'name' => "Сколько стоит ai производство контроль?", 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => "Ориентир Nero Network: 500 тыс.–2 млн ₽. Точная смета — после «Карты потерь»." ] ],
        ],
      ],
    ],
  ];
  echo '<script type="application/ld+json">' . wp_json_encode( $apkc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
  ?>


</main>

<script>
(function(){
  document.querySelectorAll('.apkc-faq-q').forEach(function(btn){
    btn.addEventListener('click',function(){
      var item=btn.closest('.apkc-faq-item');
      var open=item.classList.contains('open');
      document.querySelectorAll('.apkc-faq-item.open').forEach(function(el){el.classList.remove('open');el.querySelector('.apkc-faq-q').setAttribute('aria-expanded','false');});
      if(!open){item.classList.add('open');btn.setAttribute('aria-expanded','true');}
    });
    btn.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();btn.click();}});
  });
})();
</script>
<script>
(function(){
  'use strict';
  var root=document.querySelector('.ai-proizvodstvo-kontrol-page');
  if(!root)return;
  var items=root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var obs=new IntersectionObserver(function(entries){
      entries.forEach(function(e){if(e.isIntersecting){e.target.classList.add('nero-ai-active');obs.unobserve(e.target);}});
    },{threshold:0.1,rootMargin:'0px 0px -6% 0px'});
    items.forEach(function(i){obs.observe(i);});
  }else{items.forEach(function(i){i.classList.add('nero-ai-active');});}
})();
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
