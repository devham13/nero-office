<?php
/** Hero Алины — ai-seo-kontent. Не удалять canvas/script. */
?>
<section class="nero-ai-hero aseo-hero" id="aseo-hero" aria-labelledby="aseo-hero-title">
<style>
/* ── Hero ai-seo-kontent: самодостаточные стили (без CSS темы) ── */
.aseo-hero {
  --aseo-cyan: #79f2ff;
  --aseo-violet: #8b5cf6;
  --aseo-green: #22c55e;
  --aseo-text: #e6edf7;
  --aseo-muted: #9aa8bd;
  --aseo-soft: #c7d2e5;
  --aseo-shadow: 0 28px 90px rgba(0, 0, 0, 0.42);
  position: relative;
  min-height: min(980px, calc(100dvh - 1px));
  display: grid;
  align-items: center;
  padding: clamp(72px, 9vw, 132px) 0 clamp(44px, 7vw, 86px);
  isolation: isolate;
}
.aseo-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(circle at 42% 32%, #000 0%, transparent 72%);
  opacity: .55;
  pointer-events: none;
  z-index: -2;
}
.aseo-hero::after {
  content: "";
  position: absolute;
  left: 18%;
  top: 10%;
  width: 760px;
  height: 760px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(139, 92, 246, .14), transparent 66%);
  filter: blur(8px);
  animation: aseoHeroGlow 9s ease-in-out infinite alternate;
  z-index: -1;
  pointer-events: none;
}
@keyframes aseoHeroGlow {
  from { opacity: .42; transform: scale(.96); }
  to { opacity: .88; transform: scale(1.05); }
}
.aseo-hero .nero-ai-container {
  width: min(1220px, calc(100% - 40px));
  margin: 0 auto;
  position: relative;
  z-index: 1;
}
.aseo-hero .nero-ai-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.02fr) minmax(360px, .98fr);
  gap: clamp(28px, 4vw, 56px);
  align-items: center;
}
.aseo-hero .nero-ai-hero-copy h1 {
  margin: 0;
  max-width: 800px;
  font-size: clamp(36px, 5.4vw, 68px);
  line-height: .96;
  letter-spacing: -0.06em;
  color: #fff;
  font-weight: 900;
}
.aseo-hero .nero-ai-gradient-text {
  background: linear-gradient(92deg, #fff 0%, var(--aseo-cyan) 40%, #c4b5fd 100%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent !important;
}
.aseo-hero .nero-ai-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 16px;
  padding: 8px 12px;
  border: 1px solid rgba(121, 242, 255, 0.22);
  border-radius: 999px;
  background: rgba(121, 242, 255, 0.08);
  color: var(--aseo-cyan) !important;
  font-size: 13px;
  font-weight: 750;
  line-height: 1;
  text-transform: uppercase;
  letter-spacing: 0.1em;
}
.aseo-hero .nero-ai-hero-lead {
  margin: 22px 0 0;
  max-width: 720px;
  color: var(--aseo-soft) !important;
  font-size: clamp(17px, 1.9vw, 21px);
  line-height: 1.58;
}
.aseo-hero .nero-ai-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 26px 0 0;
  padding: 0;
  list-style: none;
}
.aseo-hero .nero-ai-badge {
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
.aseo-hero .nero-ai-btn-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
  margin-top: 34px;
}
.aseo-hero .nero-ai-btn {
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
.aseo-hero .nero-ai-btn:hover { transform: translateY(-2px); }
.aseo-hero .nero-ai-btn-primary {
  color: #041018 !important;
  background: linear-gradient(135deg, var(--aseo-cyan), #a5f3fc);
  box-shadow: 0 18px 42px rgba(121, 242, 255, 0.22);
}
.aseo-hero .nero-ai-btn-secondary {
  color: var(--aseo-text) !important;
  background: rgba(255, 255, 255, 0.07);
  border-color: rgba(255, 255, 255, 0.14);
}
.aseo-hero .nero-ai-dashboard {
  position: relative;
  padding: 18px;
  border-radius: 34px;
  background: rgba(2, 6, 23, 0.42);
  box-shadow: var(--aseo-shadow);
  transform: perspective(1100px) rotateY(-2deg) rotateX(2deg);
}
.aseo-hero .nero-ai-dashboard-shell {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 26px;
  background: linear-gradient(180deg, rgba(15, 23, 42, .95), rgba(6, 10, 24, .96));
}
.aseo-hero .nero-ai-window-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 14px;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,.08);
  background: rgba(255,255,255,.045);
}
.aseo-hero .nero-ai-dots { display: flex; gap: 7px; }
.aseo-hero .nero-ai-dot { width: 10px; height: 10px; border-radius: 50%; }
.aseo-hero .nero-ai-dot:nth-child(1) { background: #fb7185; }
.aseo-hero .nero-ai-dot:nth-child(2) { background: #fbbf24; }
.aseo-hero .nero-ai-dot:nth-child(3) { background: #34d399; }
.aseo-hero .nero-ai-window-title {
  color: #cfe3f9;
  font-size: 11px;
  font-weight: 750;
  letter-spacing: .08em;
  text-transform: uppercase;
}
.aseo-hero .nero-ai-window-body { padding: 16px; }
.aseo-hero .nero-ai-dashboard-title {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 10px;
}
.aseo-hero .nero-ai-dashboard-title h3 {
  margin: 0;
  font-size: 18px;
  letter-spacing: -0.03em;
  color: #fff;
}
.aseo-hero .nero-ai-live-pill {
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
.aseo-hero .nero-ai-live-pill::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.14);
  animation: aseoPulse 1.6s infinite;
}
@keyframes aseoPulse {
  0%, 100% { transform: scale(.86); opacity: .65; }
  50% { transform: scale(1); opacity: 1; }
}
.aseo-hero .aseo-pipeline-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 12px;
  padding: 8px 10px;
  border-radius: 14px;
  border: 1px solid rgba(121,242,255,.14);
  background: rgba(121,242,255,.05);
  font-size: 10px;
  font-weight: 800;
  color: #b8e8ff;
  letter-spacing: .04em;
}
.aseo-hero .aseo-pipeline-strip span {
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.aseo-hero .aseo-pipeline-strip .arr { color: var(--aseo-violet); opacity: .85; }
.aseo-hero .nero-ai-metrics-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 8px;
  margin-bottom: 12px;
}
.aseo-hero .nero-ai-metric {
  padding: 10px;
  border: 1px solid rgba(255,255,255,.09);
  border-radius: 14px;
  background: rgba(255,255,255,.055);
}
.aseo-hero .nero-ai-metric span {
  display: block;
  color: var(--aseo-muted);
  font-size: 10px;
  font-weight: 700;
}
.aseo-hero .nero-ai-metric strong {
  display: block;
  margin-top: 4px;
  color: #fff;
  font-size: 18px;
  line-height: 1;
}
.aseo-hero .nero-ai-metric small {
  display: block;
  margin-top: 3px;
  color: #9fb0c9;
  font-size: 10px;
}
.aseo-hero .aseo-dash-canvas-wrap {
  position: relative;
  height: clamp(210px, 30vw, 280px);
  margin: 0 0 12px;
  border-radius: 18px;
  overflow: hidden;
  border: 1px solid rgba(139, 92, 246, 0.2);
  background: radial-gradient(ellipse at 35% 40%, rgba(121,242,255,.08), rgba(6,10,24,.94) 72%);
}
.aseo-hero #aseo-factory-canvas {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  display: block;
}
.aseo-hero .aseo-cluster-table {
  display: grid;
  gap: 6px;
  margin-bottom: 10px;
}
.aseo-hero .aseo-cluster-row {
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  gap: 8px;
  padding: 7px 10px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 12px;
  background: rgba(255,255,255,.035);
  font-size: 11px;
}
.aseo-hero .aseo-cluster-row strong { color: #f1f5f9; font-weight: 800; }
.aseo-hero .aseo-cluster-row span { color: var(--aseo-muted); font-size: 10px; }
.aseo-hero .aseo-status {
  padding: 3px 8px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
.aseo-hero .aseo-status--pub { background: rgba(34,197,94,.12); color: #bbf7d0; }
.aseo-hero .aseo-status--mod { background: rgba(245,158,11,.12); color: #fde68a; }
.aseo-hero .aseo-status--queue { background: rgba(121,242,255,.1); color: #b8e8ff; }
.aseo-hero .nero-ai-task-stream { display: grid; gap: 8px; }
.aseo-hero .nero-ai-task {
  display: grid;
  grid-template-columns: 28px 1fr auto;
  align-items: center;
  gap: 10px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 14px;
  background: rgba(255,255,255,.04);
}
.aseo-hero .nero-ai-task-icon {
  display: grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 12px;
  background: rgba(139,92,246,.14);
  color: #ddd6fe;
  font-size: 10px;
  font-weight: 800;
}
.aseo-hero .nero-ai-task strong {
  display: block;
  color: #f8fafc;
  font-size: 12px;
}
.aseo-hero .nero-ai-task span {
  color: var(--aseo-muted);
  font-size: 11px;
}
.aseo-hero .nero-ai-status {
  padding: 4px 8px;
  border-radius: 999px;
  background: rgba(34,197,94,.11);
  color: #bbf7d0;
  font-size: 10px;
  font-weight: 800;
  white-space: nowrap;
}
@media (max-width: 1100px) {
  .aseo-hero .nero-ai-hero-grid { grid-template-columns: 1fr; }
  .aseo-hero .nero-ai-dashboard { transform: none; }
  .aseo-hero .nero-ai-metrics-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 520px) {
  .aseo-hero .nero-ai-dashboard { padding: 10px; border-radius: 24px; }
  .aseo-hero .nero-ai-window-body { padding: 12px; }
  .aseo-hero .nero-ai-task { grid-template-columns: 28px 1fr; }
  .aseo-hero .nero-ai-status { grid-column: 2; width: fit-content; }
  .aseo-hero .aseo-pipeline-strip { font-size: 9px; }
}
</style>

  <div class="nero-ai-container nero-ai-hero-grid">
    <div class="nero-ai-hero-copy">
      <p class="nero-ai-eyebrow">SEO / контент · внедрение под ключ</p>
      <h1 id="aseo-hero-title">AI SEO-фабрика статей и посадочных страниц: <span class="nero-ai-gradient-text">внедрение под ключ</span></h1>
      <p class="nero-ai-hero-lead">Превращаем вашу семантику Wordstat в кластеры, SEO-статьи, лендинги и FAQ — с AI-агентами, проверкой качества и публикацией в CMS</p>
      <ul class="nero-ai-badges" aria-label="Ключевые этапы конвейера">
        <li class="nero-ai-badge">Wordstat</li>
        <li class="nero-ai-badge">Кластеры</li>
        <li class="nero-ai-badge">Статьи</li>
        <li class="nero-ai-badge">Лендинги</li>
        <li class="nero-ai-badge">FAQ</li>
        <li class="nero-ai-badge">CMS</li>
      </ul>
      <div class="nero-ai-btn-row">
        <a class="nero-ai-btn nero-ai-btn-primary" href="<?php echo esc_url( $primary_cta_url ); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html( $primary_cta_label ); ?></a>
        <a class="nero-ai-btn nero-ai-btn-secondary" href="#pipeline-6-steps">6 шагов конвейера</a>
      </div>
    </div>

    <div class="nero-ai-dashboard" aria-label="Демонстрация AI SEO-конвейера: от Wordstat до публикации">
      <div class="nero-ai-dashboard-shell">
        <div class="nero-ai-window-top">
          <div class="nero-ai-dots"><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span><span class="nero-ai-dot"></span></div>
          <span class="nero-ai-window-title">пример логики AI SEO-фабрики · демонстрационные данные</span>
        </div>
        <div class="nero-ai-window-body">
          <div class="nero-ai-dashboard-title">
            <h3>AI SEO-конвейер</h3>
            <span class="nero-ai-live-pill">Конвейер активен</span>
          </div>

          <div class="aseo-pipeline-strip" aria-label="Схема конвейера">
            <span>Wordstat</span><span class="arr">→</span>
            <span>Кластеры</span><span class="arr">→</span>
            <span>ТЗ</span><span class="arr">→</span>
            <span>Генерация</span><span class="arr">→</span>
            <span>QA</span><span class="arr">→</span>
            <span>CMS</span>
          </div>

          <div class="nero-ai-metrics-grid">
            <div class="nero-ai-metric">
              <span>Кластеров</span>
              <strong>450K</strong>
              <small>кейс Keys.so</small>
            </div>
            <div class="nero-ai-metric">
              <span>Трафик</span>
              <strong>×11</strong>
              <small>Kokoc / MBS</small>
            </div>
            <div class="nero-ai-metric">
              <span>На статью</span>
              <strong>~30 мин</strong>
              <small>+ модерация</small>
            </div>
          </div>

          <div class="aseo-dash-canvas-wrap" aria-hidden="false">
            <canvas id="aseo-factory-canvas" role="img" aria-label="Анимация: ключи Wordstat группируются в кластеры, собираются в страницы и публикуются в CMS"></canvas>
          </div>

          <div class="aseo-cluster-table" aria-label="Статусы кластеров">
            <div class="aseo-cluster-row">
              <div><strong>«ai seo контент под ключ»</strong><span>лендинг · коммерция</span></div>
              <span class="aseo-status aseo-status--pub">опубликован</span>
            </div>
            <div class="aseo-cluster-row">
              <div><strong>«нейросеть для seo»</strong><span>статья · информационный</span></div>
              <span class="aseo-status aseo-status--mod">модерация</span>
            </div>
            <div class="aseo-cluster-row">
              <div><strong>«ai кластеризация запросов»</strong><span>FAQ · НЧ-хвост</span></div>
              <span class="aseo-status aseo-status--queue">в очереди</span>
            </div>
          </div>

          <div class="nero-ai-task-stream" aria-label="Лента событий конвейера">
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">WS</span>
              <div><strong>Импорт 2 847 ключей</strong><span>Wordstat → Google Sheets</span></div>
              <span class="nero-ai-status">готово</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">AI</span>
              <div><strong>Кластер #184 — 12 фраз</strong><span>интент: коммерческий</span></div>
              <span class="nero-ai-status">ТЗ</span>
            </div>
            <div class="nero-ai-task">
              <span class="nero-ai-task-icon">↑</span>
              <div><strong>Лендинг опубликован</strong><span>WordPress · Schema FAQPage</span></div>
              <span class="nero-ai-status">live</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
