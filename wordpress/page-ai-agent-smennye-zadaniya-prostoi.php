<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: SEO-лендинг — внедрение AI-агента для сменных заданий, контроля простоев и OEE на производстве.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент для производства: сменные задания и контроль простоев';
$page_seo_description = 'Внедрение AI-агента под ключ: сменные задания, фиксация простоев и отчёт руководителю без ручного ввода. Для малого производства и цехов. Заказать аудит простоев.';

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
$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Обучение по agentic AI';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: nero_ai_primary_cta_url('');

$nero_ai_header_links = [
    ['label' => 'Боли', 'href' => '#bol'],
    ['label' => 'Агент', 'href' => '#agent'],
    ['label' => 'Простои', 'href' => '#prostoi'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'ROI', 'href' => '#cena'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
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

.aasp-hero{
  position:relative;
  min-height:100vh;
  min-height:100dvh;
}

/* ── aasp content (Борис + секции статьи) ── */
.aasp-content{
  --aasp-bg:#050711;--aasp-bg2:#080b17;
  --aasp-text:#e6edf7;--aasp-muted:#9aa8bd;--aasp-soft:#c7d2e5;--aasp-heading:#fff;
  --aasp-border:rgba(255,255,255,.10);--aasp-gold:#f5c518;--aasp-violet:#8b5cf6;
  --aasp-green:#22c55e;--aasp-cyan:#38bdf8;--aasp-warn:#f59e0b;
  --aasp-r:18px;--aasp-r-lg:24px;--aasp-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aasp-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aasp-content *,.aasp-content *::before,.aasp-content *::after{box-sizing:border-box;}
.aasp-content a{color:inherit;}
.aasp-content p{color:var(--aasp-muted);line-height:1.72;margin:0 0 1em;font-size:15px;}
.aasp-content p:last-child{margin-bottom:0;}
.aasp-content h2,.aasp-content h3,.aasp-content h4{color:var(--aasp-heading);letter-spacing:-.04em;margin:0 0 .65em;}
.aasp-content strong{color:var(--aasp-soft);}
.aasp-content ul,.aasp-content ol{padding-left:0;list-style:none;margin:0 0 1em;}
.aasp-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aasp-muted);font-size:14.5px;line-height:1.65;}
.aasp-content ul li::before{content:'›';position:absolute;left:0;color:var(--aasp-gold);font-weight:700;}
.aasp-cnt{width:min(var(--aasp-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aasp-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.aasp-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.028),rgba(255,255,255,.008));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aasp-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.aasp-sh.aasp-left{margin-left:0;text-align:left;}
.aasp-sh h2{font-size:clamp(26px,3.8vw,46px);line-height:1.08;margin-bottom:12px;}
.aasp-sh p{font-size:clamp(15px,1.5vw,17px);max-width:680px;margin:0 auto;}
.aasp-sh.aasp-left p{margin-left:0;}
.aasp-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aasp-gold);margin-bottom:12px;}
.aasp-gt{background:linear-gradient(92deg,#fff 0%,var(--aasp-gold) 44%,var(--aasp-violet) 100%);-webkit-background-clip:text;background-clip:text;color:transparent!important;}
.aasp-intro{padding:clamp(36px,5vw,64px) 0;border-bottom:1px solid rgba(255,255,255,.06);}
.aasp-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:48px;align-items:center;}
.aasp-intro-text{position:relative;padding-left:18px;}
.aasp-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aasp-gold),var(--aasp-violet));}
.aasp-kpi-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aasp-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px 12px;text-align:center;}
.aasp-kpi-card .kv{font-size:clamp(18px,2.2vw,24px);font-weight:900;color:#fff;line-height:1;margin-bottom:4px;}
.aasp-kpi-card .kl{font-size:11px;color:var(--aasp-muted);line-height:1.35;}
.aasp-kpi-card .ks{font-size:10px;color:#64748b;margin-top:3px;}
.aasp-callout{border-left:3px solid var(--aasp-gold);padding:16px 20px;margin:20px 0;background:rgba(255,255,255,.04);border-radius:0 14px 14px 0;}
.aasp-callout--def{border-image:linear-gradient(180deg,var(--aasp-gold),var(--aasp-violet)) 1;}
.aasp-callout--warn{border-left-color:var(--aasp-warn);background:rgba(245,158,11,.06);}
.aasp-callout em{color:var(--aasp-soft);font-style:normal;}
.aasp-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aasp-table{width:100%;border-collapse:collapse;font-size:14px;}
.aasp-table th{padding:12px 16px;text-align:left;background:rgba(56,189,248,.12);color:var(--aasp-cyan);font-weight:700;border-bottom:1px solid rgba(56,189,248,.25);}
.aasp-table td{padding:11px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aasp-text);vertical-align:top;}
.aasp-table tr:last-child td{border-bottom:none;}
.aasp-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.aasp-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
.aasp-card{background:linear-gradient(180deg,rgba(255,255,255,.08),rgba(255,255,255,.04));border:1px solid var(--aasp-border);border-radius:var(--aasp-r-lg);padding:22px;}
.aasp-steps{counter-reset:aaspstep;}
.aasp-step{position:relative;padding-left:44px;margin-bottom:22px;}
.aasp-step::before{counter-increment:aaspstep;content:counter(aaspstep);position:absolute;left:0;top:0;width:30px;height:30px;border-radius:50%;background:rgba(245,197,24,.15);border:1px solid rgba(245,197,24,.35);color:var(--aasp-gold);font-weight:800;font-size:13px;display:grid;place-items:center;}
.aasp-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aasp-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aasp-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:#fff;cursor:pointer;display:flex;justify-content:space-between;gap:12px;}
.aasp-faq-q::after{content:'▾';color:var(--aasp-gold);transition:transform .25s;}
.aasp-faq-item.open .aasp-faq-q::after{transform:rotate(180deg);}
.aasp-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .35s ease,padding .2s;font-size:14.5px;color:var(--aasp-muted);}
.aasp-faq-item.open .aasp-faq-a{max-height:520px;padding:0 22px 18px;}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.28);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.28);}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:#fff;margin:0 0 8px;}
.ym-cta-block__sub{color:var(--aasp-muted);font-size:15px;margin:0 auto 18px;max-width:620px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-link--accent{color:var(--aasp-gold)!important;text-decoration:underline!important;}
@media(max-width:900px){.aasp-intro-grid{grid-template-columns:1fr;}.aasp-kpi-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){.aasp-grid-2,.aasp-grid-3{grid-template-columns:1fr;}}

.aasp-intro-text p{text-align:left!important;}
.aasp-toc-outer{padding:0 0 clamp(32px,4vw,52px);}
.aasp-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aasp-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:999px;font-size:13px;font-weight:600;color:var(--aasp-muted);text-decoration:none!important;transition:border-color .2s,color .2s,background .2s;}
.aasp-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--aasp-gold);background:rgba(245,197,24,.08);}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aasp-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
@media(max-width:600px){.ym-cta-block{padding:28px 20px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page aasp-page" role="main" tabindex="-1">

<section class="nero-ai-hero aasp-hero" id="hero" aria-labelledby="aasp-hero-title">
<style>
/* ── Hero aasp: самодостаточные стили (без CSS темы) ── */
.aasp-hero {
  --aasp-gold: #f5c518;
  --aasp-cyan: #38bdf8;
  --aasp-green: #22c55e;
  --aasp-violet: #8b5cf6;
  --aasp-text: #e6edf7;
  --aasp-muted: #9aa8bd;
  --aasp-soft: #c7d2e5;
  --aasp-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  background: linear-gradient(180deg, #050711 0%, #080b17 48%, #050711 100%);
  isolation: isolate;
  overflow: hidden;
}
.aasp-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 70%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.aasp-hero::after {
  content: "";
  position: absolute;
  left: -8%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(56,189,248,.09), transparent 68%);
  filter: blur(10px);
  animation: aaspHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aaspHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .75; transform: scale(1.04); }
}
.aasp-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aasp-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aasp-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.aasp-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aasp-gold) 40%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aasp-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--aasp-gold) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aasp-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aasp-soft) !important;
  font-size: clamp(17px, 1.85vw, 21px);
  line-height: 1.58;
}
.aasp-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aasp-hero .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.aasp-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aasp-hero .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 20px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.aasp-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aasp-hero .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--aasp-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.aasp-hero .nero-ai-btn-secondary {
  color: var(--aasp-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aasp-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aasp-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aasp-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aasp-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aasp-hero .nero-ai-dots { display: flex; gap: 7px; }
.aasp-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aasp-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aasp-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aasp-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aasp-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 10px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
  text-align: right;
}
.aasp-hero .nero-ai-window-body { padding: 16px; }
.aasp-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aasp-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aasp-hero .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(34,197,94,.10);
  color: #bbf7d0;
  font-size: 12px;
  font-weight: 800;
}
.aasp-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aaspPulse 1.6s infinite;
}
@keyframes aaspPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aasp-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aasp-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aasp-hero .nero-ai-metric span {
  display: block;
  color: var(--aasp-muted);
  font-size: 11px;
  font-weight: 700;
}
.aasp-hero .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aasp-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aasp-hero .aasp-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(56, 189, 248, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(56,189,248,.06), rgba(6,10,24,.94) 74%);
}
.aasp-hero #aasp-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aasp-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.aasp-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aasp-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(245,197,24,.12);
  color: var(--aasp-gold);
  font-size: 11px;
  font-weight: 800;
}
.aasp-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aasp-hero .nero-ai-task span {
  color: var(--aasp-muted);
  font-size: 11px;
}
.aasp-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aasp-hero .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.aasp-hero .nero-ai-status--cyan {
  background: rgba(56,189,248,.12);
  color: #bae6fd;
}
@media (max-width: 1100px) {
  .aasp-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aasp-hero .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aasp-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aasp-hero .nero-ai-window-body { padding: 12px; }
  .aasp-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aasp-hero .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI для производства</p>
      <h1 id="aasp-hero-title">AI-агент для сменных заданий и контроля простоев: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Сменные задания, фиксация простоев и отчёт руководителю — без ручного ввода и опоздавших фиксаций</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">AI-агент</li>
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">OEE</li>
        <li class="nero-ai-badge">1С / Excel</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">Карта потерь</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#agent">Как работает агент</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-смены: задания, простои и отчёт">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-смена онлайн · демо</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>OEE участка</span>
              <strong>68%</strong>
              <small>доступность × скорость</small>
            </div>
            <div class="nero-ai-metric">
              <span>Простои без кода</span>
              <strong>2</strong>
              <small>эскалация мастеру</small>
            </div>
            <div class="nero-ai-metric">
              <span>Время фиксации</span>
              <strong>47 сек</strong>
              <small>событие → код TPM</small>
            </div>
            <div class="nero-ai-metric">
              <span>Реакция мастера</span>
              <strong>&lt;1 мин</strong>
              <small>от простоя до ответа</small>
            </div>
          </div>

          <div class="aasp-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aasp-hero-canvas" role="img" aria-label="Анимация: сменное задание по монорельсу, фиксация простоя и отчёт руководителю в Telegram"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">СЗ</span>
              <div><strong>Сменное задание #12 — фрезеровка</strong><span>Операция из 1С → бригада участка 2</span></div>
              <span class="nero-ai-status">в работе</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏸</span>
              <div><strong>Пауза станка ЧПУ</strong><span>Датчик остановки · таймер 0:47</span></div>
              <span class="nero-ai-status nero-ai-status--amber">простой</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TPM</span>
              <div><strong>Код «нет материала»</strong><span>Классификация AI · подтверждение мастера</span></div>
              <span class="nero-ai-status">зафиксировано</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Отчёт руководителю</strong><span>OEE 68% · топ-3 причины · карта потерь</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">отправлено</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aasp-hero-engine — «Диспетчерская смены»
 * Мир: ShiftCommandBoard + OverheadTaskMonorail + DowntimePulseBeacon → TelegramReportBurst
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aasp-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 6;
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    boardBg: "#1e293b",
    boardLine: "#334155",
    gold: "#f5c518",
    cyan: "#38bdf8",
    green: "#22c55e",
    red: "#ef4444",
    violet: "#8b5cf6",
    cardAmber: "#fef3c7",
    cardBlue: "#dbeafe",
    cardGreen: "#d1fae5",
    rail: "#475569",
    pod: "rgba(30,41,59,0.85)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Подвесная монорельсовая линия — вместо Conveyor */
  function OverheadTaskMonorail() {
    this.cards = [
      { offset: 0, color: C.cardAmber, label: "СЗ" },
      { offset: 70, color: C.cardBlue, label: "ОП" },
      { offset: 140, color: C.cardGreen, label: "КК" }
    ];
  }
  OverheadTaskMonorail.prototype.draw = function (ctx) {
    var yRail = -88;
    ctx.strokeStyle = C.rail;
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(-175, yRail);
    ctx.lineTo(175, yRail);
    ctx.stroke();
    for (var i = -160; i < 180; i += 28) {
      ctx.fillStyle = C.outline;
      ctx.fillRect(i, yRail - 4, 3, 8);
    }
    this.cards.forEach(function (card) {
      var t = ((frame * 0.42 + card.offset) % 200) / 200;
      var x = -165 + t * 330;
      if (t < 0.95) {
        ctx.strokeStyle = C.outline;
        ctx.lineWidth = 1.2;
        ctx.beginPath();
        ctx.moveTo(x, yRail);
        ctx.lineTo(x, yRail + 14);
        ctx.stroke();
        drawRR(ctx, x - 11, yRail + 12, 22, 16, 3, card.color, C.outline);
        ctx.fillStyle = C.outline;
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(card.label, x, yRail + 23);
      }
    });
  };

  /* Вертикальная доска смены — вместо WebsiteTerminal */
  function ShiftCommandBoard() {
    this.rows = 0;
  }
  ShiftCommandBoard.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    drawRR(ctx, -42, -72, 84, 118, 6, C.boardBg, C.outline);
    ctx.fillStyle = C.gold;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("СМЕНА", 0, -62);

    var rowCount = Math.min(5, Math.floor(prg / 12));
    for (var r = 0; r < rowCount; r++) {
      var ry = -50 + r * 18;
      var w = 60 + (r % 2) * 8;
      drawRR(ctx, -w / 2, ry, w, 12, 2, r === 2 && prg > 130 && prg < 190 ? "rgba(239,68,68,0.35)" : "rgba(255,255,255,0.08)", C.boardLine);
    }

    if (prg > 200) {
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("ОТЧЁТ ✓", 0, 38);
    }
  };

  /* Дуговой индикатор OEE */
  function OeeArcMeter() {
    this.pulse = 0;
  }
  OeeArcMeter.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    var pct = prg < 140 ? 0.52 + Math.sin(frame * 0.05) * 0.04 : 0.68;
    this.pulse = 0.6 + Math.sin(frame * 0.08) * 0.2;
    ctx.save();
    ctx.translate(118, -18);
    ctx.strokeStyle = "rgba(255,255,255,0.12)";
    ctx.lineWidth = 6;
    ctx.beginPath();
    ctx.arc(0, 0, 28, Math.PI * 0.75, Math.PI * 2.25);
    ctx.stroke();
    ctx.strokeStyle = C.green;
    ctx.globalAlpha = this.pulse;
    ctx.beginPath();
    ctx.arc(0, 0, 28, Math.PI * 0.75, Math.PI * 0.75 + Math.PI * 1.5 * pct);
    ctx.stroke();
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#fff";
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(Math.round(pct * 100) + "%", 0, 4);
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.fillStyle = C.outline;
    ctx.fillText("OEE", 0, 14);
    ctx.restore();
  };

  /* Маяк простоя */
  function DowntimePulseBeacon() {
    this.on = false;
  }
  DowntimePulseBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    this.on = prg >= 130 && prg < 195;
    if (!this.on) return;
    var blink = 0.5 + Math.sin(frame * 0.25) * 0.5;
    ctx.save();
    ctx.globalAlpha = blink;
    ctx.fillStyle = C.red;
    ctx.beginPath();
    ctx.arc(-118, 8, 10 + blink * 4, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("!", -118, 11);
    ctx.restore();
  };

  /* Посты станков */
  function WorkstationPod(x, y, label) {
    this.x = x;
    this.y = y;
    this.label = label;
  }
  WorkstationPod.prototype.draw = function (ctx) {
    drawRR(ctx, this.x - 22, this.y, 44, 28, 5, C.pod, C.outline);
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText(this.label, this.x, this.y + 16);
    drawRR(ctx, this.x - 8, this.y + 22, 16, 10, 2, "rgba(56,189,248,0.2)", C.outline);
  };

  /* Бирка кода простоя */
  function LossCodeTag() {
    this.visible = false;
  }
  LossCodeTag.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    this.visible = prg >= 150 && prg < 200;
    if (!this.visible) return;
    var pop = Math.min(1, (prg - 150) / 15);
    ctx.save();
    ctx.globalAlpha = pop;
    drawRR(ctx, -58, 42, 72, 18, 4, C.cardAmber, C.outline);
    ctx.fillStyle = C.outline;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Нет материала", -22, 54);
    ctx.restore();
  };

  /* Финал: отчёт в Telegram */
  function TelegramReportBurst() {
    this.y = 0;
    this.alpha = 0;
  }
  TelegramReportBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % 240;
    if (prg < 200) {
      this.y = 0;
      this.alpha = 0;
      return;
    }
    var local = prg - 200;
    this.y = -local * 2.2;
    this.alpha = Math.min(1, local / 8) * (1 - local / 40);
    if (this.alpha <= 0) return;

    ctx.save();
    ctx.globalAlpha = this.alpha;
    drawRR(ctx, -20, -55 + this.y, 40, 28, 6, C.cyan, C.outline);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", 0, -38 + this.y);
    ctx.fillStyle = C.green;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillText("карта потерь", 0, -72 + this.y);
    for (var p = 0; p < 5; p++) {
      ctx.fillStyle = "rgba(56,189,248," + (0.3 - p * 0.05) + ")";
      ctx.beginPath();
      ctx.arc((p - 2) * 12, -48 + this.y - p * 6, 2, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.restore();
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x;
    this.y = y;
    this.baseX = x;
    this.baseY = y;
    this.color = color;
    this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.hitAnimation = 0;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var isMoving = false;
    var carryType = null;
    var faceDir = 1;
    var prg = (frame * 0.04) % 240;

    var targets = [
      { x: -95, y: 38 },
      { x: -30, y: 38 },
      { x: 35, y: 38 },
      { x: 100, y: 38 },
      { x: 0, y: -20 }
    ];
    var tgt = targets[Math.min(4, Math.floor(this.stepTrig / 50))] || targets[0];

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        faceDir = tgt.x > this.baseX ? 1 : -1;
        carryType = prg > this.stepTrig + 4 ? this.color : null;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 11);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 11);
      } else if (local < 14) {
        this.x = tgt.x;
        this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -faceDir;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 14) / 8);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 14) / 8);
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      if (prg >= this.stepTrig - 8 && prg < this.stepTrig) carryType = this.color;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      var rnd = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 18, rnd, 220);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    var legL = 0, legR = 0;
    if (isMoving) {
      var walk = this.timer * 6;
      legL = Math.sin(walk) * 5;
      legR = Math.sin(walk + Math.PI) * 5;
    }
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 14, 2, C.outline, null);
    drawRR(ctx, -12, 5 + Math.max(0, legL), 12, 6, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 14, 2, C.outline, null);
    drawRR(ctx, 0, 5 + Math.max(0, legR), 12, 6, 2, C.outline, null);
    drawRR(ctx, -15, -12 - bob, 30, 20, 6, this.color, C.outline);

    var hx = 0, hy = -28 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 12, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 2;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 4, hy - 2, 4, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 5, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 2, 0, Math.PI * 2); ctx.fill();
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -20 * faceDir, -18 - bob, 14, 14, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new OverheadTaskMonorail());
  entities.push(new WorkstationPod(-95, 52, "ЧПУ-1"));
  entities.push(new WorkstationPod(-30, 52, "СБОР"));
  entities.push(new WorkstationPod(35, 52, "УПАК"));
  entities.push(new WorkstationPod(100, 52, "КК"));
  entities.push(new ShiftCommandBoard());
  entities.push(new OeeArcMeter());
  entities.push(new DowntimePulseBeacon());
  entities.push(new LossCodeTag());
  entities.push(new TelegramReportBurst());

  entities.push(new Agent(-150, 62, C.agentYellow, "1_architect", 18, [
    "План из 1С загружен",
    "Сверяю заказы смены",
    "Маршрут операций готов"
  ]));
  entities.push(new Agent(-70, 72, C.agentGreen, "2_seo", 58, [
    "Код операции: фрезеровка",
    "Маркирую карточку СЗ",
    "Очередь участка 2"
  ]));
  entities.push(new Agent(10, 68, C.agentBlue, "3_coder", 138, [
    "Станок на паузе!",
    "Код TPM: нет материала",
    "Фиксация за 47 сек"
  ]));
  entities.push(new Agent(80, 74, C.agentPink, "4_designer", 98, [
    "Срочный заказ — перестройка",
    "Новый приоритет смены",
    "Мастер подтвердил"
  ]));
  entities.push(new Agent(130, 64, C.agentPurple, "5_deployer", 205, [
    "Сменный отчёт собран",
    "Карта потерь в Telegram",
    "Руководитель уведомлён"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 220, maxLife: customLife || 220 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.04) % 240;
    if (prg >= 16 && prg < 16.05) createBubble(-150, 40, "1. План смены");
    if (prg >= 56 && prg < 56.05) createBubble(-70, 50, "2. Карточка на рельс");
    if (prg >= 96 && prg < 96.05) createBubble(80, 52, "3. Перепланирование");
    if (prg >= 136 && prg < 136.05) createBubble(10, 48, "4. Простой → код");
    if (prg >= 206 && prg < 206.05) createBubble(130, 42, "5. Отчёт в TG");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.lineJoin = "round";

    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) {
        bubbles.splice(i, 1);
        continue;
      }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 10) alpha = (bub.maxLife - bub.life) / 10;
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(bub.text).width + 14;
      var th = 18;
      var bx = bub.x;
      var by = bub.y - (bub.maxLife - bub.life) * 0.04;
      drawRR(ctx, bx - tw / 2, by - th, tw, th, 5, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(bub.text, bx, by - th / 2);
      ctx.globalAlpha = 1;
    }

    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>

