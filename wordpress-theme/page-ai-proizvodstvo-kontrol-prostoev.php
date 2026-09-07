<?php
/**
 * Template Name: AI-агент для сменных заданий и контроля простоев
 * Description: Внедрение AI на производстве — контроль простоев, сменные задания, Telegram, 1С. Пилот под ключ.
 */

declare(strict_types=1);

$page_seo_title       = 'Внедрение AI на производстве: контроль простоев под ключ';
$page_seo_description = 'AI-агент для сменных заданий и контроля простоев: сбор данных по смене, фиксация отклонений и отчёт руководителю. Внедрение под ключ для цехов и малого производства.';

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

$brand = get_bloginfo('name') ?: (getenv('SITE_BRAND') ?: ''); // pragma: allowlist secret

$nero_ai_header_links = [
    ['label' => 'Простои', 'href' => '#pochemu-prostoi'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Внедрение', 'href' => '#etapy'],
    ['label' => 'Интеграции', 'href' => '#integracii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'FAQ', 'href' => '#faq'],
    ['label' => 'Аудит', 'href' => '#cta-final'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Найти простои';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'Как это работает';
$secondary_cta_url   = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

get_header();

$nero_ai_floating = get_stylesheet_directory() . '/nero-ai-floating-header.inc.php';
if (!is_readable($nero_ai_floating)) {
    require dirname(__DIR__) . '/shared/theme-canonical/nero-ai-floating-header.inc.php';
} else {
    require $nero_ai_floating;
}
?>

<?php nero_ai_echo_theme_styles(); ?>

<style>

/* Kadence layout reset */
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

.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.ipk-page .nero-ai-btn,.aipk-page .nero-ai-btn{display:inline-flex;align-items:center;justify-content:center;min-height:48px;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.aipk-page .nero-ai-btn:hover{transform:translateY(-2px);}
.aipk-page .ym-btn--accent,.aipk-page .nero-ai-btn-primary{background:linear-gradient(135deg,#2563eb,#7c3aed);color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.aipk-page .ym-btn--ghost,.aipk-page .nero-ai-btn-secondary{background:rgba(255,255,255,.08);color:#e6edf7!important;border:1.5px solid rgba(255,255,255,.18);}

/* === AIPK CONTENT ROOT === */
.aipk-content{
  --aipk-bg:#050711;--aipk-bg2:#080b17;
  --aipk-text:#e6edf7;--aipk-muted:rgba(255,255,255,.65);--aipk-soft:#c7d2e5;--aipk-heading:#fff;
  --aipk-border:rgba(255,255,255,.10);--aipk-accent:#79f2ff;--aipk-violet:#8b5cf6;
  --aipk-amber:#f59e0b;--aipk-orange:#f97316;--aipk-green:#22c55e;
  --aipk-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aipk-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.aipk-content *,.aipk-content *::before,.aipk-content *::after{box-sizing:border-box}
.aipk-content a{color:inherit}
.aipk-content p{color:var(--aipk-muted);line-height:1.72;margin:0 0 1em}
.aipk-content h2,.aipk-content h3,.aipk-content h4{color:var(--aipk-heading);letter-spacing:-.045em;margin:0 0 .7em}
.aipk-content strong{color:var(--aipk-soft)}
.aipk-content ul{padding-left:0;list-style:none;margin:0 0 1em}
.aipk-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--aipk-muted);font-size:14.5px;line-height:1.65}
.aipk-content ul li::before{content:'›';position:absolute;left:0;color:var(--aipk-accent);font-weight:700}
.aipk-cnt{width:min(var(--aipk-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.aipk-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.aipk-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.aipk-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.aipk-sh.aipk-left{margin-left:0;text-align:left}
.aipk-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.aipk-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.aipk-sh.aipk-left p{margin-left:0}
.aipk-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aipk-amber);margin-bottom:14px}
.aipk-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.aipk-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.aipk-intro-text{position:relative;padding-left:20px;text-align:left!important}
.aipk-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aipk-amber),var(--aipk-accent))}
.aipk-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.aipk-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.aipk-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.aipk-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aipk-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px}
.aipk-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aipk-muted);line-height:1.4}
.aipk-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px}
@media(max-width:900px){.aipk-intro-grid{grid-template-columns:1fr;gap:36px}.aipk-intro-kpi{grid-template-columns:repeat(4,1fr)}}
@media(max-width:600px){.aipk-intro-kpi{grid-template-columns:1fr 1fr}}
.aipk-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.aipk-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.aipk-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.072);border:1px solid var(--aipk-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aipk-muted);transition:border-color .2s,color .2s;text-decoration:none!important}
.aipk-toc a:hover{border-color:rgba(245,158,11,.42);color:var(--aipk-amber);background:rgba(245,158,11,.08)}
.aipk-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aipk-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px)}
.aipk-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:768px){.aipk-grid-2{grid-template-columns:1fr}}
.aipk-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(245,158,11,.2);margin:24px 0}
.aipk-table{width:100%;border-collapse:collapse;font-size:14px}
.aipk-table th{padding:13px 16px;text-align:left;background:rgba(245,158,11,.1);color:var(--aipk-amber);font-weight:700;border-bottom:1px solid rgba(245,158,11,.25)}
.aipk-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--aipk-text);vertical-align:top}
.aipk-table .aipk-col-nero{background:rgba(121,242,255,.06);color:var(--aipk-accent);font-weight:600}
.aipk-callout{border-radius:16px;padding:20px 24px;margin:20px 0;border:1px solid}
.aipk-callout-amber{background:rgba(245,158,11,.1);border-color:rgba(245,158,11,.3);color:var(--aipk-soft)}
.aipk-callout-warning{background:rgba(245,158,11,.08);border-color:rgba(249,115,22,.35)}
.aipk-source{font-size:13px;color:var(--aipk-muted)}
.aipk-steps{counter-reset:step;list-style:none;padding:0;margin:32px 0;display:grid;gap:14px;max-width:820px;margin-left:auto;margin-right:auto}
.aipk-steps li{counter-increment:step;position:relative;padding:18px 18px 18px 56px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:14px;color:var(--aipk-muted);font-size:14.5px;line-height:1.65}
.aipk-steps li::before{content:counter(step);position:absolute;left:16px;top:16px;width:28px;height:28px;border-radius:50%;background:rgba(121,242,255,.15);color:var(--aipk-accent);font-weight:800;font-size:13px;display:flex;align-items:center;justify-content:center}
.aipk-timeline{position:relative;padding-left:40px;max-width:820px;margin:0 auto}
.aipk-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--aipk-amber),var(--aipk-accent));opacity:.35;border-radius:2px}
.aipk-tl-item{position:relative;margin-bottom:32px}
.aipk-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--aipk-amber);box-shadow:0 0 0 4px rgba(245,158,11,.2)}
.aipk-leadmagnet{background:linear-gradient(135deg,rgba(245,158,11,.08),rgba(121,242,255,.06));border:1px solid rgba(245,158,11,.25);border-radius:24px;padding:32px;max-width:820px;margin:0 auto}
.aipk-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.aipk-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.aipk-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aipk-heading);cursor:pointer;list-style:none}
.aipk-faq-q::-webkit-details-marker{display:none}
.aipk-faq-a{padding:0 24px 20px;font-size:14.5px;color:var(--aipk-muted);line-height:1.72}
/* CTA — из Артура */
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,158,11,.12),rgba(121,242,255,.1));border:1px solid rgba(245,158,11,.3);text-align:center}
.ym-cta-block--secondary{text-align:left;background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12)}
.ym-cta-block--dual{background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(245,158,11,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,158,11,.08));border-color:rgba(139,92,246,.3)}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--aipk-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--aipk-accent)!important;text-decoration:underline!important}
@media(max-width:600px){.ym-cta-block{padding:28px 20px}}
</style>

<main id="primary" class="site-main nero-ai-home-page aipk-page" role="main" tabindex="-1">

