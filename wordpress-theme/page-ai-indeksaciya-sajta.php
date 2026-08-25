<?php
/**
 * Template Name: AI-агент контроля индексации сайта — внедрение под ключ
 * Description: AI-агент ежедневно проверяет публикацию, sitemap, robots и статус индексации страниц.
 */

declare(strict_types=1);

$page_seo_title       = 'AI-агент контроля индексации сайта — внедрение под ключ';
$page_seo_description = 'AI-агент ежедневно проверяет публикацию, sitemap, robots и статус индексации страниц. Внедрение под ключ для SEO-проектов и агентств. Бесплатный аудит 20 URL.';

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
    ['label' => 'Проблема', 'href' => '#pochemu-ne-v-indekse'],
    ['label' => 'Как работает', 'href' => '#chto-delaet-agent'],
    ['label' => 'Внедрение', 'href' => '#vnedrenie'],
    ['label' => 'Чек-лист', 'href' => '#checklist-indeksaciya'],
    ['label' => 'Стоимость', 'href' => '#ceny'],
    ['label' => 'FAQ', 'href' => '#faq'],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if (!is_readable($nero_ai_bootstrap)) {
    $nero_ai_bootstrap = dirname(__DIR__) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label   = getenv('PRIMARY_CTA_LABEL') ?: 'Проверить индексацию';
$primary_cta_url     = nero_ai_primary_cta_url();
$primary_cta_attrs   = nero_ai_primary_cta_link_attrs($primary_cta_url);
$secondary_cta_label = 'Как работает агент';
$secondary_cta_url   = '#chto-delaet-agent';
$secondary_link_url  = getenv('SECONDARY_CTA_URL') ?: '';
$secondary_link_label = getenv('SECONDARY_CTA_LABEL') ?: 'Материалы по AI';

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
.yoast-breadcrumb,.entry-header,.page-title-section { display: none !important; }

#primary,.site-main,.site-content,#content,.content-area {
  padding-top: 0 !important; margin-top: 0 !important;
}

.idx-content {
  --idx-bg: #050711; --idx-bg2: #080b17;
  --idx-text: #e6edf7; --idx-muted: #9aa8bd; --idx-soft: #c7d2e5; --idx-heading: #fff;
  --idx-border: rgba(255,255,255,.10); --idx-accent: #79f2ff; --idx-violet: #8b5cf6;
  --idx-green: #22c55e; --idx-danger: #fb7185; --idx-amber: #fbbf24;
  --idx-btn-from: #2563eb; --idx-btn-to: #7c3aed;
  --idx-container: 1160px;
  background: linear-gradient(180deg, #050711 0%, #080b17 52%, #050711 100%);
  color: var(--idx-text);
  font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  overflow-x: hidden;
}
.idx-content *, .idx-content *::before, .idx-content *::after { box-sizing: border-box; }
.idx-content a { color: inherit; }
.idx-content p { color: var(--idx-muted); line-height: 1.72; margin: 0 0 1em; }
.idx-content p:last-child { margin-bottom: 0; }
.idx-content h2, .idx-content h3, .idx-content h4 { color: var(--idx-heading); letter-spacing: -.04em; margin: 0 0 .7em; }
.idx-content strong { color: var(--idx-soft); }
.idx-content ul { padding-left: 0; list-style: none; margin: 0 0 1em; }
.idx-content ul li {
  padding-left: 20px; position: relative; margin-bottom: .45em;
  color: var(--idx-muted); font-size: 14.5px; line-height: 1.65;
}
.idx-content ul li::before { content: '›'; position: absolute; left: 0; color: var(--idx-accent); font-weight: 700; }

.idx-cnt { width: min(var(--idx-container), calc(100% - 40px)); margin: 0 auto; position: relative; z-index: 1; }
.idx-section { padding: clamp(56px, 7vw, 96px) 0; position: relative; }
.idx-section-alt {
  background: linear-gradient(180deg, rgba(255,255,255,.032), rgba(255,255,255,.01));
  border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06);
}
.idx-sh { max-width: 820px; margin: 0 auto 40px; text-align: center; }
.idx-sh.idx-left { margin-left: 0; text-align: left; }
.idx-sh h2 { font-size: clamp(26px, 3.8vw, 44px); line-height: 1.08; margin-bottom: 14px; }
.idx-sh p { font-size: clamp(15px, 1.6vw, 18px); max-width: 680px; margin: 0 auto; }
.idx-sh.idx-left p { margin-left: 0; }
.idx-eyebrow {
  display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; border-radius: 999px;
  background: rgba(121,242,255,.08); border: 1px solid rgba(121,242,255,.22);
  font-size: 11.5px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
  color: var(--idx-accent); margin-bottom: 14px;
}

.idx-intro { padding: clamp(40px, 5vw, 72px) 0 clamp(36px, 4vw, 56px); border-bottom: 1px solid rgba(255,255,255,.06); }
.idx-intro-grid { display: grid; grid-template-columns: minmax(0, 1fr) 320px; gap: 48px; align-items: start; }
.idx-intro-text { position: relative; padding-left: 20px; text-align: left !important; }
.idx-intro-text::before {
  content: ''; position: absolute; left: 0; top: 4px; bottom: 4px; width: 3px; border-radius: 2px;
  background: linear-gradient(180deg, var(--idx-accent), var(--idx-violet));
}
.idx-intro-text p { text-align: left !important; font-size: clamp(14.5px, 1.55vw, 16.5px); line-height: 1.8; }
.idx-intro-deco {
  display: grid; gap: 10px; padding: 18px; border-radius: 18px;
  background: rgba(255,255,255,.05); border: 1px solid rgba(121,242,255,.18);
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 12px;
}
.idx-intro-deco .row { display: flex; justify-content: space-between; gap: 12px; color: var(--idx-muted); }
.idx-intro-deco .row strong { color: var(--idx-accent); font-weight: 700; }
.idx-chip-row { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
.idx-chip {
  padding: 6px 11px; border-radius: 999px; font-size: 11px; font-weight: 700;
  background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.12); color: var(--idx-soft);
}
@media (max-width: 900px) { .idx-intro-grid { grid-template-columns: 1fr; } }

.idx-toc-outer { padding: 0 0 clamp(32px, 4vw, 48px); }
.idx-toc, .ym-toc {
  display: flex; flex-wrap: wrap; gap: 9px; justify-content: center;
}
.idx-toc a, .ym-toc a {
  display: inline-block; padding: 9px 18px; background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1); border-radius: 999px;
  font-size: 13px; font-weight: 600; color: var(--idx-muted); text-decoration: none !important;
  transition: border-color .2s, color .2s, background .2s;
}
.idx-toc a:hover, .ym-toc a:hover {
  border-color: rgba(121,242,255,.42); color: var(--idx-accent); background: rgba(121,242,255,.08);
}

.idx-card {
  background: linear-gradient(180deg, rgba(255,255,255,.085), rgba(255,255,255,.042));
  border: 1px solid var(--idx-border); border-radius: 20px; padding: 24px;
  backdrop-filter: blur(16px); box-shadow: 0 14px 40px rgba(0,0,0,.22);
}
.idx-card--cyan { border-color: rgba(121,242,255,.35); }
.idx-table-wrap { overflow-x: auto; border-radius: 14px; border: 1px solid rgba(255,255,255,.09); margin: 20px 0; }
.idx-table { width: 100%; border-collapse: collapse; font-size: 14px; }
.idx-table th {
  padding: 12px 16px; text-align: left; background: rgba(121,242,255,.1);
  color: var(--idx-accent); font-weight: 700; border-bottom: 1px solid rgba(121,242,255,.25);
}
.idx-table td { padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,.05); color: var(--idx-text); vertical-align: top; }
.idx-table tr:last-child td { border-bottom: none; }

.idx-stat-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 28px 0; }
.idx-stat {
  padding: 22px; border-radius: 16px; text-align: center;
  background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);
}
.idx-stat .num { font-size: clamp(28px, 4vw, 40px); font-weight: 900; color: var(--idx-danger); line-height: 1; }
.idx-stat .lbl { font-size: 13px; color: var(--idx-muted); margin-top: 8px; line-height: 1.5; }
@media (max-width: 600px) { .idx-stat-row { grid-template-columns: 1fr; } }

.idx-pipeline {
  display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 10px; margin: 24px 0;
}
.idx-pipeline .step {
  padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 700;
  background: rgba(121,242,255,.1); border: 1px solid rgba(121,242,255,.25); color: var(--idx-soft);
}
.idx-pipeline .arrow { color: var(--idx-accent); font-weight: 800; }

.idx-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.idx-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
@media (max-width: 768px) { .idx-grid-2, .idx-grid-3 { grid-template-columns: 1fr; } }
@media (max-width: 960px) { .idx-grid-3 { grid-template-columns: 1fr 1fr; } }