<div class="aasp-content">

<section class="aasp-intro aasp-section" id="intro" aria-label="Коротко о решении">
  <div class="aasp-cnt">
    <div class="aasp-intro-grid nero-ai-reveal">
      <div class="aasp-intro-text">
        <p class="aasp-eyebrow">Коротко · ai производство контроль</p>
        <p><strong>Коротко:</strong> AI-агент для производства собирает данные смены, фиксирует простои в момент события, перестраивает сменные задания при сбоях и формирует отчёт руководителю — без ручного ввода в Excel и опоздавших фиксаций.</p>
        <p>Внедрение под ключ для малого производства: мебель, пищевое, цеха.</p>
      </div>
      <div class="aasp-kpi-grid" aria-label="Ключевые цифры">
        <div class="aasp-kpi-card"><div class="kv">30–70%</div><div class="kl">OEE на российских предприятиях</div><div class="ks">РБК Компании</div></div>
        <div class="aasp-kpi-card"><div class="kv">$1,4 трлн</div><div class="kl">незапланированные простои / год</div><div class="ks">Generation AI</div></div>
        <div class="aasp-kpi-card"><div class="kv">2 ч → 5 мин</div><div class="kl">сбор данных о простоях</div><div class="ks">Нижнекамскшина</div></div>
        <div class="aasp-kpi-card"><div class="kv">40%</div><div class="kl">agentic AI-проектов отменят к 2027</div><div class="ks">Gartner</div></div>
      </div>
    </div>
  </div>
