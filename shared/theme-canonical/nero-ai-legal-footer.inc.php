<?php
/**
 * Юридический блок для AI-лонгридов — вставлять перед get_footer().
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$legal_helpers = dirname(__DIR__) . '/site-legal.php';
if (is_readable($legal_helpers)) {
    require_once $legal_helpers;
}

if (function_exists('nero_site_render_legal_footer_block')) {
    nero_site_render_legal_footer_block();
}
