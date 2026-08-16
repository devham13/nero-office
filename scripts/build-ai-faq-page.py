#!/usr/bin/env python3
"""Build page-ai-faq-dlya-saita.php from pipeline fragments."""
import re
from pathlib import Path

ROOT = Path('/workspace')
FRAG_ALINA = ROOT / '.cursor/nero-network-fragments/alina.md'
FRAG_BORIS = ROOT / '.cursor/nero-network-fragments/boris.md'
OUT = ROOT / 'wordpress/page-ai-faq-dlya-saita.php'


def extract_html(md_path: Path) -> str:
    text = md_path.read_text(encoding='utf-8')
    m = re.search(r'```html\n(.*?)```', text, re.DOTALL)
    if not m:
        raise SystemExit(f'No html block in {md_path}')
    return m.group(1).strip()


def php_header() -> str:
    return r'''<?php
/**
 * Template Name: AI-FAQ для сайта: внедрение динамических ответов из базы знаний
 * Description: SEO-лендинг — внедрение AI-FAQ виджета с RAG и автообновлением FAQ. Пакеты 80–220 тыс. ₽.
 */

$page_seo_title       = 'AI-FAQ для сайта — внедрение динамических ответов из базы знаний';
$page_seo_description = 'Внедрим AI-FAQ для сайта: виджет отвечает из вашей базы знаний и сам обновляет FAQ по реальным вопросам клиентов. Меньше тикетов в поддержку, выше конверсия 24/7. Соберите AI-FAQ от 80 тыс. ₽.';

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

$nero_ai_header_links = [
	[ 'label' => 'Что такое', 'href' => '#chto-takoe' ],
	[ 'label' => 'Как работает', 'href' => '#kak-rabotaet' ],
	[ 'label' => 'Внедрение', 'href' => '#vnedrenie' ],
	[ 'label' => 'Результаты', 'href' => '#rezultaty' ],
	[ 'label' => 'Интеграции', 'href' => '#integracii' ],
	[ 'label' => 'Цена', 'href' => '#ceny' ],
	[ 'label' => 'Этапы', 'href' => '#etapy' ],
	[ 'label' => 'FAQ', 'href' => '#faq' ],
];

$nero_ai_bootstrap = get_stylesheet_directory() . '/longread-page-wordpress-bootstrap.inc.php';
if ( ! is_readable( $nero_ai_bootstrap ) ) {
	$nero_ai_bootstrap = dirname( __DIR__ ) . '/shared/theme-canonical/longread-page-wordpress-bootstrap.inc.php';
}
require $nero_ai_bootstrap;

$primary_cta_label = getenv( 'PRIMARY_CTA_LABEL' ) ?: 'Собрать AI-FAQ';
$primary_cta_url   = nero_ai_primary_cta_url( getenv( 'PRIMARY_CTA_URL' ) ?: '' );
$primary_cta_attrs = nero_ai_primary_cta_link_attrs( $primary_cta_url );

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

.faq-hero-rag{
  min-height:100vh;
  min-height:100dvh;
  position:relative;
}

.afq-content{
  --afq-bg:#f8fafc;--afq-surface:#fff;--afq-text:#0f172a;--afq-muted:#64748b;
  --afq-soft:#334155;--afq-border:#e2e8f0;--afq-accent:#6366f1;--afq-accent2:#8b5cf6;
  --afq-teal:#0d9488;--afq-green:#10b981;--afq-amber:#f59e0b;
  --afq-btn-from:#6366f1;--afq-btn-to:#8b5cf6;
  --afq-r:18px;--afq-container:1180px;
  background:linear-gradient(180deg,#fff 0%,#f8fafc 40%,#f1f5f9 100%);
  color:var(--afq-text);
  font-family:Inter,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
  overflow-x:hidden;
}
.afq-content *,.afq-content *::before,.afq-content *::after{box-sizing:border-box;}
.afq-content a{color:inherit;}
.afq-content p{color:var(--afq-muted);line-height:1.72;margin:0 0 1em;text-align:left;}
.afq-content p:last-child{margin-bottom:0;}
.afq-content h2,.afq-content h3,.afq-content h4{color:var(--afq-text);letter-spacing:-.04em;margin:0 0 .65em;}
.afq-content strong{color:var(--afq-soft);}
.afq-content ul{padding-left:0;list-style:none;margin:0 0 1em;}
.afq-content ul li{padding-left:20px;position:relative;margin-bottom:.45em;color:var(--afq-muted);font-size:14.5px;line-height:1.65;text-align:left;}
.afq-content ul li::before{content:'›';position:absolute;left:0;color:var(--afq-accent);font-weight:700;}
.afq-cnt{width:min(var(--afq-container),calc(100% - 40px));margin:0 auto;position:relative;z-index:1;}
.afq-section{padding:clamp(56px,7vw,96px) 0;position:relative;}
.afq-section-alt{background:rgba(255,255,255,.72);border-top:1px solid var(--afq-border);border-bottom:1px solid var(--afq-border);}
.afq-sh{max-width:820px;margin:0 auto 40px;text-align:center;}
.afq-sh.afq-left{margin-left:0;text-align:left;}
.afq-sh h2{font-size:clamp(26px,3.8vw,44px);line-height:1.08;margin-bottom:12px;}
.afq-sh p{font-size:clamp(15px,1.55vw,17px);max-width:680px;margin:0 auto;text-align:center;}
.afq-sh.afq-left p{margin-left:0;text-align:left;}
.afq-eyebrow{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:999px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.2);font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--afq-accent);margin-bottom:14px;}
.afq-intro{padding:clamp(36px,5vw,64px) 0 clamp(32px,4vw,52px);background:#fff;border-bottom:1px solid var(--afq-border);}
.afq-intro-grid{display:grid;grid-template-columns:1fr 320px;gap:48px;align-items:center;}
.afq-intro-text{position:relative;padding-left:20px;text-align:left;}
.afq-intro-text::before{content:'';position:absolute;left:0;top:4px;bottom:4px;width:3px;border-radius:2px;background:linear-gradient(180deg,var(--afq-accent),var(--afq-teal));}
.afq-intro-text p{text-align:left!important;font-size:clamp(14.5px,1.5vw,16.5px);line-height:1.78;color:var(--afq-muted);}
.afq-intro-text p:last-child{color:var(--afq-soft);}
.afq-intro-deco{display:grid;gap:10px;}
.afq-chip{display:flex;align-items:center;gap:10px;padding:12px 14px;border:1px solid var(--afq-border);border-radius:14px;background:var(--afq-surface);box-shadow:0 4px 16px rgba(15,23,42,.04);}
.afq-chip strong{display:block;font-size:13px;color:var(--afq-text);}
.afq-chip span{font-size:11px;color:var(--afq-muted);}
.afq-chip-dot{width:10px;height:10px;border-radius:50%;background:var(--afq-teal);box-shadow:0 0 0 4px rgba(13,148,136,.15);flex-shrink:0;}
@media(max-width:900px){.afq-intro-grid{grid-template-columns:1fr;gap:28px;}}
.afq-toc-outer{padding:0 0 clamp(32px,4vw,48px);}
.afq-toc{display:flex;flex-wrap:wrap;gap:9px;justify-content:center;}
.afq-toc a{display:inline-block;padding:9px 18px;background:#fff;border:1px solid var(--afq-border);border-radius:999px;font-size:13px;font-weight:600;color:var(--afq-muted);transition:border-color .2s,color .2s,background .2s;text-decoration:none!important;}
.afq-toc a:hover{border-color:rgba(99,102,241,.35);color:var(--afq-accent);background:rgba(99,102,241,.06);}
.afq-card{background:#fff;border:1px solid var(--afq-border);border-radius:var(--afq-r);padding:24px;box-shadow:0 8px 28px rgba(15,23,42,.05);transition:border-color .2s,transform .2s;}
.afq-card:hover{border-color:rgba(99,102,241,.25);transform:translateY(-2px);}
.afq-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.afq-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
@media(max-width:768px){.afq-grid-2,.afq-grid-3{grid-template-columns:1fr;}}
@media(max-width:960px){.afq-grid-3{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.afq-grid-3{grid-template-columns:1fr;}}
.afq-scenario{background:#fff;border:1px solid var(--afq-border);border-radius:var(--afq-r);padding:22px;margin-bottom:12px;}
.afq-scenario:last-child{margin-bottom:0;}
.afq-scenario h3{font-size:17px;margin-bottom:8px;}
.afq-scenario p{font-size:14.5px;margin:0 0 .55em;}
.afq-table-wrap{overflow-x:auto;border-radius:14px;border:1px solid var(--afq-border);margin:20px 0;background:#fff;}
.afq-table{width:100%;border-collapse:collapse;font-size:14px;}
.afq-table th{padding:12px 16px;text-align:left;background:rgba(99,102,241,.08);color:var(--afq-accent);font-weight:700;border-bottom:1px solid var(--afq-border);white-space:nowrap;}
.afq-table td{padding:11px 16px;border-bottom:1px solid var(--afq-border);color:var(--afq-soft);vertical-align:top;}
.afq-table tr:last-child td{border-bottom:none;}
.afq-table tr:hover td{background:rgba(99,102,241,.03);}
.afq-timeline{position:relative;padding-left:36px;}
.afq-timeline::before{content:'';position:absolute;left:10px;top:6px;bottom:6px;width:2px;background:linear-gradient(180deg,var(--afq-accent),var(--afq-teal));opacity:.35;border-radius:2px;}
.afq-tl-item{position:relative;margin-bottom:28px;}
.afq-tl-item:last-child{margin-bottom:0;}
.afq-tl-dot{position:absolute;left:-30px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--afq-accent);box-shadow:0 0 0 4px rgba(99,102,241,.18);}
.afq-tl-item h3{font-size:17px;margin-bottom:6px;}
.afq-tl-item p{font-size:14.5px;margin:0;}
.afq-faq{display:flex;flex-direction:column;gap:10px;max-width:860px;margin:0 auto;}
.afq-faq-item{background:#fff;border:1px solid var(--afq-border);border-radius:14px;overflow:hidden;}
.afq-faq-q{padding:18px 22px;font-size:15px;font-weight:700;color:var(--afq-text);cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:14px;user-select:none;text-align:left;}
.afq-faq-q::after{content:'▾';font-size:12px;color:var(--afq-accent);flex-shrink:0;transition:transform .25s;}
.afq-faq-item.open .afq-faq-q::after{transform:rotate(180deg);}
.afq-faq-a{padding:0 22px;max-height:0;overflow:hidden;transition:max-height .38s ease,padding .25s;font-size:14.5px;color:var(--afq-muted);line-height:1.72;text-align:left;}
.afq-faq-item.open .afq-faq-a{max-height:800px;padding:0 22px 18px;}
.afq-checklist{list-style:none;padding:0;margin:20px 0 0;}
.afq-checklist li{padding-left:28px;position:relative;margin-bottom:10px;color:var(--afq-muted);font-size:14.5px;}
.afq-checklist li::before{content:'☐';position:absolute;left:0;color:var(--afq-accent);font-weight:700;}
.ym-cta-block{border-radius:20px;padding:32px 36px;margin:28px 0;background:linear-gradient(135deg,rgba(99,102,241,.08),rgba(139,92,246,.06));border:1px solid rgba(99,102,241,.22);}
.ym-cta-block--primary{text-align:center;}
.ym-cta-block--secondary{background:#fff;border-color:var(--afq-border);text-align:left;}
.ym-cta-block--footer-final{background:linear-gradient(135deg,rgba(13,148,136,.08),rgba(99,102,241,.08));border-color:rgba(13,148,136,.25);}
.ym-cta-block__icon{font-size:32px;margin-bottom:12px;}
.ym-cta-block__headline{font-size:clamp(19px,2.6vw,26px);font-weight:800;color:var(--afq-text);margin:0 0 10px;}
.ym-cta-block__sub{color:var(--afq-muted);font-size:15px;margin:0 auto 20px;max-width:620px;line-height:1.7;text-align:left;}
.ym-cta-block--primary .ym-cta-block__sub{text-align:center;}
.ym-cta-block__actions{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;}
.ym-btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 26px;border-radius:999px;font-size:15px;font-weight:700;text-decoration:none!important;transition:transform .2s,box-shadow .2s;}
.ym-btn:hover{transform:translateY(-2px);}
.ym-btn--accent,.nero-ai-home-page .ym-btn--accent{background:linear-gradient(135deg,var(--afq-btn-from),var(--afq-btn-to));color:#fff!important;box-shadow:0 8px 28px rgba(99,102,241,.28);}
.ym-btn--ghost{background:#fff;color:var(--afq-text)!important;border:1.5px solid var(--afq-border);}
.ym-link--accent{color:var(--afq-accent)!important;text-decoration:underline!important;}
.nero-ai-reveal{opacity:0;transform:translateY(20px);transition:opacity .55s ease,transform .55s ease;}
.nero-ai-reveal.nero-ai-active{opacity:1;transform:none;}
.nero-ai-delay-1{transition-delay:.12s;}
.nero-ai-delay-2{transition-delay:.24s;}
@media(max-width:600px){.ym-cta-block{padding:24px 18px;}}
</style>

<main id="primary" class="site-main nero-ai-home-page ai-faq-dlya-saita-page" role="main" tabindex="-1">
'''