</section>


  <div class="aasp-toc-outer">
    <div class="aasp-cnt">
      <nav class="aasp-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#bol">Боли</a>
        <a href="#agent">Агент</a>
        <a href="#prostoi">Простои</a>
        <a href="#etapy">Внедрение</a>
        <a href="#cena">ROI</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

<section class="aasp-section" id="bol" aria-labelledby="bol-title">
  <div class="aasp-cnt">
    <div class="aasp-sh aasp-left">
      <span class="aasp-eyebrow">Боли производства</span>
      <h2 id="bol-title">Почему на производстве теряют деньги на простоях и ручных сменных заданиях</h2>
      <p>Малый цех теряет маржу, когда <strong>задачи меняются вручную, а простои фиксируются поздно</strong>.</p>
    </div>
    <div class="aasp-callout aasp-callout--def">
      <p><em>Определение:</em> <strong>простой на производстве</strong> — период, когда оборудование или рабочий центр не выпускает продукцию по плану. Если причину записали на следующий день, OEE и сменный отчёт искажаются.</p>
    </div>
    <div class="aasp-grid-2 nero-ai-reveal">
      <div class="aasp-card">
        <h3>Типовые боли малого производства</h3>
        <ul>
          <li>Сменное задание живёт в Excel и в голове мастера</li>
          <li>Простои «невидимы» до конца смены</li>
          <li>ERP не отвечает: «где потеряли два часа вчера?»</li>
          <li>Мебель и пищевое — много ручных операций, диспетчеризация на звонках</li>
        </ul>
      </div>
      <div class="aasp-card">
        <h3>Когда простои фиксируют постфактум</h3>
        <ul>
          <li>Заниженный или «нарисованный» OEE</li>
          <li>Невозможность построить Pareto причин потерь</li>
          <li>Повторение одних простоев смена за сменой</li>
        </ul>
        <p class="aasp-callout" style="margin-top:14px;border-left-color:var(--aasp-green);"><strong>Итог блока:</strong> без <strong>ai для производства</strong>, который фиксирует отклонения в момент события, вы оптимизируете отчёт, а не цех.</p>
      </div>
    </div>
  </div>