.idx-checklist { display: grid; gap: 10px; margin: 20px 0; }
.idx-check {
  display: flex; align-items: flex-start; gap: 12px; padding: 12px 14px;
  background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08); border-radius: 12px;
  font-size: 14px; color: var(--idx-muted);
}
.idx-check::before { content: '☐'; color: var(--idx-accent); font-weight: 800; flex-shrink: 0; }

.idx-badge-p1, .idx-badge-p2, .idx-badge-p3 {
  display: inline-block; padding: 3px 9px; border-radius: 6px; font-size: 11px; font-weight: 800;
}
.idx-badge-p1 { background: rgba(251,113,133,.15); color: #fecdd3; }
.idx-badge-p2 { background: rgba(251,191,36,.15); color: #fde68a; }
.idx-badge-p3 { background: rgba(34,197,94,.12); color: #bbf7d0; }

.idx-price-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
@media (max-width: 700px) { .idx-price-grid { grid-template-columns: 1fr; } }
.idx-price-card {
  padding: 26px; border-radius: 20px; background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.1);
}
.idx-price-card.featured { border-color: rgba(121,242,255,.4); background: rgba(121,242,255,.07); }
.idx-price-card .amount { font-size: clamp(22px, 3vw, 30px); font-weight: 900; color: #fff; margin: 10px 0; }

.idx-case-card {
  padding: 22px; border-radius: 18px; background: rgba(255,255,255,.05);
  border: 1px solid rgba(255,255,255,.09);
}
.idx-case-tag { font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--idx-green); margin-bottom: 8px; }

.idx-faq { display: flex; flex-direction: column; gap: 10px; max-width: 820px; margin: 0 auto; }
.idx-faq-item { background: rgba(255,255,255,.055); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; overflow: hidden; }
.idx-faq-q {
  padding: 18px 22px; font-size: 16px; font-weight: 700; color: var(--idx-heading);
  cursor: pointer; display: flex; align-items: center; justify-content: space-between; gap: 16px;
}
.idx-faq-q::after { content: '▾'; color: var(--idx-accent); transition: transform .25s; }
.idx-faq-item.open .idx-faq-q::after { transform: rotate(180deg); }
.idx-faq-a { padding: 0 22px; max-height: 0; overflow: hidden; transition: max-height .38s ease, padding .25s; font-size: 14.5px; color: var(--idx-muted); line-height: 1.72; }
.idx-faq-item.open .idx-faq-a { max-height: 600px; padding: 0 22px 18px; }

.ym-cta-block {
  border-radius: 20px; padding: 36px 40px; margin: 32px 0;
  background: linear-gradient(135deg, rgba(121,242,255,.12), rgba(139,92,246,.1));
  border: 1px solid rgba(121,242,255,.3); text-align: center;
}
.ym-cta-block--secondary {
  background: linear-gradient(135deg, rgba(34,197,94,.08), rgba(121,242,255,.08));
  border-color: rgba(34,197,94,.28); text-align: left;
}
.ym-cta-block--footer-final {
  background: linear-gradient(135deg, rgba(139,92,246,.12), rgba(121,242,255,.08));
  border-color: rgba(139,92,246,.3);
}
.ym-cta-block__icon { font-size: 36px; margin-bottom: 14px; }
.ym-cta-block__headline { font-size: clamp(20px, 2.8vw, 28px); font-weight: 800; color: #fff; margin: 0 0 10px; }
.ym-cta-block__sub { color: var(--idx-muted); font-size: 15px; margin: 0 auto 22px; max-width: 640px; line-height: 1.7; }
.ym-cta-block--secondary .ym-cta-block__sub { margin-left: 0; }
.ym-link--accent { color: var(--idx-accent) !important; text-decoration: underline !important; }
.ym-btn--accent, .nero-ai-home-page .ym-btn--accent {
  background: linear-gradient(135deg, var(--idx-btn-from), var(--idx-btn-to)); color: #fff !important;
  box-shadow: 0 8px 32px rgba(59,130,246,.35);
}
@media (max-width: 600px) { .ym-cta-block { padding: 28px 20px; } }

.nero-ai-reveal { opacity: 0; transform: translateY(22px); transition: opacity .55s ease, transform .55s ease; }
.nero-ai-reveal.nero-ai-active { opacity: 1; transform: none; }
</style>

<main id="primary" class="site-main nero-ai-home-page ai-indeksaciya-sajta-page" role="main" tabindex="-1">

<section class="nero-ai-hero idx-indeksaciya-hero" id="hero" aria-labelledby="idx-hero-title">
<style>
/* ── Hero ai-indeksaciya-sajta: самодостаточные стили (канон meta-journal.ru) ── */
.idx-indeksaciya-hero {
  --idx-cyan: #79f2ff;
  --idx-violet: #8b5cf6;
  --idx-green: #22c55e;
  --idx-danger: #fb7185;
  --idx-amber: #fbbf24;
  --idx-text: #e6edf7;
  --idx-muted: #9aa8bd;
  --idx-soft: #c7d2e5;
  --idx-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.idx-indeksaciya-hero::before {
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
.idx-indeksaciya-hero::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 16%;
  width: 820px;
  height: 820px;
  transform: translateX(-50%);
  border-radius: 999px;
  background: radial-gradient(circle, rgba(121, 242, 255, .12), transparent 66%);
  filter: blur(6px);
  animation: idxHeroGlow 8s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes idxHeroGlow {
  from { opacity: .45; transform: translateX(-50%) scale(.96); }
  to { opacity: .86; transform: translateX(-50%) scale(1.06); }
}
.idx-indeksaciya-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.idx-indeksaciya-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.idx-indeksaciya-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 780px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.idx-indeksaciya-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--idx-cyan) 44%, var(--idx-violet) 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.idx-indeksaciya-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--idx-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.idx-indeksaciya-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--idx-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.idx-indeksaciya-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.idx-indeksaciya-hero .nero-ai-badge {
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
.idx-indeksaciya-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.idx-indeksaciya-hero .nero-ai-btn {
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
.idx-indeksaciya-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.idx-indeksaciya-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--idx-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.idx-indeksaciya-hero .nero-ai-btn-secondary {
  color: var(--idx-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.idx-indeksaciya-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--idx-shadow);
  transform: perspective(1100px) rotateY(-3deg) rotateX(2deg);
}
.idx-indeksaciya-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.idx-indeksaciya-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.idx-indeksaciya-hero .nero-ai-dots { display: flex; gap: 7px; }
.idx-indeksaciya-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.idx-indeksaciya-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.idx-indeksaciya-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.idx-indeksaciya-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.idx-indeksaciya-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.idx-indeksaciya-hero .nero-ai-window-body { padding: 16px; }
.idx-indeksaciya-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 12px;
}
.idx-indeksaciya-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.idx-indeksaciya-hero .nero-ai-live-pill {
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
.idx-indeksaciya-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: idxPulse 1.6s infinite;
}
@keyframes idxPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.idx-indeksaciya-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.idx-indeksaciya-hero .nero-ai-metric {
  padding: 12px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 16px;
  background: rgba(255,255,255,.055);
}
.idx-indeksaciya-hero .nero-ai-metric span {
  display: block;
  color: var(--idx-muted);
  font-size: 11px;
  font-weight: 700;
}
.idx-indeksaciya-hero .nero-ai-metric strong {
  display: block;
  margin-top: 6px;
  color: #fff;
  font-size: 22px;
  line-height: 1;
}
.idx-indeksaciya-hero .nero-ai-metric small {
  display: block;
  margin-top: 4px;
  color: #9fb0c9;
  font-size: 10px;
}
.idx-indeksaciya-hero .nero-ai-metric--danger strong { color: var(--idx-danger); }
.idx-indeksaciya-hero .idx-dash-canvas-wrap {
  position: relative;
  margin-top: 12px;
  height: 200px;
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(121, 242, 255, 0.14);
  background: radial-gradient(circle at 50% 40%, rgba(121, 242, 255, 0.06), rgba(2, 6, 23, 0.9));
}
.idx-indeksaciya-hero #idx-indeksaciya-hero-canvas {
  display: block;
  width: 100%;
  height: 100%;
}
.idx-indeksaciya-hero .nero-ai-task-stream {
  margin-top: 12px;
  display: grid;
  gap: 8px;
}
.idx-indeksaciya-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
  font-size: 12px;
}
.idx-indeksaciya-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(121,242,255,.12);
  color: var(--idx-cyan);
  font-size: 11px;
  font-weight: 800;
}
.idx-indeksaciya-hero .nero-ai-task strong { display: block; color: #f8fafc; font-size: 12px; }
.idx-indeksaciya-hero .nero-ai-task span { color: var(--idx-muted); font-size: 11px; }
.idx-indeksaciya-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.idx-indeksaciya-hero .nero-ai-status--warn {
  background: rgba(251, 191, 36, .12);
  color: #fde68a;
}
.idx-indeksaciya-hero .nero-ai-status--danger {
  background: rgba(251, 113, 133, .12);
  color: #fecdd3;
}
@media (max-width: 960px) {
  .idx-indeksaciya-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .idx-indeksaciya-hero .nero-ai-dashboard { transform: none; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy nero-ai-reveal">
      <p class="nero-ai-eyebrow"><?php echo esc_html($brand); ?> · AI-индексация и SEO-контроль</p>
      <h1 id="idx-hero-title">AI-агент контроля <span class="nero-ai-gradient-text">индексации сайта</span>: внедрение под ключ</h1>
      <p class="nero-ai-hero-lead">Страницы публикуются — но не попадают в индекс? AI-агент ежедневно проверяет публикацию, sitemap, robots и статус индексации, чтобы вы не теряли трафик из-за незамеченных ошибок</p>
      <ul class="nero-ai-badges" aria-label="Контрольные точки">
        <li class="nero-ai-badge">GSC</li>
        <li class="nero-ai-badge">Яндекс.Вебмастер</li>
        <li class="nero-ai-badge">Sitemap</li>
        <li class="nero-ai-badge">Robots</li>
        <li class="nero-ai-badge">IndexNow</li>
        <li class="nero-ai-badge">Telegram-алерты</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>>Проверить индексацию</a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#chto-delaet-agent">Как работает агент</a>
      </div>
    </div>

    <div class="nero-ai-dashboard nero-ai-reveal nero-ai-delay-2" aria-label="Демо: Indexing Control Center">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">Indexing Control Center · демо</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>Indexing Control Center</h3>
            <span class="nero-ai-live-pill">онлайн</span>
          </div>
          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric"><span>URL в мониторинге</span><strong>847</strong><small>реестр CMS</small></div>
            <div class="nero-ai-metric nero-ai-metric--danger"><span>Не в индексе</span><strong>14</strong><small>P1/P2</small></div>
            <div class="nero-ai-metric"><span>Проверено сегодня</span><strong>312</strong><small>daily job</small></div>
            <div class="nero-ai-metric"><span>Алертов P1</span><strong>3</strong><small>Telegram</small></div>
          </div>
          <div class="idx-dash-canvas-wrap" aria-hidden="false">
            <canvas id="idx-indeksaciya-hero-canvas" role="img" aria-label="Анимация: URL-пакеты по орбитам проходят robots, sitemap-радар и IndexNow — статус индексации обновляется"></canvas>
          </div>
          <div class="nero-ai-task-stream" aria-label="Лента событий индексации">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">GH</span>
              <div><strong>Ghost URL</strong><span>в sitemap нет, в CMS есть</span></div>
              <span class="nero-ai-status nero-ai-status--warn">P2</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">NX</span>
              <div><strong>noindex</strong><span>на шаблоне категории</span></div>
              <span class="nero-ai-status nero-ai-status--danger">P1</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">GSC</span>
              <div><strong>Discovered not indexed</strong><span>14 URL за 28 дней</span></div>
              <span class="nero-ai-status nero-ai-status--warn">очередь</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">72h</span>
              <div><strong>Re-check</strong><span>после IndexNow</span></div>
              <span class="nero-ai-status">запланирован</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="idx-content">

  <section class="idx-intro ym-section" id="intro" aria-label="Введение">
    <div class="idx-cnt">
      <div class="idx-intro-grid nero-ai-reveal">
        <div class="idx-intro-text">
          <p class="idx-eyebrow">Коротко</p>
          <p><strong>AI-агент контроля индексации</strong> — task-specific автоматизация, которая ежедневно сверяет опубликованные URL с sitemap, robots, Google Search Console и Яндекс.Вебмастером и присылает алерт, если страница не попала в индекс. Nero Network внедряет такой агент под ключ за 2–4 недели; стартовый шаг — бесплатный аудит 20 страниц.</p>
          <p>Прежде чем говорить об <strong>ai индексации сайта</strong>, важно развести два разных смысла слова «индексация». На рынке их часто путают — и именно здесь Nero Network предлагает понятный, технически точный оффер.</p>
          <!-- INTERNAL-LINKS:INSERT -->
        </div>
        <div class="idx-intro-deco" aria-label="Пайплайн мониторинга">
          <div class="row"><span>daily_job</span><strong>running</strong></div>
          <div class="row"><span>URL registry</span><strong>847</strong></div>
          <div class="row"><span>GSC + Вебмастер</span><strong>sync</strong></div>
          <div class="row"><span>alerts P1</span><strong>3</strong></div>
          <div class="idx-chip-row">
            <span class="idx-chip">sitemap diff</span>
            <span class="idx-chip">robots</span>
            <span class="idx-chip">IndexNow</span>
            <span class="idx-chip">re-check 72h</span>
          </div>
        </div>
      </div>

      <div class="idx-card idx-card--cyan nero-ai-reveal" style="margin-top:36px;">
        <div class="idx-table-wrap">
          <table class="idx-table">
            <thead>
              <tr>
                <th>Критерий</th>
                <th>Поисковая индексация (Google / Яндекс)</th>
                <th>RAG-индексация для AI-чата на сайте</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Цель</td><td>Попадание URL в поисковую выдачу и AI Overviews</td><td>Векторный поиск по базе знаний для чат-бота</td></tr>
              <tr><td>Где проверять</td><td>GSC, Яндекс.Вебмастер, sitemap, robots</td><td>Векторная БД, embeddings, панель чат-сервиса</td></tr>
              <tr><td>Типичный продукт</td><td>SEO-агент, краулер, IndexNow</td><td>SendyChat, RAG-платформы</td></tr>
              <tr><td>Боль клиента</td><td>«Страница опубликована, но не в индексе»</td><td>«Бот не находит ответ в документах»</td></tr>
              <tr><td>Что делает Nero Network</td><td>AI-агент контроля публикации, sitemap и индексации</td><td>Отдельные проекты (не эта страница)</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px; text-align:left; max-width:900px;">Когда в запросе звучит <strong>ai индексация сайта</strong>, речь идёт о первом столбце: о том, чтобы контент реально появился в Google и Яндексе — и только потом мог цитироваться в нейроответах. Без этого GEO и продвижение в ChatGPT/Алисе бессмысленны.</p>
      <p class="nero-ai-reveal" style="text-align:left; max-width:900px;">Страницы создаются каждый день — лонгриды, категории, лендинги A/B-тестов, карточки. Но <strong>никто системно не контролирует</strong>, попали ли они в индекс. Трафик уходит молча. <strong>AI проверка индексации</strong> закрывает эту слепую зону: не раз в квартал при аудите, а по расписанию, с приоритетами и алертами.</p>
    </div>
  </section>

  <div class="idx-toc-outer">
    <div class="idx-cnt">
      <nav class="ym-toc idx-toc" aria-label="Оглавление статьи">
        <a href="#pochemu-ne-v-indekse">Проблема</a>
        <a href="#chto-delaet-agent">Как работает</a>
        <a href="#task-specific">Task-specific</a>
        <a href="#dlya-kogo">Для кого</a>
        <a href="#vnedrenie">Внедрение</a>
        <a href="#checklist-indeksaciya">Чек-лист</a>
        <a href="#ceny">Стоимость</a>
        <a href="#keisy">Кейсы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="idx-section" id="pochemu-ne-v-indekse" aria-labelledby="idx-h2-pochemu">
    <div class="idx-cnt">
      <div class="idx-sh idx-left nero-ai-reveal">
        <span class="idx-eyebrow">Боль</span>
        <h2 id="idx-h2-pochemu">Почему страницы публикуются, но не попадают в индекс</h2>
        <p><strong>Определение:</strong> неиндексированная страница — URL, который отдаёт контент пользователю (HTTP 200), но отсутствует в индексе Google и/или Яндекса либо исключён из него по технической или качественной причине.</p>
      </div>

      <div class="idx-stat-row nero-ai-reveal">
        <div class="idx-stat"><div class="num">37%</div><div class="lbl">страниц проиндексировано в Google (Botify, 16 млн URL)</div></div>
        <div class="idx-stat"><div class="num">51%</div><div class="lbl">контента не обходит Googlebot на enterprise-сайтах 1M+ URL</div></div>
      </div>

      <div class="idx-card nero-ai-reveal">
        <h3>Типовые причины: robots, noindex, canonical, дубли</h3>
        <p>Яндекс.Вебмастер перечисляет официальные причины исключения страниц: запрет в robots.txt (Disallow), директива noindex, не-канонический URL, HTTP-ошибки, дубли.</p>
        <ul>
          <li>На staging случайно остался <code>noindex</code>, и шаблон уехал в production.</li>
          <li>Canonical указывает на старую версию URL после миграции CMS.</li>
          <li>Фильтры каталога генерируют тысячи дублей; краулер тратит бюджет не на важные страницы.</li>
          <li>Редирект 302 вместо 301 — поисковик не передаёт сигнал на целевой URL.</li>
        </ul>
      </div>

      <div class="idx-card nero-ai-reveal" style="margin-top:18px;">
        <h3>Пробелы в sitemap и crawl budget</h3>
        <ul>
          <li><strong>Ghost URL</strong> — страница опубликована в CMS, но не добавлена в sitemap.xml.</li>
          <li><strong>Orphan URL</strong> — URL есть в sitemap, но отдаёт 404 или редирект в никуда.</li>
          <li><strong>Устаревший lastmod</strong> — поисковик считает контент неактуальным.</li>
          <li><strong>Раздутый sitemap</strong> — десятки тысяч малозначимых URL отвлекают crawl budget.</li>
        </ul>
      </div>

      <div class="idx-card nero-ai-reveal" style="margin-top:18px;">
        <h3>Когда команда узнаёт об ошибке слишком поздно</h3>
        <p>Ручной мониторинг Google Search Console раз в неделю не масштабируется. SEO-специалист видит сотни статусов Discovered — currently not indexed — когда новый лонгрид уже неделю не приносил органику. <strong>Слепые зоны</strong> — главная боль: контент выходит, а URL так и не попал в индекс. Именно здесь нужен <strong>ai indexator</strong> — ежедневный контроль с эскалацией.</p>
      </div>
    </div>
  </section>

<section id="ai-indeksaciya-sajta-boris-block" class="bis-root" aria-label="Анимация: diff sitemap и статусов индексации — Ghost URL, Orphan и Discovered not indexed">
<style>
/* === БОРИС: prefix bis-, scoped внутри #ai-indeksaciya-sajta-boris-block === */
#ai-indeksaciya-sajta-boris-block.bis-root{
  padding:56px 0 64px;
  background:#f8fafc;
}
#ai-indeksaciya-sajta-boris-block .bis-cnt{
  max-width:1160px;
  margin:0 auto;
  padding:0 24px;
}
#ai-indeksaciya-sajta-boris-block .bis-card{
  display:grid;
  grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;
  overflow:hidden;
  background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-indeksaciya-sajta-boris-block .bis-card{
    grid-template-columns:1fr;
    min-height:auto;
  }
}
#ai-indeksaciya-sajta-boris-block .bis-lft{
  padding:40px 36px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-indeksaciya-sajta-boris-block .bis-lft{
    border-right:none;
    border-bottom:1px solid #e2e8f0;
    padding:32px 24px;
  }
}
#ai-indeksaciya-sajta-boris-block .bis-ey{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:11px;
  font-weight:700;
  letter-spacing:.12em;
  text-transform:uppercase;
  color:#0891b2;
  margin:0 0 14px;
}
#ai-indeksaciya-sajta-boris-block .bis-ey::before{
  content:'';
  width:18px;height:2px;
  background:#0891b2;
  border-radius:1px;
}
#ai-indeksaciya-sajta-boris-block .bis-h3{
  font-size:clamp(20px,2.4vw,26px);
  font-weight:800;
  color:#0f172a;
  line-height:1.28;
  margin:0 0 18px;
}
#ai-indeksaciya-sajta-boris-block .bis-ul{
  list-style:none;
  margin:0 0 22px;
  padding:0;
  display:flex;
  flex-direction:column;
  gap:9px;
}
#ai-indeksaciya-sajta-boris-block .bis-ul li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  font-size:14px;
  line-height:1.5;
  color:#334155;
}
#ai-indeksaciya-sajta-boris-block .bis-ic{
  flex-shrink:0;
  width:22px;height:22px;
  border-radius:50%;
  background:rgba(8,145,178,.1);
  display:flex;align-items:center;justify-content:center;
  font-size:11px;
  color:#0e7490;
  margin-top:1px;
  font-style:normal;
}
#ai-indeksaciya-sajta-boris-block .bis-pills{
  display:flex;
  flex-wrap:wrap;
  gap:8px;
  margin-bottom:18px;
}
#ai-indeksaciya-sajta-boris-block .bis-pl{
  padding:5px 12px;
  border-radius:99px;
  font-size:12px;
  font-weight:700;
  white-space:nowrap;
}
#ai-indeksaciya-sajta-boris-block .bis-pl-g{
  background:rgba(34,197,94,.08);
  color:#15803d;
  border:1.5px solid rgba(34,197,94,.22);
}
#ai-indeksaciya-sajta-boris-block .bis-pl-r{
  background:rgba(239,68,68,.08);
  color:#b91c1c;
  border:1.5px solid rgba(239,68,68,.22);
}
#ai-indeksaciya-sajta-boris-block .bis-pl-a{
  background:rgba(245,158,11,.08);
  color:#b45309;
  border:1.5px solid rgba(245,158,11,.22);
}
#ai-indeksaciya-sajta-boris-block .bis-foot{
  font-size:13px;
  color:#64748b;
  font-style:italic;
  margin:0;
}
#ai-indeksaciya-sajta-boris-block .bis-rgt{
  position:relative;
  background:linear-gradient(135deg,#ecfeff 0%,#e0f2fe 42%,#f0fdf4 100%);
  min-height:420px;
  overflow:hidden;
}
@media(max-width:1023px){
  #ai-indeksaciya-sajta-boris-block .bis-rgt{min-height:360px;}
}
#bis-index-diff-canvas{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  display:block;
}
</style>

