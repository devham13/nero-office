<?php
/**
 * Плавающая pill-шапка для AI-лендингов (стиль главной сайта).
 *
 * Ожидает:
 * - $nero_ai_header_links — массив ['label' => string, 'href' => string]
 * - $primary_cta_label, $primary_cta_url
 * - опционально $secondary_cta_label, $secondary_cta_url (кнопка-призрак на desktop)
 * - опционально $brand (иначе get_bloginfo('name'))
 */
if (!isset($nero_ai_header_links) || !is_array($nero_ai_header_links)) {
    $nero_ai_header_links = [];
}
$brand = $brand ?? (get_bloginfo('name') ?: 'AI-автоматизация');
$primary_cta_label = $primary_cta_label ?? 'Написать в Telegram';
$primary_cta_url = $primary_cta_url ?? (function_exists('nero_ai_primary_cta_url') ? nero_ai_primary_cta_url() : (defined('NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL') ? NERO_AI_DEFAULT_TELEGRAM_CHANNEL_URL : ''));
$primary_cta_attrs = function_exists('nero_ai_primary_cta_link_attrs') ? nero_ai_primary_cta_link_attrs($primary_cta_url) : '';
$logo_src = '';
$custom_logo_id = get_theme_mod('custom_logo');
if ($custom_logo_id) {
    $logo_src = (string) wp_get_attachment_image_url($custom_logo_id, 'full');
}
if ($logo_src === '') {
    $theme_img_dir = get_stylesheet_directory() . '/assets/images/';
    if (is_dir($theme_img_dir)) {
        $matches = glob($theme_img_dir . '*logo*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        if (!empty($matches[0])) {
            $logo_src = get_stylesheet_directory_uri() . '/assets/images/' . basename($matches[0]);
        }
    }
}
$home = home_url('/');
?>
<header class="nero-ai-header" id="nero-ai-header" role="banner">
  <div class="nero-ai-header-shell">
    <div class="nero-ai-header-bar">
      <a class="nero-ai-header-logo" href="<?php echo esc_url($home); ?>" aria-label="<?php echo esc_attr($brand); ?> — на главную">
        <img
          class="nero-ai-header-logo-img"
          src="<?php echo esc_url($logo_src); ?>"
          width="42"
          height="42"
          alt=""
          decoding="async"
        />
        <span class="nero-ai-header-logo-text"><?php echo esc_html($brand); ?></span>
      </a>

      <nav class="nero-ai-header-nav" id="nero-ai-header-nav" aria-label="Навигация по странице">
        <div class="nero-ai-header-pill">
          <?php foreach ($nero_ai_header_links as $item) : ?>
            <a class="nero-ai-header-link" href="<?php echo esc_url($item['href'] ?? '#'); ?>"><?php echo esc_html($item['label'] ?? ''); ?></a>
          <?php endforeach; ?>
          <a class="nero-ai-header-cta nero-ai-header-cta--mobile" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </nav>

      <div class="nero-ai-header-actions">
        <?php if (!empty($secondary_cta_label) && !empty($secondary_cta_url)) : ?>
          <a class="nero-ai-header-cta nero-ai-header-cta--ghost" href="<?php echo esc_url($secondary_cta_url); ?>"><?php echo esc_html($secondary_cta_label); ?></a>
        <?php endif; ?>
        <a class="nero-ai-header-cta" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $primary_cta_attrs; ?>><?php echo esc_html($primary_cta_label); ?></a>
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