</section>

<section class="aasp-section aasp-section-alt" id="agent" aria-labelledby="agent-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">Продукт</span>
      <h2 id="agent-title">Что делает AI-агент на смене: сбор данных, контроль отклонений, отчёт руководителю</h2>
      <p><strong>ai производство контроль</strong> — один агент закрывает сменные задания, контроль простоев и перепланирование при сбое.</p>
    </div>
    <div class="aasp-callout aasp-callout--def">
      <p><em>Определение:</em> <strong>AI-агент для производства</strong> — слой поверх 1С, Excel, MES/SCADA и Telegram: собирает факт смены, классифицирует простои, предлагает перестановку заданий, формирует <strong>отчёт руководителю</strong>.</p>
    </div>
    <h3>Какие данные агент собирает за смену</h3>
    <div class="aasp-table-wrap">
      <table class="aasp-table">
        <thead><tr><th>Источник</th><th>Что даёт</th></tr></thead>
        <tbody>
          <tr><td>1С:ERP / УНФ / КА</td><td>заказы, маршруты, штатные сменные задания</td></tr>
          <tr><td>Excel / Google Sheets</td><td>план на смену, нормы времени (MVP)</td></tr>
          <tr><td>Telegram / терминал</td><td>статусы «старт / пауза / готово», коды простоев</td></tr>
          <tr><td>MES / SCADA (этап 2)</td><td>автоматическая остановка станка, циклы</td></tr>
        </tbody>
      </table>
    </div>
    <h3>Как формируется отчёт без ручного ввода</h3>
    <ul>
      <li>OEE участка, топ-3–5 причин простоев, отклонения от плана</li>
      <li>Рекомендации на следующую смену и «карта потерь»</li>
      <li>Аналог Moveworks shift handoff packet — для малого цеха это Telegram-отчёт или PDF</li>
    </ul>
  </div>