def page_content() -> str:
    return r'''
<div class="afq-content">

  <section class="afq-intro nero-ai-section" id="intro" aria-label="Введение">
    <div class="afq-cnt">
      <div class="afq-intro-grid nero-ai-reveal">
        <div class="afq-intro-text">
          <p class="afq-eyebrow">Лонгрид · ai faq для сайта</p>
          <p><strong>Коротко:</strong> AI-FAQ — связка виджета на сайте, RAG-поиска по вашим документам и механики автообновления FAQ по реальным вопросам клиентов. Nero Network внедряет решение под ключ для B2B-услуг, клиник, EdTech и SaaS в коридоре <strong>80–220 тыс. ₽</strong>.</p>
          <p>Статичный FAQ когда-то закрывал базовые интенты. Сегодня он часто устаревает быстрее, чем маркетинг успевает его править: новые тарифы, условия, интеграции — а на сайте остаётся текст двухлетней давности.</p>
        </div>
        <div class="afq-intro-deco" aria-label="Ключевые метрики AI-FAQ">
          <div class="afq-chip"><span class="afq-chip-dot" aria-hidden="true"></span><div><strong>78% resolved</strong><span>типовые вопросы без оператора</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#6366f1" aria-hidden="true"></span><div><strong>4 сек</strong><span>среднее время ответа RAG</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#f59e0b" aria-hidden="true"></span><div><strong>+12 FAQ/нед</strong><span>новые пары из логов · HITL</span></div></div>
          <div class="afq-chip"><span class="afq-chip-dot" style="background:#8b5cf6" aria-hidden="true"></span><div><strong>80–220 тыс. ₽</strong><span>пакеты Старт / Бизнес / Pro</span></div></div>
        </div>
      </div>
    </div>
  </section>

  <div class="afq-toc-outer">
    <div class="afq-cnt">
      <nav class="afq-toc ym-toc" aria-label="Оглавление статьи">
        <a href="#chto-takoe">Что такое AI-FAQ</a>
        <a href="#kak-rabotaet">Как работает RAG</a>
        <a href="#vnedrenie">Внедрение под ключ</a>
        <a href="#rezultaty">Результаты</a>
        <a href="#integracii">Интеграции</a>
        <a href="#riski">Риски</a>
        <a href="#ceny">Стоимость</a>
        <a href="#etapy">Этапы</a>
        <a href="#faq">FAQ</a>
      </nav>
    </div>
  </div>

  <section class="afq-section" id="chto-takoe">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Боль и решение</span>
        <h2>Что такое AI-FAQ и почему статичный FAQ перестаёт работать</h2>
        <p>Динамический FAQ на базе знаний закрывает повторяющиеся вопросы 24/7 и показывает, где в контенте «белые пятна».</p>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-bottom:24px;">
        <h3 style="font-size:18px;margin-bottom:10px;">Определение</h3>
        <p><strong>AI-FAQ (AI-динамический FAQ)</strong> — не страница с десятком застывших вопросов, а система, которая отвечает посетителю из <strong>базы знаний</strong> через RAG, логирует реальные запросы и <strong>предлагает обновления</strong> для SEO-блока FAQ без ручного переписывания всей страницы.</p>
      </div>

      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Почему FAQ устаревает</h3>
          <p>Поддержка отвечает на одни и те же вопросы десятки раз в неделю. FAQ на сайте не отражает реальные запросы из чата и почты. Устаревший FAQ снижает доверие.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Чем отличается от обычного блока</h3>
          <p>Умный FAQ на сайте живёт в базе знаний: видимый блок обновляется по правилам, когда редактор утверждает новые пары из логов.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Для кого подходит</h3>
          <p>B2B-услуги, клиники, EdTech и SaaS — где FAQ влияет на конверсию и нагрузку на поддержку.</p>
        </div>
      </div>

      <div class="afq-table-wrap nero-ai-reveal" style="margin-top:28px;">
        <table class="afq-table">
          <thead><tr><th>Подход</th><th>Как работает</th><th>Слабое место</th></tr></thead>
          <tbody>
            <tr><td><strong>Статичный FAQ</strong></td><td>Ручное редактирование HTML/блока в CMS</td><td>Быстро устаревает, не видит реальные запросы</td></tr>
            <tr><td><strong>Сценарный чат-бот</strong></td><td>Жёсткие ветки «если X → ответ Y»</td><td>Долго обучать; каждая правка — разработка</td></tr>
            <tr><td><strong>AI-FAQ на RAG</strong></td><td>Поиск по документам + ответ с цитатой источника</td><td>Нужна качественная KB и контроль качества</td></tr>
            <tr><td><strong>AI-FAQ + динамическое обновление</strong></td><td>Виджет + лог вопросов → модерация → публикация в FAQ</td><td>Проектная доработка Nero Network поверх RAG</td></tr>
          </tbody>
        </table>
      </div>

      <p class="nero-ai-reveal" style="margin-top:24px;text-align:left;max-width:900px;"><!-- INTERNAL-LINKS:INSERT -->Кейс КНАУФ (Just AI): RAG-ветка вместо ручных Q&A-пар на ~1 000 страниц документов — <strong>89% точности</strong>, экономия до <strong>50% времени</strong> поддержки. Для клиник: V-AI Labs — ответ за 3 сек, <strong>72%</strong> обращений без админов. Для SaaS: СофтВейв — <strong>92% точность</strong>, <strong>−45%</strong> тикетов только с людьми.</p>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="kak-rabotaet">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">RAG · база знаний</span>
        <h2>Как работает AI-FAQ на базе знаний (RAG)</h2>
        <p>От вопроса посетителя до ответа с цитатой и эскалации к оператору — прозрачный контур качества.</p>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Откуда берутся ответы: база знаний, документы, wiki</h3>
        <p><strong>FAQ на основе базы знаний</strong> строится на RAG: модель ищет релевантные фрагменты в документах и формулирует ответ с опорой на контекст.</p>
        <ol style="margin:12px 0 0;padding-left:20px;color:var(--afq-muted);font-size:14.5px;line-height:1.7;">
          <li>Документы → чанки (500–1000 токенов)</li>
          <li>Embeddings → vector store (Qdrant, pgvector)</li>
          <li>Семантический поиск top-k (+ hybrid search, reranker)</li>
          <li>LLM генерирует ответ <strong>строго по контексту</strong> + ссылки на источники</li>
          <li>Confidence score — ниже порога → эскалация к оператору</li>
        </ol>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Как система учится на реальных вопросах посетителей</h3>
        <p><strong>Автоматическое обновление FAQ</strong> — цикл с модерацией: лог вопросов → топ без ответа → черновик Q&A → утверждение редактора → публикация в WordPress + Schema FAQPage.</p>
      </div>

      <div class="afq-scenario nero-ai-reveal">
        <h3>Контроль качества: логирование, модерация, эскалация к оператору</h3>
        <p>Citations, confidence threshold, blacklist тем (медицина, юридические формулировки), audit log. ДИТ Москвы × AutoFAQ: до <strong>250 обращений в час</strong> в пик. sk.ru / OSMI: <strong>87,8% accuracy</strong>, ответ до <strong>10 сек</strong>.</p>
      </div>
    </div>
  </section>

  <!-- BORIS_BLOCK -->

  <aside class="ym-cta-block ym-cta-block--primary afq-cnt" id="cta-kak-rabotaet" style="max-width:1180px;margin-left:auto;margin-right:auto;">
    <div class="ym-cta-block__icon" aria-hidden="true">💬</div>
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Собрать AI-FAQ для вашего сайта</p>
      <p class="ym-cta-block__sub">Проведём аудит FAQ и базы знаний, покажем схему RAG-виджета и оценим сроки внедрения в коридоре 80–220 тыс. ₽. Без обязательств.</p>
      <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent ym-cta-block__btn"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
    </div>
  </aside>

  <section class="afq-section" id="vnedrenie">
    <div class="afq-cnt">
      <div class="afq-sh afq-left">
        <span class="afq-eyebrow">Под ключ</span>
        <h2>Что входит во внедрение AI-FAQ под ключ</h2>
        <p>Аудит, виджет, тестирование и пилот — от карты вопросов до запуска на части трафика.</p>
      </div>

      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Аудит текущего FAQ</h3>
          <p>Сбор источников знаний, 30–50 реальных вопросов, карта чувствительных тем, оценка «белых пятен» (3–5 дней).</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Настройка виджета</h3>
          <p>JS-виджет (чат или FAQ drawer), брендинг, подсказки «люди также спрашивают» по логам. WordPress-native внедрение.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Тестирование и запуск</h3>
          <p>Eval на 50–100 вопросов, настройка порога confidence, обучение команды, пилот 2–4 недели на части трафика.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="rezultaty">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">KPI</span>
        <h2>Результаты для бизнеса: меньше тикетов, больше лидов</h2>
        <p>Ориентиры из кейсов рынка — не гарантия Nero Network; честная методология deflection vs resolution.</p>
      </div>

      <div class="afq-table-wrap nero-ai-reveal">
        <table class="afq-table">
          <thead><tr><th>Кейс</th><th>Метрика</th><th>Источник</th></tr></thead>
          <tbody>
            <tr><td>СофтВейв (SaaS)</td><td>−45% тикетов только с людьми, −23% тикетов/мес</td><td>flow-masters.ru</td></tr>
            <tr><td>V-AI Labs (клиника)</td><td>72% без админов, −50% нагрузки</td><td>v-ai-labs.ru</td></tr>
            <tr><td>КНАУФ</td><td>до 50% экономии времени поддержки</td><td>generation-ai.ru</td></tr>
            <tr><td>Infomaze (SaaS)</td><td>70% тикетов закрывается автоматически</td><td>infomazeelite.com</td></tr>
          </tbody>
        </table>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-top:24px;">
        <h3>Какие метрики смотреть до и после внедрения</h3>
        <ul>
          <li>Время первого ответа (секунды vs часа)</li>
          <li>% resolved в виджете без эскалации</li>
          <li>% escalated — высокий на старте нормален</li>
          <li>Deflection vs resolution — не путать «отклонение» и полное self-service</li>
          <li>Топ «белых пятен» в KB — карта контента для маркетинга</li>
          <li>Конверсия с инфо-страниц (Метрика/GA4: widget_open, resolved, lead_from_widget)</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="afq-section" id="integracii">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">CMS · CRM · KB</span>
        <h2>Интеграции: CMS, CRM, чаты и источники знаний</h2>
      </div>
      <div class="afq-grid-2 nero-ai-reveal">
        <div class="afq-card">
          <h3>WordPress и другие CMS</h3>
          <p><strong>AI-FAQ WordPress</strong> — приоритет Nero Network: виджет в тему, блок FAQ в page-{slug}.php, Schema FAQPage без REST API для страниц с script/canvas.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Notion, Google Docs, PDF</h3>
          <p>Ingest pipeline: парсинг сайта, PDF, DOCX, Notion/Google Docs API, Confluence, help center URL.</p>
        </div>
        <div class="afq-card">
          <h3>CRM и аналитика</h3>
          <p>amoCRM, Bitrix24 — лид при эскалации с транскриптом. Яндекс.Метрика, GA4 — цели из виджета. Telegram — уведомление менеджеру.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Автоматизация</h3>
          <p>n8n / Make — webhook при «неотвеченном» вопросе → задача редактору в Notion.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="riski">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Compliance</span>
        <h2>Риски и как их закрываем при внедрении</h2>
      </div>
      <div class="afq-grid-3 nero-ai-reveal">
        <div class="afq-card">
          <h3>Галлюцинации</h3>
          <p>RAG «только из контекста», citations, confidence gate, human-in-the-loop на старте. Индивидуальные скидки и жалобы — у человека.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>152-ФЗ и GDPR</h3>
          <p>LLM и vector store в РФ, согласие в виджете, без трансграничной передачи ПДн без оснований. PII-маскирование в логах.</p>
        </div>
        <div class="afq-card nero-ai-delay-2">
          <h3>Живой оператор</h3>
          <p>Гибрид 24/7: бот на типовое, человек на сложное — с полным контекстом диалога. В медицине — только организационные ответы.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section" id="ceny">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">Коммерция</span>
        <h2>Стоимость AI-FAQ: из чего складывается чек 80–220 тыс. ₽</h2>
      </div>
      <div class="afq-table-wrap nero-ai-reveal">
        <table class="afq-table">
          <thead><tr><th>Пакет</th><th>Состав</th><th>Ориентир</th></tr></thead>
          <tbody>
            <tr><td><strong>Старт</strong></td><td>Виджет + KB до ~100 стр., WordPress, лог вопросов, ручное обновление FAQ</td><td><strong>80–120 тыс. ₽</strong></td></tr>
            <tr><td><strong>Бизнес</strong></td><td>+ CRM-лид, авто-предложения FAQ, 2 источника, аналитика</td><td><strong>120–180 тыс. ₽</strong></td></tr>
            <tr><td><strong>Pro</strong></td><td>+ reranker, Telegram, SLA на KB 30 дней, eval-отчёт</td><td><strong>180–220 тыс. ₽</strong></td></tr>
          </tbody>
        </table>
      </div>
      <p class="nero-ai-reveal" style="margin-top:16px;text-align:left;">Ежемесячно: хостинг + токены LLM <strong>~3 000–15 000 ₽</strong> (средний трафик). Сравнение с 0,5–1 FTE в поддержке: оператор ~80–150 тыс. ₽/мес + онбординг.</p>
    </div>
  </section>

  <section class="afq-section afq-section-alt" id="etapy">
    <div class="afq-cnt">
      <div class="afq-sh afq-left">
        <span class="afq-eyebrow">Процесс</span>
        <h2>Этапы работы с Nero Network: от брифа до запуска</h2>
      </div>
      <div class="afq-card nero-ai-reveal">
        <div class="afq-timeline">
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>Бриф и сбор базы знаний</h3><p>ЦА, каналы, текущий FAQ, CRM, чувствительные темы. Приоритизация топ-30 вопросов.</p></div>
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>MVP RAG-виджета (1–2 недели)</h3><p>Ingest → vector store → виджет. Логирование и динамический FAQ (3–7 дней): дашборд «топ без ответа».</p></div>
          <div class="afq-tl-item"><div class="afq-tl-dot"></div><h3>Пилот и масштабирование</h3><p>2–4 недели на части трафика, доработка по логам. Админка: PDF/ссылка → переиндексация без программиста на каждую правку.</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="afq-section" id="samostoyatelno">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">DIY vs под ключ</span>
        <h2>Как сделать AI-FAQ самостоятельно — и когда лучше заказать под ключ</h2>
      </div>
      <div class="afq-grid-2 nero-ai-reveal">
        <div class="afq-card">
          <h3>Обзор подхода: RAG, промпты, виджет</h3>
          <p>Vector store, ingest, LLM с system prompt «только из контекста», open-source или SaaS-виджет, логирование и eval. Хорошо настроенный RAG — 55–72% tier-1 без человека при качественной KB.</p>
        </div>
        <div class="afq-card nero-ai-delay-1">
          <h3>Типичные ошибки DIY</h3>
          <p>Индексация «сырого» KB, нет confidence threshold, игнор 152-ФЗ, обещание «−80% тикетов» без eval, виджет без связки с SEO-FAQ.</p>
        </div>
      </div>
      <div class="afq-card nero-ai-reveal" style="margin-top:18px;">
        <h3>Когда выгоднее передать внедрение команде</h3>
        <p>WordPress-native, динамическое обновление FAQ-блока, CRM, compliance, отраслевые сценарии (клиника, SaaS, B2B), eval с метриками accuracy. Уникальный угол Nero Network: <strong>«не просто чат — живой FAQ на сайте»</strong> + пакеты 80–220 тыс. ₽ с TCO.</p>
      </div>
    </div>
  </section>

  <aside class="ym-cta-block ym-cta-block--secondary afq-cnt" id="cta-obuchenie" style="max-width:1180px;margin-left:auto;margin-right:auto;">
    <div class="ym-cta-block__body">
      <p class="ym-cta-block__headline">Хотите разобраться в RAG и AI-FAQ до старта проекта?</p>
      <p class="ym-cta-block__sub">Если команде важно понимать chunking, промпты, human-in-the-loop и eval до заказа внедрения — посмотрите <a href="<?php echo esc_url(getenv('SECONDARY_CTA_URL') ?: ''); ?>" class="ym-link ym-link--accent" target="_blank" rel="noopener noreferrer"><?php echo esc_html(getenv('SECONDARY_CTA_LABEL') ?: 'обучение по внедрению AI в бизнес-процессы'); ?></a>. Это ускоряет согласование пилота с IT и поддержкой.</p>
    </div>
  </aside>

  <section class="afq-section afq-section-alt" id="faq">
    <div class="afq-cnt">
      <div class="afq-sh">
        <span class="afq-eyebrow">FAQ</span>
        <h2>FAQ о AI-FAQ</h2>
      </div>
      <div class="afq-faq nero-ai-reveal">
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли подключить AI-FAQ к WordPress?</div><div class="afq-faq-a">Да. Виджет вставляется скриптом в тему; FAQ-блок синхронизируется с утверждёнными Q&A. Nero Network работает с WordPress-native шаблонами без REST API для страниц с script/canvas.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько времени занимает запуск?</div><div class="afq-faq-a">MVP RAG-виджета — 1–2 недели; полный цикл с пилотом — 2–4 недели. КНАУФ — 2 недели до прод; при готовой платформе — вывод за 1 день.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Нужна ли готовая база знаний до старта?</div><div class="afq-faq-a">Не обязательно. Достаточно FAQ, типовых писем поддержки, регламентов, прайса. Аудит выявит «белые пятна».</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Подходит ли AI-FAQ для клиник и образовательных проектов?</div><div class="afq-faq-a">Да. Клиники: организационные FAQ, записи, расписание — не медсоветы. EdTech: программы, оплата, дедлайны.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как виджет обновляет FAQ без ручного редактирования страниц?</div><div class="afq-faq-a">Лог вопросов → кластеризация → черновик Q&A → модерация редактора → публикация в блок FAQ (WP) + Schema FAQPage.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Чем AI-FAQ отличается от обычного чат-бота?</div><div class="afq-faq-a">Чат-бот — сценарные ветки; AI-FAQ — семантический поиск по KB + опциональное обновление SEO-блока FAQ.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Сколько стоит AI-FAQ?</div><div class="afq-faq-a">80–220 тыс. ₽ разово (пакеты Старт/Бизнес/Pro) + ~3 000–15 000 ₽/мес на LLM и хостинг.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Бот соврёт?</div><div class="afq-faq-a">RAG только по вашим документам, citations, порог уверенности, эскалация. Качество KB — главный фактор.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как соблюсти 152-ФЗ?</div><div class="afq-faq-a">LLM и БД в РФ, согласие в виджете, без трансграничной передачи ПДн без оснований.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Какие модели используют?</div><div class="afq-faq-a">YandexGPT, GigaChat, Cotype; embedding — Yandex или open-source на RF-сервере.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Нужен ли программист для обновления ответов?</div><div class="afq-faq-a">После запуска — админка: PDF/ссылка → переиндексация. Разработчик — для новых интеграций.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Как измерить ROI?</div><div class="afq-faq-a">Сравнить время ответа, % resolved, тикеты/мес, конверсию с инфо-страниц до и после пилота.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Можно ли интегрировать с amoCRM и Bitrix24?</div><div class="afq-faq-a">Да — лид при эскалации с транскриптом и тегом «AI-FAQ».</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Поддерживаются ли Notion и Google Docs?</div><div class="afq-faq-a">Да, через ingest API; плюс PDF, сайт, Confluence, help center URL.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Что если клиент хочет только человека?</div><div class="afq-faq-a">Гибрид: бот 24/7 на типовое, оператор с контекстом диалога на сложное.</div></div>
        <div class="afq-faq-item"><div class="afq-faq-q" role="button" tabindex="0" aria-expanded="false">Есть ли демо на странице?</div><div class="afq-faq-a">На лендинге Nero Network — живой виджет «спросите про AI-FAQ»; CTA «Собрать AI-FAQ».</div></div>
      </div>

      <div class="ym-cta-block ym-cta-block--footer-final nero-ai-reveal" id="cta-final" style="margin-top:32px;">
        <div class="ym-cta-block__body">
          <p class="ym-cta-block__headline">Готовы обновить FAQ и снизить нагрузку на поддержку?</p>
          <p class="ym-cta-block__sub">Бесплатная схема внедрения: виджет + RAG + динамическое обновление FAQ-блока. Пакеты Старт / Бизнес / Pro — от 80 тыс. ₽.</p>
          <div class="ym-cta-block__actions">
            <a href="<?php echo esc_url($primary_cta_url); ?>" class="nero-ai-btn nero-ai-btn-primary ym-btn ym-btn--accent"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
            <a href="#etapy" class="nero-ai-btn nero-ai-btn-secondary ym-btn ym-btn--ghost">Этапы внедрения →</a>
          </div>
        </div>
      </div>

      <div class="afq-card nero-ai-reveal" style="margin-top:28px;">
        <h3 style="font-size:18px;margin-bottom:12px;">Чеклист подготовки к внедрению</h3>
        <ul class="afq-checklist">
          <li>Текущий FAQ и 30–50 реальных вопросов от поддержки</li>
          <li>Регламенты, прайс, инструкции</li>
          <li>Список запрещённых тем и дисклеймеры</li>
          <li>Доступ к CMS для виджета и FAQ-блока</li>
          <li>Политика ПДн и механизм согласия</li>
        </ul>
        <p style="margin-top:18px;"><strong>Итог:</strong> AI-FAQ для сайта — практичный способ закрыть устаревший FAQ, снизить нагрузку на поддержку и поднять конверсию актуальными ответами 24/7. Nero Network внедряет виджет + RAG + динамическое обновление FAQ-блока под ключ в коридоре <strong>80–220 тыс. ₽</strong>.</p>
      </div>
    </div>
  </section>

</div>

<!-- SCHEMA-MARKUP:INSERT -->
</main>
'''


def php_footer() -> str:
    return r'''
<script>
(function(){
  document.querySelectorAll('.afq-faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var item = btn.closest('.afq-faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.afq-faq-item.open').forEach(function(el){
        el.classList.remove('open');
        var q = el.querySelector('.afq-faq-q');
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
  var root = document.querySelector('.ai-faq-dlya-saita-page');
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
'''


def main() -> None:
    hero = extract_html(FRAG_ALINA)
    boris = extract_html(FRAG_BORIS)
    content = page_content().replace('  <!-- BORIS_BLOCK -->', '\n' + boris + '\n')
    full = php_header() + '\n' + hero + '\n' + content + php_footer()
    OUT.write_text(full, encoding='utf-8')
    print(f'Wrote {OUT} ({len(full)} bytes)')


if __name__ == '__main__':
    main()