<div class="bis-cnt">
  <div class="bis-card">

    <div class="bis-lft">
      <span class="bis-ey">Мост мониторинга</span>
      <h3 class="bis-h3">Sitemap ↔ индекс: где теряются URL до первого алерта</h3>
      <ul class="bis-ul">
        <li><span class="bis-ic">G</span><strong>Ghost URL</strong> — опубликовано в CMS, но нет в sitemap.xml</li>
        <li><span class="bis-ic">O</span><strong>Orphan URL</strong> — в sitemap, но 404 или редирект в никуда</li>
        <li><span class="bis-ic">D</span><strong>Discovered not indexed</strong> — в GSC есть, в индексе нет</li>
        <li><span class="bis-ic">↻</span>Ежедневный diff → приоритет P1–P3 → Telegram за сутки, не через неделю</li>
      </ul>
      <div class="bis-pills">
        <span class="bis-pl bis-pl-r">Ghost · 12 URL</span>
        <span class="bis-pl bis-pl-a">Discovered · 14</span>
        <span class="bis-pl bis-pl-g">Indexed · 847</span>
      </div>
      <p class="bis-foot">Дальше разберём, что делает AI-агент контроля индексации → <a href="#chto-delaet-agent">#chto-delaet-agent</a></p>
    </div>

    <div class="bis-rgt">
      <canvas
        id="bis-index-diff-canvas"
        aria-label="Анимация: URL из sitemap и CMS сверяются с индексом Google и Яндекса; расхождения подсвечиваются красным и жёлтым"
        role="img"
      ></canvas>
    </div>

  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bis-index-diff-canvas');
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
    ink:'#0f172a',
    muted:'#64748b',
    line:'rgba(8,145,178,.28)',
    sitemap:'#0ea5e9',
    cms:'#6366f1',
    gsc:'#4285f4',
    yandex:'#fc3f1d',
    ok:'#22c55e',
    warn:'#f59e0b',
    err:'#ef4444',
    scan:'#0891b2',
    scanGlow:'rgba(8,145,178,.22)',
    node:'#ffffff',
    nodeBdr:'#cbd5e1'
  };

  function rr(ctx,x,y,w,h,r,fill,stroke){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else ctx.rect(x,y,w,h);
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=1.5; ctx.stroke(); }
  }

  var urlNodes = [];
  var scanPulse = 0;

  function spawnNode(){
    var types = ['ghost','orphan','discovered','indexed','indexed','indexed'];
    var type = types[Math.floor(Math.random()*types.length)];
    var labels = {
      ghost:'/blog/new-post',
      orphan:'/old-landing',
      discovered:'/category/seo',
      indexed:'/services/ai'
    };
    urlNodes.push({
      type: type,
      label: labels[type] + (Math.floor(Math.random()*90)+10),
      x: W*0.08,
      y: H*0.22 + Math.random()*H*0.55,
      tx: 0, ty: 0,
      phase: 0,
      speed: 0.8 + Math.random()*0.5,
      alpha: 0
    });
  }

  function colorForType(t){
    if(t==='indexed') return C.ok;
    if(t==='ghost'||t==='orphan') return C.err;
    return C.warn;
  }

  function drawColumn(x, y, w, h, title, sub, color){
    rr(ctx,x,y,w,h,10,'rgba(255,255,255,.92)',color);
    ctx.fillStyle = color;
    ctx.font = 'bold 11px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.fillText(title, x+10, y+18);
    ctx.fillStyle = C.muted;
    ctx.font = '9px system-ui,sans-serif';
    ctx.fillText(sub, x+10, y+h-10);
  }

  function drawScanner(cx, cy, r, pulse){
    var g = ctx.createRadialGradient(cx,cy,0,cx,cy,r*2.2);
    g.addColorStop(0, C.scanGlow);
    g.addColorStop(1, 'rgba(8,145,178,0)');
    ctx.fillStyle = g;
    ctx.beginPath();
    ctx.arc(cx,cy,r*2,0,Math.PI*2);
    ctx.fill();

    rr(ctx,cx-r*0.55,cy-r*0.55,r*1.1,r*1.1,r*0.3,'#ecfeff',C.scan);
    ctx.fillStyle = C.scan;
    ctx.font = 'bold ' + Math.max(10,r*0.2) + 'px system-ui,sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('DIFF', cx, cy-2);
    ctx.font = Math.max(8,r*0.14) + 'px system-ui,sans-serif';
    ctx.fillStyle = C.muted;
    ctx.fillText('sitemap ↔ index', cx, cy+r*0.35);

    ctx.strokeStyle = C.scan;
    ctx.lineWidth = 2 + pulse*2;
    ctx.globalAlpha = 0.25 + pulse*0.35;
    ctx.beginPath();
    ctx.arc(cx,cy,r+8+pulse*10,0,Math.PI*2);
    ctx.stroke();
    ctx.globalAlpha = 1;

    /* sweep line */
    var ang = frame * 0.04;
    ctx.strokeStyle = 'rgba(8,145,178,.45)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(cx,cy);
    ctx.lineTo(cx + Math.cos(ang)*r*1.4, cy + Math.sin(ang)*r*1.4);
    ctx.stroke();
  }

  function drawUrlChip(n){
    var col = colorForType(n.type);
    var lw = Math.min(88, W*0.14);
    var lh = 20;
    ctx.globalAlpha = n.alpha;
    rr(ctx,n.x,n.y,lw,lh,5,C.node,col);
    ctx.fillStyle = col;
    ctx.font = '9px system-ui,sans-serif';
    ctx.textAlign = 'left';
    ctx.textBaseline = 'middle';
    var short = n.label.length > 14 ? n.label.slice(0,12)+'…' : n.label;
    ctx.fillText(short, n.x+6, n.y+lh/2);
    ctx.globalAlpha = 1;
  }

  var counts = {ghost:0,orphan:0,discovered:0,indexed:0};

  function tick(){
    frame++;
    scanPulse = 0.5 + 0.5*Math.sin(frame*0.07);
    if(frame % 70 === 0) spawnNode();

    ctx.clearRect(0,0,W,H);

    var colW = W*0.17;
    var colH = H*0.12;
    drawColumn(W*0.04, H*0.06, colW, colH, 'Sitemap', '847 URL', C.sitemap);
    drawColumn(W*0.04, H*0.22, colW, colH, 'CMS', 'publish hook', C.cms);
    drawColumn(W*0.78, H*0.08, colW, colH, 'Google', 'GSC API', C.gsc);
    drawColumn(W*0.78, H*0.24, colW, colH, 'Яндекс', 'Вебмастер', C.yandex);

    var hubX = W*0.48, hubY = H*0.52, hubR = Math.min(W,H)*0.08;
    drawScanner(hubX, hubY, hubR, scanPulse);

    ctx.strokeStyle = C.line;
    ctx.lineWidth = 1.5;
    ctx.setLineDash([5,4]);
    ctx.beginPath();
    ctx.moveTo(W*0.21, H*0.12);
    ctx.lineTo(hubX - hubR, hubY - hubR*0.5);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(W*0.21, H*0.28);
    ctx.lineTo(hubX - hubR, hubY);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR, hubY - hubR*0.3);
    ctx.lineTo(W*0.78, H*0.14);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(hubX + hubR, hubY + hubR*0.2);
    ctx.lineTo(W*0.78, H*0.30);
    ctx.stroke();
    ctx.setLineDash([]);

    var buckets = {
      ghost:   {x:W*0.72, y:H*0.58},
      orphan:  {x:W*0.72, y:H*0.68},
      discovered:{x:W*0.72, y:H*0.78},
      indexed: {x:W*0.72, y:H*0.88}
    };

    urlNodes = urlNodes.filter(function(n){
      n.phase += n.speed;
      n.alpha = Math.min(1, n.alpha + 0.04);
      if(n.phase < 80){
        n.x += n.speed*1.2;
      } else if(n.phase < 160){
        var dx = hubX - n.x, dy = hubY - n.y;
        n.x += dx*0.045;
        n.y += dy*0.045;
      } else if(n.phase < 240){
        var b = buckets[n.type];
        n.x += (b.x - n.x)*0.06;
        n.y += (b.y - n.y)*0.06;
      } else {
        counts[n.type]++;
        return false;
      }
      drawUrlChip(n);
      return true;
    });

    /* legend buckets */
    var leg = [
      {k:'ghost', label:'Ghost', c:C.err},
      {k:'orphan', label:'Orphan', c:C.err},
      {k:'discovered', label:'Discovered', c:C.warn},
      {k:'indexed', label:'Indexed', c:C.ok}
    ];
    leg.forEach(function(item,i){
      var by = H*0.58 + i*H*0.1;
      rr(ctx,W*0.04,by,W*0.22,H*0.07,6,'rgba(255,255,255,.85)',item.c);
      ctx.fillStyle = item.c;
      ctx.font = 'bold 10px system-ui,sans-serif';
      ctx.textAlign = 'left';
      ctx.fillText(item.label + ': ' + (counts[item.k] % 99), W*0.06, by+H*0.045);
    });

    requestAnimationFrame(tick);
  }
  tick();
})();
</script>
</section>


  <section class="idx-section idx-section-alt" id="chto-delaet-agent" aria-labelledby="idx-h2-agent">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal">
        <span class="idx-eyebrow">Решение</span>
        <h2 id="idx-h2-agent">Что делает AI-агент контроля индексации</h2>
        <p>Task-specific система: публикация → техсигналы → GSC/Вебмастер → приоритет → алерт.</p>
      </div>
      <div class="idx-pipeline nero-ai-reveal" aria-label="Схема пайплайна">
        <span class="step">CMS</span><span class="arrow">→</span>
        <span class="step">Orchestrator</span><span class="arrow">→</span>
        <span class="step">GSC + Вебмастер</span><span class="arrow">→</span>
        <span class="step">LLM</span><span class="arrow">→</span>
        <span class="step">Telegram</span>
      </div>
      <div class="idx-grid-2 nero-ai-reveal">
        <div class="idx-card"><h3>Проверка публикации</h3><p>HTTP 200, не draft, корректные редиректы 301 vs 302. Алерт P1, если страница «вышла», но отдаёт 500.</p></div>
        <div class="idx-card"><h3>Sitemap и robots</h3><p>Ежедневный diff URL в sitemap ↔ CMS, lastmod, Disallow, meta/X-Robots-Tag.</p></div>
        <div class="idx-card"><h3>GSC и Вебмастер</h3><p>URL Inspection, Page Indexing, important-urls, причины исключения — сводка на русском.</p></div>
        <div class="idx-card"><h3>Алерты</h3><p>Классификация причины, приоритет P1–P3, шаги фикса, re-check через 48–72 часа.</p></div>
      </div>
    </div>
  </section>

  <div class="idx-cnt">
    <div class="ym-cta-block ym-cta-block--primary" id="cta-audit-indeksaciya">
      <div class="ym-cta-block__icon" aria-hidden="true">🔍</div>
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Бесплатный аудит 20 страниц на индексацию</p>
        <p class="ym-cta-block__sub">Проверим robots, canonical, sitemap, статусы GSC и Яндекс.Вебмастера — получите карту проблем с приоритетами P1/P2/P3.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

  <section class="idx-section" id="task-specific" aria-labelledby="idx-h2-task">
    <div class="idx-cnt">
      <div class="idx-sh idx-left nero-ai-reveal">
        <h2 id="idx-h2-task">Task-specific AI-агент vs ручной мониторинг</h2>
        <p>Gartner: к концу 2026 года <strong>40% enterprise-приложений</strong> будут интегрированы с task-specific AI agents.</p>
      </div>
      <div class="idx-table-wrap nero-ai-reveal">
        <table class="idx-table">
          <thead><tr><th>Задача</th><th>Ручной режим</th><th>AI-агент Nero Network</th></tr></thead>
          <tbody>
            <tr><td>Проверить 20 новых URL</td><td>2–3 часа в GSC + Вебмастер</td><td>5 минут на чтение сводки</td></tr>
            <tr><td>Найти выпавшие из индекса</td><td>Раз в месяц, если вспомнили</td><td>Ежедневный diff</td></tr>
            <tr><td>Отправить на переобход</td><td>Ручные клики, риск квоты</td><td>Auto-submit с approve и 7-day guard</td></tr>
            <tr><td>Отчёт клиенту агентства</td><td>Сводка в Excel</td><td>PDF/Notion + приоритеты P1–P3</td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal"><strong>Внедрение ai агентов</strong> здесь узкое: один агент — одна функция (контроль индексации), а не «цифровая трансформация» целиком.</p>
    </div>
  </section>

  <section class="idx-section idx-section-alt" id="dlya-kogo" aria-labelledby="idx-h2-dlya">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal"><h2 id="idx-h2-dlya">Для кого подходит внедрение</h2></div>
      <div class="idx-grid-3 nero-ai-reveal">
        <div class="idx-card"><h3>SEO-проекты</h3><p>Редакция публикует 10–30 материалов в месяц — агент даёт реестр: что в индексе, что ждёт обхода.</p></div>
        <div class="idx-card"><h3>Агентства</h3><p>50 клиентских сайтов, один дашборд «что не в индексе» вместо 50 кабинетов.</p></div>
        <div class="idx-card"><h3>In-house без техSEO</h3><p><strong>ai индексация сайта без программиста</strong> — pipeline настраивает Nero Network; merge в production — за человеком.</p></div>
      </div>
    </div>
  </section>

  <section class="idx-section" id="vnedrenie" aria-labelledby="idx-h2-vnedr">
    <div class="idx-cnt">
      <div class="idx-sh idx-left nero-ai-reveal">
        <h2 id="idx-h2-vnedr">Как проходит внедрение AI-индексации под ключ</h2>
        <p>Срок — <strong>2–4 недели</strong>: аудит 20 URL → подключение API → daily job → алерты → передача чек-листа.</p>
      </div>
      <div class="idx-grid-2 nero-ai-reveal">
        <div class="idx-card"><h3>Аудит 20 страниц</h3><p>HTTP, robots, canonical, sitemap, GSC, Яндекс — приоритет P1/P2/P3.</p></div>
        <div class="idx-card"><h3>Источники данных</h3><p>GSC, Вебмастер, sitemap, CMS webhook, опционально Метрика/GA4.</p></div>
        <div class="idx-card"><h3>CRM-алерты</h3><p>amoCRM/Bitrix24: тикет «страница не в индексе» с диагностикой.</p></div>
        <div class="idx-card"><h3>Запуск</h3><p>Документация, чек-лист <code>#checklist-indeksaciya</code>, audit log, re-check 72h.</p></div>
      </div>
    </div>
  </section>

  <div class="idx-cnt">
    <aside class="ym-cta-block ym-cta-block--secondary" id="cta-obuchenie-indeksaciya">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Команда хочет понять AI до запуска мониторинга?</p>
        <p class="ym-cta-block__sub">Перед внедрением ai индексации полезно разобраться в n8n, MCP и task-specific агентах. <?php if ($secondary_link_url) : ?>Посмотрите <a href="<?php echo esc_url($secondary_link_url); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html($secondary_link_label); ?></a>.<?php endif; ?></p>
      </div>
    </aside>
  </div>

  <section class="idx-section idx-section-alt" id="checklist-indeksaciya" aria-labelledby="idx-h2-check">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal"><h2 id="idx-h2-check">Технический чек-лист индексации</h2></div>
      <div class="idx-checklist nero-ai-reveal">
        <div class="idx-check">URL отдаёт 200, контент полный</div>
        <div class="idx-check">Нет accidental noindex на production</div>
        <div class="idx-check">Canonical указывает на себя (или осознанно на master-URL)</div>
        <div class="idx-check">URL присутствует в sitemap.xml, lastmod актуален</div>
        <div class="idx-check">Нет orphan и ghost URL</div>
        <div class="idx-check">Robots.txt не блокирует нужный раздел</div>
      </div>
      <div class="idx-table-wrap nero-ai-reveal">
        <table class="idx-table">
          <thead><tr><th>Симптом</th><th>Причина</th><th>Действие</th><th>Приоритет</th></tr></thead>
          <tbody>
            <tr><td>Discovered — not indexed</td><td>Низкий приоритет</td><td>Перелинковка, обход</td><td><span class="idx-badge-p2">P2</span></td></tr>
            <tr><td>Crawled — not indexed</td><td>Качество / дубли</td><td>Доработать контент</td><td><span class="idx-badge-p2">P2</span></td></tr>
            <tr><td>URL excluded — noindex</td><td>Тег noindex</td><td>Убрать noindex</td><td><span class="idx-badge-p1">P1</span></td></tr>
            <tr><td>В sitemap нет, в CMS есть</td><td>Ghost URL</td><td>Добавить в sitemap</td><td><span class="idx-badge-p1">P1</span></td></tr>
            <tr><td>IndexNow отправлен, Google молчит</td><td>Google не в IndexNow</td><td>GSC Request indexing</td><td><span class="idx-badge-p3">P3</span></td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="idx-section" id="ceny" aria-labelledby="idx-h2-ceny">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal"><h2 id="idx-h2-ceny">Стоимость и формат работ</h2><p>Ориентир Nero Network — <strong>100–300 тыс. ₽</strong> за внедрение под ключ.</p></div>
      <div class="idx-price-grid nero-ai-reveal">
        <div class="idx-price-card featured">
          <div class="idx-eyebrow">Базовый пакет</div>
          <div class="amount">100–200 тыс. ₽</div>
          <p>Аудит 20 URL, GSC + Вебмастер, daily pipeline, Telegram-алерты, weekly отчёт, IndexNow в квоте.</p>
        </div>
        <div class="idx-price-card">
          <div class="idx-eyebrow">Расширение</div>
          <div class="amount">200–300 тыс. ₽</div>
          <p>Мультидомен, 10k+ URL, CRM, self-hosted n8n, MCP-слой для Cursor/Claude.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="idx-section idx-section-alt" id="keisy" aria-labelledby="idx-h2-keisy">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal"><h2 id="idx-h2-keisy">Кейсы и примеры внедрения</h2><p>Смежные внедрения — не идентичная услуга под ключ.</p></div>
      <div class="idx-grid-3 nero-ai-reveal">
        <div class="idx-case-card"><div class="idx-case-tag">Open-source · RU</div><h3>Mr.Seo</h3><p>Ежедневные сканы GSC и Вебмастера, переобход и IndexNow.</p></div>
        <div class="idx-case-card"><div class="idx-case-tag">США</div><h3>Ghost SEO Agent</h3><p>GSC → диагностика → re-crawl, эскалация 72h.</p></div>
        <div class="idx-case-card"><div class="idx-case-tag">GEO · Habr</div><h3>B2B-кейс</h3><p>Контроль индексации — третий сигнал здоровья канала нейросетей.</p></div>
      </div>
      <div class="idx-table-wrap nero-ai-reveal" style="margin-top:24px;">
        <table class="idx-table">
          <thead><tr><th>Метрика</th><th>Без агента</th><th>С агентом</th></tr></thead>
          <tbody>
            <tr><td>Время обнаружения</td><td>Дни–недели</td><td>Алерт в сутки</td></tr>
            <tr><td>Охват проверки</td><td>Выборочный GSC</td><td>Все новые URL</td></tr>
            <tr><td>Re-check</td><td>Если вспомнили</td><td>Auto 48–72h</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="idx-section" id="faq" aria-labelledby="idx-h2-faq">
    <div class="idx-cnt">
      <div class="idx-sh nero-ai-reveal"><h2 id="idx-h2-faq">FAQ — частые вопросы</h2></div>
      <div class="idx-faq nero-ai-reveal">
        <div class="idx-faq-item"><div class="idx-faq-q" tabindex="0" role="button" aria-expanded="false">Как внедрить ai индексация сайта?</div><div class="idx-faq-a">Заявка на аудит 20 URL → подключение GSC и Вебмастера → оркестратор → алерты → daily job. Срок 2–4 недели.</div></div>
        <div class="idx-faq-item"><div class="idx-faq-q" tabindex="0" role="button" aria-expanded="false">Сколько стоит ai индексация сайта?</div><div class="idx-faq-a">Ориентир 100–300 тыс. ₽ за ai индексация сайта под ключ — один домен, стандартные интеграции.</div></div>
        <div class="idx-faq-item"><div class="idx-faq-q" tabindex="0" role="button" aria-expanded="false">Можно ли без программиста?</div><div class="idx-faq-a">Да. Nero Network настраивает pipeline; правки robots/sitemap согласуются по чек-листу, merge — за ответственным сотрудником.</div></div>
        <div class="idx-faq-item"><div class="idx-faq-q" tabindex="0" role="button" aria-expanded="false">Чем отличается от обычного краулера?</div><div class="idx-faq-a">Связка «публикация → техсигналы → GSC/Вебмастер → алерт», а не разовый crawl. LLM объясняет причину на русском.</div></div>
        <div class="idx-faq-item"><div class="idx-faq-q" tabindex="0" role="button" aria-expanded="false">Как быстро виден результат?</div><div class="idx-faq-a">Первые находки — в аудите 20 страниц. Daily-мониторинг — с первой недели. Re-check — через 48–72 часа после фикса.</div></div>
      </div>
    </div>
  </section>

  <div class="idx-cnt">
    <div class="ym-cta-block ym-cta-block--footer-final" id="cta-final-indeksaciya">
      <div class="ym-cta-block__body">
        <p class="ym-cta-block__headline">Готовы убрать слепые зоны индексации?</p>
        <p class="ym-cta-block__sub">Следующий шаг — аудит 20 URL и план внедрения AI-агента: GSC, Яндекс.Вебмастер, sitemap, Telegram-алерты. Срок — 2–4 недели.</p>
        <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
      </div>
    </div>
  </div>