</section>

<!-- INTERNAL-LINKS:INSERT -->

<section class="aasp-section" id="boris-article-viz" aria-labelledby="boris-viz-title">
<style>
#aasp-boris-shift-floor-block{
  --boris-bg:#f8fafc;--boris-card:#fff;--boris-text:#0f172a;--boris-muted:#64748b;
  --boris-gold:#f5c518;--boris-red:#ef4444;--boris-green:#22c55e;--boris-cyan:#0ea5e9;
  background:linear-gradient(135deg,#f8fafc 0%,#eef2ff 48%,#f0fdf4 100%);
  border:1px solid rgba(15,23,42,.08);border-radius:22px;padding:clamp(22px,3vw,36px);
  box-shadow:0 20px 60px rgba(0,0,0,.18);max-width:100%;overflow:hidden;
}
#aasp-boris-shift-floor-block .boris-split{
  display:grid;grid-template-columns:1.1fr 1fr;gap:clamp(20px,3vw,36px);align-items:center;
  min-height:420px;
}
#aasp-boris-shift-floor-block .boris-eyebrow{
  font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#b45309;margin:0 0 8px;
}
#aasp-boris-shift-floor-block .boris-kicker{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:var(--boris-text);line-height:1.15;margin:0 0 10px;
}
#aasp-boris-shift-floor-block .boris-lead{font-size:14.5px;color:var(--boris-muted);line-height:1.65;margin:0 0 16px;}
#aasp-boris-shift-floor-block .boris-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
#aasp-boris-shift-floor-block .boris-pill{
  display:inline-flex;align-items:center;gap:6px;padding:7px 12px;border-radius:999px;
  background:#fff;border:1px solid rgba(15,23,42,.1);font-size:12px;font-weight:700;color:var(--boris-text);
}
#aasp-boris-shift-floor-block .boris-pill em{font-style:normal;color:var(--boris-red);}
#aasp-boris-shift-floor-block .boris-pill--ok em{color:var(--boris-green);}
#aasp-boris-shift-floor-block .boris-bridge{font-size:13px;color:#475569;margin:0;font-style:italic;}
#aasp-boris-shift-floor-block .boris-canvas-wrap{
  position:relative;border-radius:18px;overflow:hidden;border:1px solid rgba(15,23,42,.1);
  background:radial-gradient(ellipse at 50% 30%,rgba(245,197,24,.12),#0f172a 70%);
  min-height:380px;max-height:min(520px,70vh);
}
#aasp-boris-shift-floor-block #aasp-boris-shift-floor-canvas{
  display:block;width:100%;height:100%;min-height:380px;
}
@media(max-width:768px){
  #aasp-boris-shift-floor-block .boris-split{grid-template-columns:1fr;min-height:auto;}
  #aasp-boris-shift-floor-block .boris-canvas-wrap{min-height:320px;}
}
</style>

