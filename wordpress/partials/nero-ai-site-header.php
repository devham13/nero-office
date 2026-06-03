<?php
/**
 * Плавающая шапка Nero AI — единый компонент для главной и лонгридов.
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$brand = getenv('SITE_BRAND') ?: get_bloginfo('name') ?: '[REDACTED]';
$primary_cta_label = getenv('PRIMARY_CTA_LABEL') ?: 'Бесплатный аудит';
$primary_cta_url = getenv('PRIMARY_CTA_URL') ?: home_url('/#audit');
$home_url = trailingslashit(home_url('/'));
$logo_url = get_stylesheet_directory_uri() . '/assets/images/neurinix-logo.jpg'; // pragma: allowlist secret

$nav_links = [
    ['href' => $home_url . '#services', 'label' => 'Услуги'],
    ['href' => $home_url . '#how-it-works', 'label' => 'Как работает'],
    ['href' => $home_url . '#process', 'label' => 'Процесс'],
    ['href' => $home_url . '#niches', 'label' => 'Кому подходит'],
    ['href' => $home_url . '#nero-ai-results-section', 'label' => 'Результат'],
    ['href' => $home_url . '#faq', 'label' => 'FAQ'],
];
?>
<header class="nero-ai-header" id="nero-ai-header" role="banner">
  <div class="nero-ai-header-shell">
    <div class="nero-ai-header-bar">
      <a class="nero-ai-header-logo" href="<?php echo esc_url($home_url); ?>" aria-label="<?php echo esc_attr($brand); ?> — на главную">
        <img
          class="nero-ai-header-logo-img"
          src="<?php echo esc_url($logo_url); ?>"
          width="42"
          height="42"
          alt=""
          decoding="async"
        />
        <span class="nero-ai-header-logo-text"><?php echo esc_html($brand); ?></span>
      </a>

      <nav class="nero-ai-header-nav" id="nero-ai-header-nav" aria-label="Основная навигация">
        <div class="nero-ai-header-pill">
          <?php foreach ($nav_links as $item) : ?>
            <a class="nero-ai-header-link" href="<?php echo esc_url($item['href']); ?>"><?php echo esc_html($item['label']); ?></a>
          <?php endforeach; ?>
          <a class="nero-ai-header-cta nero-ai-header-cta--mobile" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </nav>

      <div class="nero-ai-header-actions">
        <a class="nero-ai-header-cta" href="<?php echo esc_url($primary_cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($primary_cta_label); ?></a>
        <button type="button" class="nero-ai-header-toggle" id="nero-ai-header-toggle" aria-expanded="false" aria-controls="nero-ai-header-nav">
          <span class="nero-ai-header-toggle-line" aria-hidden="true"></span>
          <span class="nero-ai-header-toggle-line" aria-hidden="true"></span>
          <span class="nero-ai-header-toggle-line" aria-hidden="true"></span>
          <span class="screen-reader-text">Меню</span>
        </button>
      </div>
    </div>
  </div>
</header>