</div>

<?php
$idx_page_url = trailingslashit(get_permalink());
$idx_site_url = trailingslashit(home_url('/'));
$idx_h1       = 'AI-агент контроля индексации сайта: внедрение под ключ';
$idx_schema   = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type' => 'Organization',
            '@id'   => $idx_site_url . '#organization',
            'name'  => $brand,
            'url'   => $idx_site_url,
        ],
        [
            '@type'     => 'WebSite',
            '@id'       => $idx_site_url . '#website',
            'url'       => $idx_site_url,
            'name'      => $brand,
            'publisher' => ['@id' => $idx_site_url . '#organization'],
        ],
        [
            '@type'       => 'WebPage',
            '@id'         => $idx_page_url . '#webpage',
            'url'         => $idx_page_url,
            'name'        => $idx_h1,
            'description' => $page_seo_description,
            'isPartOf'    => ['@id' => $idx_site_url . '#website'],
            'about'       => ['@id' => $idx_site_url . '#organization'],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id'   => $idx_page_url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Главная', 'item' => $idx_site_url],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $idx_h1, 'item' => $idx_page_url],
            ],
        ],
        [
            '@type'       => 'Service',
            '@id'         => $idx_page_url . '#service',
            'name'        => $idx_h1,
            'description' => $page_seo_description,
            'url'         => $idx_page_url,
            'provider'    => ['@id' => $idx_site_url . '#organization'],
        ],
        [
            '@type' => 'FAQPage',
            '@id'   => $idx_page_url . '#faq',
            'mainEntity' => [
                ['@type' => 'Question', 'name' => 'Как внедрить ai индексация сайта?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Заявка на аудит 20 URL → подключение GSC и Вебмастера → оркестратор → алерты → daily job. Срок 2–4 недели.']],
                ['@type' => 'Question', 'name' => 'Сколько стоит ai индексация сайта?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Ориентир 100–300 тыс. ₽ за ai индексация сайта под ключ — один домен, стандартные интеграции.']],
                ['@type' => 'Question', 'name' => 'Можно ли без программиста?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Да. Nero Network настраивает pipeline; правки robots/sitemap согласуются по чек-листу, merge — за ответственным сотрудником.']],
                ['@type' => 'Question', 'name' => 'Чем отличается от обычного краулера?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Связка «публикация → техсигналы → GSC/Вебмастер → алерт», а не разовый crawl. LLM объясняет причину на русском.']],
                ['@type' => 'Question', 'name' => 'Как быстро виден результат?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Первые находки — в аудите 20 страниц. Daily-мониторинг — с первой недели. Re-check — через 48–72 часа после фикса.']],
            ],
        ],
    ],
];
echo '<script type="application/ld+json">' . wp_json_encode($idx_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
?>
</script>

</main>

<script>
/**
 * idx-indeksaciya-hero-engine — «Диспетчерская потоков индексации»
 * Мир: орбитальные дорожки URL → robots/sitemap diff → радар → IndexNow → Indexed
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("idx-indeksaciya-hero-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 200;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 4;
    scale = Math.min(cw / 380, ch / 200) * 1.05;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#94a3b8",
    radarBase: "#1e293b",
    radarSweep: "rgba(121,242,255,0.35)",
    orbit: "rgba(148,163,184,0.25)",
    urlPacket: "#dbeafe",
    urlGhost: "#fbbf24",
    urlBlocked: "#fb7185",
    urlIndexed: "#22c55e",
    robotsGate: "#475569",
    gscBlue: "#3b82f6",
    yandexRed: "#ef4444",
    indexNow: "#a78bfa",
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
      ctx.lineWidth = 1.2;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  /* Орбитальные дорожки — вместо Conveyor */
  function CrawlOrbitLanes() {
    this.packets = [
      { lane: 0, offset: 0, status: "ok", label: "/blog" },
      { lane: 1, offset: 70, status: "ghost", label: "ghost" },
      { lane: 2, offset: 140, status: "ok", label: "URL" }
    ];
  }
  CrawlOrbitLanes.prototype.draw = function (ctx) {
    var radii = [52, 72, 92];
    radii.forEach(function (r) {
      ctx.strokeStyle = C.orbit;
      ctx.lineWidth = 1;
      ctx.setLineDash([4, 6]);
      ctx.beginPath();
      ctx.arc(0, 0, r * scale / 1.05, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
    });
    var prg = (frame * 0.042) % 260;
    this.packets.forEach(function (p) {
      var r = radii[p.lane];
      var t = ((frame * 0.35 + p.offset) % 140) / 140;
      var ang = t * Math.PI * 2 - Math.PI / 2;
      var px = Math.cos(ang) * r * scale / 1.05;
      var py = Math.sin(ang) * r * scale / 1.05;
      var col = C.urlPacket;
      if (p.status === "ghost") col = C.urlGhost;
      if (prg >= 55 && prg < 95 && p.status === "ghost") col = C.urlBlocked;
      if (prg >= 210) col = C.urlIndexed;
      drawRR(ctx, px - 8, py - 6, 16, 12, 2, col, C.outline);
      ctx.fillStyle = C.outline;
      ctx.font = "bold 5px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(p.label, px, py + 2);
    });
  };

  /* Радар sitemap — вместо WebsiteTerminal */
  function SitemapRadarCore() {
    this.sweep = 0;
    this.indexedFlash = 0;
  }
  SitemapRadarCore.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.sweep = (frame * 0.04) % (Math.PI * 2);
    drawRR(ctx, -38, -38, 76, 76, 38, C.radarBase, C.outline);
    ctx.strokeStyle = C.orbit;
    ctx.lineWidth = 1;
    for (var i = 1; i <= 3; i++) {
      ctx.beginPath();
      ctx.arc(0, 0, 12 * i, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.save();
    ctx.rotate(this.sweep);
    var grad = ctx.createRadialGradient(0, 0, 0, 0, 0, 42);
    grad.addColorStop(0, C.radarSweep);
    grad.addColorStop(1, "transparent");
    ctx.fillStyle = grad;
    ctx.beginPath();
    ctx.moveTo(0, 0);
    ctx.arc(0, 0, 42, -0.35, 0.35);
    ctx.closePath();
    ctx.fill();
    ctx.restore();

    if (prg >= 95 && prg < 170) {
      var blips = [[-18, -10], [14, 8], [-6, 20]];
      blips.forEach(function (b, i) {
        var on = prg > 100 + i * 18;
        ctx.fillStyle = on ? C.gscBlue : "rgba(255,255,255,0.2)";
        ctx.beginPath();
        ctx.arc(b[0], b[1], 3, 0, Math.PI * 2);
        ctx.fill();
      });
    }

    if (prg >= 210) {
      this.indexedFlash = Math.min(1, (prg - 210) / 20);
      ctx.save();
      ctx.globalAlpha = 0.25 + this.indexedFlash * 0.45;
      ctx.strokeStyle = C.urlIndexed;
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, 0, 36 + this.indexedFlash * 8, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = C.urlIndexed;
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("Indexed", 0, 4);
      ctx.restore();
    }
  };

  function RobotsGatePanel() {
    this.open = false;
  }
  RobotsGatePanel.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var gx = -95, gy = 28;
    drawRR(ctx, gx, gy, 34, 42, 4, C.robotsGate, C.outline);
    ctx.fillStyle = "#cbd5e1";
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("robots", gx + 17, gy + 12);
    var barH = 28;
    if (prg >= 55 && prg < 95) {
      var block = prg < 75;
      ctx.fillStyle = block ? C.urlBlocked : C.urlIndexed;
      ctx.fillRect(gx + 6, gy + 18, 22, barH * (block ? 0.35 : 0.7));
      if (block && prg === 60) createBubble(gx + 17, gy, "Disallow на /blog/", 220);
    }
  };

  function GscStatusTower() {
    this.rows = ["Indexed", "Discovered", "Crawled"];
  }
  GscStatusTower.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var tx = 78, ty = -42;
    drawRR(ctx, tx, ty, 40, 58, 4, "rgba(59,130,246,0.15)", C.outline);
    ctx.fillStyle = C.gscBlue;
    ctx.font = "bold 6px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("GSC", tx + 20, ty + 10);
    if (prg >= 120 && prg < 200) {
      this.rows.forEach(function (r, i) {
        var on = prg > 125 + i * 22;
        ctx.fillStyle = on ? (i === 1 ? C.urlGhost : C.urlIndexed) : "rgba(255,255,255,0.25)";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "left";
        ctx.fillText(r, tx + 6, ty + 22 + i * 14);
      });
      if (prg === 130) createBubble(tx + 20, ty - 8, "14 URL Discovered not indexed", 240);
    }
  };

  function YandexWebmasterBeacon() {
    this.pulse = 0;
  }
  YandexWebmasterBeacon.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    var bx = 88, by = 32;
    drawRR(ctx, bx, by, 28, 28, 14, "rgba(239,68,68,0.2)", C.outline);
    ctx.fillStyle = C.yandexRed;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("Я", bx + 14, by + 17);
    if (prg >= 140 && prg < 205) {
      this.pulse = Math.sin(frame * 0.1) * 0.3 + 0.7;
      ctx.save();
      ctx.globalAlpha = this.pulse * 0.5;
      ctx.strokeStyle = C.yandexRed;
      ctx.lineWidth = 1.5;
      ctx.beginPath();
      ctx.arc(bx + 14, by + 14, 18 + this.pulse * 4, 0, Math.PI * 2);
      ctx.stroke();
      ctx.restore();
    }
  };

  function GhostUrlMarker() {
    this.blink = 0;
  }
  GhostUrlMarker.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 95 || prg >= 170) return;
    this.blink = frame % 30 < 15 ? 1 : 0.4;
    ctx.save();
    ctx.globalAlpha = this.blink;
    drawRR(ctx, -120, -55, 22, 14, 3, C.urlGhost, C.outline);
    ctx.fillStyle = "#0f172a";
    ctx.font = "bold 5px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("ghost", -109, -46);
    ctx.restore();
    if (prg === 100) createBubble(-109, -62, "URL в CMS, нет в sitemap", 230);
  };

  function IndexNowPulseBurst() {
    this.rings = [];
  }
  IndexNowPulseBurst.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    if (prg < 200 || prg > 250) return;
    var burst = (prg - 200) / 50;
    ctx.save();
    ctx.strokeStyle = C.indexNow;
    ctx.lineWidth = 1.5;
    for (var i = 0; i < 3; i++) {
      var r = 12 + burst * 40 + i * 8;
      ctx.globalAlpha = Math.max(0, 1 - burst - i * 0.2);
      ctx.beginPath();
      ctx.arc(0, 0, r, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.fillStyle = C.indexNow;
    ctx.globalAlpha = 1;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("IndexNow", 0, -52);
    ctx.restore();
    if (prg === 205) createBubble(0, -65, "Ping Яндекс/Bing отправлен", 220);
    if (prg === 235) createBubble(55, -30, "Re-check через 72h", 200);
  };

  function Agent(x, y, color, role, stepTrig, dialogs) {
    this.x = x; this.y = y; this.baseX = x; this.baseY = y;
    this.color = color; this.role = role;
    this.timer = Math.random() * 100;
    this.stepTrig = stepTrig;
    this.dialogs = dialogs;
    this.stationAngle = stepTrig * 0.02;
  }
  Agent.prototype.draw = function (ctx) {
    var prg = (frame * 0.042) % 260;
    this.timer += 0.03;
    var isMoving = false;
    var faceDir = 1;
    var targetX = Math.cos(this.stationAngle) * 68;
    var targetY = Math.sin(this.stationAngle) * 48;

    if (prg >= this.stepTrig && prg < this.stepTrig + 28) {
      var local = prg - this.stepTrig;
      if (local < 12) {
        isMoving = true;
        var t = local / 12;
        this.x = this.baseX + (targetX - this.baseX) * t;
        this.y = this.baseY + (targetY - this.baseY) * t;
      } else if (local < 18) {
        this.x = targetX; this.y = targetY;
      } else {
        isMoving = true;
        var t2 = (local - 18) / 10;
        this.x = targetX + (this.baseX - targetX) * t2;
        this.y = targetY + (this.baseY - targetY) * t2;
      }
    } else {
      this.x = this.baseX; this.y = this.baseY;
    }

    if (!isMoving && frame % 180 === 0 && Math.random() < 0.12) {
      createBubble(this.x, this.y - 18, this.dialogs[Math.floor(Math.random() * this.dialogs.length)], 240);
    }

    var bob = isMoving ? Math.abs(Math.sin(this.timer * 3)) * 2 : Math.sin(this.timer * 1.5);
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.lineJoin = "round";
    var legL = isMoving ? Math.sin(this.timer * 6) * 4 : 0;
    var legR = isMoving ? Math.sin(this.timer * 6 + Math.PI) * 4 : 0;
    drawRR(ctx, -10, -5 + Math.max(0, legL), 8, 12, 2, C.outline, null);
    drawRR(ctx, 2, -5 + Math.max(0, legR), 8, 12, 2, C.outline, null);
    drawRR(ctx, -14, -12 - bob, 28, 18, 6, this.color, C.outline);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -26 - bob, 10, 0, Math.PI * 2);
    ctx.fill();
    ctx.lineWidth = 1.5;
    ctx.strokeStyle = C.outline;
    ctx.stroke();
    ctx.restore();
  };

  var entities = [];
  var bubbles = [];
  entities.push(new CrawlOrbitLanes());
  entities.push(new SitemapRadarCore());
  entities.push(new RobotsGatePanel());
  entities.push(new GscStatusTower());
  entities.push(new YandexWebmasterBeacon());
  entities.push(new GhostUrlMarker());
  entities.push(new IndexNowPulseBurst());
  entities.push(new Agent(-110, 55, C.agentYellow, "1_architect", 105, [
    "Реестр URL обновлён", "Политика noindex учтена", "Сверяю CMS и sitemap"
  ]));
  entities.push(new Agent(-70, -70, C.agentGreen, "2_seo", 125, [
    "Discovered not indexed!", "14 URL в очереди GSC", "Приоритет P1 на лендинг"
  ]));
  entities.push(new Agent(95, -65, C.agentBlue, "3_coder", 145, [
    "Снял Disallow в robots", "Canonical на master-URL", "HTTP 200 подтверждён"
  ]));
  entities.push(new Agent(105, 60, C.agentPink, "4_designer", 165, [
    "Ghost URL в карту сайта", "lastmod обновлён", "Дубль canonical убран"
  ]));
  entities.push(new Agent(-50, 75, C.agentPurple, "5_deployer", 195, [
    "IndexNow в Яндекс", "Переобход в квоте", "Жду re-check 72h"
  ]));

  function createBubble(x, y, text, customLife) {
    bubbles.push({ x: x, y: y, text: text, life: customLife || 260, maxLife: customLife || 260 });
  }

  function engineLoop() {
    frame++;
    ctx.save();
    ctx.clearRect(0, 0, cw, ch);
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    entities.forEach(function (e) { e.draw(ctx); });
    bubbles.forEach(function (b) {
      b.life--;
      if (b.life <= 0) return;
      var alpha = Math.min(1, b.life / 40);
      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.font = "bold 7px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 12;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 14, 4, C.bubbleBg, C.outline);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 12);
      ctx.restore();
    });
    bubbles = bubbles.filter(function (b) { return b.life > 0; });
    ctx.restore();
    requestAnimationFrame(engineLoop);
  }
  engineLoop();
});
</script>

<script>
document.querySelectorAll('.idx-faq-q').forEach(function(btn) {
  btn.addEventListener('click', function() {
    var item = btn.closest('.idx-faq-item');
    var open = item.classList.contains('open');
    document.querySelectorAll('.idx-faq-item.open').forEach(function(el) {
      el.classList.remove('open');
      var q = el.querySelector('.idx-faq-q');
      if (q) q.setAttribute('aria-expanded', 'false');
    });
    if (!open) {
      item.classList.add('open');
      btn.setAttribute('aria-expanded', 'true');
    }
  });
  btn.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
  });
});
</script>

<?php nero_ai_echo_theme_scripts(); ?>
<?php get_footer(); ?>
