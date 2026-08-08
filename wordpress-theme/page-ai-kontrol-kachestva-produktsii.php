<?php
/**
 * Template Name: AI-контроль качества продукции: внедрение компьютерного зрения под ключ
 * Description: AI-контроль качества продукции под ключ — обнаружение дефектов на линии, интеграция с MES/ERP.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-контроль качества продукции: внедрение под ключ';
$page_seo_description = 'AI-контроль качества продукции под ключ: обнаружение дефектов на линии, интеграция с MES/ERP. Для производства, пищевой отрасли и электроники. Оценка и демо.';

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
    ['label' => 'Зачем AI',     'href' => '#reshenie'],
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Отрасли',      'href' => '#otrasli'],
    ['label' => 'Внедрение',    'href' => '#etapy'],
    ['label' => 'Интеграции',   'href' => '#integracii'],
    ['label' => 'Цена',         'href' => '#ceny'],
    ['label' => 'Кейсы',        'href' => '#keisy'],
    ['label' => 'FAQ',          'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить контроль качества';
$primary_cta_url   = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);

$nero_internal_base = rtrim((string) (getenv('PUBLIC_SITE_URL') ?: getenv('WP_SITE_URL') ?: ''), '/');

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

.aqc-content{
  --aqc-bg:#050711;--aqc-bg2:#080b17;
  --aqc-text:#e6edf7;--aqc-muted:#9aa8bd;--aqc-soft:#c7d2e5;--aqc-heading:#fff;
  --aqc-border:rgba(255,255,255,.10);
  --aqc-accent:#f5c518;--aqc-violet:#8b5cf6;--aqc-green:#22c55e;
  --aqc-red:#ef4444;--aqc-amber:#f59e0b;--aqc-cyan:#79f2ff;
  --aqc-btn-from:#2563eb;--aqc-btn-to:#7c3aed;
  --aqc-r:18px;--aqc-r-lg:24px;--aqc-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--aqc-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.aqc-content *,.aqc-content *::before,.aqc-content *::after{box-sizing:border-box;}
.aqc-content a{color:inherit;}
.aqc-content p{color:var(--aqc-muted);line-height:1.72;margin:0 0 1em;}
.aqc-content p:last-child{margin-bottom:0;}
.aqc-content h2,.aqc-content h3{color:var(--aqc-heading);letter-spacing:-.045em;margin:0 0 .7em;}
.aqc-content strong{color:var(--aqc-soft);}
.aqc-cnt{width:min(var(--aqc-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.aqc-section{padding:clamp(64px,8vw,112px) 0;position:relative;}
.aqc-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);}
.aqc-section-pain .aqc-card-pain{border-left:3px solid var(--aqc-red);background:linear-gradient(90deg,rgba(239,68,68,.06),transparent);}
.aqc-section-cta{background:linear-gradient(135deg,rgba(245,197,24,.08),rgba(139,92,246,.08));}
.aqc-sh{max-width:820px;margin:0 auto 48px;text-align:center;}
.aqc-sh.aqc-left{margin-left:0;text-align:left;}
.aqc-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px;}
.aqc-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto;}
.aqc-sh.aqc-left p{margin-left:0;}
.aqc-eyebrow{display:inline-flex;padding:6px 14px;border-radius:999px;background:rgba(245,197,24,.08);border:1px solid rgba(245,197,24,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--aqc-accent);margin-bottom:14px;}
.aqc-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06);}
.aqc-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center;}
.aqc-intro-text{position:relative;padding-left:20px;}
.aqc-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--aqc-accent),var(--aqc-violet));}
.aqc-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8;color:var(--aqc-muted);margin-bottom:1em;}
.aqc-intro-text p:last-child{margin-bottom:0;color:var(--aqc-soft);}
.aqc-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.aqc-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;box-shadow:0 8px 28px rgba(0,0,0,.25);backdrop-filter:blur(12px);}
.aqc-kpi-card .kv{font-size:clamp(20px,2.5vw,26px);font-weight:900;color:var(--aqc-heading);letter-spacing:-.04em;line-height:1;margin-bottom:5px;}
.aqc-kpi-card .kl{font-size:11px;font-weight:600;color:var(--aqc-muted);line-height:1.4;}
.aqc-kpi-card .ks{font-size:10px;color:#64748b;margin-top:4px;}
.aqc-toc-outer{padding:0 0 clamp(36px,4.5vw,56px);}
.aqc-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.aqc-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.07);border:1px solid var(--aqc-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--aqc-muted);text-decoration:none;transition:border-color .2s,color .2s,background .2s;}
.aqc-toc a:hover{border-color:rgba(245,197,24,.42);color:var(--aqc-accent);background:rgba(245,197,24,.08);}
.aqc-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--aqc-border);border-radius:var(--aqc-r-lg);padding:26px;backdrop-filter:blur(16px);box-shadow:0 14px 40px rgba(0,0,0,.22);transition:border-color .22s,transform .22s;}
.aqc-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.aqc-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aqc-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.aqc-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:20px 0;}
.aqc-table{width:100%;border-collapse:collapse;font-size:14px;}
.aqc-table th,.aqc-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);text-align:left;}
.aqc-table th{background:rgba(245,197,24,.1);color:var(--aqc-accent);font-weight:700;white-space:nowrap;}
.aqc-table tr:hover td{background:rgba(255,255,255,.03);}
.aqc-table-compare .aqc-col-manual{color:var(--aqc-red);}
.aqc-table-compare .aqc-col-cv{color:var(--aqc-green);}
.aqc-table-compare .aqc-col-agent{color:var(--aqc-violet);}
.aqc-industry-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
.aqc-industry-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:26px;transition:border-color .2s,transform .2s;}
.aqc-industry-card:hover{border-color:rgba(245,197,24,.28);transform:translateY(-2px);}
.aqc-industry-icon{font-size:28px;margin-bottom:12px;}
.aqc-stepper{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.aqc-step{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:26px;}
.aqc-step-num{font-size:32px;font-weight:900;color:var(--aqc-accent);opacity:.5;margin-bottom:8px;}
.aqc-chips{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;}
.aqc-chip{padding:8px 16px;border-radius:999px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);font-size:13px;font-weight:600;}
.aqc-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.aqc-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px;border-left:4px solid var(--aqc-green);transition:border-color .2s,transform .2s;}
.aqc-case-card:hover{border-color:rgba(34,197,94,.35);transform:translateY(-2px);}
.aqc-case-food{border-left-color:var(--aqc-green);}
.aqc-case-pack{border-left-color:var(--aqc-cyan);}
.aqc-case-enterprise{border-left-color:var(--aqc-cyan);}
.aqc-case-aviation{border-left-color:var(--aqc-violet);}
.aqc-case-mid{border-left-color:var(--aqc-amber);}
.aqc-case-tag{font-size:11px;font-weight:700;text-transform:uppercase;color:var(--aqc-accent);margin-bottom:10px;}
.aqc-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto;}
.aqc-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;}
.aqc-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--aqc-heading);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:16px;user-select:none;}
.aqc-faq-q::after{content:'▾';font-size:13px;color:var(--aqc-accent);flex-shrink:0;transition:transform .25s;}
.aqc-faq-item.open .aqc-faq-q::after{transform:rotate(180deg);}
.aqc-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--aqc-muted);line-height:1.72;}
.aqc-faq-item.open .aqc-faq-a{max-height:600px;padding:0 24px 20px;}
.aqc-steps-list{padding-left:20px;color:var(--aqc-muted);}
.aqc-steps-list li{margin-bottom:.6em;}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(245,197,24,.12),rgba(139,92,246,.1));border:1px solid rgba(245,197,24,.3);text-align:center;}
.ym-cta-block--secondary{background:rgba(255,255,255,.04);border-color:rgba(255,255,255,.12);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(139,92,246,.12),rgba(245,197,24,.08));border-color:rgba(139,92,246,.3);}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px;}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px;}
.ym-cta-block__sub{color:var(--aqc-muted);font-size:15px;margin:0 auto 22px;max-width:600px;line-height:1.7;}
.ym-cta-block--secondary .ym-cta-block__sub{margin-left:0;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 28px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--aqc-btn-from),var(--aqc-btn-to));color:#fff!important;box-shadow:0 8px 32px rgba(59,130,246,.35);}
.ym-btn--ghost{background:rgba(255,255,255,.08);color:var(--aqc-text)!important;border:1.5px solid rgba(255,255,255,.18);}
.ym-link--accent{color:var(--aqc-accent)!important;text-decoration:underline!important;}
.aqc-related .aqc-related-item{font-size:15px;line-height:1.75;margin:0 0 1.1em;color:var(--aqc-muted);}
.aqc-related .aqc-related-item:last-child{margin-bottom:0;}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:900px){.aqc-intro-grid,.aqc-stepper,.aqc-case-grid{grid-template-columns:1fr;}.aqc-grid-2,.aqc-grid-3,.aqc-industry-grid{grid-template-columns:1fr;}.aqc-intro-kpi{grid-template-columns:repeat(4,1fr);}}
@media(max-width:768px){.aqc-grid-2,.aqc-grid-3{grid-template-columns:1fr;}}
@media(max-width:600px){.aqc-intro-kpi{grid-template-columns:1fr 1fr;}.ym-cta-block{padding:28px 20px;}.aqc-case-grid{grid-template-columns:1fr;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-kontrol-kachestva-produktsii-page" role="main" tabindex="-1">

<?php
$hero_primary_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Оценить контроль качества';
$hero_primary_url     = function_exists('nero_ai_primary_cta_url')
    ? nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '')
    : (defined('NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL') ? NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL : '#cta');
$hero_primary_attrs   = function_exists('nero_ai_primary_cta_link_attrs')
    ? nero_ai_primary_cta_link_attrs($hero_primary_url)
    : ' target="_blank" rel="noopener noreferrer"';
$hero_secondary_label = 'Демо проверки качества';
$hero_secondary_url   = '#faq';
?>

<section class="nero-ai-hero aqc-hero-qc" id="aqc-hero-qc" aria-labelledby="aqc-hero-title">
<style>
/* ── Hero AI QC: самодостаточные стили (без CSS темы) ── */
.aqc-hero-qc {
  --aqc-bg: #050711;
  --aqc-gold: #f5c518;
  --aqc-green: #22c55e;
  --aqc-red: #ef4444;
  --aqc-amber: #f59e0b;
  --aqc-violet: #8b5cf6;
  --aqc-cyan: #79f2ff;
  --aqc-text: #e6edf7;
  --aqc-muted: #9aa8bd;
  --aqc-soft: #c7d2e5;
  --aqc-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
  background: radial-gradient(ellipse 80% 60% at 20% 0%, rgba(34, 197, 94, 0.06), transparent 55%),
              radial-gradient(ellipse 70% 50% at 85% 15%, rgba(245, 197, 24, 0.08), transparent 60%),
              var(--aqc-bg);
}
.aqc-hero-qc::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.028) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.028) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 32% 24%, #000 0%, transparent 74%);
  opacity: .5;
  pointer-events: none;
  z-index: -2;
}
.aqc-hero-qc::after {
  content: "";
  position: absolute;
  right: 6%;
  top: 10%;
  width: 580px;
  height: 580px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(34, 197, 94, .09), transparent 68%);
  filter: blur(10px);
  animation: aqcHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aqcHeroGlow {
  from { opacity: .35; transform: scale(.94); }
  to { opacity: .78; transform: scale(1.06); }
}
.aqc-hero-qc .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aqc-hero-qc .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aqc-hero-qc .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 820px;
  font-size: clamp(34px, 5.2vw, 66px);
  line-height: .98;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aqc-hero-qc .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aqc-gold) 40%, #fde68a 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aqc-hero-qc .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(245, 197, 24, 0.22);
  border-radius: 999px;
  background: rgba(245, 197, 24, 0.08);
  color: var(--aqc-gold) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aqc-hero-qc .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aqc-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aqc-hero-qc .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aqc-hero-qc .nero-ai-badge {
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
.aqc-hero-qc .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aqc-hero-qc .nero-ai-btn {
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
.aqc-hero-qc .nero-ai-btn:hover { transform: translateY(-2px); }
.aqc-hero-qc .nero-ai-btn-primary {
  color: #1a1200 !important;
  background: linear-gradient(135deg, var(--aqc-gold), #fde68a);
  box-shadow: 0 18px 42px rgba(245, 197, 24, 0.22);
}
.aqc-hero-qc .nero-ai-btn-secondary {
  color: var(--aqc-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aqc-hero-qc .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aqc-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aqc-hero-qc .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aqc-hero-qc .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aqc-hero-qc .nero-ai-dots { display: flex; gap: 7px; }
.aqc-hero-qc .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aqc-hero-qc .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aqc-hero-qc .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aqc-hero-qc .nero-ai-dot:nth-child(3) { background: #34d399; }
.aqc-hero-qc .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aqc-hero-qc .nero-ai-window-body { padding: 16px; }
.aqc-hero-qc .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.aqc-hero-qc .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aqc-hero-qc .nero-ai-live-pill {
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
.aqc-hero-qc .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--aqc-green);
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aqcPulse 1.6s infinite;
}
@keyframes aqcPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aqc-hero-qc .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.aqc-hero-qc .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.aqc-hero-qc .nero-ai-metric span {
  display: block;
  color: var(--aqc-muted);
  font-size: 11px;
  font-weight: 700;
}
.aqc-hero-qc .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.aqc-hero-qc .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.aqc-hero-qc .nero-ai-metric--ok strong { color: var(--aqc-green); }
.aqc-hero-qc .nero-ai-metric--warn strong { color: var(--aqc-amber); }
.aqc-hero-qc .nero-ai-metric--cyan strong { color: var(--aqc-cyan); }
.aqc-hero-qc .aqc-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(34, 197, 94, 0.18);
  background: radial-gradient(ellipse at 50% 40%, rgba(34,197,94,.06), rgba(6,10,24,.94) 72%);
}
.aqc-hero-qc #aqc-qc-hero-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aqc-hero-qc .nero-ai-task-stream { display: grid; gap: 8px; }
.aqc-hero-qc .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aqc-hero-qc .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--aqc-cyan);
  font-size: 11px;
  font-weight: 800;
}
.aqc-hero-qc .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aqc-hero-qc .nero-ai-task span {
  color: var(--aqc-muted);
  font-size: 11px;
}
.aqc-hero-qc .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aqc-hero-qc .nero-ai-status--red {
  background: rgba(239,68,68,.14);
  color: #fecaca;
}
.aqc-hero-qc .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
@media (max-width: 1100px) {
  .aqc-hero-qc .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aqc-hero-qc .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .aqc-hero-qc .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aqc-hero-qc .nero-ai-window-body { padding: 12px; }
  .aqc-hero-qc .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aqc-hero-qc .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">Контроль качества · Производство</p>
      <h1 id="aqc-hero-title">AI-контроль качества продукции: <span class="nero-ai-gradient-text">внедрение компьютерного зрения под ключ</span></h1>
      <p class="nero-ai-hero-lead">Обнаруживаем дефекты на линии до отгрузки — без усталости контролёра и позднего брака. Внедрим AI и компьютерное зрение под ключ для производства, пищевой отрасли, упаковки и электроники.</p>
      <ul class="nero-ai-badges" aria-label="Отрасли">
        <li class="nero-ai-badge">Пищевая</li>
        <li class="nero-ai-badge">Упаковка</li>
        <li class="nero-ai-badge">Электроника</li>
        <li class="nero-ai-badge">Одежда</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($hero_primary_url); ?>"<?php echo $hero_primary_attrs; ?>><?php echo esc_html($hero_primary_label); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="<?php echo esc_url($hero_secondary_url); ?>"><?php echo esc_html($hero_secondary_label); ?></a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-контроля качества на производственной линии">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Линия QC · CV-инспекция</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric nero-ai-metric--ok">
              <span>Проверено сегодня</span>
              <strong id="aqc-metric-checked">4&nbsp;218</strong>
              <small>100% потока в зоне камеры</small>
            </div>
            <div class="nero-ai-metric">
              <span>Defect rate</span>
              <strong id="aqc-metric-defect">1.8%</strong>
              <small>за текущую смену</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--warn">
              <span>На review</span>
              <strong id="aqc-metric-review">3</strong>
              <small>HITL · confidence &lt; 0.85</small>
            </div>
            <div class="nero-ai-metric nero-ai-metric--cyan">
              <span>Latency</span>
              <strong>68&nbsp;мс</strong>
              <small>edge inference</small>
            </div>
          </div>

          <div class="aqc-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aqc-qc-hero-canvas" role="img" aria-label="Анимация: конвейер с изделиями, AI подсвечивает дефекты в реальном времени"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий контроля качества">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ЗП</span>
              <div><strong>Запайка — брак шва</strong><span>Линия 2 · партия #A-4412 · отбраковка</span></div>
              <span class="nero-ai-status nero-ai-status--red">DEFECT</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">DM</span>
              <div><strong>DataMatrix — читаемость</strong><span>EAN-13 + код маркировки · норма</span></div>
              <span class="nero-ai-status">OK</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">ГМ</span>
              <div><strong>Геометрия упаковки</strong><span>confidence 0.76 — оператор-арбитр</span></div>
              <span class="nero-ai-status nero-ai-status--amber">REVIEW</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">СБ</span>
              <div><strong>Сборка узла — комплектация</strong><span>Электроника · все вставки на месте</span></div>
              <span class="nero-ai-status">OK</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
/**
 * aqc-qc-hero-engine — «Производственная линия CV-инспекции»
 * Мир: горизонтальный конвейер → камера над линией → bounding box → шлюз брака → HITL-пост
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aqc-qc-hero-canvas");
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
  if (typeof ResizeObserver !== "undefined") {
    var ro = new ResizeObserver(resizeCanvas);
    if (canvas.parentElement) ro.observe(canvas.parentElement);
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    belt: "#334155",
    beltEdge: "#1e293b",
    roller: "#475569",
    productOk: "#e2e8f0",
    productFood: "#fef3c7",
    productPack: "#dbeafe",
    productElec: "#d1fae5",
    defect: "#ef4444",
    review: "#f59e0b",
    ok: "#22c55e",
    camBody: "#0f172a",
    camLens: "#79f2ff",
    scanBeam: "rgba(121,242,255,0.45)",
    bboxOk: "rgba(34,197,94,0.85)",
    bboxDef: "rgba(239,68,68,0.9)",
    bboxRev: "rgba(245,158,11,0.88)",
    gate: "#64748b",
    hitl: "#8b5cf6",
    labelBg: "rgba(15,23,42,0.88)",
    labelText: "#f8fafc",
    outline: "#94a3b8"
  };

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

  function drawProduct(ctx, x, y, w, h, color, status) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 4, color, C.outline);
    if (status === "defect") {
      ctx.strokeStyle = C.defect;
      ctx.lineWidth = 2;
      ctx.strokeRect(x - w / 2 - 2, y - h / 2 - 2, w + 4, h + 4);
      ctx.fillStyle = C.defect;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("DEFECT", x, y - h / 2 - 5);
    } else if (status === "review") {
      ctx.strokeStyle = C.review;
      ctx.lineWidth = 1.8;
      ctx.strokeRect(x - w / 2 - 2, y - h / 2 - 2, w + 4, h + 4);
      ctx.fillStyle = C.review;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("REVIEW", x, y - h / 2 - 5);
    } else if (status === "ok") {
      ctx.strokeStyle = C.bboxOk;
      ctx.lineWidth = 1.2;
      ctx.setLineDash([3, 2]);
      ctx.strokeRect(x - w / 2 - 1, y - h / 2 - 1, w + 2, h + 2);
      ctx.setLineDash([]);
    }
  }

  /* Горизонтальный конвейер с роликами */
  function ProductionBelt() {
    this.offset = 0;
  }
  ProductionBelt.prototype.draw = function (ctx) {
    var beltY = 18;
    var beltW = 340;
    var beltH = 22;
    drawRR(ctx, -beltW / 2, beltY - beltH / 2, beltW, beltH, 6, C.belt, C.beltEdge);
    for (var i = -8; i <= 8; i++) {
      var rx = i * 22 + (this.offset % 22);
      ctx.fillStyle = C.roller;
      ctx.beginPath();
      ctx.arc(rx, beltY, 5, 0, Math.PI * 2);
      ctx.fill();
    }
    ctx.strokeStyle = "rgba(148,163,184,0.25)";
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(-beltW / 2 + 8, beltY);
    ctx.lineTo(beltW / 2 - 8, beltY);
    ctx.stroke();
    this.offset += 0.6;
  };

  /* Изделия на ленте */
  function ConveyorItems() {
    this.items = [
      { phase: 0,   w: 22, h: 16, color: C.productFood, status: "ok" },
      { phase: 55,  w: 20, h: 18, color: C.productPack, status: "ok" },
      { phase: 110, w: 24, h: 14, color: C.productElec, status: "defect" },
      { phase: 165, w: 21, h: 17, color: C.productOk, status: "review" },
      { phase: 220, w: 23, h: 15, color: C.productFood, status: "ok" }
    ];
  }
  ConveyorItems.prototype.draw = function (ctx) {
    var beltY = 18;
    var travel = 300;
    var speed = 0.55;
    this.items.forEach(function (it) {
      var t = ((frame * speed + it.phase) % (travel + 40)) / travel;
      if (t > 1) return;
      var x = -travel / 2 + t * travel;
      var y = beltY - it.h / 2 - 2;
      var st = it.status;
      if (t > 0.38 && t < 0.58) {
        drawProduct(ctx, x, y, it.w, it.h, it.color, st);
      } else {
        drawProduct(ctx, x, y, it.w, it.h, it.color, t > 0.58 ? "ok" : "none");
      }
    });
  };

  /* Камера CV над зоной сканирования */
  function VisionCameraRig() {
    this.beamPhase = 0;
  }
  VisionCameraRig.prototype.draw = function (ctx) {
    var camX = 0;
    var camY = -52;
    drawRR(ctx, camX - 28, camY - 12, 56, 24, 5, C.camBody, C.outline);
    ctx.fillStyle = C.camLens;
    ctx.beginPath();
    ctx.arc(camX, camY + 2, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.2;
    ctx.stroke();
    ctx.fillStyle = "#64748b";
    ctx.fillRect(camX - 3, camY + 10, 6, 18);

    this.beamPhase = (frame * 0.04) % 1;
    ctx.save();
    ctx.globalAlpha = 0.25 + Math.sin(frame * 0.1) * 0.12;
    ctx.fillStyle = C.scanBeam;
    ctx.beginPath();
    ctx.moveTo(camX - 14, camY + 28);
    ctx.lineTo(camX + 14, camY + 28);
    ctx.lineTo(camX + 38, 36);
    ctx.lineTo(camX - 38, 36);
    ctx.closePath();
    ctx.fill();
    var scanY = -8 + this.beamPhase * 32;
    ctx.strokeStyle = C.camLens;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(camX - 32, scanY);
    ctx.lineTo(camX + 32, scanY);
    ctx.stroke();
    ctx.restore();

    ctx.fillStyle = C.labelBg;
    drawRR(ctx, camX - 32, camY - 28, 64, 12, 3, C.labelBg, C.camLens);
    ctx.fillStyle = C.camLens;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("CV · edge 68ms", camX, camY - 19);
  };

  /* Шлюз отбраковки */
  function RejectGate() {
    this.arm = 0;
  }
  RejectGate.prototype.draw = function (ctx) {
    var gx = 95;
    var gy = 10;
    drawRR(ctx, gx - 8, gy - 20, 16, 40, 3, C.gate, C.outline);
    var prg = (frame * 0.038) % 250;
    this.arm = prg > 115 && prg < 145 ? (prg - 115) / 30 : 0;
    ctx.save();
    ctx.translate(gx, gy);
    ctx.rotate(-0.4 * this.arm);
    drawRR(ctx, -4, -2, 28, 6, 2, C.defect, C.outline);
    ctx.restore();
    if (this.arm > 0.3) {
      ctx.fillStyle = C.defect;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("REJECT", gx + 12, gy - 8);
    }
  };

  /* HITL-пост оператора */
  function HitlReviewStation() {
    this.blink = 0;
  }
  HitlReviewStation.prototype.draw = function (ctx) {
    var hx = -118;
    var hy = -8;
    drawRR(ctx, hx - 22, hy - 28, 44, 36, 5, "rgba(139,92,246,0.12)", C.hitl);
    ctx.fillStyle = C.hitl;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("HITL", hx, hy - 20);
    drawRR(ctx, hx - 16, hy - 10, 32, 22, 3, "rgba(15,23,42,0.7)", C.outline);
    var prg = (frame * 0.038) % 250;
    if (prg > 155 && prg < 210) {
      this.blink = Math.sin(frame * 0.2) > 0 ? 1 : 0.4;
      ctx.globalAlpha = this.blink;
      ctx.strokeStyle = C.review;
      ctx.lineWidth = 1.5;
      ctx.strokeRect(hx - 12, hy - 6, 24, 14);
      ctx.fillStyle = C.review;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.fillText("0.76?", hx, hy + 4);
      ctx.globalAlpha = 1;
    }
    ctx.fillStyle = "#cbd5e1";
    ctx.beginPath();
    ctx.arc(hx, hy + 22, 6, 0, Math.PI * 2);
    ctx.fill();
    drawRR(ctx, hx - 8, hy + 28, 16, 12, 3, C.hitl, "");
  };

  /* Счётчик брака */
  function DefectCounterPanel() {
    this.count = 76;
  }
  DefectCounterPanel.prototype.draw = function (ctx) {
    drawRR(ctx, 118, -58, 52, 42, 5, "rgba(239,68,68,0.1)", C.defect);
    ctx.fillStyle = C.defect;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("БРАК", 144, -48);
    var n = 76 + Math.floor((frame * 0.02) % 5);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 14px Inter,sans-serif";
    ctx.fillText(String(n), 144, -32);
    ctx.fillStyle = C.outline;
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("за смену", 144, -22);
  };

  var belt = new ProductionBelt();
  var items = new ConveyorItems();
  var camera = new VisionCameraRig();
  var gate = new RejectGate();
  var hitl = new HitlReviewStation();
  var counter = new DefectCounterPanel();

  function drawScene() {
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    belt.draw(ctx);
    items.draw(ctx);
    camera.draw(ctx);
    gate.draw(ctx);
    hitl.draw(ctx);
    counter.draw(ctx);

    ctx.restore();
    frame++;
    requestAnimationFrame(drawScene);
  }
  drawScene();

  /* Лёгкая пульсация метрик */
  var checkedEl = document.getElementById("aqc-metric-checked");
  var defectEl = document.getElementById("aqc-metric-defect");
  var reviewEl = document.getElementById("aqc-metric-review");
  var baseChecked = 4218;
  setInterval(function () {
    if (checkedEl) {
      var n = baseChecked + Math.floor(frame / 18);
      checkedEl.textContent = n.toLocaleString("ru-RU");
    }
    if (defectEl && frame % 120 === 0) {
      var d = (1.6 + Math.random() * 0.5).toFixed(1);
      defectEl.textContent = d + "%";
    }
    if (reviewEl && frame % 90 === 0) {
      reviewEl.textContent = String(2 + Math.floor(Math.random() * 3));
    }
  }, 800);
});
</script>

<div class="aqc-content">

  <!-- Intro + KPI -->
  <section class="aqc-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="aqc-cnt">
      <div class="aqc-intro-grid nero-ai-reveal">
        <div class="aqc-intro-text">
          <p class="aqc-eyebrow">Лонгрид · ai контроль качества</p>
          <p><strong>Коротко:</strong> <strong>AI-контроль качества</strong> на базе компьютерного зрения смотрит на каждое изделие в потоке, фиксирует дефект до отгрузки и оставляет цифровой след для технолога. Nero Network внедряет такие решения под ключ — от аудита линии до промышленного запуска с интеграцией в MES, 1С и ERP.</p>
          <p>В 2026 году промышленные компании тестируют agentic AI, но брак на большинстве линий всё ещё всплывает на финальном ОТК или у клиента. Разрыв пилот–производство закрывает детерминированный CV-контур с human-in-the-loop, а не «чёрный ящик» LLM.</p>
        </div>
        <div class="aqc-intro-kpi" aria-label="Ключевые метрики QC">
          <div class="aqc-kpi-card"><div class="kv">100%</div><div class="kl">контроль потока</div><div class="ks">в зоне камеры</div></div>
          <div class="aqc-kpi-card"><div class="kv">&lt;100 мс</div><div class="kl">edge inference</div><div class="ks">latency на линии</div></div>
          <div class="aqc-kpi-card"><div class="kv">800К–6М ₽</div><div class="kl">ориентир чека</div><div class="ks">под ключ</div></div>
          <div class="aqc-kpi-card"><div class="kv">HITL</div><div class="kl">оператор-арбитр</div><div class="ks">на спорных</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOC -->
  <div class="aqc-toc-outer">
    <div class="aqc-cnt">
      <nav class="aqc-toc" aria-label="Оглавление статьи">
        <a href="#reshenie">Зачем AI</a>
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#otrasli">Отрасли</a>
        <a href="#etapy">Внедрение</a>
        <a href="#integracii">Интеграции</a>
        <a href="#ceny">Цена</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
        <a href="#cta">Заказать</a>
      </nav>
    </div>
  </div>

  <!-- #bol — Боль -->
  <section class="aqc-section aqc-section-pain" id="bol">
    <div class="aqc-cnt">
      <div class="aqc-sh aqc-left">
        <span class="aqc-eyebrow">Проблема</span>
        <h2>Почему ручной контроль качества продукции не справляется с браком</h2>
        <p>Контроль качества продукции на производстве держится на выборочном осмотре — и это математически пропускает часть потока.</p>
      </div>

      <div class="aqc-grid-3 nero-ai-reveal">
        <div class="aqc-card aqc-card-pain">
          <h3>Усталость контролёров и выборочный осмотр</h3>
          <p>Точность падает через 15–30 минут монотонной работы. При проверке 10% партии 90% изделий уходит без визуального контроля. На высокоскоростных линиях человек физически не успевает.</p>
        </div>
        <div class="aqc-card aqc-card-pain nero-ai-delay-1">
          <h3>Штрафы, возвраты и репутационные потери</h3>
          <p>Поздний брак включает упаковку, логистику, обратную доставку и штрафы. X5 после CV-контроля упаковки заявила о сокращении возвратов на 80–90% и выявлении &gt;95% дефектов на линии.</p>
        </div>
        <div class="aqc-card aqc-card-pain nero-ai-delay-2">
          <h3>Разрыв пилот AI и реальной линии (verification gap)</h3>
          <p>Исследование arXiv:2605.14675 фиксирует capability–deployment verification gap: эксперименты с agentic AI опережают механизмы верификации. Пилот без параллельной валидации с ручным ОТК — главная причина провала.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #reshenie — Решение -->
  <section class="aqc-section aqc-section-alt" id="reshenie">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Решение</span>
        <h2>AI-контроль качества: обнаружение дефектов до отгрузки</h2>
        <p><strong>AI-контроль качества</strong> — внедрение компьютерного зрения и ML на линии для автоматического обнаружения дефектов, проверки стандартов и цифрового следа по каждой единице.</p>
      </div>

      <div class="aqc-grid-2 nero-ai-reveal">
        <div class="aqc-card">
          <h3>Как CV находит дефекты 24/7</h3>
          <p>Камеры + освещение → edge-сервер классифицирует кадр за доли секунды → вердикт «норма / брак A / B / C» с confidence. <strong>Нейросети контроль качества</strong> — одна из самых зрелых ветвей прикладного ИИ в промышленности.</p>
        </div>
        <div class="aqc-card nero-ai-delay-1">
          <h3>Верификация стандартов и human-in-the-loop</h3>
          <p>При confidence ниже порога — эскалация оператору. Оператор не исчезает: он переходит в роль контролёра ИИ-системы и принимает финальные решения в сложных случаях (ТВЭЛ, Росатом).</p>
        </div>
      </div>

      <div class="aqc-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="aqc-table aqc-table-compare">
          <thead>
            <tr>
              <th>Критерий</th>
              <th class="aqc-col-manual">Ручной ОТК</th>
              <th class="aqc-col-cv">AI-контроль (CV)</th>
              <th class="aqc-col-agent">CV + agentic</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Охват потока</td><td>Выборочно (5–20%)</td><td>100% в зоне камеры</td><td>100% + текстовые отчёты</td></tr>
            <tr><td>Скорость</td><td>Ограничена человеком</td><td>Синхронно с линией (&lt;100 мс)</td><td>То же + черновик root cause</td></tr>
            <tr><td>Усталость</td><td>Деградация через 15–30 мин</td><td>Нет</td><td>Нет</td></tr>
            <tr><td>Цифровой след</td><td>Бумага / разрозненные записи</td><td>Фото, тип, смена, партия</td><td>+ гипотеза причины</td></tr>
            <tr><td>Верификация</td><td>Субъективная</td><td>Детерминированная (пороги)</td><td>CV детерминирован; LLM — черновик</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- === БОРИС: визуальный блок (после #reshenie) === -->
  <section id="ai-kontrol-kachestva-produktsii-boris-block" class="bqc-root" aria-label="Анимация: контур AI-контроля качества — камера, edge-модель, решение и интеграция с MES/1С">
<style>
#ai-kontrol-kachestva-produktsii-boris-block.bqc-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #ai-kontrol-kachestva-produktsii-boris-block .bqc-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-kontrol-kachestva-produktsii-boris-block .bqc-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#b45309;margin:0 0 14px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-ey::before{
  content:'';width:18px;height:2px;background:#f59e0b;border-radius:1px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;
  line-height:1.28;margin:0 0 18px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-ul{
  list-style:none;margin:0 0 22px;padding:0;
  display:flex;flex-direction:column;gap:9px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-ul li{
  display:flex;align-items:flex-start;gap:10px;
  font-size:14px;line-height:1.5;color:#334155;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#b45309;margin-top:1px;font-style:normal;font-weight:700;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-pills{
  display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-pl-o{background:rgba(245,158,11,.08);color:#b45309;border:1.5px solid rgba(245,158,11,.22);}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-pl-b{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22);}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-foot{
  font-size:13px;color:#64748b;font-style:italic;margin:0;
}
#ai-kontrol-kachestva-produktsii-boris-block .bqc-rgt{
  position:relative;
  background:linear-gradient(135deg,#fffbeb 0%,#fef3c7 20%,#f0fdf4 50%,#f0f9ff 80%,#f8fafc 100%);
  min-height:440px;overflow:hidden;
}
@media(max-width:1023px){
  #ai-kontrol-kachestva-produktsii-boris-block .bqc-rgt{min-height:380px;}
}
#bqc-qc-pipeline-canvas{
  position:absolute;inset:0;width:100%;height:100%;display:block;
}
</style>

<div class="bqc-cnt">
  <div class="bqc-card">
    <div class="bqc-lft">
      <span class="bqc-ey">Контур QC · продолжение</span>
      <h3 class="bqc-h3">За дашбордом hero — полный путь кадра: от камеры до браковочного акта в 1С</h3>
      <ul class="bqc-ul">
        <li><span class="bqc-ic">1</span>Камера + триггер линии захватывает кадр в воспроизводимой точке</li>
        <li><span class="bqc-ic">2</span>Edge-модель (YOLO/TensorRT) выдаёт класс и confidence за &lt;100 мс</li>
        <li><span class="bqc-ic">3</span>OK → поток; DEFECT → отбраковка PLC; REVIEW → оператор-арбитр</li>
        <li><span class="bqc-ic">4</span>Событие с фото и партией уходит в MES/1С и Telegram-алерт</li>
      </ul>
      <div class="bqc-pills">
        <span class="bqc-pl bqc-pl-g">&lt;100 мс latency</span>
        <span class="bqc-pl bqc-pl-o">HITL на review</span>
        <span class="bqc-pl bqc-pl-b">1С / MES API</span>
      </div>
      <p class="bqc-foot">Дальше — как работает внедрение AI-контроля качества под ключ →</p>
    </div>
    <div class="bqc-rgt">
      <canvas id="bqc-qc-pipeline-canvas" aria-label="Анимация: кадр проходит камеру, edge AI, решение OK/DEFECT/REVIEW и запись в MES/1С" role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bqc-qc-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width  = p.clientWidth  || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    ink:'#0f172a', muted:'#64748b', line:'rgba(14,165,233,.25)',
    cam:'#0ea5e9', camGlow:'rgba(14,165,233,.15)',
    ai:'#8b5cf6', aiGlow:'rgba(139,92,246,.18)',
    green:'#22c55e', red:'#ef4444', amber:'#f59e0b',
    panel:'#1e293b', panelBdr:'#334155',
    ok:'#dcfce7', defect:'#fee2e2', review:'#fef3c7'
  };

  var LOOP = 520;

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function drawCamera(x,y,w,h,pulse){
    rr(x,y,w,h,10,C.camGlow,C.cam,2);
    rr(x+12,y+14,w-24,h*0.45,6,'#fff','#cbd5e1',1);
    ctx.fillStyle=C.cam;
    ctx.font='bold 10px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('CAM',x+w/2,y+28);
    var lensR = Math.min(18, w*0.12);
    ctx.beginPath();
    ctx.arc(x+w/2,y+h*0.62,lensR,0,Math.PI*2);
    ctx.fillStyle='#e0f2fe';ctx.fill();
    ctx.strokeStyle=C.cam;ctx.lineWidth=2;ctx.stroke();
    ctx.beginPath();
    ctx.arc(x+w/2,y+h*0.62,lensR*0.45+pulse%3,0,Math.PI*2);
    ctx.fillStyle=C.cam;ctx.globalAlpha=0.3+0.2*Math.sin(pulse*0.08);ctx.fill();
    ctx.globalAlpha=1;
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('GigE · триггер',x+w/2,y+h-8);
  }

  function drawEdgeAI(x,y,w,h,pulse){
    rr(x,y,w,h,12,C.aiGlow,C.ai,2);
    ctx.fillStyle=C.ai;
    ctx.font='bold 11px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Edge AI',x+w/2,y+20);
    for(var i=0;i<4;i++){
      var bx=x+14+i*((w-28)/3.5);
      var by=y+36+Math.sin(pulse*0.05+i)*3;
      rr(bx,by,22,22,4,'rgba(139,92,246,.15)',C.ai,1);
    }
    var barW=w-28;
    var prog=(pulse%80)/80;
    rr(x+14,y+h-28,barW,8,4,'rgba(139,92,246,.1)',null,0);
    rr(x+14,y+h-28,barW*prog,8,4,C.ai,null,0);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.fillText('conf 0.'+Math.floor(72+prog*25),x+w/2,y+h-10);
  }

  function drawDecision(x,y,w,h,state){
    var colors={ok:C.green,defect:C.red,review:C.amber};
    var labels={ok:'OK',defect:'DEFECT',review:'REVIEW'};
    var bg={ok:C.ok,defect:C.defect,review:C.review};
    rr(x,y,w,h,8,bg[state],colors[state],2);
    ctx.fillStyle=colors[state];
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText(labels[state],x+w/2,y+h/2+4);
  }

  function drawMES(x,y,w,h,events,pulse){
    rr(x,y,w,h,10,C.panel,C.panelBdr,2);
    ctx.fillStyle='#94a3b8';
    ctx.font='bold 10px Inter,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('MES / 1С · браковочный акт',x+10,y+18);
    events.slice(0,4).forEach(function(ev,i){
      var ey=y+28+i*32;
      rr(x+8,ey,w-16,26,5,ev.clr==='red'?'rgba(239,68,68,.12)':ev.clr==='amber'?'rgba(245,158,11,.12)':'rgba(34,197,94,.1)','rgba(255,255,255,.1)',1);
      ctx.fillStyle='#e2e8f0';
      ctx.font='9px Inter,sans-serif';
      ctx.fillText(ev.txt,x+14,ey+16);
    });
    ctx.fillStyle=C.green;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='right';
    ctx.fillText('API online',x+w-10,y+18);
  }

  function drawArrow(x1,y1,x2,y2,alpha){
    ctx.globalAlpha=alpha||0.6;
    ctx.strokeStyle=C.line;ctx.lineWidth=2;
    ctx.setLineDash([5,4]);
    ctx.beginPath();ctx.moveTo(x1,y1);ctx.lineTo(x2,y2);ctx.stroke();
    ctx.setLineDash([]);
    var ang=Math.atan2(y2-y1,x2-x1);
    ctx.beginPath();
    ctx.moveTo(x2,y2);
    ctx.lineTo(x2-8*Math.cos(ang-0.4),y2-8*Math.sin(ang-0.4));
    ctx.lineTo(x2-8*Math.cos(ang+0.4),y2-8*Math.sin(ang+0.4));
    ctx.closePath();
    ctx.fillStyle=C.line;ctx.fill();
    ctx.globalAlpha=1;
  }

  function loop(){
    frame++;
    var t=frame%LOOP;
    ctx.clearRect(0,0,W,H);

    var pad=16;
    var nodeW=Math.min(88,W*0.14);
    var nodeH=Math.min(100,H*0.28);
    var gap=(W-pad*2-nodeW*4)/3;
    var yMid=H*0.42;

    var camX=pad, aiX=camX+nodeW+gap, decX=aiX+nodeW+gap, mesX=decX+nodeW+gap;

    drawCamera(camX,yMid-nodeH/2,nodeW,nodeH,frame);
    drawEdgeAI(aiX,yMid-nodeH/2,nodeW,nodeH,frame);

    var states=['ok','defect','review'];
    var st=states[Math.floor(t/170)%3];
    drawDecision(decX,yMid-28,nodeW,56,st);

    var evts=[
      {txt:'Партия #4821 · OK',clr:'green'},
      {txt:'Запайка · DEFECT · стоп PLC',clr:'red'},
      {txt:'DataMatrix · REVIEW 0.76',clr:'amber'},
      {txt:'Акт брака → 1С:ERP',clr:'green'}
    ];
    drawMES(mesX,yMid-nodeH/2,nodeW+20,nodeH+40,evts,frame);

    drawArrow(camX+nodeW,yMid,aiX,yMid,0.7);
    drawArrow(aiX+nodeW,yMid,decX,yMid,0.7);
    drawArrow(decX+nodeW,yMid,mesX,yMid,0.7);

    var prog=Math.min(1,(t%170)/120);
    var dotX=camX+nodeW+(aiX-camX-nodeW)*prog;
    if(t%170<150){
      ctx.beginPath();
      ctx.arc(dotX,yMid,5,0,Math.PI*2);
      ctx.fillStyle=C.cam;ctx.fill();
    }

    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Захват',camX+nodeW/2,H-14);
    ctx.fillText('Inference',aiX+nodeW/2,H-14);
    ctx.fillText('Решение',decX+nodeW/2,H-14);
    ctx.fillText('Учёт',mesX+(nodeW+20)/2,H-14);

    requestAnimationFrame(loop);
  }
  requestAnimationFrame(loop);
})();
</script>
  </section>

  <!-- #kak-rabotaet -->
  <section class="aqc-section" id="kak-rabotaet">
    <div class="aqc-cnt">
      <div class="aqc-sh aqc-left">
        <span class="aqc-eyebrow">Архитектура</span>
        <h2>Как работает внедрение AI-контроля качества под ключ</h2>
        <p><strong>Внедрение ai контроль качества</strong> в Nero Network — проект с понятными этапами и измеримым результатом на пилоте.</p>
      </div>

      <div class="aqc-card nero-ai-reveal">
        <h3>Камера → модель → алерт → дашборд</h3>
        <ol class="aqc-steps-list">
          <li><strong>Захват.</strong> Промышленная камера (GigE/USB3) и освещение фиксируют изделие по триггеру.</li>
          <li><strong>Inference.</strong> Edge-сервер (Jetson / промышленный ПК) обрабатывает кадр за &lt;100 мс.</li>
          <li><strong>Решение.</strong> Модель (YOLOv8/YOLO11, TensorRT/OpenVINO) выдаёт класс и confidence.</li>
          <li><strong>Реакция.</strong> Алерт оператору, пневмоотбраковка или стоп линии через PLC — по критичности.</li>
          <li><strong>Дашборд.</strong> Лента дефектов, счётчики по сменам, тренды defect rate.</li>
        </ol>
      </div>

      <div class="aqc-grid-2 nero-ai-reveal" style="margin-top:20px;">
        <div class="aqc-card">
          <h3>Edge vs cloud: задержка на линии</h3>
          <p>Облачный round-trip добавляет 20–80 мс только на сеть. <strong>Edge-first</strong> — стандарт: inference на площадке, облако — для обучения и бэкапа датасета.</p>
        </div>
        <div class="aqc-card nero-ai-delay-1">
          <h3>Отчёты и браковочные акты для MES/ERP</h3>
          <p>Событие QC записывается с привязкой к партии, смене, SKU: фото, тип дефекта, timestamp. Данные уходят в MES/1С/ERP — формируется браковочный акт.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #otrasli -->
  <section class="aqc-section aqc-section-alt" id="otrasli">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Отрасли</span>
        <h2>AI-контроль качества для производства: отрасли и сценарии</h2>
        <p><strong>AI контроль качества для бизнеса</strong> в среднем сегменте — упаковка, текстиль, сборка, пищевая, электроника.</p>
      </div>

      <div class="aqc-industry-grid nero-ai-reveal">
        <div class="aqc-industry-card">
          <div class="aqc-industry-icon" aria-hidden="true">🍽</div>
          <h3>Пищевая промышленность</h3>
          <p>Запаечный шов, герметичность, маркировка EAN-13/DataMatrix. Референс X5: &gt;95% дефектов, −80–90% возвратов. ХАССП и прослеживаемость партий.</p>
        </div>
        <div class="aqc-industry-card">
          <div class="aqc-industry-icon" aria-hidden="true">📦</div>
          <h3>Упаковка и маркировка</h3>
          <p>Микротрещины, смещение печати, геометрия тары. CV связывает дефект с рулоном сырья — технолог видит, где начался сбой.</p>
        </div>
        <div class="aqc-industry-card">
          <div class="aqc-industry-icon" aria-hidden="true">⚡</div>
          <h3>Электроника и сборка</h3>
          <p>Кейс Ariston: &gt;600 000 водонагревателей/год; градация красный/жёлтый/зелёный; стоп линии при критическом браке. ОДК — микродефекты лопаток.</p>
        </div>
        <div class="aqc-industry-card">
          <div class="aqc-industry-icon" aria-hidden="true">🧵</div>
          <h3>Текстиль и одежда</h3>
          <p>Дефекты ткани, пятна, отклонения от лекал. Пилот на 3–5 типах брака с дообучением на кадрах клиента — типовой вход для швейного производства.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #etapy -->
  <section class="aqc-section" id="etapy">
    <div class="aqc-cnt">
      <div class="aqc-sh aqc-left">
        <span class="aqc-eyebrow">Под ключ</span>
        <h2>Этапы внедрения AI-контроля качества под ключ</h2>
        <p><strong>AI контроль качества под ключ</strong> — проект с фиксированными вехами: от аудита до первых промышленных метрик за 2–4 месяца.</p>
      </div>

      <div class="aqc-stepper nero-ai-reveal" aria-label="Этапы внедрения">
        <div class="aqc-step">
          <div class="aqc-step-num">01</div>
          <h3>Аудит линии и постановка ТЗ</h3>
          <p>1–2 недели: 3–5 типов брака, скорость конвейера, PLC/MES/1С, формат актов. <strong>Настройка ai контроль качества</strong> начинается с вашего брака.</p>
        </div>
        <div class="aqc-step">
          <div class="aqc-step-num">02</div>
          <h3>Пилот на реальных изделиях</h3>
          <p>4–8 недель: 1–2 камеры, 500–2000 кадров, обучение модели. Параллельная работа CV и ручного ОТК — обязательная валидация.</p>
        </div>
        <div class="aqc-step">
          <div class="aqc-step-num">03</div>
          <h3>Промышленный запуск и обучение</h3>
          <p>Тираж камер, интеграция PLC/1С, алерты Telegram. Active learning, ежемесячная отчётность по defect rate.</p>
        </div>
      </div>

      <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Команда хочет понимать AI до старта пилота на линии?</p>
          <p class="ym-cta-block__sub">Перед внедрением компьютерного зрения полезно разобраться в human-in-the-loop, edge inference и интеграции с PLC/MES — это ускоряет согласование с технологом и IT. Посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>.</p>
        </div>
      </aside>
    </div>
  </section>

  <!-- #integracii -->
  <section class="aqc-section aqc-section-alt" id="integracii">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Интеграции</span>
        <h2>Интеграция AI-контроля качества с MES, 1С и ERP</h2>
        <p><strong>Интеграция ai контроль качества</strong> отличает зрелый проект от демо-стенда.</p>
      </div>

      <div class="aqc-chips nero-ai-reveal" aria-label="Точки интеграции">
        <span class="aqc-chip">📷 Камеры GigE/USB3</span>
        <span class="aqc-chip">⚙️ PLC · Modbus/EtherCAT</span>
        <span class="aqc-chip">📊 1С:ERP / УПП</span>
        <span class="aqc-chip">🏭 MES</span>
        <span class="aqc-chip">✈️ Telegram-алерты</span>
        <span class="aqc-chip">🖥 Edge GPU</span>
      </div>

      <div class="aqc-grid-3 nero-ai-reveal" style="margin-top:24px;">
        <div class="aqc-card">
          <h3>Камеры, PLC и триггеры</h3>
          <p>Синхронизация с линией: энкодер, фотодатчик, сигнал PLC. Реакции по критичности: жёлтый — алерт; красный — остановка.</p>
        </div>
        <div class="aqc-card nero-ai-delay-1">
          <h3>MES/1С/ERP: traceability</h3>
          <p>Событие QC → фото, тип дефекта, ID партии → браковочный акт. Технолог видит причину дрейфа качества, а не только «брак вырос».</p>
        </div>
        <div class="aqc-card nero-ai-delay-2">
          <h3>Уведомления смены</h3>
          <p>Telegram/email при критическом браке; дашборд мастера; еженедельный свод defect rate. Edge-first — данные на площадке.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #ceny -->
  <section class="aqc-section" id="ceny">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Коммерция</span>
        <h2>Сколько стоит AI-контроль качества: ориентиры и факторы цены</h2>
        <p>Ориентир Nero Network: <strong>800 тыс.–6 млн ₽</strong>. Точная <strong>ai контроль качества цена</strong> — после аудита линии.</p>
      </div>

      <div class="aqc-table-wrap nero-ai-reveal">
        <table class="aqc-table">
          <thead>
            <tr><th>Компонент</th><th>~800К–1,5М ₽</th><th>1,5–6М ₽</th></tr>
          </thead>
          <tbody>
            <tr><td>Аудит и ТЗ</td><td>✓</td><td>✓ + несколько линий</td></tr>
            <tr><td>Камеры и освещение</td><td>1–2 точки</td><td>3–8+ точек</td></tr>
            <tr><td>Edge-сервер</td><td>1 узел</td><td>Несколько узлов, резерв</td></tr>
            <tr><td>Обучение модели</td><td>3–5 классов</td><td>Многоклассовая, SKU</td></tr>
            <tr><td>Интеграция PLC/1С</td><td>Базовая</td><td>MES, traceability</td></tr>
            <tr><td>Пилот + валидация</td><td>1 участок</td><td>Несколько участков</td></tr>
          </tbody>
        </table>
      </div>

      <div class="aqc-grid-2 nero-ai-reveal" style="margin-top:20px;">
        <div class="aqc-card">
          <h3>От чего зависит стоимость</h3>
          <p>Скорость линии, количество классов дефектов, условия среды (пищевая, взрывозащита), глубина интеграции в ERP.</p>
        </div>
        <div class="aqc-card nero-ai-delay-1">
          <h3>Пилот vs полное внедрение</h3>
          <p>Пилот на одном участке — проверка гипотезы без коммита на всё производство. <strong>AI контроль качества стоимость</strong> пилота заметно ниже тиража на нескольких линиях.</p>
        </div>
      </div>

      <div class="ym-cta-block ym-cta-block--primary" id="cta-ocenka">
        <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Оцените AI-контроль качества на вашей линии</p>
          <p class="ym-cta-block__sub">Инженер Nero Network проведёт короткий бриф: типы брака, скорость конвейера, точки камер и вилку бюджета 800 тыс.–6 млн ₽. Без обязательств — только понятная картина пилота и сроков.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Оценить контроль качества'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- #keisy -->
  <section class="aqc-section aqc-section-alt" id="keisy">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Доказательства</span>
        <h2>Кейсы и примеры внедрения AI-контроля качества</h2>
        <p><strong>AI контроль качества кейсы</strong> в России — от пищевой retail до металлургии и авиадвигателей. Публичные референсы, не проекты Nero Network, если не указано иное.</p>
      </div>

      <div class="aqc-case-grid nero-ai-reveal">
        <div class="aqc-case-card aqc-case-food">
          <div class="aqc-case-tag">Пищевая</div>
          <h3>X5 Group</h3>
          <p>CV запайки, герметичности, EAN-13/DataMatrix. &gt;95% дефектов; −80–90% возвратов (заявление компании).</p>
        </div>
        <div class="aqc-case-card aqc-case-pack">
          <div class="aqc-case-tag">Упаковка</div>
          <h3>Lenta tech + Кордиант</h3>
          <p>CV классификации шин, 30+ типоразмеров. Точность &gt;95%; +15 000 шин/год потенциал.</p>
        </div>
        <div class="aqc-case-card aqc-case-mid">
          <div class="aqc-case-tag">Сборка</div>
          <h3>Ariston + ML Sense</h3>
          <p>&gt;600 000 водонагревателей/год. Градация критичности; стоп при критическом браке.</p>
        </div>
        <div class="aqc-case-card aqc-case-enterprise">
          <div class="aqc-case-tag">Металлургия</div>
          <h3>Северсталь</h3>
          <p>~60% товарной продукции под автоконтролем. ~2 млрд ₽ за 10 лет (заявление гендиректора).</p>
        </div>
        <div class="aqc-case-card aqc-case-aviation">
          <div class="aqc-case-tag">Авиастроение</div>
          <h3>ОДК «Точка контроля»</h3>
          <p>Микроотклонения лопаток ПД-8. Human-in-the-loop + роботизированный пост.</p>
        </div>
        <div class="aqc-case-card aqc-case-mid">
          <div class="aqc-case-tag">Средний сегмент</div>
          <h3>Модель Nero Network</h3>
          <p>Упаковка, текстиль, сборка: 1–3 линии, чек 800К–3М ₽. Пилот 4–8 недель с параллельным ОТК.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- #faq -->
  <section class="aqc-section" id="faq">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">FAQ</span>
        <h2>FAQ: как внедрить AI-контроль качества</h2>
      </div>
      <div class="aqc-faq nero-ai-reveal">
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">Как внедрить AI-контроль качества на существующей линии?</div>
          <div class="aqc-faq-a">Аудит → камеры на одном участке → пилот с параллельным ручным ОТК 2–4 недели → калибровка → PLC и учётные системы → тираж. Минимум: 200–500 кадров на класс дефекта.</div>
        </div>
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-контроль качества для малого и среднего бизнеса?</div>
          <div class="aqc-faq-a"><strong>AI контроль качества для малого бизнеса</strong> (1 линия, 1–2 камеры) — от 800 тыс. ₽. <strong>Для среднего бизнеса</strong> — обычно 1,5–3 млн ₽; сложные контуры — до 6 млн ₽.</div>
        </div>
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">Нужны ли программисты в штате?</div>
          <div class="aqc-faq-a"><strong>AI контроль качества без программиста</strong> — нормальная модель: операторы с дашбордом, технолог настраивает пороги, Nero Network ведёт дообучение по SLA.</div>
        </div>
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">Какие задачи решает AI-контроль качества кроме поиска дефектов?</div>
          <div class="aqc-faq-a">100% контроль потока, цифровой след, аналитика defect rate, ранний дрейф качества, автоматические акты в 1С/MES, опционально — черновик root cause.</div>
        </div>
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">AI контроль качества под ключ или самостоятельно?</div>
          <div class="aqc-faq-a">Самостоятельная сборка даёт демо, но редко доходит до промышленного контура. <strong>Под ключ</strong> закрывает verification gap — от пилота до акта в ERP.</div>
        </div>
        <div class="aqc-faq-item">
          <div class="aqc-faq-q" role="button" tabindex="0" aria-expanded="false">Как проходит демо проверки качества?</div>
          <div class="aqc-faq-a">Лид-магнит: вы отправляете фото/видео изделия → инженер показывает детекцию на демо-стенде → обсуждаем применимость и вилку бюджета. Демо не заменяет пилот на площадке.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- #cta -->
  <section class="aqc-section aqc-section-cta" id="cta">
    <div class="aqc-cnt">
      <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы закрыть verification gap на вашем производстве?</p>
          <p class="ym-cta-block__sub">Камеры на линии, edge inference, интеграция с 1С/MES и оператор-арбитр на спорных случаях — не презентация про ИИ, а рабочий контур контроля качества. Пилот на одном участке за 4–8 недель.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label ?: 'Оценить контроль качества'); ?></a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Демо проверки качества →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div><!-- /.aqc-content -->

  <!-- internal-linker: outgoing links -->
  <section class="aqc-section aqc-section-alt aqc-related" id="related" aria-label="Смежные материалы">
    <div class="aqc-cnt">
      <div class="aqc-sh">
        <span class="aqc-eyebrow">Смежные материалы</span>
        <h2>Внедрение AI в смежных бизнес-процессах</h2>
        <p>Контроль качества на линии часто идёт в паре с учётным контуром и автоматизацией заявок — ниже посадочные Nero Network по соседним сценариям.</p>
      </div>
      <div class="aqc-related-links nero-ai-reveal" style="max-width:820px;margin:0 auto;">
        <p class="aqc-related-item">Браковочные акты и traceability в 1С/MES закрываются не только CV, но и <a href="<?php echo esc_url($nero_internal_base . '/ai-1c-erp/'); ?>" class="ym-link ym-link--accent">AI-агентом для 1С и ERP под ключ</a> — когда QC-события должны попадать в учётный контур без ручного переноса.</p>
        <p class="aqc-related-item">На корпоративном масштабе те же принципы agentic AI и managed-агентов разбираются в материале <a href="<?php echo esc_url($nero_internal_base . '/kpmg-claude-vnedrenie-ai-276-tysyach/'); ?>" class="ym-link ym-link--accent">KPMG и Claude — уроки AI для бизнеса</a>: полезно перед согласованием пилота CV с IT и руководством.</p>
        <p class="aqc-related-item">Если параллельно автоматизируете продажи и лиды, посмотрите <a href="<?php echo esc_url($nero_internal_base . '/vnedrenie-ai-amocrm/'); ?>" class="ym-link ym-link--accent">внедрение AI-агента в amoCRM</a> — сценарий «заявка без двойного ввода» рядом с производственными контурами среднего бизнеса.</p>
        <p class="aqc-related-item">Для потоков входящих обращений до этапа производства уместна <a href="<?php echo esc_url($nero_internal_base . '/vnedrenie-ai-obrabotka-email-crm/'); ?>" class="ym-link ym-link--accent">AI-обработка входящей почты в CRM</a> — triage заявок до того, как заказ попадёт на линию.</p>
      </div>
    </div>
  </section>
  <?php
  $aqc_page_url  = trailingslashit( get_permalink() );
  $aqc_site_url  = trailingslashit( home_url( '/' ) );
  $aqc_brand     = get_bloginfo( 'name' ) ?: 'Nero Network';
  $aqc_h1        = 'AI-контроль качества продукции: внедрение компьютерного зрения под ключ';
  $aqc_schema    = [
      '@context' => 'https://schema.org',
      '@graph'   => [
          [
              '@type' => 'Organization',
              '@id'   => $aqc_site_url . '#organization',
              'name'  => $aqc_brand,
              'url'   => $aqc_site_url,
          ],
          [
              '@type'     => 'WebSite',
              '@id'       => $aqc_site_url . '#website',
              'url'       => $aqc_site_url,
              'name'      => $aqc_brand,
              'publisher' => [ '@id' => $aqc_site_url . '#organization' ],
          ],
          [
              '@type'       => 'WebPage',
              '@id'         => $aqc_page_url . '#webpage',
              'url'         => $aqc_page_url,
              'name'        => $aqc_h1,
              'description' => $page_seo_description,
              'isPartOf'    => [ '@id' => $aqc_site_url . '#website' ],
              'about'       => [ '@id' => $aqc_site_url . '#organization' ],
          ],
          [
              '@type'           => 'BreadcrumbList',
              '@id'             => $aqc_page_url . '#breadcrumb',
              'itemListElement' => [
                  [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $aqc_site_url ],
                  [ '@type' => 'ListItem', 'position' => 2, 'name' => $aqc_h1, 'item' => $aqc_page_url ],
              ],
          ],
          [
              '@type'       => 'Service',
              '@id'         => $aqc_page_url . '#service',
              'name'        => $aqc_h1,
              'description' => $page_seo_description,
              'url'         => $aqc_page_url,
              'provider'    => [ '@id' => $aqc_site_url . '#organization' ],
          ],
          [
              '@type'      => 'FAQPage',
              '@id'        => $aqc_page_url . '#faq',
              'mainEntity' => [
                  [ '@type' => 'Question', 'name' => 'Как внедрить AI-контроль качества на существующей линии?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Аудит → камеры на одном участке → пилот с параллельным ручным ОТК 2–4 недели → калибровка → PLC и учётные системы → тираж. Минимум: 200–500 кадров на класс дефекта.' ] ],
                  [ '@type' => 'Question', 'name' => 'Сколько стоит AI-контроль качества для малого и среднего бизнеса?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI контроль качества для малого бизнеса (1 линия, 1–2 камеры) — от 800 тыс. ₽. Для среднего бизнеса — обычно 1,5–3 млн ₽; сложные контуры — до 6 млн ₽.' ] ],
                  [ '@type' => 'Question', 'name' => 'Нужны ли программисты в штате?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'AI контроль качества без программиста — нормальная модель: операторы с дашбордом, технолог настраивает пороги, Nero Network ведёт дообучение по SLA.' ] ],
                  [ '@type' => 'Question', 'name' => 'Какие задачи решает AI-контроль качества кроме поиска дефектов?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => '100% контроль потока, цифровой след, аналитика defect rate, ранний дрейф качества, автоматические акты в 1С/MES, опционально — черновик root cause.' ] ],
                  [ '@type' => 'Question', 'name' => 'AI контроль качества под ключ или самостоятельно?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Самостоятельная сборка даёт демо, но редко доходит до промышленного контура. Под ключ закрывает verification gap — от пилота до акта в ERP.' ] ],
                  [ '@type' => 'Question', 'name' => 'Как проходит демо проверки качества?', 'acceptedAnswer' => [ '@type' => 'Answer', 'text' => 'Лид-магнит: вы отправляете фото/видео изделия → инженер показывает детекцию на демо-стенде → обсуждаем применимость и вилку бюджета. Демо не заменяет пилот на площадке.' ] ],
              ],
          ],
      ],
  ];
  echo '<script type="application/ld+json">' . wp_json_encode( $aqc_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "
";
  ?>
  

</main>

<script>
(function(){
  document.querySelectorAll('.aqc-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.aqc-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.aqc-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.aqc-faq-q');
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
  var root = document.querySelector('.ai-kontrol-kachestva-produktsii-page') || document.querySelector('.aqc-content');
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