<div class="aasp-cnt">
  <div id="aasp-boris-shift-floor-block" class="nero-ai-reveal">
    <div class="boris-split">
      <div class="boris-copy">
        <p class="boris-eyebrow">Мостик мониторинга · контраст к hero</p>
        <h3 class="boris-kicker" id="boris-viz-title">Фиксация простоя в момент события — не «узнали завтра»</h3>
        <p class="boris-lead">Пока dashboard hero показывает сводку смены, здесь — <strong>цеховой контур</strong>: остановка станка → код причины → эскалация мастеру → Pareto потерь.</p>
        <div class="boris-pills" aria-label="Микро-метрики пилота">
          <span class="boris-pill"><em>12 мин</em> без кода</span>
          <span class="boris-pill boris-pill--ok"><em>&lt;1 мин</em> реакция</span>
          <span class="boris-pill">OEE <em>участка</em></span>
        </div>
        <p class="boris-bridge">Дальше разберём, как AI перестраивает сменные задания без хаоса в чатах ↓</p>
      </div>
      <div class="boris-canvas-wrap">
        <canvas id="aasp-boris-shift-floor-canvas" role="img" aria-label="Анимация: рабочие центры цеха, фиксация простоя, эскалация мастеру и Pareto потерь"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  document.addEventListener('DOMContentLoaded', function(){
    var canvas = document.getElementById('aasp-boris-shift-floor-canvas');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    var cw, ch, cx, cy, scale, frame = 0;

    function resize(){
      var wrap = canvas.parentElement;
      if (!wrap) return;
      canvas.width = wrap.clientWidth || 600;
      canvas.height = Math.max(380, Math.min(wrap.clientHeight || 420, window.innerHeight * 0.7));
      cw = canvas.width; ch = canvas.height;
      cx = cw * 0.5; cy = ch * 0.58;
      scale = cw < 520 ? cw / 520 : Math.min(cw / 720, 1.15);
    }
    window.addEventListener('resize', resize);
    resize();

    var C = {
      outline:'#0f172a', floor:'#1e293b', floorLight:'#334155',
      gold:'#f5c518', red:'#ef4444', green:'#22c55e', cyan:'#38bdf8', violet:'#8b5cf6',
      panel:'#ffffff', muted:'#94a3b8'
    };

    function rr(ctx,x,y,w,h,r,fill,stroke){
      ctx.fillStyle = fill;
      ctx.beginPath();
      if (ctx.roundRect) ctx.roundRect(x,y,w,h,r);
      else ctx.rect(x,y,w,h);
      ctx.fill();
      if (stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=2; ctx.stroke(); }
    }

    function WorkCenter(x, y, label, state){
      this.x=x; this.y=y; this.label=label; this.state=state;
    }
    WorkCenter.prototype.draw = function(ctx, pulse){
      var w=70*scale, h=52*scale;
      var col = this.state==='down' ? C.red : (this.state==='warn' ? C.gold : C.green);
      rr(ctx, this.x-w/2, this.y-h, w, h, 6*scale, C.floorLight, C.outline);
      rr(ctx, this.x-w/2+8*scale, this.y-h+10*scale, w-16*scale, h-22*scale, 4*scale, '#0f172a', null);
      if (this.state==='down'){
        ctx.fillStyle = 'rgba(239,68,68,'+(0.35+Math.sin(pulse)*0.2)+')';
        ctx.fillRect(this.x-w/2+8*scale, this.y-h+10*scale, w-16*scale, h-22*scale);
      }
      ctx.fillStyle = col;
      ctx.beginPath(); ctx.arc(this.x, this.y-h+18*scale, 5*scale, 0, Math.PI*2); ctx.fill();
      ctx.fillStyle = '#e2e8f0';
      ctx.font = 'bold '+(9*scale)+'px Inter,sans-serif';
      ctx.textAlign = 'center';
      ctx.fillText(this.label, this.x, this.y-6*scale);
    };

    function OeeGaugeRing(cx, cy, r, pct){
      this.cx=cx; this.cy=cy; this.r=r; this.pct=pct;
    }
    OeeGaugeRing.prototype.draw = function(ctx){
      ctx.strokeStyle = 'rgba(255,255,255,.15)'; ctx.lineWidth = 10*scale;
      ctx.beginPath(); ctx.arc(this.cx, this.cy, this.r, 0, Math.PI*2); ctx.stroke();
      ctx.strokeStyle = C.green; ctx.lineWidth = 10*scale;
      ctx.beginPath(); ctx.arc(this.cx, this.cy, this.r, -Math.PI/2, -Math.PI/2 + Math.PI*2*this.pct); ctx.stroke();
      ctx.fillStyle = '#fff'; ctx.font = 'bold '+(16*scale)+'px Inter,sans-serif';
      ctx.textAlign = 'center'; ctx.fillText(Math.round(this.pct*100)+'%', this.cx, this.cy+5*scale);
      ctx.fillStyle = C.muted; ctx.font = (9*scale)+'px Inter,sans-serif';
      ctx.fillText('OEE', this.cx, this.cy+18*scale);
    };

    function TelegramEscalation(x, y, text, alpha){
      this.x=x; this.y=y; this.text=text; this.alpha=alpha;
    }
    TelegramEscalation.prototype.draw = function(ctx){
      if (this.alpha <= 0) return;
      ctx.save(); ctx.globalAlpha = this.alpha;
      rr(ctx, this.x, this.y, 130*scale, 36*scale, 10*scale, C.cyan, null);
      ctx.fillStyle = '#fff';
      ctx.font = 'bold '+(8*scale)+'px Inter,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('TG · '+this.text, this.x+10*scale, this.y+22*scale);
      ctx.restore();
    };

    var centers = [
      new WorkCenter(-95*scale, 0, 'Станок A', 'ok'),
      new WorkCenter(0, 0, 'Участок B', 'warn'),
      new WorkCenter(95*scale, 0, 'Линия C', 'down')
    ];
    var gauge = new OeeGaugeRing(cx, cy - 95*scale, 42*scale, 0.62);
    var tg = new TelegramEscalation(cx - 65*scale, cy - 175*scale, 'Простой > 8 мин', 0);

    function loop(){
      frame++;
      var prg = (frame * 0.035) % 280;
      ctx.clearRect(0,0,cw,ch);

      /* пол */
      rr(ctx, cx-160*scale, cy-20*scale, 320*scale, 80*scale, 8*scale, C.floor, C.outline);
      ctx.fillStyle = 'rgba(245,197,24,.25)';
      for (var i=0;i<5;i++) ctx.fillRect(cx-150*scale+i*32*scale, cy+20*scale, 18*scale, 4*scale);

      /* фазы цикла */
      centers[2].state = prg < 120 ? 'down' : (prg < 200 ? 'warn' : 'ok');
      centers[1].state = prg > 60 && prg < 140 ? 'warn' : 'ok';
      gauge.pct = 0.55 + Math.sin(frame*0.02)*0.08;

      centers.forEach(function(wc){ wc.draw(ctx, frame*0.08); });

      /* код простоя popup */
      if (prg > 40 && prg < 110){
        var pop = Math.min(1, (prg-40)/20);
        ctx.save(); ctx.globalAlpha = pop;
        rr(ctx, cx+20*scale, cy-70*scale, 100*scale, 44*scale, 6*scale, C.panel, C.outline);
        ctx.fillStyle = C.outline; ctx.font = 'bold '+(8*scale)+'px Inter,sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText('Код: ожидание', cx+28*scale, cy-52*scale);
        ctx.fillText('материала', cx+28*scale, cy-38*scale);
        ctx.restore();
      }

      /* Pareto полоски */
      if (prg > 200){
        var bars = [0.7, 0.45, 0.3];
        bars.forEach(function(b,i){
          rr(ctx, cx-120*scale, cy+45*scale+i*14*scale, b*140*scale, 8*scale, 2*scale, i===0?C.red:C.gold, null);
        });
        ctx.fillStyle = '#cbd5e1'; ctx.font = (8*scale)+'px Inter,sans-serif';
        ctx.textAlign = 'left'; ctx.fillText('Pareto потерь', cx-120*scale, cy+38*scale);
      }

      tg.alpha = prg > 100 && prg < 190 ? Math.min(1,(prg-100)/15) : (prg >= 190 ? Math.max(0, 1-(prg-190)/20) : 0);
      tg.draw(ctx);
      gauge.draw(ctx);

      requestAnimationFrame(loop);
    }
    loop();
  });
})();
</script>
</section>

