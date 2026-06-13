<?php
/**
 * Template Name: AI-агент для заявок VK и Telegram: внедрение под ключ
 * Description: SEO-лендинг — AI ловит коммерческие сообщения в VK, Telegram и комментариях, квалифицирует лиды и передаёт в CRM.
 */

$page_seo_title       = 'AI-агент для заявок VK и Telegram: внедрение под ключ';
$page_seo_description = 'AI ловит коммерческие сообщения в VK, Telegram и комментариях, квалифицирует лиды и передаёт в CRM. Внедрение под ключ, цена и кейсы. Бесплатный аудит входящих за неделю.';

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
    ['label' => 'Как работает', 'href' => '#kak-rabotaet'],
    ['label' => 'Этапы', 'href' => '#etapy'],
    ['label' => 'Сценарии', 'href' => '#scenarii'],
    ['label' => 'Кейсы', 'href' => '#keisy'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить заявки из соцсетей';
$primary_cta_url = nero_ai_primary_cta_url(getenv('PRIMARY_CTA_URL') ?: '');
$primary_cta_attrs = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы';
$secondary_cta_url = getenv('SECONDARY_CTA_URL') ?: '#kak-rabotaet';

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
/* Kadence reset — дублирует паттерн vnec/vna */
body.nero-ai-landing #masthead,body.nero-ai-landing .site-header,body.nero-ai-landing header.site-header,body.nero-ai-landing #mobile-header{display:none!important}
body.nero-ai-landing{padding-top:0!important}
.breadcrumbs,.breadcrumb,.breadcrumb-list,.breadcrumb-item,nav[aria-label="Хлебные крошки"],.woocommerce-breadcrumb,.rank-math-breadcrumb,.rank-math-breadcrumbs,.yoast-breadcrumb,.entry-header,.page-title-section{display:none!important}
#primary,.site-main,.site-content,#content,.content-area{padding-top:0!important;margin-top:0!important}

.vnz-content{
  --vnz-bg:#050711;--vnz-text:#e6edf7;--vnz-muted:#9aa8bd;--vnz-soft:#c7d2e5;--vnz-heading:#fff;
  --vnz-border:rgba(255,255,255,.10);--vnz-accent:#79f2ff;--vnz-violet:#8b5cf6;--vnz-green:#22c55e;
  --vnz-vk:#0077ff;--vnz-tg:#29b6f6;
  --vnz-btn-from:#2563eb;--vnz-btn-to:#7c3aed;--vnz-container:1220px;
  background:linear-gradient(180deg,#050711 0%,#080b17 52%,#050711 100%);
  color:var(--vnz-text);font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;overflow-x:hidden;
}
.vnz-content *,.vnz-content *::before,.vnz-content *::after{box-sizing:border-box}
.vnz-content a{color:inherit}
.vnz-content p{color:var(--vnz-muted);line-height:1.72;margin:0 0 1em}
.vnz-content p:last-child{margin-bottom:0}
.vnz-content h2,.vnz-content h3,.vnz-content h4{color:var(--vnz-heading);letter-spacing:-.045em;margin:0 0 .7em}
.vnz-content strong{color:var(--vnz-soft)}
.vnz-content ul,.vnz-content ol{padding-left:0;list-style:none;margin:0 0 1em}
.vnz-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--vnz-muted);font-size:14.5px;line-height:1.65}
.vnz-content ul li::before{content:'›';position:absolute;left:0;color:var(--vnz-accent);font-weight:700}
.vnz-content code{font-size:13px;padding:2px 6px;border-radius:6px;background:rgba(121,242,255,.08);color:var(--vnz-accent)}
.vnz-cnt{width:min(var(--vnz-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1}
.vnz-section{padding:clamp(64px,8vw,112px) 0;position:relative}
.vnz-section-alt{background:linear-gradient(180deg,rgba(255,255,255,.032),rgba(255,255,255,.01));border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)}
.vnz-sh{max-width:820px;margin:0 auto 48px;text-align:center}
.vnz-sh.vnz-left{margin-left:0;text-align:left}
.vnz-sh h2{font-size:clamp(26px,4vw,50px);line-height:1.06;margin-bottom:14px}
.vnz-sh p{font-size:clamp(15px,1.6vw,18px);max-width:680px;margin:0 auto}
.vnz-sh.vnz-left p{margin-left:0}
.vnz-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(121,242,255,.08);border:1px solid rgba(121,242,255,.22);font-size:11.5px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnz-accent);margin-bottom:14px}
.vnz-intro{padding:clamp(40px,5vw,72px) 0 clamp(40px,5vw,64px);background:linear-gradient(180deg,rgba(255,255,255,.03),transparent);border-bottom:1px solid rgba(255,255,255,.06)}
.vnz-intro-grid{display:grid;grid-template-columns:1fr 340px;gap:56px;align-items:center}
.vnz-intro-text{position:relative;padding-left:20px}
.vnz-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--vnz-accent),var(--vnz-violet))}
.vnz-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.55vw,16.5px);line-height:1.8}
.vnz-intro-kpi{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.vnz-kpi-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:16px 14px;text-align:center;backdrop-filter:blur(12px)}
.vnz-kpi-card .kv{font-size:clamp(18px,2.3vw,24px);font-weight:900;color:var(--vnz-heading);letter-spacing:-.04em;line-height:1.1;margin-bottom:5px}
.vnz-kpi-card .kl{font-size:11px;font-weight:600;color:var(--vnz-muted);line-height:1.4}
@media(max-width:900px){.vnz-intro-grid{grid-template-columns:1fr;gap:36px}.vnz-intro-kpi{grid-template-columns:repeat(3,1fr)}}
@media(max-width:600px){.vnz-intro-kpi{grid-template-columns:1fr 1fr}}
.vnz-toc-outer{padding:0 0 clamp(36px,4.5vw,56px)}
.vnz-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center}
.vnz-toc a{display:inline-block;padding:9px 18px;background:rgba(255,255,255,.06);border:1px solid var(--vnz-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--vnz-muted);text-decoration:none!important;transition:border-color .2s,color .2s}
.vnz-toc a:hover{border-color:rgba(121,242,255,.42);color:var(--vnz-accent)}
.vnz-card{background:linear-gradient(180deg,rgba(255,255,255,.085),rgba(255,255,255,.042));border:1px solid var(--vnz-border);border-radius:24px;padding:26px;backdrop-filter:blur(16px)}
.vnz-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:20px}
.vnz-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:768px){.vnz-grid-2,.vnz-grid-3{grid-template-columns:1fr}}
.vnz-channel-card{border-radius:20px;padding:24px;border:1px solid rgba(255,255,255,.09);background:rgba(255,255,255,.055)}
.vnz-channel-card--vk{border-color:rgba(0,119,255,.25)}
.vnz-channel-card--tg{border-color:rgba(41,182,246,.25)}
.vnz-channel-card--cmt{border-color:rgba(139,92,246,.25)}
.vnz-channel-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:10px}
.vnz-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid rgba(255,255,255,.09);margin:24px 0}
.vnz-table{width:100%;border-collapse:collapse;font-size:14px}
.vnz-table th{padding:13px 16px;text-align:left;background:rgba(121,242,255,.1);color:var(--vnz-accent);font-weight:700;border-bottom:1px solid rgba(121,242,255,.25)}
.vnz-table td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.05);color:var(--vnz-text);vertical-align:top}
.vnz-table tr:last-child td{border-bottom:none}
.vnz-table tr.row-highlight td{background:rgba(34,197,94,.08)}
.vnz-timeline{position:relative;padding-left:40px}
.vnz-timeline::before{content:'';position:absolute;left:12px;top:8px;bottom:8px;width:2px;background:linear-gradient(180deg,var(--vnz-accent),var(--vnz-violet));opacity:.35}
.vnz-tl-item{position:relative;margin-bottom:32px}
.vnz-tl-dot{position:absolute;left:-32px;top:4px;width:16px;height:16px;border-radius:50%;background:var(--vnz-accent);box-shadow:0 0 0 4px rgba(121,242,255,.2)}
.vnz-tl-item h3{font-size:17px;margin-bottom:8px}
.vnz-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
@media(max-width:900px){.vnz-case-grid{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.vnz-case-grid{grid-template-columns:1fr}}
.vnz-case-card{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.09);border-radius:20px;padding:26px}
.vnz-case-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--vnz-green);margin-bottom:10px}
.vnz-faq{display:flex;flex-direction:column;gap:10px;max-width:820px;margin:0 auto}
.vnz-faq-item{background:rgba(255,255,255,.055);border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden}
.vnz-faq-q{padding:19px 24px;font-size:16px;font-weight:700;color:var(--vnz-heading);cursor:pointer;display:flex;justify-content:space-between;gap:16px}
.vnz-faq-q::after{content:'▾';color:var(--vnz-accent);transition:transform .25s}
.vnz-faq-item.open .vnz-faq-q::after{transform:rotate(180deg)}
.vnz-faq-a{padding:0 24px;max-height:0;overflow:hidden;transition:max-height .38s ease}
.vnz-faq-item.open .vnz-faq-a{max-height:900px;padding:0 24px 20px}
.ym-cta-block{border-radius:20px;padding:36px 40px;margin:32px 0;background:linear-gradient(135deg,rgba(121,242,255,.12),rgba(139,92,246,.1));border:1px solid rgba(121,242,255,.3);text-align:center}
.ym-cta-block--dual{text-align:left;background:linear-gradient(135deg,rgba(34,197,94,.1),rgba(121,242,255,.1));border-color:rgba(34,197,94,.3)}
.ym-cta-block--footer-final{margin-top:48px}
.ym-cta-block__icon{font-size:36px;margin-bottom:14px}
.ym-cta-block__headline{font-size:clamp(20px,2.8vw,28px);font-weight:800;color:#fff;margin:0 0 10px}
.ym-cta-block__sub{color:var(--vnz-muted);font-size:15px;margin:0 auto 22px;max-width:640px;line-height:1.7}
.ym-cta-block--dual .ym-cta-block__sub{margin-left:0;max-width:none}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center}
.ym-link--accent{color:var(--vnz-accent)!important;text-decoration:underline!important}
.nero-ai-reveal{opacity:0;transform:translateY(22px);transition:opacity .55s ease,transform .55s ease}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none}
.nero-ai-delay-1{transition-delay:.12s}.nero-ai-delay-2{transition-delay:.24s}
</style>