<section class="nero-ai-hero aipk-hero-shift" id="hero" aria-labelledby="aipk-hero-title">
<style>
/* ── Hero ai-proizvodstvo-kontrol-prostoev: самодостаточные стили (без CSS темы) ── */
.aipk-hero-shift {
  --aipk-amber: #f59e0b;
  --aipk-orange: #f97316;
  --aipk-cyan: #79f2ff;
  --aipk-violet: #8b5cf6;
  --aipk-green: #22c55e;
  --aipk-text: #e6edf7;
  --aipk-muted: #9aa8bd;
  --aipk-soft: #c7d2e5;
  --aipk-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background:
    radial-gradient(ellipse 70% 55% at 18% 22%, rgba(245, 158, 11, 0.14), transparent 58%),
    radial-gradient(ellipse 55% 45% at 82% 18%, rgba(121, 242, 255, 0.12), transparent 55%),
    radial-gradient(ellipse 50% 40% at 60% 88%, rgba(139, 92, 246, 0.1), transparent 50%),
    linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
}
.aipk-hero-shift::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 56px 56px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: 0;
}
.aipk-hero-shift::after {
  content: "";
  position: absolute;
  left: 6%;
  bottom: 8%;
  width: 520px;
  height: 520px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(249, 115, 22, .1), transparent 68%);
  filter: blur(10px);
  animation: aipkHeroGlow 8s ease-in-out infinite alternate;
  z-index: 0;
  pointer-events: none;
}
@keyframes aipkHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.04); }
}
.aipk-hero-shift .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aipk-hero-shift .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aipk-hero-shift .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 64px);
  line-height: .98;
  letter-spacing: -0.055em;
  color: #fff;
  font-weight: 900;
}
.aipk-hero-shift .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aipk-cyan) 38%, var(--aipk-amber) 72%, var(--aipk-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aipk-hero-shift .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 158, 11, 0.28);
  border-radius: 999px;
  background: rgba(245, 158, 11, 0.09);
  color: var(--aipk-amber) !important;
  font-size: 12px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aipk-hero-shift .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aipk-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aipk-hero-shift .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aipk-hero-shift .nero-ai-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 8px 11px;
  border: 1px solid rgba(255,255,255,.11);
  border-radius: 999px;
  background: rgba(255,255,255,.055);
  color: #dce8f7;
  font-size: 13px;
  font-weight: 700;
}
.aipk-hero-shift .aipk-phase-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 18px;
}
.aipk-hero-shift .aipk-phase {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 7px 12px;
  border-radius: 12px;
  border: 1px solid rgba(121, 242, 255, 0.18);
  background: rgba(121, 242, 255, 0.06);
  color: #b8e8ff;
  font-size: 12px;
  font-weight: 700;
}
.aipk-hero-shift .aipk-phase span {
  width: 22px;
  height: 22px;
  border-radius: 8px;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, var(--aipk-orange), var(--aipk-amber));
  color: #1a1200;
  font-size: 11px;
  font-weight: 900;
}
.aipk-hero-shift .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 32px;
}
.aipk-hero-shift .nero-ai-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-height: 48px;
  padding: 14px 22px;
  border-radius: 999px;
  border: 1px solid transparent;
  font-size: 15px;
  font-weight: 800;
  line-height: 1;
  text-decoration: none !important;
  transition: transform .22s ease, border-color .22s ease, background .22s ease;
}
.aipk-hero-shift .nero-ai-btn:hover { transform: translateY(-2px); }
.aipk-hero-shift .nero-ai-btn-primary {
  color: #0a1628 !important;
  background: linear-gradient(135deg, var(--aipk-cyan), #38bdf8 45%, var(--aipk-amber));
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aipk-hero-shift .nero-ai-btn-secondary {
  color: var(--aipk-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aipk-hero-shift .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.44);
  box-shadow: var(--aipk-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aipk-hero-shift .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .96), rgba(6, 10, 24, .98));
}
.aipk-hero-shift .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aipk-hero-shift .nero-ai-dots { display: flex; gap: 7px; }
.aipk-hero-shift .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aipk-hero-shift .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aipk-hero-shift .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aipk-hero-shift .nero-ai-dot:nth-child(3) { background: #34d399; }
.aipk-hero-shift .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aipk-hero-shift .nero-ai-window-body { padding: 16px; }
.aipk-hero-shift .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aipk-hero-shift .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aipk-hero-shift .nero-ai-live-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 999px;
  background: rgba(249, 115, 22, .12);
  color: #fde68a;
  font-size: 12px;
  font-weight: 800;
}
.aipk-hero-shift .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--aipk-orange);
  box-shadow: 0 0 0 6px rgba(249, 115, 22, .14);
  animation: aipkPulse 1.5s infinite;
}
@keyframes aipkPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aipk-hero-shift .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aipk-hero-shift .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aipk-hero-shift .nero-ai-metric span {
  display: block;
  color: var(--aipk-muted);
  font-size: 11px;
  font-weight: 700;
}
.aipk-hero-shift .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aipk-hero-shift .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aipk-hero-shift .nero-ai-metric--alert strong { color: #fde68a; }
.aipk-hero-shift .aipk-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(249, 115, 22, 0.2);
  background: radial-gradient(ellipse at 50% 42%, rgba(121,242,255,.06), rgba(6,10,24,.94) 72%);
}
.aipk-hero-shift #aipk-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aipk-hero-shift .nero-ai-task-stream { display: grid; gap: 8px; }
.aipk-hero-shift .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aipk-hero-shift .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(249,115,22,.14);
  color: var(--aipk-amber);
  font-size: 11px;
  font-weight: 800;
}
.aipk-hero-shift .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aipk-hero-shift .nero-ai-task span {
  color: var(--aipk-muted);
  font-size: 11px;
}
.aipk-hero-shift .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aipk-hero-shift .nero-ai-status--amber {
  background: rgba(245,158,11,.14);
  color: #fde68a;
}
.aipk-hero-shift .nero-ai-status--cyan {
  background: rgba(121,242,255,.12);
  color: #b8e8ff;
}
@media (max-width: 1100px) {
  .aipk-hero-shift .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aipk-hero-shift .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aipk-hero-shift .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aipk-hero-shift .nero-ai-window-body { padding: 12px; }
  .aipk-hero-shift .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aipk-hero-shift .nero-ai-status { grid-column: 2; width: fit-content; }
  .aipk-hero-shift .aipk-phase-strip { flex-direction: column; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · ai производство</p>
      <h1 id="aipk-hero-title">AI-агент для сменных заданий и <span class="nero-ai-gradient-text">контроля простоев</span>: внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">Собираем данные по смене, фиксируем отклонения и простои вовремя — и отдаём руководителю понятный отчёт вместо ручных таблиц</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">Сменные задания</li>
        <li class="nero-ai-badge">Контроль простоев</li>
        <li class="nero-ai-badge">Telegram</li>
        <li class="nero-ai-badge">Под ключ</li>
      </ul>
      <div class="aipk-phase-strip" aria-label="Этапы цикла смены">
        <div class="aipk-phase"><span>1</span> План смены</div>
        <div class="aipk-phase"><span>2</span> Фиксация простоя</div>
        <div class="aipk-phase"><span>3</span> Эскалация мастеру</div>
        <div class="aipk-phase"><span>4</span> Отчёт директору</div>
      </div>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля смены и простоев">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">смена · участок 2 · демо-данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Диспетчерская смены</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>OEE</span>
              <strong>62%</strong>
              <small>план/факт по линии</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--alert">
              <span>Простой</span>
              <strong>18 мин</strong>
              <small>зафиксирован вовремя</small>
            </div>
            <div class="nero-ai-metric">
              <span>План/факт</span>
              <strong>87%</strong>
              <small>сменное задание</small>
            </div>
            <div class="nero-ai-metric">
              <span>Отчёт</span>
              <strong>auto</strong>
              <small>руководителю в Telegram</small>
            </div>
          </div>

          <div class="aipk-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aipk-hero-canvas" role="img" aria-label="Анимация: орбита данных смены, фиксация простоя и автоматический отчёт руководителю"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий смены">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📋</span>
              <div><strong>Задание выдано</strong><span>Участок 2 · 12 операций · мастер утвердил</span></div>
              <span class="nero-ai-status">ok</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">⏸</span>
              <div><strong>Простой зафиксирован</strong><span>Переналадка ЧПУ · 18 мин · причина из справочника</span></div>
              <span class="nero-ai-status nero-ai-status--amber">alert</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📲</span>
              <div><strong>Эскалация мастеру</strong><span>Telegram · линия 3 · порог 15 мин</span></div>
              <span class="nero-ai-status nero-ai-status--cyan">sent</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">📊</span>
              <div><strong>Отчёт готов</strong><span>Топ-3 простоя · план/факт · PDF директору</span></div>
              <span class="nero-ai-status">done</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="aipk-content">

  <!-- INTRO -->
  <section class="aipk-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aipk-cnt">
      <div class="aipk-intro-grid nero-ai-reveal">
        <div class="aipk-intro-text">
          <p class="aipk-eyebrow">Лонгрид · ai производство контроль</p>
          <p><strong>Коротко:</strong> Nero Network внедряет AI-агента для <strong>ai производство контроль</strong> — сменные задания, фиксация простоев в моменте и отчёт руководителю. Не MES на три года, а пилот на одном участке с проверкой человеком.</p>
          <p>На малом производстве — мебельном цехе, пищевой линии, участке металлообработки на 20–50 человек — смена до сих пор живёт в Excel, WhatsApp и бумажных журналах. Задачи меняются вручную, простои фиксируются поздно. <strong>AI производство контроль</strong> в формате агента закрывает этот разрыв: собирает факт по смене, ловит отклонения вовремя и отдаёт руководителю понятный отчёт — без «тушения пожаров» в конце смены.</p>
          <p><strong>Определение:</strong> AI-агент для сменных заданий и контроля простоев — надстройка над уже существующим контуром (1С, Excel, Telegram, частично датчики), которая формирует сменное задание, собирает факт, классифицирует простои и готовит отчёт. Это не замена ERP и не полноценная MES «на три года внедрения».</p>
        </div>
        <div class="aipk-intro-kpi" aria-label="Ключевые метрики производства">
          <div class="aipk-kpi-card"><div class="kv">25–30%</div><div class="kl">простои как «норма»</div><div class="ks">без учёта в моменте</div></div>
          <div class="aipk-kpi-card"><div class="kv">8–15 п.п.</div><div class="kl">завышение OEE</div><div class="ks">ручной учёт, TeepTrak</div></div>
          <div class="aipk-kpi-card"><div class="kv">500K–2M ₽</div><div class="kl">чек пилота</div><div class="ks">Nero Network</div></div>
          <div class="aipk-kpi-card"><div class="kv">4–10 нед</div><div class="kl">типовой пилот</div><div class="ks">1 участок</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="aipk-toc-outer">
    <div class="aipk-cnt">
      <nav class="aipk-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-prostoi">Простои</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#keisy">Кейсы</a>
        <a href="#agentic-ai">Agentic AI</a>
        <a href="#karta-potery">Карта потерь</a>
        <a href="#faq">FAQ</a>
        <a href="#cta-final">Аудит</a>
      </nav>
    </div>
  </div>

  <!-- §1 ПОЧЕМУ ПРОСТОИ -->
  <section class="aipk-section" id="pochemu-prostoi">
    <div class="aipk-cnt">
      <div class="aipk-sh aipk-left nero-ai-reveal">
        <span class="aipk-eyebrow">Боль клиента</span>
        <h2>Почему на производстве простои узнают слишком поздно</h2>
      </div>

      <div class="aipk-grid-2 nero-ai-reveal">
        <div class="aipk-card">
          <h3 id="ruchnye-zadaniya">Задачи меняются вручную — где теряются данные по смене</h3>
          <p>Типовая картина на цехе 10–100 человек: план на смену лежит в Excel или приходит голосом в общий чат. Срочный заказ — мастер переписывает задание от руки или дублирует в мессенджере. Операторы видят разные версии. Факт выработки сдают в конце смены.</p>
          <ul>
            <li>план и факт живут в разных файлах;</li>
            <li>причины простоя не классифицируются — пишут «встали»;</li>
            <li>короткие остановки не попадают в учёт;</li>
            <li>сменный отчёт собирается часами, часто уже после ухода руководителя.</li>
          </ul>
        </div>
        <div class="aipk-card">
          <div class="aipk-callout aipk-callout-amber" role="note">
            <strong>25–30%</strong> планового фонда на производстве воспринимается как «нормальные простои» — потому что их не измеряют в моменте (<a href="https://companies.rbc.ru/news/k77qukLaXu/oee-na-proizvodstve-kak-izmerit-i-podnyat-effektivnost-stankov-na-20/" target="_blank" rel="noopener noreferrer">РБК Компании</a>).
          </div>
          <p>Ручной учёт, по данным TeepTrak State of OEE 2026, <strong>завышает OEE на 8–15 процентных пунктов</strong>: короткие остановки просто не видны (<a href="https://teeptrak.com/en/state-of-oee-2026/" target="_blank" rel="noopener noreferrer">TeepTrak</a>).</p>
        </div>
      </div>

      <div class="aipk-sh aipk-left nero-ai-reveal" style="margin-top:40px">
        <h3 id="stoimost-prostoya">Сколько стоит простой на малом производстве</h3>
        <p>Точная цифра зависит от отрасли, маржинальности и загрузки линии. Универсального «час простоя = X рублей» не существует — но ориентиры помогают понять, почему <strong>ai контроль простоев</strong> окупается быстрее, чем кажется.</p>
      </div>

      <div class="aipk-table-wrap nero-ai-reveal">
        <table class="aipk-table" aria-label="Ориентиры стоимости часа простоя по отраслям">
          <thead>
            <tr><th>Отрасль</th><th>Ориентир стоимости часа простоя</th></tr>
          </thead>
          <tbody>
            <tr><td>Пищевое производство</td><td>50–100 тыс. ₽/ч</td></tr>
            <tr><td>Деревообработка, мебель</td><td>30–80 тыс. ₽/ч</td></tr>
            <tr><td>Машиностроение</td><td>90–180 тыс. ₽/ч</td></tr>
          </tbody>
        </table>
      </div>
      <p class="aipk-source nero-ai-reveal">Источник ориентиров: <a href="https://inner.su/articles/stoimost-prostoya-bez-avtomatiki-roi-modernizatsii-proizvodstva-2025/" target="_blank" rel="noopener noreferrer">inner.su, июнь 2025</a>. Методика расчёта ущерба: <a href="https://sveto-copy.com/skolko-stoit-chas-prostoya-proizvodstva-metodika-rascheta-ubytkov-i-vybor-rezervnoj-moshhnosti.html" target="_blank" rel="noopener noreferrer">sveto-copy.com</a>.</p>
      <p class="nero-ai-reveal">Если план смены собирается из входящих заявок, имеет смысл заранее автоматизировать их приём: <a href="<?php echo esc_url(home_url('/vnedrenie-ai-obrabotka-email-crm/')); ?>">AI-обработка входящей почты в CRM</a> сокращает задержку между заказом и выдачей сменного задания на участок.</p>
      <p class="nero-ai-reveal"><strong>Итог:</strong> если простой фиксируется на следующий день, вы теряете не только деньги за час остановки, но и возможность среагировать в смене. AI-агент не отменяет поломку — но сокращает «слепой» простой и время на сбор отчёта.</p>
    </div>
  </section>

  <!-- §2 КАК РАБОТАЕТ + БОРИС CANVAS -->
  <section class="aipk-section aipk-section-alt" id="kak-rabotaet">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Решение</span>
        <h2>AI-агент для производства: контроль простоев и сменных заданий</h2>
        <p><strong>AI для производства</strong> в модели Nero Network — не «чат-бот ради чат-бота». Агент работает поверх ваших систем: план → смена → фиксация → AI-сводка → отчёт.</p>
      </div>
    </div>

    <!-- === БОРИС: визуальный блок === -->
    <section id="ai-proizvodstvo-kontrol-prostoev-boris-block" class="apk-root" aria-label="Анимация: фиксация простоя на линии и эскалация мастеру в Telegram">
      <style>
      /* === БОРИС: prefix apk-, scoped внутри #ai-proizvodstvo-kontrol-prostoev-boris-block === */
      #ai-proizvodstvo-kontrol-prostoev-boris-block.apk-root{
        padding:48px 0 56px;
        background:linear-gradient(180deg,rgba(245,158,11,.04),rgba(121,242,255,.03));
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-cnt{
        max-width:1160px;margin:0 auto;padding:0 24px;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-card{
        display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
        border-radius:22px;overflow:hidden;
        background:#fff;
        box-shadow:0 12px 48px rgba(15,23,42,.1),0 0 0 1px rgba(245,158,11,.15);
        min-height:460px;
      }
      @media(max-width:1023px){
        #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-card{grid-template-columns:1fr;min-height:auto;}
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-lft{
        padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
        border-right:1px solid #fde68a;
      }
      @media(max-width:1023px){
        #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-lft{border-right:none;border-bottom:1px solid #fde68a;padding:32px 24px;}
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-ey{
        display:inline-flex;align-items:center;gap:8px;
        font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
        color:#d97706;margin:0 0 14px;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-ey::before{
        content:'';width:18px;height:2px;background:#f59e0b;border-radius:1px;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-h3{
        font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-ul{
        list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-ul li{
        display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-ic{
        flex-shrink:0;width:22px;height:22px;border-radius:50%;
        background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;
        font-size:11px;color:#b45309;margin-top:1px;font-style:normal;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-pl{
        padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
      }
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-pl-a{background:rgba(245,158,11,.1);color:#b45309;border:1.5px solid rgba(245,158,11,.25);}
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
      #ai-proizvodstvo-kontrol-prostoev-boris-block .apk-rgt{
        position:relative;
        background:linear-gradient(145deg,#0a0e1c 0%,#111827 55%,#0f172a 100%);
        min-height:400px;overflow:hidden;
      }
      @media(max-width:1023px){#ai-proizvodstvo-kontrol-prostoev-boris-block .apk-rgt{min-height:360px;}}
      #apk-shift-downtime-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
      </style>

      <div class="apk-cnt">
        <div class="apk-card">
          <div class="apk-lft">
            <span class="apk-ey">Момент простоя</span>
            <h3 class="apk-h3">Оператор нажал «Простой» — мастер узнал через 18 секунд, а не завтра утром</h3>
            <ul class="apk-ul">
              <li><span class="apk-ic">⏱</span>Таймер простоя стартует в момент остановки линии</li>
              <li><span class="apk-ic">📱</span>Эскалация в Telegram мастеру при превышении порога</li>
              <li><span class="apk-ic">🏷</span>AI предлагает причину из справочника — мастер подтверждает</li>
              <li><span class="apk-ic">📊</span>Данные сразу попадают в сменный отчёт руководителя</li>
            </ul>
            <div class="apk-pills">
              <span class="apk-pl apk-pl-a">18 мин → фиксация сразу</span>
              <span class="apk-pl apk-pl-g">human-in-the-loop</span>
              <span class="apk-pl apk-pl-c">Telegram · 1С</span>
            </div>
            <p class="apk-foot">Дальше — 5 шагов работы агента по смене →</p>
          </div>
          <div class="apk-rgt">
            <canvas id="apk-shift-downtime-canvas" role="img" aria-label="Анимация: линия производства, простой на участке, таймер и уведомление мастеру в Telegram"></canvas>
          </div>
        </div>
      </div>

      <script>
      (function(){
        'use strict';
        var cv = document.getElementById('apk-shift-downtime-canvas');
        if (!cv) return;
        var ctx = cv.getContext('2d');
        var W = 0, H = 0, fr = 0, pulse = 0;

        function resize(){
          var p = cv.parentElement;
          if (!p) return;
          cv.width = p.clientWidth || 640;
          cv.height = p.clientHeight || 420;
          W = cv.width; H = cv.height;
        }
        window.addEventListener('resize', resize);
        resize();

        var C = {
          bg:'#0f172a', line:'rgba(255,255,255,.08)', text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
          work:'#22c55e', idle:'#f59e0b', setup:'#60a5fa', tg:'#29b6f6', alert:'#f97316'
        };

        var stations = [
          {x:0.12, label:'Резка', state:'work'},
          {x:0.32, label:'Сборка', state:'work'},
          {x:0.52, label:'Упаковка', state:'idle', idleSec:0},
          {x:0.72, label:'ОТК', state:'work'},
          {x:0.88, label:'Отгрузка', state:'setup'}
        ];

        var LOOP = 600;
        var phase = 0; /* 0 run, 1 idle growing, 2 alert, 3 resolve */

        function rr(x,y,w,h,r,fill,stroke,lw){
          ctx.beginPath();
          if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
          else ctx.rect(x,y,w,h);
          if(fill){ ctx.fillStyle=fill; ctx.fill(); }
          if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
        }

        function drawStation(st, i, cx, cy, sw, sh){
          var col = st.state==='idle'?C.idle:st.state==='setup'?C.setup:C.work;
          var glow = st.state==='idle' ? 0.15+0.12*Math.sin(pulse*0.12) : 0.06;
          rr(cx-sw/2-4, cy-sh/2-4, sw+8, sh+8, 10, 'rgba(245,158,11,'+glow+')', null, 0);
          rr(cx-sw/2, cy-sh/2, sw, sh, 8, 'rgba(255,255,255,.06)', col, 2);
          ctx.fillStyle=col;
          ctx.font='bold 10px Inter,system-ui,sans-serif';
          ctx.textAlign='center';
          ctx.fillText(st.label, cx, cy+4);
          if(st.state==='idle'){
            ctx.fillStyle=C.alert;
            ctx.font='bold 9px Inter,sans-serif';
            ctx.fillText('ПРОСТОЙ', cx, cy-sh/2-8);
          }
        }

        function draw(){
          fr++; pulse++;
          var t = fr % LOOP;
          phase = t < 120 ? 0 : t < 360 ? 1 : t < 480 ? 2 : 3;

          if(t === 120){ stations[2].state='idle'; stations[2].idleSec=0; }
          if(t === 480){ stations[2].state='work'; }

          if(phase >= 1 && phase < 3) stations[2].idleSec = Math.floor((t-120)/20);

          ctx.fillStyle=C.bg;
          ctx.fillRect(0,0,W,H);

          /* floor line */
          var floorY = H*0.58;
          ctx.strokeStyle=C.line; ctx.lineWidth=1;
          ctx.beginPath(); ctx.moveTo(24,floorY); ctx.lineTo(W-24,floorY); ctx.stroke();

          var sw = Math.min(72, W*0.11), sh = 44;
          stations.forEach(function(st,i){
            drawStation(st, i, st.x*W, floorY-sh/2-8, sw, sh);
          });

          /* conveyor dots */
          var off = (fr*0.6)%24;
          ctx.fillStyle='rgba(34,197,94,.35)';
          for(var d=0; d<W; d+=24){
            ctx.beginPath(); ctx.arc(d-off+12, floorY+18, 3, 0, Math.PI*2); ctx.fill();
          }

          /* timer panel */
          if(phase >= 1){
            var sec = stations[2].idleSec;
            var tx = W*0.52, ty = H*0.14;
            rr(tx-70, ty-22, 140, 44, 10, 'rgba(245,158,11,.15)', C.idle, 2);
            ctx.fillStyle=C.text;
            ctx.font='bold 14px Inter,sans-serif';
            ctx.textAlign='center';
            ctx.fillText('Простой: '+sec+' мин', tx, ty+5);
          }

          /* Telegram alert */
          if(phase >= 2){
            var slide = Math.min(1, (t-360)/40);
            var bx = W - 220 + (1-slide)*80;
            var by = H*0.22;
            rr(bx, by, 200, 72, 12, 'rgba(41,182,246,.18)', C.tg, 1.5);
            ctx.fillStyle=C.tg;
            ctx.font='bold 11px Inter,sans-serif';
            ctx.textAlign='left';
            ctx.fillText('Telegram · мастер смены', bx+12, by+18);
            ctx.fillStyle=C.text;
            ctx.font='12px Inter,sans-serif';
            ctx.fillText('Упаковка: простой '+stations[2].idleSec+' мин', bx+12, by+38);
            ctx.fillStyle=C.muted;
            ctx.font='10px Inter,sans-serif';
            ctx.fillText('Причина: ожидание сырья?', bx+12, by+56);
          }

          /* shift report bar */
          var barW = W-48, barX = 24, barY = H-36;
          rr(barX, barY, barW, 14, 7, 'rgba(255,255,255,.06)', null, 0);
          var prog = phase >= 3 ? 0.92 : phase >= 2 ? 0.65 : phase >= 1 ? 0.35 : 0.18;
          var g = ctx.createLinearGradient(barX,0,barX+barW,0);
          g.addColorStop(0,'#79f2ff'); g.addColorStop(1,'#8b5cf6');
          rr(barX, barY, barW*prog, 14, 7, g, null, 0);
          ctx.fillStyle=C.muted;
          ctx.font='10px Inter,sans-serif';
          ctx.textAlign='left';
          ctx.fillText('Сменный отчёт · авто-сборка '+Math.round(prog*100)+'%', barX, barY-6);

          requestAnimationFrame(draw);
        }
        draw();
      })();
      </script>
    </section>
    <!-- === /БОРИС === -->

    <div class="aipk-cnt">
      <ol class="aipk-steps nero-ai-reveal" aria-label="5 шагов работы AI-агента по смене">
        <li><strong>Утром или вечером</strong> — агент забирает план из 1С, Excel или таблицы заказов.</li>
        <li><strong>Формирует сменное задание</strong> по участкам — мастер правит и утверждает.</li>
        <li><strong>В смене</strong> оператор отмечает старт/финиш или простой в Telegram, на киоске или голосом.</li>
        <li><strong>AI-слой</strong> сопоставляет факт с планом, уточняет причину, напоминает о несданных данных.</li>
        <li><strong>В конце смены</strong> собирает отчёт: выработка, простои по категориям, отклонения, комментарии.</li>
      </ol>

      <div class="aipk-grid-2 nero-ai-reveal" style="margin-top:40px">
        <div class="aipk-card">
          <h3 id="sborn-dannyh">Как агент собирает данные по смене</h3>
          <p>Паттерн «мессенджер как интерфейс смены» уже работает в России: Noltis — «второй мастер смены» в Telegram поверх 1С/MES (<a href="https://noltis.ru/product/ai-dlya-proizvodstva/" target="_blank" rel="noopener noreferrer">noltis.ru</a>); open-source бот ООО «Цинк» (<a href="https://github.com/RussianPostman/Bot_for_factory" target="_blank" rel="noopener noreferrer">Bot_for_factory</a>). Nero идёт дальше: классификация причин, сводка отклонений и ответы руководителю.</p>
        </div>
        <div class="aipk-card">
          <h3 id="fiksaciya-otklonenij">Фиксация отклонений в реальном времени и отчёт руководителю</h3>
          <p><strong>AI сменные задания</strong> и <strong>ai контроль простоев</strong>: план → факт → отклонение → действие. При простое дольше порога — эскалация мастеру. При срочном заказе — пересборка смены; <strong>мастер утверждает</strong>, агент не применяет изменения сам.</p>
          <p>На Апатите (ФосАгро) «AIХимик» автоматизирует подготовку данных по смене (<a href="https://www.osp.ru/articles/2026/0311/13060511" target="_blank" rel="noopener noreferrer">Открытые системы</a>). Для малого цеха Nero — сменный отчёт за минуты вместо часа в Excel.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §3 ВНЕДРЕНИЕ -->
  <section class="aipk-section" id="etapy">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Коммерция</span>
        <h2>Внедрение AI на производстве под ключ</h2>
        <p>Nero Network продаёт <strong>внедрение ai производство контроль</strong> и <strong>ai производство контроль под ключ</strong> — от аудита одного участка до работающей цифровой смены. Ориентир чека: <strong>500 тыс.–2 млн ₽</strong>.</p>
      </div>

      <div class="aipk-timeline nero-ai-reveal" aria-label="Этапы внедрения">
        <div class="aipk-tl-item">
          <span class="aipk-tl-dot"></span>
          <h3>Фаза 0 (1–2 недели): аудит «карта потерь»</h3>
          <p>1 смена, 1 участок; как выдаются задания и фиксируются простои; какие системы уже есть (1С, CRM, Excel).</p>
        </div>
        <div class="aipk-tl-item">
          <span class="aipk-tl-dot"></span>
          <h3>Фаза 1 (3–5 недель): пилот «цифровая смена» без датчиков</h3>
          <p>Telegram-бот, шаблоны причин простоя, AI-напоминания и классификация, дашборд руководителя.</p>
        </div>
        <div class="aipk-tl-item">
          <span class="aipk-tl-dot"></span>
          <h3>Фаза 2 (4–8 недель): интеграции</h3>
          <p>Обмен с 1С, автогенерация сменного задания; опционально — сигналы с датчиков.</p>
        </div>
        <div class="aipk-tl-item">
          <span class="aipk-tl-dot"></span>
          <h3>Фаза 3: тираж и KPI в договоре</h3>
          <p>Второй участок, измеримые KPI по «слепому» простою и времени отчёта.</p>
        </div>
      </div>

      <div class="aipk-card nero-ai-reveal" style="margin-top:32px">
        <h3>Сроки, состав команды и что получает заказчик</h3>
        <p>Типовой пилот — <strong>4–10 недель</strong> на одном участке. Команда: аналитик процессов, интегратор 1С/CRM, разработчик агента, QA на смене.</p>
        <ul>
          <li>работающий контур сменных заданий и учёта простоев;</li>
          <li>дашборд руководителя и журнал аудита;</li>
          <li>обучение мастеров (1 смена) и документация.</li>
        </ul>
      </div>

      <div class="aipk-sh aipk-left nero-ai-reveal" style="margin-top:40px" id="ceny">
        <h3>Сколько стоит ai производство контроль и от чего зависит цена</h3>
        <p><strong>Стоимость</strong> зависит от числа участков, глубины интеграции с 1С, on-premise и датчиков. Ориентиры рынка: Noltis — аудит 80–180 тыс. ₽, пилот 420 тыс.–1,8 млн ₽ (<a href="https://noltis.ru/product/ai-dlya-proizvodstva/" target="_blank" rel="noopener noreferrer">noltis.ru</a>); AI Journal 2026 — пилот 200 тыс.–1 млн ₽ (<a href="https://ai-journal.ru/ii-v-promyshlennosti/" target="_blank" rel="noopener noreferrer">ai-journal.ru</a>).</p>
        <p><strong>Чтобы заказать внедрение</strong> с понятным бюджетом, Nero начинает с аудита «Карта потерь производства».</p>
      </div>

      <!-- CTA #1 от Артура -->
      <div class="ym-cta-block ym-cta-block--primary" id="cta-karta-potery">
        <div class="ym-cta-block__icon" aria-hidden="true">🏭</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Карта потерь производства — бесплатный аудит одной смены</p>
          <p class="ym-cta-block__sub">За 1–2 недели зафиксируем, где на участке теряется время: ожидание, переналадка, микропростои, брак. На выходе — схема потерь, «слепые зоны» учёта и ориентир бюджета пилота (500 тыс.–2 млн ₽) без обязательств по внедрению.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
        </div>
      </div>
    </div>
  </section>

  <!-- §4 ИНТЕГРАЦИИ -->
  <section class="aipk-section aipk-section-alt" id="integracii">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Стек</span>
        <h2>Интеграция AI с учётом простоев, CRM и 1С</h2>
      </div>
      <div class="aipk-grid-2 nero-ai-reveal">
        <div class="aipk-card">
          <h3>Связка со сменными заданиями и MES/ERP</h3>
          <p><strong>Интеграция ai производство контроль</strong> — API-прослойка: AI не бьёт в транзакционную шину ERP (<a href="https://oborot.ru/blogs/legacy-sistemy-protiv-ii-kak-integrirovat-avtonomnyh-agentov-v-samopisnye-erp-i-mes-dvadcatiletnej-davnosti-i270679.html" target="_blank" rel="noopener noreferrer">Oborot.ru</a>).</p>
          <ul>
            <li><strong>ERP:</strong> <a href="<?php echo esc_url(home_url('/ai-1c-erp/')); ?>">AI-агент для 1С и ERP</a>, 1С:УПП, 1С:ERP, Excel/Google Sheets;</li>
            <li><strong>Планирование:</strong> агенты MBS Group в 1С (<a href="https://mbsgroup.ru/ai/1c/proizvodstvo-planirovanie/optimizator-proizvodstvennogo-raspisaniya/" target="_blank" rel="noopener noreferrer">mbsgroup.ru</a>);</li>
            <li><strong>MES:</strong> ENGINE, TAP MES — опционально, фаза 2+;</li>
            <li><strong>Автоматизация:</strong> n8n / Make; <strong>LLM:</strong> YandexGPT / GigaChat / OpenAI.</li>
          </ul>
        </div>
        <div class="aipk-card">
          <h3>Telegram для мастеров смен и дашборд для руководителя</h3>
          <p><strong>AI производство контроль в CRM</strong> актуален, когда заказы из amoCRM или Bitrix24 — см. <a href="<?php echo esc_url(home_url('/vnedrenie-ai-amocrm/')); ?>">интеграция AI с amoCRM под ключ</a>. Для мастера — Telegram: 2–3 кнопки, голосовой ввод причины простоя. Для директора — дашборд OEE, топ-причины потерь, вопросы агенту по данным смены.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §5 ДЛЯ КОГО -->
  <section class="aipk-section" id="dlya-kogo">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Целевая аудитория</span>
        <h2>Для кого подходит: цеха, мебель, пищевое производство</h2>
      </div>
      <div class="aipk-grid-2 nero-ai-reveal">
        <div class="aipk-card">
          <h3>Малые производства до 50–100 человек</h3>
          <p><strong>AI производство контроль для малого бизнеса</strong> — основная ЦА: мебельные цеха, пищевые линии, дискретное производство 20–50 человек. Медианный OEE ~<strong>60%</strong>, эталон <strong>85%</strong> (<a href="https://teeptrak.com/en/state-of-oee-2026/" target="_blank" rel="noopener noreferrer">TeepTrak</a>). Кейс кофейного производства: <strong>+10–15% OEE</strong> без нового оборудования.</p>
        </div>
        <div class="aipk-card">
          <h3>Внедрение ai производство контроль без программиста на месте</h3>
          <p>Nero берёт интеграцию на себя. На стороне заказчика — мастер, утверждающий задания и причины простоев. Обучение — одна смена. Данные — on-prem или российское облако (152-ФЗ).</p>
        </div>
      </div>
    </div>
  </section>

  <!-- §6 КЕЙСЫ -->
  <section class="aipk-section aipk-section-alt" id="keisy">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Сравнение</span>
        <h2>Кейсы и примеры внедрения AI на производстве</h2>
        <p>Ступени зрелости: Excel/WhatsApp → AI-агент → интеграция 1С → датчики (опционально).</p>
      </div>

      <div class="aipk-table-wrap nero-ai-reveal">
        <table class="aipk-table aipk-table-compare" aria-label="Сравнение Excel+WhatsApp, MES и AI-агента Nero">
          <thead>
            <tr><th>Критерий</th><th>Excel + WhatsApp</th><th>MES / OEE</th><th class="aipk-col-nero">AI-агент Nero</th></tr>
          </thead>
          <tbody>
            <tr><td>Срок внедрения</td><td>0, но хаос</td><td>месяцы–годы</td><td class="aipk-col-nero">4–10 недель пилот</td></tr>
            <tr><td>Сменное задание</td><td>вручную</td><td>цифровое</td><td class="aipk-col-nero">цифровое + пересборка</td></tr>
            <tr><td>Фиксация простоя</td><td>в конце смены</td><td>часто с датчиками</td><td class="aipk-col-nero">в моменте, чат</td></tr>
            <tr><td>Классификация причин</td><td>нет</td><td>справочник</td><td class="aipk-col-nero">AI + справочник</td></tr>
            <tr><td>Отчёт руководителю</td><td>вручную</td><td>дашборд</td><td class="aipk-col-nero">дашборд + Q&amp;A</td></tr>
            <tr><td>Стоимость</td><td>низкая</td><td>высокая</td><td class="aipk-col-nero">500 тыс.–2 млн ₽</td></tr>
            <tr><td>Нужны датчики</td><td>нет</td><td>часто да</td><td class="aipk-col-nero">нет на старте</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal">КАМАЗ перевёл сменно-суточное задание из бумаги в цифру через MES (<a href="https://integral-russia.ru/2026/07/14/vnedrenie-mes-sistemy-na-kuznechno-pressovom-proizvodstve-kamaza-ot-osnovnyh-ponyatij-do-rezultatov-proekta/" target="_blank" rel="noopener noreferrer">integral-russia.ru</a>). Для малого цеха AI-агент — <strong>лёгкая альтернатива тяжёлой MES</strong>.</p>
    </div>
  </section>

  <!-- §7 AGENTIC AI -->
  <section class="aipk-section" id="agentic-ai">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Тренд 2026</span>
        <h2>Agentic AI на производстве в 2026: тренды и контроль результата</h2>
      </div>

      <div class="aipk-callout aipk-callout-warning nero-ai-reveal" role="alert">
        <strong>Gartner (25.06.2025):</strong> более <strong>40% проектов agentic AI будут отменены к концу 2027</strong> — рост затрат, неясная ценность, слабый risk control (<a href="https://www.gartner.com/en/newsroom/press-releases/2025-06-25-gartner-predicts-over-40-percent-of-agentic-ai-projects-will-be-canceled-by-end-of-2027" target="_blank" rel="noopener noreferrer">пресс-релиз</a>).
      </div>

      <div class="aipk-grid-2 nero-ai-reveal">
        <div class="aipk-card">
          <h3>Почему отменяют agentic-проекты и как снизить риск</h3>
          <p>Deloitte State of AI 2026: ~74% планируют agentic AI, но только ~21% имеют зрелую модель governance (<a href="https://www.deloitte.com/us/en/what-we-do/capabilities/applied-artificial-intelligence/content/state-of-ai-in-the-enterprise.html" target="_blank" rel="noopener noreferrer">Deloitte</a>). <strong>Вывод:</strong> не «автономный завод», а <strong>агент с проверкой</strong> — пилот, KPI, журнал аудита.</p>
        </div>
        <div class="aipk-card">
          <h3>Human-in-the-loop: проверка результата на смене</h3>
          <p>Manufacturing Dive (2026): стадия <strong>«semiautomatic human-in-the-loop»</strong> (<a href="https://www.manufacturingdive.com/news/agentic-ai-manufacturing-adoption-data-gaps-evolution/822789/" target="_blank" rel="noopener noreferrer">статья</a>). Мастер утверждает задания и причины простоя; агент предлагает, человек решает.</p>
        </div>
      </div>

      <!-- CTA #2 от Артура -->
      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать agentic AI до старта пилота?</p>
          <p class="ym-cta-block__sub">Перед внедрением на смене полезно разобраться в n8n, промптах, human-in-the-loop и интеграции с 1С/Telegram — это ускоряет согласование сценариев с мастерами и IT. Посмотрите <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- §8 КАРТА ПОТЕРЬ -->
  <section class="aipk-section aipk-section-alt" id="karta-potery">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">Лид-магнит</span>
        <h2>Карта потерь производства — бесплатный аудит</h2>
      </div>
      <div class="aipk-leadmagnet nero-ai-reveal">
        <h3>Что входит в карту потерь и как её получить</h3>
        <ul>
          <li>1 смена наблюдения на одном участке;</li>
          <li>схема потерь: ожидание, переналадка, микропростои, брак;</li>
          <li>оценка «слепых зон» учёта;</li>
          <li>рекомендация: Excel → агент → 1С → датчики;</li>
          <li>ориентир бюджета и сроков пилота.</li>
        </ul>
        <p>Карта стыкуется с болью: «задачи меняются вручную, простои фиксируются поздно». Сначала измеряем потери — потом внедряем <strong>ai производство контроль</strong>.</p>
      </div>
    </div>
  </section>

  <!-- §9 FAQ -->
  <section class="aipk-section" id="faq">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <span class="aipk-eyebrow">FAQ</span>
        <h2>FAQ: внедрение AI для контроля простоев</h2>
      </div>
      <div class="aipk-faq nero-ai-reveal">
        <details class="aipk-faq-item" open>
          <summary class="aipk-faq-q">Как внедрить ai производство контроль</summary>
          <div class="aipk-faq-a"><p>1) Заявка на «Карту потерь». 2) Аудит 1 участка (1–2 нед.). 3) Пилот Telegram + дашборд (3–5 нед.). 4) Интеграция 1С/CRM. 5) Тираж и KPI. Программист на стороне заказчика не обязателен.</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Можно ли начать без полной автоматизации цеха</summary>
          <div class="aipk-faq-a"><p>Да. Старт без датчиков: ручной ввод и чат. Датчики и MES — фаза 2.</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Какие данные нужны агенту в первую неделю</summary>
          <div class="aipk-faq-a"><p>Участки и роли, план смены, справочник причин (10–20 поз.), нормативы операций, регламент сдачи факта, доступ к 1С/таблице.</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Нужны ли датчики</summary>
          <div class="aipk-faq-a"><p>Нет на старте. Ручной ввод + Telegram закрывает 80% боли «поздняя фиксация».</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Заменит ли AI людей на смене</summary>
          <div class="aipk-faq-a"><p>Нет. Агент снимает рутину: сводки, напоминания, классификацию. Решения по останову и браку — за мастером.</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Что если 1С старая</summary>
          <div class="aipk-faq-a"><p>API-прослойка: файлы, REST, COM. AI при отключении не ломает учёт (<a href="https://companies.rbc.ru/news/g8aJzwNPwl/kak-vstroit-ii-v-erp-i-mes-bez-riska-dlya-korporativnyih-sistem/" target="_blank" rel="noopener noreferrer">РБК</a>).</p></div>
        </details>
        <details class="aipk-faq-item">
          <summary class="aipk-faq-q">Сколько стоит и как считать эффект</summary>
          <div class="aipk-faq-a"><p>Ориентир Nero: 500 тыс.–2 млн ₽ за пилот. Эффект — через сокращение «слепого» простоя и времени отчёта, не через «+30% OEE за месяц».</p></div>
        </details>
      </div>
    </div>
  </section>

  <!-- §10 ФИНАЛ -->
  <section class="aipk-section aipk-section-alt" id="cta-final">
    <div class="aipk-cnt">
      <div class="aipk-sh nero-ai-reveal">
        <h2>Найти простои на вашем производстве</h2>
        <p>Если <strong>задачи меняются вручную, а простои фиксируются поздно</strong> — вы платите за каждый час, о котором узнаёте слишком поздно.</p>
        <p><strong>Nero Network</strong> внедряет AI-агента для сменных заданий и контроля простоев: сбор данных по смене, фиксация отклонений, отчёт руководителю. Не MES на три года — <strong>пилот на одном участке под ключ</strong> с human-in-the-loop.</p>
      </div>

      <!-- CTA #3 от Артура -->
      <div class="ym-cta-block ym-cta-block--dual ym-cta-block--footer-final" id="cta-final-block">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Найти простои на вашем производстве</p>
          <p class="ym-cta-block__sub">Если задачи меняются вручную, а простои фиксируются поздно — начните с бесплатной «Карты потерь» или консультации. Пилот на одном участке под ключ с human-in-the-loop.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Найти простои</a>
            <a href="#karta-potery" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Карта потерь</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.aipk-content -->


<?php
$schema_origin = trailingslashit(home_url());
$schema_page_url = trailingslashit(home_url('/ai-proizvodstvo-kontrol-prostoev/'));
$schema_org_id = $schema_origin . '#organization';
$schema_website_id = $schema_origin . '#website';
$schema_webpage_id = $schema_page_url . '#webpage';
$schema_h1 = 'AI-агент для сменных заданий и контроля простоев: внедрение под ключ';
$schema_graph = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => $schema_org_id,
            'name' => $brand ?: 'Nero Network',
            'url' => $schema_origin,
        ],
        [
            '@type' => 'WebSite',
            '@id' => $schema_website_id,
            'url' => $schema_origin,
            'name' => $brand ?: 'Nero Network',
            'publisher' => ['@id' => $schema_org_id],
        ],
        [
            '@type' => 'WebPage',
            '@id' => $schema_webpage_id,
            'url' => $schema_page_url,
            'name' => $schema_h1,
            'description' => $page_seo_description,
            'isPartOf' => ['@id' => $schema_website_id],
            'about' => ['@id' => $schema_org_id],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $schema_page_url . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Главная',
                    'item' => $schema_origin,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $schema_h1,
                    'item' => $schema_page_url,
                ],
            ],
        ],
        [
            '@type' => 'Service',
            '@id' => $schema_page_url . '#service',
            'name' => $schema_h1,
            'description' => $page_seo_description,
            'url' => $schema_page_url,
            'provider' => ['@id' => $schema_org_id],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $schema_page_url . '#faq',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Как внедрить ai производство контроль',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => '1) Заявка на «Карту потерь». 2) Аудит 1 участка (1–2 нед.). 3) Пилот Telegram + дашборд (3–5 нед.). 4) Интеграция 1С/CRM. 5) Тираж и KPI. Программист на стороне заказчика не обязателен.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Можно ли начать без полной автоматизации цеха',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Да. Старт без датчиков: ручной ввод и чат. Датчики и MES — фаза 2.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Какие данные нужны агенту в первую неделю',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Участки и роли, план смены, справочник причин (10–20 поз.), нормативы операций, регламент сдачи факта, доступ к 1С/таблице.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Нужны ли датчики',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Нет на старте. Ручной ввод + Telegram закрывает 80% боли «поздняя фиксация».',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Заменит ли AI людей на смене',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Нет. Агент снимает рутину: сводки, напоминания, классификацию. Решения по останову и браку — за мастером.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Что если 1С старая',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'API-прослойка: файлы, REST, COM. AI при отключении не ломает учёт.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Сколько стоит и как считать эффект',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Ориентир Nero: 500 тыс.–2 млн ₽ за пилот. Эффект — через сокращение «слепого» простоя и времени отчёта, не через «+30% OEE за месяц».',
                    ],
                ],
            ],
        ],
    ],
];
?>
<script type="application/ld+json">
<?php echo wp_json_encode($schema_graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

</main>

<script>
/**
 * aipk-hero-engine — «Диспетчерская орбиты смены ShiftBeacon»
 * Мир: кольцо станций → OrbitDataArc → ShiftCommandTower → DirectorReportLift
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aipk-hero-canvas");
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
    scale = Math.min(cw / 400, ch / 260) * 1.15;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    towerBase: "#1e293b",
    towerGlow: "rgba(121,242,255,0.35)",
    screen: "#0f172a",
    screenLine: "#79f2ff",
    amber: "#f59e0b",
    orange: "#f97316",
    red: "#ef4444",
    green: "#22c55e",
    cyan: "#79f2ff",
    violet: "#8b5cf6",
    station: "#334155",
    chipPlan: "#dbeafe",
    chipFact: "#fde68a",
    heatLo: "rgba(249,115,22,0.08)",
    heatHi: "rgba(239,68,68,0.22)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    report: "#f8fafc"
  };

  var LOOP = 260;

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Тепловая сетка потерь на полу цеха */
  function LossHeatmap() {}
  LossHeatmap.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    for (var gx = -3; gx <= 3; gx++) {
      for (var gy = -2; gy <= 2; gy++) {
        var pulse = Math.sin(frame * 0.05 + gx * 1.3 + gy) * 0.5 + 0.5;
        var hot = (gx === 1 && gy === 0 && prg > 65 && prg < 195) ? 1 : pulse * 0.35;
        ctx.fillStyle = hot > 0.6 ? C.heatHi : C.heatLo;
        drawRR(ctx, gx * 34 - 14, gy * 28 + 42, 28, 22, 4, ctx.fillStyle, null);
      }
    }
  };

  /* Кольцо рабочих станций */
  function WorkstationRing() {
    this.count = 5;
    this.radius = 92;
  }
  WorkstationRing.prototype.draw = function (ctx) {
    ctx.strokeStyle = "rgba(121,242,255,0.15)";
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(0, 8, this.radius, 0, Math.PI * 2);
    ctx.stroke();

    for (var i = 0; i < this.count; i++) {
      var ang = (i / this.count) * Math.PI * 2 - Math.PI / 2 + frame * 0.002;
      var sx = Math.cos(ang) * this.radius;
      var sy = Math.sin(ang) * this.radius + 8;
      drawRR(ctx, sx - 14, sy - 10, 28, 20, 5, C.station, C.outline);
      ctx.fillStyle = C.cyan;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("L" + (i + 1), sx, sy + 2);
    }
  };

  /* Орбитальные дуги данных — вместо Conveyor */
  function OrbitDataArc() {
    this.packets = [
      { angle: 0, speed: 0.018, color: C.chipPlan, label: "план" },
      { angle: 2.1, speed: 0.022, color: C.chipFact, label: "факт" },
      { angle: 4.2, speed: 0.016, color: C.amber, label: "⏸" }
    ];
  }
  OrbitDataArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    ctx.strokeStyle = "rgba(249,115,22,0.25)";
    ctx.lineWidth = 1.2;
    ctx.setLineDash([4, 6]);
    ctx.beginPath();
    ctx.arc(0, 8, 58, -Math.PI * 0.15, Math.PI * 1.12);
    ctx.stroke();
    ctx.setLineDash([]);

    this.packets.forEach(function (p) {
      p.angle += p.speed;
      var r = 58 + Math.sin(frame * 0.04 + p.angle) * 4;
      var px = Math.cos(p.angle) * r;
      var py = Math.sin(p.angle) * r + 8;
      drawRR(ctx, px - 7, py - 5, 14, 10, 3, p.color, C.outline);
      if (prg > 60 && prg < 130 && p.label === "⏸") {
        ctx.fillStyle = C.red;
        ctx.beginPath();
        ctx.arc(px + 8, py - 6, 3, 0, Math.PI * 2);
        ctx.fill();
      }
    });
  };

  /* Пульс простоя */
  function DowntimeFlare() {}
  DowntimeFlare.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    if (prg < 68 || prg > 188) return;
    var intensity = prg < 100 ? (prg - 68) / 32 : 1 - (prg - 100) / 88;
    var rad = 18 + Math.sin(frame * 0.14) * 6;
    ctx.save();
    ctx.globalAlpha = 0.25 + intensity * 0.45;
    ctx.fillStyle = C.orange;
    ctx.beginPath();
    ctx.arc(42, -18, rad, 0, Math.PI * 2);
    ctx.fill();
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#fde68a";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ПРОСТОЙ", 42, -16);
    ctx.restore();
  };

  /* Telegram-маяк мастера */
  function TelegramBeacon() {}
  TelegramBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    if (prg < 132 || prg > 210) return;
    var bounce = Math.sin((prg - 132) * 0.12) * 3;
    drawRR(ctx, -118, -72 + bounce, 22, 22, 11, C.cyan, C.outline);
    ctx.fillStyle = "#0a1628";
    ctx.font = "bold 9px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("TG", -107, -58 + bounce);
    if (prg > 140 && prg < 145) {
      createBubble(-107, -88 + bounce, "Мастер: линия 3?", 220);
    }
  };

  /* Башня смены — вместо WebsiteTerminal */
  function ShiftCommandTower() {
    this.tab = 0;
    this.reportY = 0;
    this.reportSpeed = 0;
  }
  ShiftCommandTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    drawRR(ctx, -32, -48, 64, 78, 8, C.towerBase, C.outline);

    ctx.save();
    ctx.shadowColor = C.towerGlow;
    ctx.shadowBlur = 12 + Math.sin(frame * 0.08) * 4;
    drawRR(ctx, -26, -42, 52, 36, 6, C.screen, C.cyan);
    ctx.restore();

    var oee = 62 + Math.sin(frame * 0.06) * 2;
    ctx.fillStyle = C.cyan;
    ctx.font = "bold 11px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("OEE " + Math.round(oee) + "%", 0, -24);

    var barW = 40;
    var fillW = barW * (oee / 100);
    drawRR(ctx, -20, -14, barW, 6, 2, "rgba(255,255,255,0.1)", null);
    drawRR(ctx, -20, -14, fillW, 6, 2, C.green, null);

    var phases = ["briefing", "monitor", "escalate", "report"];
    var phaseIdx = prg < 65 ? 0 : prg < 130 ? 1 : prg < 195 ? 2 : 3;
    var phaseLabels = ["План", "Монитор", "Эскалация", "Отчёт"];
    ctx.fillStyle = "#94a3b8";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.fillText(phaseLabels[phaseIdx], 0, -2);

    for (var t = 0; t < 4; t++) {
      var tx = -18 + t * 12;
      var on = t <= phaseIdx;
      ctx.fillStyle = on ? C.amber : "rgba(255,255,255,0.15)";
      ctx.beginPath();
      ctx.arc(tx, 6, 3, 0, Math.PI * 2);
      ctx.fill();
    }

    if (prg >= 195) {
      var lift = prg - 195;
      if (lift === 0.04) this.reportSpeed = 0;
      this.reportSpeed += 0.35;
      this.reportY -= this.reportSpeed;
      var rx = 0, ry = -55 + this.reportY;
      drawRR(ctx, rx - 14, ry - 10, 28, 20, 4, C.report, C.outline);
      ctx.fillStyle = C.orange;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("PDF", rx, ry + 2);
      ctx.fillStyle = "#fde68a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("смена", rx, ry + 10);

      if (lift > 8 && lift < 12) {
        createBubble(72, -92, "Отчёт директору ✓", 280);
      }
    } else {
      this.reportY = 0;
      this.reportSpeed = 0;
    }
  };

  /* Луч отчёта к директору */
  function DirectorReportLift() {}
  DirectorReportLift.prototype.draw = function (ctx) {
    var prg = (frame * 0.04) % LOOP;
    if (prg < 200) return;
    var t = (prg - 200) / 55;
    ctx.strokeStyle = "rgba(121,242,255," + (0.15 + t * 0.35) + ")";
    ctx.lineWidth = 1.5;
    ctx.setLineDash([3, 5]);
    ctx.beginPath();
    ctx.moveTo(0, -70);
    ctx.lineTo(88, -98);
    ctx.stroke();
    ctx.setLineDash([]);
    drawRR(ctx, 78, -108, 24, 24, 12, "rgba(34,197,94,0.15)", C.green);
    ctx.fillStyle = C.green;
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CEO", 90, -94);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
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
    var prg = (frame * 0.04) % LOOP;

    var ang = this.stepTrig * 0.9;
    var ringR = 72;
    var targetX = Math.cos(ang) * ringR;
    var targetY = Math.sin(ang) * ringR + 8;

    if (prg >= this.stepTrig && prg < this.stepTrig + 22) {
      var local = prg - this.stepTrig;
      if (local < 11) {
        isMoving = true;
        faceDir = targetX > this.baseX ? 1 : -1;
        carryType = this.color;
        var t = local / 11;
        this.x = this.baseX + (targetX - this.baseX) * t;
        this.y = this.baseY + (targetY - this.baseY) * t;
      } else if (local < 14) {
        this.x = targetX;
        this.y = targetY;
      } else {
        isMoving = true;
        faceDir = -faceDir;
        var t2 = (local - 14) / 8;
        this.x = targetX + (this.baseX - targetX) * t2;
        this.y = targetY + (this.baseY - targetY) * t2;
      }
    } else {
      this.x = this.baseX;
      this.y = this.baseY;
      carryType = prg >= this.stepTrig - 8 ? this.color : null;
    }

    if (!isMoving && frame % 220 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";

    drawRR(ctx, -10, 4 + bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, 4 - bob, 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -10 - bob, 28, 18, 6, this.color, C.outline);

    var hx = 0, hy = -24 - bob;
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(hx, hy, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();

    ctx.save();
    ctx.scale(faceDir, 1);
    ctx.fillStyle = "#fff";
    ctx.beginPath(); ctx.arc(hx + 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 3, hy - 2, 3, 0, Math.PI * 2); ctx.fill();
    ctx.fillStyle = C.outline;
    ctx.beginPath(); ctx.arc(hx + 4, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();
    ctx.beginPath(); ctx.arc(hx - 2, hy - 2, 1.5, 0, Math.PI * 2); ctx.fill();

    if (this.role === "1_architect") {
      ctx.strokeStyle = C.outline; ctx.lineWidth = 1;
      ctx.strokeRect(hx + 1, hy - 5, 5, 5);
    } else if (this.role === "3_coder") {
      ctx.fillStyle = C.outline;
      ctx.fillRect(hx - 8, hy - 10, 16, 3);
    } else if (this.role === "5_deployer") {
      ctx.strokeStyle = C.outline;
      ctx.beginPath(); ctx.arc(hx, hy, 12, Math.PI, 0); ctx.stroke();
    }
    ctx.restore();

    if (carryType) {
      drawRR(ctx, -16 * faceDir, -16 - bob, 12, 12, 2, carryType, C.outline);
    }
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];

  entities.push(new LossHeatmap());
  entities.push(new WorkstationRing());
  entities.push(new OrbitDataArc());
  entities.push(new DowntimeFlare());
  entities.push(new ShiftCommandTower());
  entities.push(new TelegramBeacon());
  entities.push(new DirectorReportLift());

  entities.push(new Agent(-95, 55, C.agentYellow, "1_architect", 12, [
    "Пересобираю смену…", "Срочный заказ в план", "Мастер утвердил задание"
  ]));
  entities.push(new Agent(-55, 78, C.agentGreen, "2_seo", 52, [
    "OEE просел на 8%", "Топ-3 простоя смены", "Слепая зона учёта"
  ]));
  entities.push(new Agent(10, 82, C.agentBlue, "3_coder", 92, [
    "Таймер простоя 15 мин", "Порог эскалации ок", "Факт ≠ план на L3"
  ]));
  entities.push(new Agent(58, 58, C.agentPink, "4_designer", 132, [
    "Причина: переналадка ЧПУ", "Нет фурнитуры — стоп", "Классифицировала простой"
  ]));
  entities.push(new Agent(88, 20, C.agentPurple, "5_deployer", 172, [
    "Отчёт руководителю готов", "Human-in-the-loop ✓", "PDF в Telegram директору"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (ent) { ent.draw(ctx); });

    var prg = (frame * 0.04) % LOOP;
    if (prg >= 14 && prg < 14.08) createBubble(-20, -30, "1. План смены выдан", 200);
    if (prg >= 72 && prg < 72.08) createBubble(38, -28, "2. Простой зафиксирован", 200);
    if (prg >= 138 && prg < 138.08) createBubble(-100, -60, "3. Эскалация мастеру", 200);
    if (prg >= 198 && prg < 198.08) createBubble(10, -75, "4. Отчёт директору", 200);

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var bub = bubbles[i];
      bub.life--;
      if (bub.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, bub.life / 28);
      if (bub.life > bub.maxLife - 12) alpha = (bub.maxLife - bub.life) / 12;
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

<script>
(function(){
  'use strict';
  var root = document.querySelector('.aipk-page') || document.querySelector('.aipk-content');
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

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