<section class="aasp-section" id="smennye-zadaniya" aria-labelledby="smen-title">
  <div class="aasp-cnt">
    <div class="aasp-sh aasp-left">
      <span class="aasp-eyebrow">Диспетчеризация</span>
      <h2 id="smen-title">Сменные задания без хаоса: как AI помогает диспетчеризации</h2>
      <p><strong>ai сменные задания</strong> — слой поверх 1С: превращает план заказов в живой сценарий смены.</p>
    </div>
    <h3>От Excel и устных задач к единому сценарию смены</h3>
    <div class="aasp-steps">
      <div class="aasp-step"><p><strong>Утро:</strong> агент загружает план из 1С или таблицы.</p></div>
      <div class="aasp-step"><p><strong>Распределение:</strong> черновик задания — мастер утверждает.</p></div>
      <div class="aasp-step"><p><strong>Исполнение:</strong> бригада получает задание в Telegram с кнопками статуса.</p></div>
      <div class="aasp-step"><p><strong>Сбой:</strong> агент пересчитывает очередь и предлагает перенос.</p></div>
    </div>
    <h3>Связь сменного задания с фактом выполнения</h3>
    <p>Каждая операция связана со временем старта/завершения, паузами с кодом причины, эскалацией при простое &gt; N минут.</p>
  </div>
</section>

<section class="aasp-section aasp-section-alt" id="prostoi" aria-labelledby="prostoi-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">OEE · простои</span>
      <h2 id="prostoi-title">Контроль простоев и OEE: фиксация в реальном времени</h2>
    </div>
    <div class="aasp-callout aasp-callout--def">
      <p><em>OEE</em> = Доступность × Производительность × Качество. Поздняя фиксация простоя делает <strong>доступность</strong> ложной.</p>
    </div>
    <h3>Причины остановок и классификация простоев</h3>
    <p>Стартовый справочник — 8–15 кодов по TPM/lean. Агент предлагает код, классифицирует текст через LLM, ведёт audit log.</p>
    <h3>Метрики OEE, MTBF и сменные KPI</h3>
    <div class="aasp-table-wrap">
      <table class="aasp-table">
        <thead><tr><th>Метрика</th><th>Зачем на пилоте</th></tr></thead>
        <tbody>
          <tr><td>OEE участка</td><td>главный KPI «до/после»</td></tr>
          <tr><td>Время фиксации простоя</td><td>с часов до минут</td></tr>
          <tr><td>% простоев «без кода»</td><td>дисциплина смены</td></tr>
          <tr><td>Время реакции мастера</td><td>эскалации</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="aasp-section" id="karta-poter" aria-labelledby="karta-title">
  <div class="aasp-cnt">
    <div class="aasp-sh aasp-left">
      <span class="aasp-eyebrow">Lean · карта потерь</span>
      <h2 id="karta-title">Карта потерь производства: от данных смены к решениям</h2>
      <p>Лид-магнит Nero Network — <strong>карта потерь</strong> с шаблоном кодов и расчётом стоимости часа простоя.</p>
    </div>
    <div class="aasp-grid-2">
      <div class="aasp-card">
        <h3>Как построить карту потерь на базе AI-агента</h3>
        <ol class="aasp-steps" style="list-style:none;">
          <li class="aasp-step">Аудит 1–2 дня: 8 видов Muda, baseline</li>
          <li class="aasp-step">Справочник кодов с мастером</li>
          <li class="aasp-step">Неделя пилота: timestamps + Pareto</li>
          <li class="aasp-step">Визуализация топ-3 потерь в рублях</li>
        </ol>
      </div>
      <div class="aasp-card">
        <h3>Что получает собственник и начальник цеха</h3>
        <ul>
          <li><strong>Собственник:</strong> стоимость простоя за неделю, узкое место, ROI</li>
          <li><strong>Начальник цеха:</strong> три действия из Pareto на завтра</li>
          <li><strong>Мастер:</strong> меньше ручного ввода</li>
        </ul>
      </div>
    </div>

    <!-- CTA Артура №1 — после #karta-poter -->
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit">
      <div class="ym-cta-block__icon" aria-hidden="true">📊</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Найти простои на вашем участке — аудит за 1–2 дня</p>
        <p class="ym-cta-block__sub">Обход цеха, baseline OEE, шаблон кодов простоев и черновик карты потерь. На выходе — Pareto причин и ориентир ROI без обязательств по пилоту.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="aasp-section aasp-section-alt" id="etapy" aria-labelledby="etapy-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">Внедрение под ключ</span>
      <h2 id="etapy-title">Внедрение AI-агента под ключ: этапы, сроки, интеграции</h2>
      <p>Пилот на одном участке с одним KPI — ответ на риски Gartner (&gt;40% отмен agentic AI к 2027).</p>
    </div>
    <h3>Источники данных: 1С, MES, Excel, терминалы, датчики</h3>
    <div class="aasp-table-wrap">
      <table class="aasp-table">
        <thead><tr><th>Этап</th><th>Стек</th></tr></thead>
        <tbody>
          <tr><td>MVP (4–8 нед.)</td><td>1С/Excel + Telegram + n8n</td></tr>
          <tr><td>Рост</td><td>1С:MES, CRM</td></tr>
          <tr><td>Зрелость</td><td>OPC UA, SCADA, авто-стоп</td></tr>
        </tbody>
      </table>
    </div>
    <h3>Интеграция с ERP/CRM и уведомления руководителю</h3>
    <p>1С — заказы и выработка; Telegram — канал малого цеха; CRM — задачи бригадам; эскалация при простое без реакции.</p>
    <h3>Риски agentic AI и как снижать отмену проекта (Gartner 2027)</h3>
    <div class="aasp-callout aasp-callout--warn">
      <p>Hype-driven PoC без KPI, «робот сам переназначил смену», agent washing — митигация: один участок, human approval, audit log, калькулятор ROI.</p>
    </div>
    <p><strong>Дорожная карта пилота (6 шагов):</strong> аудит → MVP → агент смены → агент простоев → governance → масштаб.</p>

    <!-- CTA Артура №2 — после рисков Gartner -->
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понять agentic AI до старта пилота?</p>
        <p class="ym-cta-block__sub">Перед внедрением на производстве полезно разобраться в n8n, human-in-the-loop, интеграции с 1С и Telegram — это ускоряет согласование с мастером и собственником. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent"<?php echo nero_ai_primary_cta_link_attrs($secondary_cta_url); ?>><?php echo esc_html($secondary_cta_label); ?></a>.</p>
      </div>
    </aside>
  </div>
