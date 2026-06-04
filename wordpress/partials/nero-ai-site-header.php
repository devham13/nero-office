<?php
/**
 * Плавающая шапка Nero AI.
 * На лонгридах задайте $nero_header_nav_links (и при необходимости CTA) до require.
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$brand = getenv('SITE_BRAND') ?: get_bloginfo('name') ?: '[REDACTED]';
$home_url = trailingslashit(home_url('/'));
$page_url = trailingslashit(get_permalink() ?: $home_url);
$logo_url = get_stylesheet_directory_uri() . '/assets/images/neurinix-logo.jpg'; // pragma: allowlist secret

if (!isset($nero_header_nav_links) || !is_array($nero_header_nav_links) || $nero_header_nav_links === []) {
    $nero_header_nav_links = [
        ['href' => $home_url . '#services', 'label' => 'Услуги'],
        ['href' => $home_url . '#how-it-works', 'label' => 'Как работает'],
        ['href' => $home_url . '#process', 'label' => 'Процесс'],
        ['href' => $home_url . '#niches', 'label' => 'Кому подходит'],
        ['href' => $home_url . '#nero-ai-results-section', 'label' => 'Результат'],
        ['href' => $home_url . '#faq', 'label' => 'FAQ'],
    ];
}

$resolve_header_href = static function (string $href) use ($page_url, $home_url): string {
    if ($href === '') {
        return $page_url;
    }
    if ($href[0] === '#') {
        return $page_url . $href;
    }
    if (str_starts_with($href, '/')) {
        return home_url($href);
    }
    return $href;
};

$primary_cta_label = $nero_header_cta_label ?? (getenv('PRIMARY_CTA_LABEL') ?: 'Бесплатный аудит');
$primary_cta_url = $resolve_header_href($nero_header_cta_url ?? (getenv('PRIMARY_CTA_URL') ?: '#audit'));
$cta_is_external = str_starts_with($primary_cta_url, 'http') && !str_starts_with($primary_cta_url, home_url());
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

      <nav class="nero-ai-header-nav" id="nero-ai-header-nav" aria-label="Навигация по странице">
        <div class="nero-ai-header-pill">
          <?php foreach ($nero_header_nav_links as $item) : ?>
            <?php
            $label = (string) ($item['label'] ?? '');
            $href = $resolve_header_href((string) ($item['href'] ?? '#'));
            if ($label === '') {
                continue;
            }
            ?>
            <a class="nero-ai-header-link" href="<?php echo esc_url($href); ?>"><?php echo esc_html($label); ?></a>
          <?php endforeach; ?>
          <a class="nero-ai-header-cta nero-ai-header-cta--mobile" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $cta_is_external ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($primary_cta_label); ?></a>
        </div>
      </nav>

      <div class="nero-ai-header-actions">
        <a class="nero-ai-header-cta" href="<?php echo esc_url($primary_cta_url); ?>"<?php echo $cta_is_external ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($primary_cta_label); ?></a>
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
