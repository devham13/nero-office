<?php
/**
 * Plugin Name: Nero Site Legal (MU)
 * Description: Оператор сайта, ИНН, политика конфиденциальности, юридический футер.
 * Version: 1.0.0
 */
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('NERO_SITE_OPERATOR_NAME')) {
    define('NERO_SITE_OPERATOR_NAME', 'Горбачев Юрий Александрович');
}

if (!defined('NERO_SITE_OPERATOR_INN')) {
    define('NERO_SITE_OPERATOR_INN', '164807872488');
}

if (!defined('NERO_SITE_OPERATOR_EMAIL')) {
    define('NERO_SITE_OPERATOR_EMAIL', 'devham@mail.ru');
}

if (!defined('NERO_SITE_PRIVACY_PATH')) {
    define('NERO_SITE_PRIVACY_PATH', '/politika-konfidentsialnosti/');
}

if (!defined('NERO_SITE_CONTACTS_PATH')) {
    define('NERO_SITE_CONTACTS_PATH', '/kontakty/');
}

if (!defined('NERO_SITE_TERMS_PATH')) {
    define('NERO_SITE_TERMS_PATH', '/usloviya-ispolzovaniya/');
}

if (!defined('NERO_SITE_ABOUT_PATH')) {
    define('NERO_SITE_ABOUT_PATH', '/o-kompanii/');
}

if (!function_exists('nero_site_privacy_url')) {
    function nero_site_privacy_url(): string
    {
        return home_url(NERO_SITE_PRIVACY_PATH);
    }
}

if (!function_exists('nero_site_contacts_url')) {
    function nero_site_contacts_url(): string
    {
        return home_url(NERO_SITE_CONTACTS_PATH);
    }
}

if (!function_exists('nero_site_operator_line')) {
    function nero_site_operator_line(): string
    {
        return sprintf('Оператор: %s, ИНН %s', NERO_SITE_OPERATOR_NAME, NERO_SITE_OPERATOR_INN);
    }
}

if (!function_exists('nero_site_privacy_consent_line')) {
    function nero_site_privacy_consent_line(): string
    {
        return 'Отправляя обращение, вы соглашаетесь с '
            . '<a href="' . esc_url(nero_site_privacy_url()) . '">политикой конфиденциальности</a>. '
            . 'Мы не запрашиваем пароли, коды из SMS, данные банковских карт и доступы к аккаунтам.';
    }
}

if (!function_exists('nero_site_render_legal_footer_block')) {
    function nero_site_render_legal_footer_block(): void
    {
        $links = [
            nero_site_privacy_url()        => 'Политика конфиденциальности',
            nero_site_contacts_url()       => 'Контакты',
            home_url(NERO_SITE_ABOUT_PATH) => 'О проекте',
            home_url(NERO_SITE_TERMS_PATH) => 'Условия использования',
        ];

        echo '<aside class="nero-site-legal-block" role="contentinfo" aria-label="Юридическая информация">';
        echo '<p class="nero-site-legal-operator"><small>' . esc_html(nero_site_operator_line()) . '</small></p>';
        echo '<nav class="nero-site-legal-nav" aria-label="Юридические документы"><p>';
        $parts = [];
        foreach ($links as $url => $label) {
            $parts[] = '<a href="' . esc_url($url) . '">' . esc_html($label) . '</a>';
        }
        echo implode(' · ', $parts);
        echo '</p></nav>';
        echo '<p class="nero-site-legal-consent"><small>' . wp_kses_post(nero_site_privacy_consent_line()) . '</small></p>';
        echo '</aside>';
    }
}