</section>

<section class="aasp-section" id="cena" aria-labelledby="cena-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">ROI</span>
      <h2 id="cena-title">Стоимость, ROI и окупаемость: сколько стоит час простоя</h2>
    </div>
    <h3>Ориентир чека 500 тыс.–2 млн ₽ и факторы цены</h3>
    <p>Количество центров, глубина интеграции, on-premise, число агентов (смена / простои / переплан).</p>
    <h3>ROI-калькулятор: стоимость простоя vs внедрение</h3>
    <div class="aasp-callout aasp-callout--def">
      <p><strong>Формула:</strong> Экономия в год = (часы простоя в месяц × 12 × стоимость часа) × % снижения после пилота</p>
      <p><strong>Пример:</strong> 40 ч/мес × 3 000 ₽ × 20% = 288 000 ₽/год; пилот 800 000 ₽ → ~33 мес. при консервативных 20%.</p>
    </div>
  </div>
</section>

<section class="aasp-section aasp-section-alt" id="keisy" aria-labelledby="keisy-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">Сценарии</span>
      <h2 id="keisy-title">Кейсы и сценарии: мебель, пищевое производство, малые цеха</h2>
    </div>
    <div class="aasp-grid-2">
      <div class="aasp-card">
        <h3>Сценарий «найти скрытые простои за неделю»</h3>
        <p>Мебель, 15–30 человек, Excel + Telegram → Pareto + карта потерь.</p>
      </div>
      <div class="aasp-card">
        <h3>Сценарий «сменное задание + контроль выполнения»</h3>
        <p>Пищевое на 1С:УНФ: связка 1С → агент → Telegram, переплан с approve мастера.</p>
      </div>
    </div>
    <div class="aasp-table-wrap">
      <table class="aasp-table">
        <thead><tr><th>Кейс</th><th>Результат</th></tr></thead>
        <tbody>
          <tr><td>GroupBWT (EU)</td><td>−31% внеплановых простоев за 6 мес.</td></tr>
          <tr><td>КЭАЗ «КРОТ»</td><td>реакция &lt;1 мин, OEE до 80%</td></tr>
          <tr><td>ФосАгро «AIХимик»</td><td>агент в контуре АСУП</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="aasp-section" id="faq" aria-labelledby="faq-title">
  <div class="aasp-cnt">
    <div class="aasp-sh">
      <span class="aasp-eyebrow">FAQ</span>
      <h2 id="faq-title">FAQ: внедрение без программиста, CRM, поддержка</h2>
    </div>
    <div class="aasp-faq" data-aasp-faq>
      <div class="aasp-faq-item"><div class="aasp-faq-q">Нужен ли свой IT-отдел?</div><div class="aasp-faq-a">На пилоте — нет: интегратор настраивает связку, мастер работает с кнопками в Telegram.</div></div>
      <div class="aasp-faq-item"><div class="aasp-faq-q">Как быстро увидеть первые результаты?</div><div class="aasp-faq-a">1–2 дня аудит; 2–4 недели MVP; первая полная смена с отчётом — неделя 4–8.</div></div>
      <div class="aasp-faq-item"><div class="aasp-faq-q">1С уже умеет сменные задания — зачем агент?</div><div class="aasp-faq-a">1С планирует; агент фиксирует простой в момент события, эскалирует, перепланирует и собирает отчёт.</div></div>
      <div class="aasp-faq-item"><div class="aasp-faq-q">Попадём в 40% отменённых проектов Gartner?</div><div class="aasp-faq-a">Снижаете риск: один KPI, фиксированный срок, human-in-the-loop, baseline до старта.</div></div>
    </div>
  </div>
</section>
<script>
document.querySelectorAll('[data-aasp-faq] .aasp-faq-q').forEach(function(q){
  q.addEventListener('click', function(){ q.parentElement.classList.toggle('open'); });
});
</script>

<section class="aasp-section aasp-section-alt" id="cta" aria-labelledby="cta-title">
  <div class="aasp-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final">
      <p class="aasp-eyebrow" style="margin-bottom:10px;">CTA · Найти простои</p>
      <h2 id="cta-title" class="ym-cta-block__headline">Найти простои: аудит и карта потерь</h2>
      <p class="ym-cta-block__sub">Вы теряете деньги, когда простой узнают на следующий день, а сменное задание переписывают в пятом чате. <strong>Внедрение ai производство контроль</strong> под ключ — агент смены для цеха без MES: Telegram, 1С, Excel, фиксация отклонений, отчёт руководителю.</p>
      <p class="ym-cta-block__sub"><strong>Лид-магнит:</strong> Карта потерь производства — 8 видов потерь, расчёт стоимости часа простоя.</p>
      <div class="ym-cta-block__actions" style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:8px;">
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a href="#karta-poter" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Скачать логику карты потерь</a>
      </div>
    </div>
  </div>
</section>

</div><!-- .aasp-content -->

<!-- SCHEMA-MARKUP:INSERT -->


</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