<main id="primary" class="site-main nero-ai-home-page vnedrenie-ai-zayavki-vk-telegram-page" role="main" tabindex="-1">

<style>
/* ── Hero VK/Telegram: самодостаточные стили (без CSS темы) ── */
.vnz-hero-vk-tg {
  --vnz-cyan: #79f2ff;
  --vnz-violet: #8b5cf6;
  --vnz-vk: #5181b8;
  --vnz-tg: #2aabee;
  --vnz-green: #22c55e;
  --vnz-text: #e6edf7;
  --vnz-muted: #9aa8bd;
  --vnz-soft: #c7d2e5;
  --vnz-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
}
.vnz-hero-vk-tg.nero-ai-hero {
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.vnz-hero-vk-tg::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 45% 30%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.vnz-hero-vk-tg::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(6px);
  animation: vnzHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes vnzHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.vnz-hero-vk-tg .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.vnz-hero-vk-tg .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.vnz-hero-vk-tg .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(38px, 5.8vw, 72px);
  line-height: .95;
  letter-spacing: -0.065em;
  color: #fff;
  font-weight: 900;
}
.vnz-hero-vk-tg .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--vnz-cyan) 38%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.vnz-hero-vk-tg .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.2);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--vnz-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.11em;
}
.vnz-hero-vk-tg .nero-ai-hero-lead {
  margin: 24px 0 0;
  max-width: 720px;
  color: var(--vnz-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.vnz-hero-vk-tg .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.vnz-hero-vk-tg .nero-ai-badge {
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
.vnz-hero-vk-tg .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.vnz-hero-vk-tg .nero-ai-btn {
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
.vnz-hero-vk-tg .nero-ai-btn:hover { transform: translateY(-2px); }
.vnz-hero-vk-tg .nero-ai-btn-primary {
  color: #031018 !important;
  background: linear-gradient(135deg, var(--vnz-cyan), #a7f3d0);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.vnz-hero-vk-tg .nero-ai-btn-secondary {
  color: var(--vnz-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.vnz-hero-vk-tg .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--vnz-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.vnz-hero-vk-tg .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.vnz-hero-vk-tg .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.vnz-hero-vk-tg .nero-ai-dots { display: flex; gap: 7px; }
.vnz-hero-vk-tg .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.vnz-hero-vk-tg .nero-ai-dot:nth-child(1) { background: #fb7185; }
.vnz-hero-vk-tg .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.vnz-hero-vk-tg .nero-ai-dot:nth-child(3) { background: #34d399; }
.vnz-hero-vk-tg .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.vnz-hero-vk-tg .nero-ai-window-body { padding: 16px; }
.vnz-hero-vk-tg .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.vnz-hero-vk-tg .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.vnz-hero-vk-tg .nero-ai-live-pill {
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
.vnz-hero-vk-tg .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: vnzPulse 1.6s infinite;
}
@keyframes vnzPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.vnz-hero-vk-tg .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  margin-bottom: 12px;
}
.vnz-hero-vk-tg .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.vnz-hero-vk-tg .nero-ai-metric span {
  display: block;
  color: var(--vnz-muted);
  font-size: 11px;
  font-weight: 700;
}
.vnz-hero-vk-tg .nero-ai-metric strong {
  display: block;
  margin-top: 5px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.vnz-hero-vk-tg .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 11px;
}
.vnz-hero-vk-tg .vnz-dash-canvas-wrap {
  position: relative;
  height: clamp(220px, 32vw, 300px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.18);
  background: radial-gradient(ellipse at 50% 42%, rgba(81,129,184,.12), rgba(6,10,24,.92) 72%);
}
.vnz-hero-vk-tg #vnz-social-leads-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.vnz-hero-vk-tg .nero-ai-task-stream { display: grid; gap: 8px; }
.vnz-hero-vk-tg .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.vnz-hero-vk-tg .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--vnz-cyan);
  font-size: 11px;
  font-weight: 800;
}
.vnz-hero-vk-tg .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.vnz-hero-vk-tg .nero-ai-task span {
  color: var(--vnz-muted);
  font-size: 11px;
}
.vnz-hero-vk-tg .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.vnz-hero-vk-tg .nero-ai-status--amber {
  background: rgba(245,158,11,.12);
  color: #fde68a;
}
.vnz-hero-vk-tg .nero-ai-status--violet {
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
}
@media (max-width: 1100px) {
  .vnz-hero-vk-tg .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .vnz-hero-vk-tg .nero-ai-dashboard { transform: none; }
}
@media (max-width: 520px) {
  .vnz-hero-vk-tg .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .vnz-hero-vk-tg .nero-ai-window-body { padding: 12px; }
  .vnz-hero-vk-tg .nero-ai-task { grid-template-columns: 28px 1fr; }
  .vnz-hero-vk-tg .nero-ai-status { grid-column: 2; width: fit-content; }
}
</style>

<section class="nero-ai-hero vnz-hero-vk-tg" id="vnz-hero-vk-tg" aria-labelledby="vnz-hero-title">
  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">VK / Telegram · лиды в CRM</p>
      <h1 id="vnz-hero-title">AI-агент для заявок из VK и Telegram: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">AI ловит коммерческие сообщения в соцсетях, квалифицирует лиды и передаёт в CRM — без потерь из-за медленного ответа менеджера</p>
      <ul class="nero-ai-badges" aria-label="Ключевые возможности">
        <li class="nero-ai-badge">VK ЛС и комментарии</li>
        <li class="nero-ai-badge">Telegram Bot API</li>
        <li class="nero-ai-badge">Квалификация AI</li>
        <li class="nero-ai-badge">amoCRM / Битрикс24</li>
        <li class="nero-ai-badge">Аудит 7 дней</li>
        <li class="nero-ai-badge">Make / n8n</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить заявки из соцсетей</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#kak-rabotaet">Как это работает</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI-заявок из соцсетей">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI-системы · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI-центр заявок из соцсетей</h3>
            <span class="nero-ai-live-pill">live</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Входящих сегодня</span>
              <strong>31</strong>
              <small>VK + Telegram</small>
            </div>
            <div class="nero-ai-metric">
              <span>Средний ответ</span>
              <strong>12 сек</strong>
              <small>до первого сообщения</small>
            </div>
            <div class="nero-ai-metric">
              <span>В CRM</span>
              <strong>18</strong>
              <small>квалифицированных лидов</small>
            </div>
            <div class="nero-ai-metric">
              <span>Комментарии без ответа</span>
              <strong>−47%</strong>
              <small>за 7 дней аудита</small>
            </div>
          </div>

          <div class="vnz-dash-canvas-wrap" aria-hidden="false">
            <canvas id="vnz-social-leads-canvas" role="img" aria-label="Анимация: заявки из VK, комментариев и Telegram квалифицируются AI и уходят в CRM"></canvas>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий соцсетей">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">VK</span>
              <div><strong>Комментарий: «сколько стоит?»</strong><span>Класс: коммерция · перевод в ЛС</span></div>
              <span class="nero-ai-status nero-ai-status--violet">квалификация</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">CRM</span>
              <div><strong>Лид amoCRM #2841</strong><span>Источник: VK комментарий · бюджет собран</span></div>
              <span class="nero-ai-status">сделка</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">TG</span>
              <div><strong>Telegram: запись на замер</strong><span>Автоответ 8 сек · гео Самара</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">!</span>
              <div><strong>Эскалация менеджеру</strong><span>Негатив в ЛС · handoff с контекстом</span></div>
              <span class="nero-ai-status nero-ai-status--amber">human</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vnz-content">

  <!-- Вводный блок + KPI -->
  <section class="vnz-intro" aria-label="Краткое введение">
    <div class="vnz-cnt">
      <div class="vnz-intro-grid nero-ai-reveal">
        <div class="vnz-intro-text">
          <p><strong>Коротко:</strong> AI-агент для заявок из соцсетей — первая линия продаж в VK, Telegram и комментариях: система классифицирует коммерческие обращения, квалифицирует лида и передаёт горячий контакт в CRM с полным контекстом диалога.</p>
          <p>3 июня 2026 Meta представила <strong>Meta Business Agent</strong> для WhatsApp, Messenger и Instagram. В России рабочий контур — <strong>VK + Telegram + CRM</strong>. Nero Network внедряет связку каналов, ИИ и CRM под вашу воронку — не шаблонный конструктор с кнопками.</p>
        </div>
        <div class="vnz-intro-kpi" aria-label="Ключевые показатели">
          <div class="vnz-kpi-card">
            <div class="kv">~50%</div>
            <div class="kl">уходят при ответе &gt;10 мин</div>
          </div>
          <div class="vnz-kpi-card">
            <div class="kv">93,4 млн</div>
            <div class="kl">MAU VK (Q4 2025)</div>
          </div>
          <div class="vnz-kpi-card">
            <div class="kv">3 входа</div>
            <div class="kl">комментарий → ЛС → CRM</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnz-toc-outer">
    <div class="vnz-cnt">
      <nav class="vnz-toc" aria-label="Оглавление статьи">
        <a href="#kak-rabotaet">Как работает</a>
        <a href="#etapy">Этапы</a>
        <a href="#scenarii">Сценарии</a>
        <a href="#keisy">Кейсы</a>
        <a href="#ceny">Стоимость</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <!-- §1 Почему теряют -->
  <section class="vnz-section" id="pochemu-teryaet">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Боль бизнеса</span>
        <h2>Почему бизнес теряет заявки из VK, Telegram и комментариев</h2>
        <p>Потеря лидов в соцсетях — когда коммерческое обращение не попадает в CRM вовремя и клиент уходит к конкуренту.</p>
      </div>
      <div class="vnz-card nero-ai-reveal" id="medlennyj-otvet">
        <h3>Сколько лидов уходит из-за медленного ответа в мессенджерах</h3>
        <p>Исследование <strong>Телфин + OkoCRM</strong> (7,5 тыс. компаний, ноябрь 2025): примерно <strong>половина клиентов уходит без заказа</strong>, если ответ ждут <strong>более 10 минут</strong>. Callibri (600 тыс. обращений за 2025): без автоматизации теряют до <strong>20% звонков</strong> и <strong>15% заявок из чатов</strong>.</p>
      </div>
      <div class="vnz-card nero-ai-reveal nero-ai-delay-1" id="gde-propuskayut" style="margin-top:20px">
        <h3>Где пропускают обращения: ЛС, комментарии, упоминания</h3>
        <ul>
          <li>Комментарий под постом без ответа и без перевода в ЛС</li>
          <li>ЛС сообщества ночью и в выходные — задержка до следующего дня</li>
          <li>Несколько сотрудников в одном аккаунте без единой очереди</li>
          <li>Telegram-бот с кнопками не понимает свободный текст</li>
          <li>Разрыв между соцсетями и CRM — непонятно, во что конвертировалось обращение</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- §2 Что такое -->
  <div class="vnz-cnt" style="padding:0 0 clamp(20px,3vw,36px)">
    <p class="vnz-related nero-ai-reveal" style="font-size:15px;max-width:820px;margin:0 auto 14px;text-align:center">После квалификации лид из VK или Telegram обычно уходит в CRM — тот же принцип, что и в сценарии <a href="/vnedrenie-ai-amocrm/" style="color:var(--vnz-accent);text-decoration:underline;text-underline-offset:3px">внедрение AI-агента в amoCRM под ключ</a>: карточка сделки, теги источника и handoff менеджеру без ручного копипаста.</p>
    <p class="vnz-related nero-ai-reveal" style="font-size:15px;max-width:820px;margin:0 auto;text-align:center">Если часть заявок приходит ещё и на почту, имеет смысл собрать единую картину входящих: <a href="/vnedrenie-ai-obrabotka-email-crm/" style="color:var(--vnz-accent);text-decoration:underline;text-underline-offset:3px">AI-обработка входящей почты в CRM</a> — соседний разбор автоматизации email→CRM, дополняющий мессенджеры и комментарии.</p>
  </div>
  <section class="vnz-section vnz-section-alt" id="chto-takoe">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Определение</span>
        <h2>Что такое AI-агент для заявок из соцсетей</h2>
        <p>Система первой линии: VK (ЛС, комментарии), Telegram, классификация, квалификация, CRM, эскалация человеку.</p>
      </div>
      <div class="vnz-table-wrap nero-ai-reveal">
        <table class="vnz-table" aria-label="Классификация обращений AI">
          <thead><tr><th>Тип</th><th>Примеры</th><th>Действие</th></tr></thead>
          <tbody>
            <tr class="row-highlight"><td><strong>Коммерция</strong></td><td>«сколько стоит», «запишите»</td><td>Квалификация → CRM</td></tr>
            <tr><td>FAQ</td><td>режим работы, адрес</td><td>Ответ из базы знаний</td></tr>
            <tr><td>Жалоба</td><td>негатив, возврат</td><td>Эскалация менеджеру</td></tr>
            <tr><td>Спам</td><td>оффтоп, реклама</td><td>Игнор / модерация</td></tr>
          </tbody>
        </table>
      </div>
      <div class="vnz-card nero-ai-reveal nero-ai-delay-1" style="margin-top:24px" id="kvalifikaciya-crm">
        <h3>Квалификация лидов AI перед передачей в CRM</h3>
        <p>Модуль BANT-lite: услуга, гео, бюджет, контакт, согласие на ПДн (152-ФЗ). В CRM — готовая карточка с тегами источника (VK комментарий / VK ЛС / Telegram) и резюме диалога.</p>
      </div>
    </div>
  </section>

  <!-- §3 Как работает + #etapy (canvas Бориса ниже) -->
  <section class="vnz-section" id="kak-rabotaet">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Внедрение под ключ</span>
        <h2>Как работает внедрение AI-заявок из соцсетей под ключ</h2>
        <p>Проект из 4–6 этапов: работающая связка каналов, ИИ и CRM — не «подписка на SaaS».</p>
      </div>

      <div class="vnz-timeline nero-ai-reveal">
        <div class="vnz-tl-item" id="audit-nedelya">
          <div class="vnz-tl-dot"></div>
          <h3>Аудит входящих сообщений соцсети за неделю</h3>
          <p>Бесплатный аудит за 7 дней: выгрузка диалогов VK/Telegram, карта потерь, SLA, доля коммерческих комментариев.</p>
        </div>
        <div class="vnz-tl-item" id="scenarii-vk-tg">
          <div class="vnz-tl-dot"></div>
          <h3>Настройка сценариев для VK и Telegram</h3>
          <p>VK ЛС, комментарии (<code>wall_reply_new</code> → ответ + ЛС), Telegram webhook. Стек: <strong>n8n</strong> или <strong>Make.com</strong>.</p>
        </div>
        <div class="vnz-tl-item" id="integraciya-crm">
          <div class="vnz-tl-dot"></div>
          <h3>Интеграция с amoCRM и Битрикс24</h3>
          <p>amoCRM: <code>POST /api/v4/leads/complex</code>. Битрикс24: <code>crm.lead.add</code>. VK Callback: <code>message_new</code>, <code>wall_reply_new</code>. Telegram: <code>setWebhook</code> (webhook и polling взаимоисключающие).</p>
        </div>
      </div>
    </div>


<section id="vnedrenie-ai-zayavki-vk-telegram-boris-block" class="bvt-root" aria-label="Схема интеграции: VK, Telegram, AI и CRM">
<style>
/* === БОРИС: prefix bvt-, scoped === */
#vnedrenie-ai-zayavki-vk-telegram-boris-block.bvt-root{
  padding:56px 0 48px;
  background:#f0f4fb;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-cnt{
  max-width:1160px;margin:0 auto;padding:0 24px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:500px;
}
@media(max-width:1023px){
  #vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-card{grid-template-columns:1fr;min-height:auto;}
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px;}
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-ey{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  color:#0077ff;margin:0 0 14px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-ey::before{
  content:'';width:18px;height:2px;background:#0077ff;border-radius:1px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-h3{
  font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-ul{
  list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-ul li{
  display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;
  background:rgba(0,119,255,.1);display:flex;align-items:center;justify-content:center;
  font-size:11px;color:#005ccc;font-style:normal;margin-top:1px;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-pl{
  padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap;
}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-pl-vk{background:rgba(0,119,255,.08);color:#005ccc;border:1.5px solid rgba(0,119,255,.22);}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-pl-tg{background:rgba(41,182,246,.08);color:#0284c7;border:1.5px solid rgba(41,182,246,.22);}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22);}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-foot{font-size:13px;color:#64748b;font-style:italic;margin:0;}
#vnedrenie-ai-zayavki-vk-telegram-boris-block .bvt-rgt{
  position:relative;
  background:linear-gradient(135deg,#eef6ff 0%,#e8f4fd 45%,#f8fafc 100%);
  min-height:420px;overflow:hidden;
}
#bvt-social-pipeline-canvas{position:absolute;inset:0;width:100%;height:100%;display:block;}
</style>

<div class="bvt-cnt" id="etapy">
  <div class="bvt-card nero-ai-reveal">
    <div class="bvt-lft">
      <span class="bvt-ey">Схема интеграции · #etapy</span>
      <h3 class="bvt-h3">Три входа в одну воронку: VK, Telegram и комментарии → CRM</h3>
      <ul class="bvt-ul">
        <li><span class="bvt-ic">VK</span><code>message_new</code> и <code>wall_reply_new</code> через Callback API на webhook</li>
        <li><span class="bvt-ic">TG</span>Telegram Bot API: <code>setWebhook</code> → HTTPS POST на оркестратор</li>
        <li><span class="bvt-ic">AI</span>Классификация коммерции, квалификация BANT-lite, RAG по базе знаний</li>
        <li><span class="bvt-ic">CRM</span>amoCRM / Битрикс24: лид с источником и резюме диалога</li>
      </ul>
      <div class="bvt-pills">
        <span class="bvt-pl bvt-pl-vk">VK Callback</span>
        <span class="bvt-pl bvt-pl-tg">Telegram webhook</span>
        <span class="bvt-pl bvt-pl-g">n8n / Make</span>
      </div>
      <p class="bvt-foot">Дальше — сценарии по каналам и кейсы внедрения →</p>
    </div>
    <div class="bvt-rgt">
      <canvas id="bvt-social-pipeline-canvas"
        aria-label="Анимация: сообщения из VK, комментариев и Telegram проходят AI-квалификацию и создают лид в CRM"
        role="img"></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bvt-social-pipeline-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0, cycleT = 0;

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
    vk:'#0077ff', tg:'#29b6f6', ai:'#8b5cf6', orch:'#f59e0b', crm:'#22c55e',
    line:'rgba(14,165,233,.4)', text:'#1e293b', muted:'#64748b', white:'#ffffff'
  };

  var SOURCES = [
    {key:'vk_ls', label:'VK ЛС', color:C.vk, api:'message_new'},
    {key:'vk_c',  label:'Коммент.', color:'#6d28d9', api:'wall_reply_new'},
    {key:'tg',    label:'Telegram', color:C.tg, api:'webhook'}
  ];

  var packets = [];
  var crmAlpha = 0;

  function rr(x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  function drawNode(x,y,w,h,label,sub,color){
    rr(x,y,w,h,10,C.white,color);
    ctx.fillStyle = color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(label, x+w/2, y+h*0.42);
    if(sub){
      ctx.fillStyle = C.muted;
      ctx.font = '9px system-ui,sans-serif';
      ctx.fillText(sub, x+w/2, y+h*0.68);
    }
  }

  function spawnPacket(){
    var s = SOURCES[Math.floor(Math.random()*SOURCES.length)];
    packets.push({
      src: s, phase: 0, x: W*0.08, y: H*0.22 + Math.random()*H*0.5,
      alpha: 0
    });
  }

  function drawBubble(x,y,r,color,text){
    ctx.globalAlpha = 0.92;
    rr(x-r,y-r*0.7,r*2,r*1.4,8,color,'rgba(255,255,255,.5)');
    ctx.fillStyle = '#fff';
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText(text, x, y+3);
    ctx.globalAlpha = 1;
  }

  function tick(){
    frame++; cycleT++;
    if(frame % 70 === 0) spawnPacket();

    ctx.clearRect(0,0,W,H);

    /* узлы схемы */
    var srcX = W*0.06, srcW = W*0.14, nodeH = H*0.09, gap = H*0.11;
    SOURCES.forEach(function(s,i){
      var ny = H*0.18 + i*gap;
      s._y = ny + nodeH/2;
      drawNode(srcX, ny, srcW, nodeH, s.label, s.api, s.color);
    });

    var whX = W*0.28, whW = W*0.12;
    var whY = H*0.42;
    drawNode(whX, whY, whW, nodeH*1.1, 'n8n', 'Make', C.orch);

    var aiX = W*0.46, aiW = W*0.14;
    var aiY = H*0.38;
    drawNode(aiX, aiY, aiW, nodeH*1.3, 'AI', 'квалификация', C.ai);
    var pulse = 0.5+0.5*Math.sin(frame*0.07);
    ctx.strokeStyle = C.ai;
    ctx.lineWidth = 2+pulse*2;
    ctx.globalAlpha = 0.25+pulse*0.35;
    ctx.beginPath();
    ctx.arc(aiX+aiW/2, aiY+nodeH*0.65, aiW*0.55+pulse*6, 0, Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;

    var crmX = W*0.72, crmW = W*0.22, crmY = H*0.32, crmH = H*0.36;
    drawNode(crmX, crmY, crmW, crmH, 'CRM', 'amoCRM / B24', C.crm);

  /* статические линии потока */
    ctx.strokeStyle = C.line;
    ctx.lineWidth = 2;
    ctx.setLineDash([6,4]);
    SOURCES.forEach(function(s){
      ctx.beginPath();
      ctx.moveTo(srcX+srcW, s._y);
      ctx.lineTo(whX, whY+nodeH*0.55);
      ctx.stroke();
    });
    ctx.beginPath();
    ctx.moveTo(whX+whW, whY+nodeH*0.55);
    ctx.lineTo(aiX, aiY+nodeH*0.65);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(aiX+aiW, aiY+nodeH*0.65);
    ctx.lineTo(crmX, crmY+crmH*0.5);
    ctx.stroke();
    ctx.setLineDash([]);

    /* движущиеся пакеты */
    packets = packets.filter(function(p){
      p.phase++;
      p.alpha = Math.min(1, p.alpha + 0.04);
      var t = p.phase;
      var x1 = srcX+srcW, y1 = p.src._y || H*0.3;
      var x2 = whX, y2 = whY+nodeH*0.55;
      var x3 = aiX, y3 = aiY+nodeH*0.65;
      var x4 = crmX, y4 = crmY+crmH*0.5;
      var px, py;
      if(t < 80){ var e=t/80; px=x1+(x2-x1)*e; py=y1+(y2-y1)*e; }
      else if(t < 160){ var e2=(t-80)/80; px=x2+(x3-x2)*e2; py=y2+(y3-y2)*e2; }
      else if(t < 240){ var e3=(t-160)/80; px=x3+(x4-x3)*e3; py=y3+(y4-y3)*e3; }
      else { crmAlpha = Math.min(1, crmAlpha+0.03); return false; }
      ctx.globalAlpha = p.alpha;
      drawBubble(px, py, 14, p.src.color, 'лид');
      ctx.globalAlpha = 1;
      return true;
    });

    if(crmAlpha > 0.05){
      ctx.globalAlpha = crmAlpha;
      rr(crmX+10, crmY+crmH*0.55, crmW-20, 22, 5, 'rgba(34,197,94,.12)', C.crm);
      ctx.fillStyle = C.text;
      ctx.font = '10px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText('Лид: VK комментарий · бюджет 120к', crmX+16, crmY+crmH*0.55+14);
      ctx.globalAlpha = 1;
    }

    if(cycleT > 400){ cycleT=0; crmAlpha=0; packets=[]; }

    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</section>


    <div class="vnz-cnt">
      <div class="ym-cta-block ym-cta-block--primary" id="cta-etapy">
        <div class="ym-cta-block__icon" aria-hidden="true">📲</div>
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Проверить заявки из соцсетей — бесплатно</p>
          <p class="ym-cta-block__sub">За 7 дней выгрузим диалоги VK и Telegram, покажем карту потерь: где ответили поздно, сколько коммерческих комментариев не дошло до CRM, и какой SLA у вас сейчас.</p>
          <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить заявки из соцсетей</a>
        </div>
      </div>
    </div>
  </section>

  <!-- §4 Сценарии -->
  <section class="vnz-section vnz-section-alt" id="scenarii">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Каналы</span>
        <h2>Сценарии: VK, Telegram и комментарии</h2>
      </div>
      <div class="vnz-grid-3 nero-ai-reveal">
        <div class="vnz-channel-card vnz-channel-card--vk">
          <div class="vnz-channel-tag" style="color:var(--vnz-vk)">VK ЛС</div>
          <h3>Малый бизнес и услуги</h3>
          <p>Кейс F5 «Потолки Самара»: VK + Telegram + amoCRM, 10–20 заявок/день, диалог с дней до ~5 минут.</p>
        </div>
        <div class="vnz-channel-card vnz-channel-card--cmt">
          <div class="vnz-channel-tag" style="color:var(--vnz-violet)">VK комментарий</div>
          <h3>Комментарии под постами</h3>
          <p><code>wall_reply_new</code> → классификация → публичный ответ → приглашение в ЛС → CRM. Ключевой дифференциатор vs конкуренты.</p>
        </div>
        <div class="vnz-channel-card vnz-channel-card--tg">
          <div class="vnz-channel-tag" style="color:var(--vnz-tg)">Telegram</div>
          <h3>Онлайн-школы и SMM</h3>
          <p>Запись на пробный урок, снятие рутины с комментариев, ночная «смена» без доп. менеджера.</p>
        </div>
      </div>
      <div class="vnz-table-wrap nero-ai-reveal" style="margin-top:28px">
        <table class="vnz-table" aria-label="Каналы и API-события">
          <thead><tr><th>Канал</th><th>Событие API</th><th>Задача</th></tr></thead>
          <tbody>
            <tr><td>VK ЛС</td><td><code>message_new</code></td><td>Квалификация, запись</td></tr>
            <tr class="row-highlight"><td>VK комментарий</td><td><code>wall_reply_new</code></td><td>Ответ + перевод в ЛС</td></tr>
            <tr><td>Telegram</td><td><code>message</code> (webhook)</td><td>FAQ, передача в CRM</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- §5 Meta trend -->
  <section class="vnz-section" id="meta-trend">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Тренд 2026</span>
        <h2>Meta enterprise AI agent и российский аналог в 2026</h2>
        <p>Meta легитимизировала категорию «AI business agent в мессенджерах» — в РФ спрос на VK + Telegram + CRM.</p>
      </div>
      <div class="vnz-table-wrap nero-ai-reveal">
        <table class="vnz-table" aria-label="Meta Business Agent vs VK/Telegram">
          <thead><tr><th>Параметр</th><th>Meta Business Agent</th><th>AI-заявки VK/Telegram (РФ)</th></tr></thead>
          <tbody>
            <tr><td>Каналы</td><td>WhatsApp, Messenger, Instagram</td><td>VK, Telegram, комментарии</td></tr>
            <tr><td>CRM</td><td>Западные экосистемы</td><td>amoCRM, Битрикс24</td></tr>
            <tr><td>Юридика</td><td>GDPR</td><td>152-ФЗ, ПДн в РФ</td></tr>
            <tr class="row-highlight"><td>Комментарии</td><td>Instagram</td><td>VK <code>wall_reply_new</code></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- §6 Цена -->
  <section class="vnz-section vnz-section-alt" id="ceny">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Бюджет</span>
        <h2>Сколько стоит внедрение AI-заявок из соцсетей</h2>
        <p>Ориентир Nero Network: <strong>120–350 тыс. ₽</strong> под ключ — каналы, CRM, база знаний, SLA-аналитика.</p>
      </div>
      <div class="vnz-card nero-ai-reveal" id="sostav-ceny">
        <h3>Из чего складывается цена внедрения под ключ</h3>
        <ul>
          <li>Аудит и проектирование сценариев</li>
          <li>Интеграция VK Callback и Telegram webhook</li>
          <li>AI-слой: классификация, RAG, извлечение полей</li>
          <li>CRM-коннектор, handoff, обучение команды</li>
        </ul>
      </div>
      <div class="vnz-card nero-ai-reveal nero-ai-delay-1" id="roi-otvet" style="margin-top:20px">
        <h3>ROI: скорость ответа в мессенджерах и конверсия в заявку</h3>
        <p>~50% клиентов уходит при ответе &gt;10 мин (Телфин+OkoCRM). Автоматизация сокращает первый ответ с часов до секунд. Метрики: медиана времени до ответа, доля обращений в CRM, конверсия диалог → лид.</p>
      </div>

      <div class="ym-cta-block ym-cta-block--dual" id="cta-ceny">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Узнайте бюджет под ваш поток из VK и Telegram</p>
          <p class="ym-cta-block__sub">Ориентир <strong>120–350 тыс. ₽</strong> за внедрение под ключ. На аудите дадим оценку каналов и ROI. Если команда хочет понимать n8n и human-in-the-loop до старта — <a href="<?php echo esc_url($secondary_cta_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_cta_label); ?></a>.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>>Проверить заявки из соцсетей</a>
            <a href="#faq" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Вопросы по внедрению</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- §7 Кейсы -->
  <div class="vnz-cnt" style="padding:0 0 clamp(20px,3vw,36px)">
    <p class="vnz-related nero-ai-reveal" style="font-size:15px;max-width:820px;margin:0 auto 14px;text-align:center">На корпоративном масштабе те же идеи managed-агентов и цифровых шлюзов уже разбирали в материале <a href="/kpmg-claude-vnedrenie-ai-276-tysyach/" style="color:var(--vnz-accent);text-decoration:underline;text-underline-offset:3px">KPMG и Claude — уроки AI для бизнеса</a> — полезно для сравнения enterprise-подхода Meta и практики внедрения в РФ.</p>
    <p class="vnz-related nero-ai-reveal" style="font-size:15px;max-width:820px;margin:0 auto;text-align:center">Когда заявки из соцсетей должны стыковаться с учётом и складом, а не только с CRM, смотрите смежный кейс <a href="/ai-1c-erp/" style="color:var(--vnz-accent);text-decoration:underline;text-underline-offset:3px">AI-агент для 1С и ERP</a> — автоматизация заявок поверх 1С и ERP без разрыва между каналами и операционкой.</p>
  </div>
  <section class="vnz-section" id="keisy">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Результаты рынка</span>
        <h2>Кейсы и примеры внедрения AI-заявок из соцсетей</h2>
        <p>Цифры из материалов интеграторов (F5, iFabrique, NextBot) — порядок эффекта, не гарантия.</p>
      </div>
      <div class="vnz-case-grid nero-ai-reveal">
        <div class="vnz-case-card">
          <div class="vnz-case-tag">F5 / VK+TG</div>
          <h3>Потолки Самара</h3>
          <p>Диалог с дней до ~5 мин, +10% конверсии квалификации на Авито.</p>
        </div>
        <div class="vnz-case-card">
          <div class="vnz-case-tag">iFabrique</div>
          <h3>Стройкомпания СПб</h3>
          <p>+18% продаж, +12% заявок в офис, омниканал + нейро-ассистент.</p>
        </div>
        <div class="vnz-case-card">
          <div class="vnz-case-tag">NextBot</div>
          <h3>Загородный комплекс</h3>
          <p>+31% продаж за 2 недели, ответ за 3 сек вместо часов.</p>
        </div>
      </div>
      <div class="vnz-card nero-ai-reveal" style="margin-top:24px" id="oshibki-bota">
        <h3>Типовые ошибки при самостоятельной настройке бота</h3>
        <ul>
          <li>Только ЛС, без комментариев VK</li>
          <li>Кнопочный бот без ИИ на свободном тексте</li>
          <li>Нет CRM и handoff для негатива</li>
          <li>Нет согласия на ПДн (152-ФЗ)</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- §8 Заказать -->
  <section class="vnz-section vnz-section-alt" id="zakazat">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Старт проекта</span>
        <h2>Как заказать внедрение AI-агента для заявок</h2>
      </div>
      <div class="vnz-card nero-ai-reveal">
        <h3>Что входит в работу под ключ</h3>
        <ul>
          <li>Аудит входящих за неделю и карта потерь</li>
          <li>Сценарии VK, Telegram, комментарии</li>
          <li>AI-агент с базой знаний + интеграция CRM</li>
          <li>Метрики SLA и сопровождение первых 100 диалогов</li>
        </ul>
        <p style="margin-top:16px"><strong>CTA:</strong> первый шаг — «Проверить заявки из соцсетей»: бесплатный аудит за 7 дней. Цикл внедрения: <strong>2–4 недели</strong> для VK + Telegram + CRM.</p>
      </div>
    </div>
  </section>

  <!-- §9 FAQ -->
  <section class="vnz-section" id="faq">
    <div class="vnz-cnt">
      <div class="vnz-sh nero-ai-reveal">
        <span class="vnz-eyebrow">Вопросы</span>
        <h2>FAQ по AI-заявкам из соцсетей</h2>
      </div>
      <div class="vnz-faq nero-ai-reveal" data-vnz-faq>
        <div class="vnz-faq-item">
          <div class="vnz-faq-q" role="button" tabindex="0">Как внедрить без потери качества диалога?</div>
          <div class="vnz-faq-a"><p>RAG по базе знаний, тон бренда, handoff человеку. AI — первая линия; человек закрывает сделку.</p></div>
        </div>
        <div class="vnz-faq-item">
          <div class="vnz-faq-q" role="button" tabindex="0">Нужна ли CRM?</div>
          <div class="vnz-faq-a"><p>Да, если считаете лиды. Поддерживаются amoCRM и Битрикс24; омниканалы — по согласованию.</p></div>
        </div>
        <div class="vnz-faq-item">
          <div class="vnz-faq-q" role="button" tabindex="0">Юридические ограничения VK и Telegram?</div>
          <div class="vnz-faq-a"><p>152-ФЗ: согласие на ПДн до сбора телефона. Без спама; автоответы в комментариях — уместно, не флуд.</p></div>
        </div>
        <div class="vnz-faq-item">
          <div class="vnz-faq-q" role="button" tabindex="0">Чем отличается от Senler / Salebot?</div>
          <div class="vnz-faq-a"><p>Senler/Salebot — рассылки и воронки. AI-агент Nero — квалификация входящих в свободной форме и передача в CRM.</p></div>
        </div>
        <div class="vnz-faq-item">
          <div class="vnz-faq-q" role="button" tabindex="0">Сколько занимает внедрение?</div>
          <div class="vnz-faq-a"><p>Аудит — 7 дней. Разработка — обычно 2–4 недели для VK + Telegram + amoCRM/Битрикс24.</p></div>
        </div>
      </div>
    </div>
  </section>

  <div class="vnz-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы перестать терять лиды из VK и Telegram?</p>
        <p class="ym-cta-block__sub">Первый шаг — аудит входящих за неделю: цифры по комментариям, ЛС и SLA. Дальше — коммерческое предложение за 2–4 недели.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>>Проверить заявки из соцсетей</a>
      </div>
    </div>
  </div>

</div><!-- .vnz-content -->

<script>
/**
 * vnz-social-leads-engine — Диспетчерская «Омниканальные заявки VK/Telegram»
 * Мир: три ленты-кабеля каналов → SocialLeadRouter → квалификация → CRM handoff
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vnz-social-leads-canvas");
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
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    vk: "#5181b8",
    tg: "#2aabee",
    comment: "#a78bfa",
    hub: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    crmGreen: "#22c55e",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0",
    chatBg: "#f8fafc",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6"
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

  function drawChatBubble(ctx, x, y, w, h, color, tail) {
    drawRR(ctx, x - w / 2, y - h / 2, w, h, 5, color, C.outline);
    if (tail) {
      ctx.fillStyle = color;
      ctx.beginPath();
      ctx.moveTo(x - 4, y + h / 2 - 2);
      ctx.lineTo(x + 2, y + h / 2 + 6);
      ctx.lineTo(x + 8, y + h / 2 - 2);
      ctx.fill();
      ctx.strokeStyle = C.outline;
      ctx.stroke();
    }
  }

  /* Три изогнутых кабеля с пузырями — транспорт (не конвейер, не орбиты) */
  function ChannelRibbonCables() {
    this.phase = 0;
  }
  ChannelRibbonCables.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % 1;
    var cables = [
      { color: C.vk, sx: -175, sy: 85, cx1: -120, cy1: 20, cx2: -60, cy2: -30, ex: -35, ey: -45, label: "VK ЛС" },
      { color: C.comment, sx: -195, sy: -55, cx1: -110, cy1: -70, cx2: -30, cy2: -55, ex: 0, ey: -70, label: "коммент" },
      { color: C.tg, sx: 175, sy: 80, cx1: 120, cy1: 15, cx2: 55, cy2: -25, ex: 35, ey: -48, label: "Telegram" }
    ];
    cables.forEach(function (cable, idx) {
      ctx.strokeStyle = cable.color + "55";
      ctx.lineWidth = idx === 1 ? 2.5 : 2;
      ctx.setLineDash([5, 7]);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.moveTo(cable.sx, cable.sy);
      ctx.bezierCurveTo(cable.cx1, cable.cy1, cable.cx2, cable.cy2, cable.ex, cable.ey);
      ctx.stroke();
      ctx.setLineDash([]);

      var t = (this.phase + idx * 0.33) % 1;
      var mt = 1 - t;
      var bx = mt * mt * mt * cable.sx + 3 * mt * mt * t * cable.cx1 + 3 * mt * t * t * cable.cx2 + t * t * t * cable.ex;
      var by = mt * mt * mt * cable.sy + 3 * mt * mt * t * cable.cy1 + 3 * mt * t * t * cable.cy2 + t * t * t * cable.ey;
      drawChatBubble(ctx, bx, by, 18, 12, C.chatBg, idx !== 1);
      ctx.fillStyle = cable.color;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(cable.label, cable.sx, cable.sy + (idx === 1 ? -14 : 16));
    }, this);
  };

  /* Центральный роутер лидов — вместо WebsiteTerminal / CrmDealForge */
  function SocialLeadRouter() {
    this.leadSlide = 0;
  }
  SocialLeadRouter.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.leadSlide = 0;

    drawRR(ctx, -48, -58, 96, 116, 12, C.hub, C.outline);

    /* Шестигранный хаб */
    ctx.fillStyle = "rgba(121,242,255,0.1)";
    ctx.beginPath();
    for (var i = 0; i < 6; i++) {
      var ang = (Math.PI / 3) * i - Math.PI / 2;
      var hx = Math.cos(ang) * 38;
      var hy = -8 + Math.sin(ang) * 32;
      if (i === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 1.5;
    ctx.stroke();

    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("AI-роутер", 0, -6);
    ctx.font = "7px Inter,sans-serif";
    ctx.fillStyle = "#cbd5e1";
    ctx.fillText("3 канала → 1 воронка", 0, 6);

    /* Фаза CLASSIFY */
    if (prg >= 55 && prg < 125) {
      var intents = ["коммерция", "FAQ", "спам"];
      intents.forEach(function (lab, i) {
        var alpha = i === 0 ? 1 : 0.35;
        drawRR(ctx, -34 + i * 22, 18, 20, 12, 3, "rgba(139,92,246," + (alpha * 0.35) + ")", i === 0 ? C.hubViolet : C.outline);
        ctx.fillStyle = i === 0 ? "#ede9fe" : "#94a3b8";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.fillText(lab, -24 + i * 22, 27);
      });
    }

    /* Фаза QUALIFY — поля BANT */
    if (prg >= 125 && prg < 195) {
      var fields = ["Гео", "Бюджет", "Услуга"];
      fields.forEach(function (f, i) {
        var fy = 22 + i * 16;
        var fillW = Math.min(1, (prg - 125 - i * 12) / 30) * 52;
        drawRR(ctx, -26, fy, 52, 10, 3, "rgba(255,255,255,0.08)", C.outline);
        drawRR(ctx, -25, fy + 1, Math.max(0, fillW), 8, 2, C.crmGreen, null);
        ctx.fillStyle = "#fff";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(f, -24, fy + 8);
      });
    }

    /* Фаза HANDOFF — карточка в CRM-слот */
    if (prg >= 195) {
      var hand = Math.min(1, (prg - 195) / 28);
      this.leadSlide = hand;
      var cardY = 38 - hand * 52;
      drawRR(ctx, -30, cardY, 60, 28, 6, "rgba(34,197,94,0.28)", C.crmGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Лид #2841", 0, cardY + 12);
      ctx.font = "6px Inter,sans-serif";
      ctx.fillStyle = "#bbf7d0";
      ctx.fillText("VK → amoCRM", 0, cardY + 22);
    }
  };

  /* Подъём комментария VK — уникальный объект */
  function VkCommentLift() {
    this.liftY = 0;
  }
  VkCommentLift.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 20 || prg > 75) return;
    var t = (prg - 20) / 55;
    this.liftY = 70 - t * 95;
    drawRR(ctx, -168, this.liftY, 44, 22, 5, "rgba(81,129,184,0.2)", C.vk);
    ctx.fillStyle = "#dbeafe";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("«сколько стоит?»", -162, this.liftY + 13);
    if (prg > 50 && prg < 58) {
      ctx.strokeStyle = "rgba(167,139,250,0.8)";
      ctx.lineWidth = 1.5;
      ctx.setLineDash([3, 3]);
      ctx.beginPath();
      ctx.moveTo(-124, this.liftY + 5);
      ctx.lineTo(-55, -35);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = C.comment;
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.fillText("→ в ЛС", -95, this.liftY - 18);
    }
  };

  /* Дуга Telegram webhook */
  function TelegramWebhookArc() {
    this.pulse = 0;
  }
  TelegramWebhookArc.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    this.pulse = Math.sin(frame * 0.12) * 0.3 + 0.7;
    ctx.strokeStyle = "rgba(42,171,238," + (0.25 + this.pulse * 0.2) + ")";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(130, 15, 42, Math.PI * 0.55, Math.PI * 1.45);
    ctx.stroke();
    ctx.fillStyle = C.tg;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("webhook", 130, -8);
    if (prg > 30 && prg < 90) {
      var px = 130 + Math.cos(prg * 0.08) * 30;
      var py = 15 + Math.sin(prg * 0.08) * 22;
      ctx.fillStyle = C.tg;
      ctx.beginPath();
      ctx.moveTo(px, py);
      ctx.lineTo(px + 10, py + 4);
      ctx.lineTo(px + 2, py + 8);
      ctx.closePath();
      ctx.fill();
    }
  };

  /* Импульс handoff менеджеру — финал цикла */
  function ManagerHandoffPing() {
    this.radius = 0;
  }
  ManagerHandoffPing.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 210) return;
    var t = (prg - 210) / 35;
    this.radius = t * 55;
    ctx.strokeStyle = "rgba(34,197,94," + (0.85 - t * 0.75) + ")";
    ctx.lineWidth = 2.5;
    ctx.beginPath();
    ctx.arc(118, -72, 12 + this.radius, 0, Math.PI * 2);
    ctx.stroke();
    drawRR(ctx, 104, -82, 28, 18, 4, "rgba(34,197,94,0.2)", C.crmGreen);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("mgr", 118, -70);
    if (prg > 225 && prg < 230) {
      ctx.fillStyle = C.crmGreen;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.fillText("✓ 12 сек", 118, -95);
    }
  };

  /* Шкала квалификации */
  function QualificationGauge() {
    this.score = 0.4;
  }
  QualificationGauge.prototype.draw = function (ctx) {
    var prg = (frame * 0.038) % 260;
    if (prg < 70) this.score = 0.35 + (prg / 70) * 0.25;
    else if (prg < 140) this.score = 0.6 + ((prg - 70) / 70) * 0.28;
    else this.score = 0.92;
    drawRR(ctx, -175, -78, 58, 14, 4, "rgba(255,255,255,0.07)", C.outline);
    drawRR(ctx, -173, -76, 54 * this.score, 10, 3, C.hubViolet, null);
    ctx.fillStyle = "#ede9fe";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "left";
    ctx.fillText("intent " + Math.round(this.score * 100) + "%", -172, -66);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
  }

  Agent.prototype.draw = function (ctx) {
    this.timer += 0.03;
    var prg = (frame * 0.038) % 260;
    var isMoving = false;
    var faceDir = 1;
    var carryType = null;

    /* Агенты идут к боковым мониторам каналов — другая геометрия */
    var monitorTargets = {
      "1_architect": { x: -115, y: 72 },
      "2_seo": { x: -55, y: 82 },
      "3_coder": { x: 55, y: 82 },
      "4_designer": { x: 115, y: 72 },
      "5_deployer": { x: 0, y: 92 }
    };
    var tgt = monitorTargets[this.role] || { x: 0, y: 80 };

    if (prg >= this.stepTrig && prg < this.stepTrig + 24) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        this.x = this.baseX + (tgt.x - this.baseX) * (local / 12);
        this.y = this.baseY + (tgt.y - this.baseY) * (local / 12);
      } else if (local < 17) {
        this.x = tgt.x; this.y = tgt.y;
      } else {
        isMoving = true;
        faceDir = -1;
        this.x = tgt.x - (tgt.x - this.baseX) * ((local - 17) / 7);
        this.y = tgt.y - (tgt.y - this.baseY) * ((local - 17) / 7);
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
      carryType = prg >= this.stepTrig - 10 ? this.color : null;
    }

    if (!isMoving && frame % 240 === 0 && Math.random() < 0.14) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 230);
    }

    var bob = Math.sin(this.timer * 1.5) * 1.2;
    ctx.save();
    ctx.translate(this.x, this.y);
    var legL = 0, legR = 0;
    if (isMoving) {
      var wp = this.timer * 6;
      legL = Math.sin(wp) * 4;
      legR = Math.sin(wp + Math.PI) * 4;
    }
    drawRR(ctx, -8, -4 + Math.max(0, legL), 7, 12, 2, C.outline, null);
    drawRR(ctx, 0, -4 + Math.max(0, legR), 7, 12, 2, C.outline, null);
    drawRR(ctx, -12, -10 - bob, 24, 16, 5, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -22 - bob, 9, 0, Math.PI * 2);
    ctx.fill();
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    if (carryType) drawRR(ctx, -16, -16 - bob, 12, 12, 2, carryType, C.outline);
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  var ribbons = new ChannelRibbonCables();
  var router = new SocialLeadRouter();
  var vkLift = new VkCommentLift();
  var tgArc = new TelegramWebhookArc();
  var gauge = new QualificationGauge();
  var handoff = new ManagerHandoffPing();

  entities.push(ribbons);
  entities.push(vkLift);
  entities.push(tgArc);
  entities.push(gauge);
  entities.push(router);
  entities.push(handoff);
  entities.push(new Agent(-150, 98, C.agentYellow, "1_architect", 20, [
    "Схема VK Callback готова", "Три входа в воронку", "wall_reply_new настроен"
  ]));
  entities.push(new Agent(-75, 108, C.agentGreen, "2_seo", 68, [
    "Коммент = коммерция!", "Интент: запись на замер", "VK + Telegram LSI"
  ]));
  entities.push(new Agent(0, 110, C.agentBlue, "3_coder", 116, [
    "Webhook Telegram OK", "message_new → n8n", "Классификатор 0.94"
  ]));
  entities.push(new Agent(75, 108, C.agentPink, "4_designer", 164, [
    "Теги источника в CRM", "Поля квалификации", "amoCRM карточка"
  ]));
  entities.push(new Agent(150, 98, C.agentPurple, "5_deployer", 212, [
    "Лид #2841 создан", "Менеджер уведомлён", "12 сек до CRM"
  ]));

  function createBubble(x, y, text, life) {
    bubbles.push({ x: x, y: y, text: text, life: life || 250, maxLife: life || 250 });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    entities.sort(function (a, b) { return (a.y || 0) - (b.y || 0); });
    entities.forEach(function (e) { e.draw(ctx); });

    var prg = (frame * 0.038) % 260;
    if (prg >= 18 && prg < 18.05) createBubble(-120, -30, "VK: комментарий под постом");
    if (prg >= 72 && prg < 72.05) createBubble(90, 10, "Telegram: свободный текст");
    if (prg >= 118 && prg < 118.05) createBubble(-20, -20, "AI: коммерция 0.91");
    if (prg >= 168 && prg < 168.05) createBubble(10, 35, "Бюджет и гео собраны");
    if (prg >= 218 && prg < 218.05) createBubble(100, -50, "Лид в amoCRM · handoff");

    ctx.font = "bold 10px Inter,sans-serif";
    ctx.textAlign = "center";
    for (var i = bubbles.length - 1; i >= 0; i--) {
      var b = bubbles[i];
      b.life--;
      if (b.life <= 0) { bubbles.splice(i, 1); continue; }
      var alpha = Math.min(1, b.life / 25);
      ctx.globalAlpha = alpha;
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 5, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.fillText(b.text, b.x, b.y - 11);
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
document.querySelectorAll('[data-vnz-faq] .vnz-faq-q').forEach(function(q){
  q.addEventListener('click', function(){
    var item = q.closest('.vnz-faq-item');
    if(item) item.classList.toggle('open');
  });
  q.addEventListener('keydown', function(e){
    if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); q.click(); }
  });
});
</script>

<script>
(function(){
  'use strict';
  var root = document.querySelector('.vnz-content');
  if(!root) return;
  var items = root.querySelectorAll('.nero-ai-reveal');
  if('IntersectionObserver' in window){
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add('nero-ai-active');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
    items.forEach(function(item){ observer.observe(item); });
  } else {
    items.forEach(function(item){ item.classList.add('nero-ai-active'); });
  }
})();
</script>

<?php
$vnz_page_url = trailingslashit( get_permalink() );
$vnz_site_url = trailingslashit( home_url( '/' ) );
$vnz_brand    = get_bloginfo( 'name' ) ?: 'Nero Network';
$vnz_schema   = [
  '@context' => 'https://schema.org',
  '@graph'   => [
    [
      '@type' => 'Organization',
      '@id'   => $vnz_site_url . '#organization',
      'name'  => $vnz_brand,
      'url'   => $vnz_site_url,
    ],
    [
      '@type'     => 'WebSite',
      '@id'       => $vnz_site_url . '#website',
      'url'       => $vnz_site_url,
      'name'      => $vnz_brand,
      'publisher' => [ '@id' => $vnz_site_url . '#organization' ],
    ],
    [
      '@type'       => 'WebPage',
      '@id'         => $vnz_page_url . '#webpage',
      'url'         => $vnz_page_url,
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'isPartOf'    => [ '@id' => $vnz_site_url . '#website' ],
      'about'       => [ '@id' => $vnz_site_url . '#organization' ],
    ],
    [
      '@type' => 'BreadcrumbList',
      '@id'   => $vnz_page_url . '#breadcrumb',
      'itemListElement' => [
        [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $vnz_site_url ],
        [ '@type' => 'ListItem', 'position' => 2, 'name' => $page_seo_title, 'item' => $vnz_page_url ],
      ],
    ],
    [
      '@type'       => 'Service',
      '@id'         => $vnz_page_url . '#service',
      'name'        => $page_seo_title,
      'description' => $page_seo_description,
      'url'         => $vnz_page_url,
      'provider'    => [ '@id' => $vnz_site_url . '#organization' ],
    ],
    [
      '@type' => 'FAQPage',
      '@id'   => $vnz_page_url . '#faq',
      'mainEntity' => [
        [
          '@type' => 'Question',
          'name'  => 'Как внедрить без потери качества диалога?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'RAG по базе знаний, тон бренда, handoff человеку. AI — первая линия; человек закрывает сделку.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Нужна ли CRM?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Да, если считаете лиды. Поддерживаются amoCRM и Битрикс24; омниканалы — по согласованию.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Юридические ограничения VK и Telegram?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => '152-ФЗ: согласие на ПДн до сбора телефона. Без спама; автоответы в комментариях — уместно, не флуд.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Чем отличается от Senler / Salebot?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Senler/Salebot — рассылки и воронки. AI-агент Nero — квалификация входящих в свободной форме и передача в CRM.',
          ],
        ],
        [
          '@type' => 'Question',
          'name'  => 'Сколько занимает внедрение?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Аудит — 7 дней. Разработка — обычно 2–4 недели для VK + Telegram + amoCRM/Битрикс24.',
          ],
        ],
      ],
    ],
  ],
];
echo '<script type="application/ld+json">' . wp_json_encode( $vnz_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
?>

</main>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
