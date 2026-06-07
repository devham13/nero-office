<?php
/**
 * Hero в стиле главной сайта (.nero-ai-home).
 * Переменные задаются в page-{slug}.php до require.
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$hero_eyebrow = $hero_eyebrow ?? '';
$hero_title = $hero_title ?? '';
$hero_title_id = $hero_title_id ?? 'nero-ai-hero-title';
$hero_lead = $hero_lead ?? '';
$hero_badges = $hero_badges ?? [];
$hero_primary_label = $hero_primary_label ?? (getenv('PRIMARY_CTA_LABEL') ?: 'Написать в Telegram');
$hero_primary_url = $hero_primary_url ?? (function_exists('nero_ai_primary_cta_url') ? nero_ai_primary_cta_url() : (defined('NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL') ? NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL : ''));
$hero_primary_attrs = '';
if (function_exists('nero_ai_primary_cta_link_attrs')) {
    $hero_primary_attrs = nero_ai_primary_cta_link_attrs($hero_primary_url);
} elseif (function_exists('nero_ai_external_link_attrs')) {
    $hero_primary_attrs = nero_ai_external_link_attrs($hero_primary_url);
} elseif (str_starts_with($hero_primary_url, 'http')) {
    $hero_primary_attrs = ' target="_blank" rel="noopener noreferrer"';
}
$hero_secondary_label = $hero_secondary_label ?? (getenv('SECONDARY_CTA_LABEL') ?: 'Что можно автоматизировать');
$hero_secondary_url = $hero_secondary_url ?? (getenv('SECONDARY_CTA_URL') ?: home_url('/#services'));
$hero_secondary_external = $hero_secondary_external ?? null;
if ($hero_secondary_external === null && function_exists('nero_ai_external_link_attrs')) {
    $hero_secondary_external = nero_ai_external_link_attrs($hero_secondary_url) !== '';
} elseif ($hero_secondary_external === null) {
    $hero_secondary_external = str_starts_with($hero_secondary_url, 'http') && !str_starts_with($hero_secondary_url, home_url());
}
$hero_dashboard_title = $hero_dashboard_title ?? 'AI-операционный центр';
$hero_dashboard_note = $hero_dashboard_note ?? 'пример логики AI-системы · демонстрационные данные';
$hero_metrics = $hero_metrics ?? [];
$hero_feed = $hero_feed ?? [];
?>
<div class="nero-ai-home">
  <section class="nero-ai-hero nero-ai-section" aria-labelledby="<?php echo esc_attr($hero_title_id); ?>">
    <div class="nero-ai-container">
      <div class="nero-ai-hero-grid">
        <div>
          <?php if ($hero_eyebrow !== '') : ?>
            <span class="nero-ai-eyebrow"><?php echo esc_html($hero_eyebrow); ?></span>
          <?php endif; ?>
          <h1 id="<?php echo esc_attr($hero_title_id); ?>" class="nero-ai-h1"><?php echo esc_html($hero_title); ?></h1>
          <p class="nero-ai-lead"><?php echo esc_html($hero_lead); ?></p>
          <?php if ($hero_badges !== []) : ?>
            <div class="nero-ai-badges" aria-label="Ключевые этапы">
              <?php foreach ($hero_badges as $badge) : ?>
                <span class="nero-ai-badge"><?php echo esc_html((string) $badge); ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <div class="nero-ai-cta-row">
            <a class="nero-ai-btn nero-ai-btn--primary" href="<?php echo esc_url($hero_primary_url); ?>"<?php echo $hero_primary_attrs; ?>><?php echo esc_html($hero_primary_label); ?></a>
            <a class="nero-ai-btn nero-ai-btn--ghost" href="<?php echo esc_url($hero_secondary_url); ?>"<?php echo $hero_secondary_external ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($hero_secondary_label); ?></a>
          </div>
        </div>
        <div class="nero-ai-dashboard" aria-label="Демонстрация AI-обработки заявок">
          <p class="nero-ai-dashboard-note"><?php echo esc_html($hero_dashboard_note); ?></p>
          <div class="nero-ai-dash-header">
            <span class="nero-ai-dash-title"><?php echo esc_html($hero_dashboard_title); ?></span>
            <span class="nero-ai-dash-status">онлайн</span>
          </div>
          <?php if ($hero_metrics !== []) : ?>
            <div class="nero-ai-dash-grid">
              <?php foreach ($hero_metrics as $metric) : ?>
                <div class="nero-ai-dash-card">
                  <strong><?php echo esc_html((string) ($metric['value'] ?? '')); ?></strong>
                  <span><?php echo esc_html((string) ($metric['label'] ?? '')); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($hero_feed !== []) : ?>
            <div class="nero-ai-dash-feed">
              <?php foreach ($hero_feed as $row) : ?>
                <?php
                $dot = preg_replace('/[^a-z]/', '', (string) ($row['dot'] ?? 'blue'));
                $dot_class = in_array($dot, ['blue', 'green', 'amber'], true) ? $dot : 'blue';
                ?>
                <div class="nero-ai-dash-row">
                  <span class="nero-ai-dash-dot nero-ai-dash-dot--<?php echo esc_attr($dot_class); ?>" aria-hidden="true"></span>
                  <?php echo esc_html((string) ($row['text'] ?? '')); ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</div>
