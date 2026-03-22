<?php
/**
 * Afrobass Festival Theme — functions.php
 */
defined('ABSPATH') || exit;

/* ─── SETUP ─── */
function fest_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('fest-artist', 600, 750, true);
    add_image_size('fest-hero',   1920, 1080, true);
    register_nav_menus(['primary' => 'Primary Navigation']);
}
add_action('after_setup_theme', 'fest_setup');

/* ─── ENQUEUE ─── */
function fest_enqueue() {
    wp_enqueue_style('fest-main', get_template_directory_uri() . '/assets/css/main.css', [], '3.0.0');
    wp_enqueue_style('fest-style', get_stylesheet_uri(), ['fest-main'], '3.0.0');
    wp_enqueue_script('fest-main', get_template_directory_uri() . '/assets/js/main.js', [], '3.0.0', true);
    wp_localize_script('fest-main', 'festAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('fest_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'fest_enqueue');

/* ─── CUSTOM POST TYPE — ARTISTS ─── */
function fest_register_artists() {
    register_post_type('fest_artist', [
        'labels' => [
            'name'          => 'Artists',
            'singular_name' => 'Artist',
            'add_new_item'  => 'Add New Artist',
            'menu_name'     => 'Artists',
        ],
        'public'       => true,
        'has_archive'  => false,
        'rewrite'      => ['slug' => 'artist', 'with_front' => false],
        'supports'     => ['title', 'thumbnail', 'editor'],
        'menu_icon'    => 'dashicons-microphone',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'fest_register_artists');

/* ─── ACF FIELDS ─── */
function fest_register_acf() {
    if (!function_exists('acf_add_local_field_group')) return;

    /* Artists */
    acf_add_local_field_group([
        'key'    => 'group_fest_artist',
        'title'  => 'Artist Details',
        'fields' => [
            ['key'=>'field_fest_artist_role',      'label'=>'Role',         'name'=>'fest_artist_role',      'type'=>'select',
             'choices'=>['Headliner'=>'Headliner','Co-Headliner'=>'Co-Headliner','Supporting Act'=>'Supporting Act','DJ Set'=>'DJ Set','Special Guest'=>'Special Guest'],
             'default_value'=>'Headliner'],
            ['key'=>'field_fest_artist_origin',    'label'=>'Origin',       'name'=>'fest_artist_origin',    'type'=>'text', 'placeholder'=>'Lagos, Nigeria'],
            ['key'=>'field_fest_artist_bio',       'label'=>'Short Bio',    'name'=>'fest_artist_bio',       'type'=>'textarea', 'rows'=>3],
            ['key'=>'field_fest_artist_instagram', 'label'=>'Instagram URL','name'=>'fest_artist_instagram', 'type'=>'url'],
            ['key'=>'field_fest_artist_spotify',   'label'=>'Spotify URL',  'name'=>'fest_artist_spotify',   'type'=>'url'],
            ['key'=>'field_fest_artist_order',     'label'=>'Display Order','name'=>'fest_artist_order',     'type'=>'number', 'default_value'=>10],
            ['key'=>'field_fest_artist_tba',       'label'=>'TBA (hide name/photo)','name'=>'fest_artist_tba','type'=>'true_false','default_value'=>0],
        ],
        'location' => [[ ['param'=>'post_type','operator'=>'==','value'=>'fest_artist'] ]],
    ]);

    /* Homepage / Site Settings */
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Festival Settings',
            'menu_title' => 'Festival Settings',
            'menu_slug'  => 'fest-settings',
            'capability' => 'manage_options',
            'icon_url'   => 'dashicons-tickets-alt',
        ]);
        acf_add_local_field_group([
            'key'    => 'group_fest_settings',
            'title'  => 'Festival Settings',
            'fields' => [
                ['key'=>'field_fest_hero_video',    'label'=>'Hero Video (MP4)',     'name'=>'fest_hero_video',    'type'=>'file',  'return_format'=>'array', 'mime_types'=>'mp4,webm'],
                ['key'=>'field_fest_ticket_url',    'label'=>'Ticket Purchase URL',  'name'=>'fest_ticket_url',    'type'=>'url'],
                ['key'=>'field_fest_phone',         'label'=>'Phone',                'name'=>'fest_phone',         'type'=>'text',  'default_value'=>'416.846.6483'],
                ['key'=>'field_fest_email',         'label'=>'Email',                'name'=>'fest_email',         'type'=>'email', 'default_value'=>'contact@afrobass.com'],
                ['key'=>'field_fest_instagram',     'label'=>'Instagram',            'name'=>'fest_instagram',     'type'=>'url'],
                ['key'=>'field_fest_youtube',       'label'=>'YouTube',              'name'=>'fest_youtube',       'type'=>'url'],
                ['key'=>'field_fest_tiktok',        'label'=>'TikTok',               'name'=>'fest_tiktok',        'type'=>'url'],
                ['key'=>'field_fest_facebook',      'label'=>'Facebook',             'name'=>'fest_facebook',      'type'=>'url'],
                ['key'=>'field_fest_twitter',       'label'=>'X / Twitter',          'name'=>'fest_twitter',       'type'=>'url'],
            ],
            'location' => [[ ['param'=>'options_page','operator'=>'==','value'=>'fest-settings'] ]],
        ]);
    }
}
add_action('acf/init', 'fest_register_acf');

/* ─── EMAIL CAPTURE AJAX ─── */
function fest_email_capture() {
    check_ajax_referer('fest_nonce', 'nonce');

    // Honeypot
    if (!empty($_POST['website'])) { wp_send_json_error('Submission rejected.'); }

    // Rate limit
    $ip    = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key   = 'fest_rate_' . md5($ip);
    $count = (int) get_transient($key);
    if ($count >= 5) { wp_send_json_error('Too many submissions. Please try again later.'); }
    set_transient($key, $count + 1, HOUR_IN_SECONDS);

    $first = sanitize_text_field($_POST['first_name'] ?? '');
    $last  = sanitize_text_field($_POST['last_name']  ?? '');
    $email = sanitize_email($_POST['email']           ?? '');
    $phone = sanitize_text_field($_POST['phone']      ?? '');

    if (!$email || !is_email($email)) { wp_send_json_error('Please enter a valid email address.'); }

    $to      = get_field('fest_email', 'option') ?: 'contact@afrobass.com';
    $subject = 'New Festival Interest — ' . $first . ' ' . $last;
    $body    = "New signup from afrobassfestival.com\n\n";
    $body   .= "Name:  {$first} {$last}\n";
    $body   .= "Email: {$email}\n";
    $body   .= "Phone: {$phone}\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $first . ' ' . $last . ' <' . $email . '>',
    ];

    // Store subscriber in WP options (simple list)
    $subscribers = get_option('fest_subscribers', []);
    $subscribers[] = [
        'first' => $first, 'last' => $last,
        'email' => $email, 'phone' => $phone,
        'date'  => current_time('mysql'),
    ];
    update_option('fest_subscribers', $subscribers);

    wp_mail($to, $subject, $body, $headers);
    wp_send_json_success("You're on the list! We'll notify you when tickets drop.");
}
add_action('wp_ajax_fest_email_capture',        'fest_email_capture');
add_action('wp_ajax_nopriv_fest_email_capture', 'fest_email_capture');

/* ─── SUBSCRIBER EXPORT (admin) ─── */
function fest_export_subscribers() {
    if (!current_user_can('manage_options')) return;
    if (empty($_GET['fest_export'])) return;
    $subs = get_option('fest_subscribers', []);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="fest-subscribers.csv"');
    echo "First,Last,Email,Phone,Date\n";
    foreach ($subs as $s) {
        echo implode(',', array_map('esc_html', [$s['first'],$s['last'],$s['email'],$s['phone'] ?? '',$s['date']])) . "\n";
    }
    exit;
}
add_action('admin_init', 'fest_export_subscribers');

/* ─── TEMPLATE ROUTING BY SLUG ─── */
function fest_route_templates($template) {
    if (!is_page()) return $template;
    $slug = get_post_field('post_name', get_queried_object_id());
    $map  = [
        'lineup'       => 'page-lineup.php',
        'tickets'      => 'page-tickets.php',
        'sponsors'     => 'page-sponsors.php',
        'about'        => 'page-about.php',
        'the-festival' => 'page-about.php',
    ];
    if (isset($map[$slug])) {
        $located = locate_template($map[$slug]);
        if ($located) return $located;
    }
    return $template;
}
add_filter('template_include', 'fest_route_templates', 99);

/* ─── HELPERS ─── */
function fest_setting(string $key): string {
    if (!function_exists('get_field')) return '';
    return (string)(get_field($key, 'option') ?: '');
}

function fest_social_icons(): array {
    return [
        'instagram' => [
            'url' => fest_setting('fest_instagram') ?: 'https://instagram.com/afrobass.ca',
            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>',
        ],
        'youtube' => [
            'url' => fest_setting('fest_youtube') ?: 'https://www.youtube.com/@Afrobass',
            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.2 2.8 12 2.8 12 2.8s-4.2 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.6 21.8 12 21.8 12 21.8s4.2 0 6.8-.3c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.3v-2C23.3 9.1 23 7 23 7zM9.7 15.5v-7.4l8.1 3.7-8.1 3.7z"/></svg>',
        ],
        'tiktok' => [
            'url' => fest_setting('fest_tiktok') ?: 'https://www.tiktok.com/@afrobass',
            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V9.02a8.16 8.16 0 004.77 1.52V7.1a4.85 4.85 0 01-1-.41z"/></svg>',
        ],
        'facebook' => [
            'url' => fest_setting('fest_facebook') ?: 'https://facebook.com/afrobass.ca',
            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg>',
        ],
        'twitter' => [
            'url' => fest_setting('fest_twitter') ?: 'https://x.com/afrobassca',
            'svg' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.736-8.849L2 2.25h6.946l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>',
        ],
    ];
}

function fest_flush() { flush_rewrite_rules(); }
add_action('after_switch_theme', 'fest_flush');

/* ── FAVICON ── */
function fest_favicon() {
    $favicon = get_template_directory_uri() . '/assets/images/favicon.png';
    echo '<link rel="icon" type="image/png" href="' . esc_url($favicon) . '">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url($favicon) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon) . '">' . "\n";
}
add_action('wp_head', 'fest_favicon', 1);

/* ── SEO — META, OG, TWITTER, SCHEMA ── */
function fest_seo_meta() {
    $site_name   = 'Afrobass Music Festival';
    $title       = 'Afrobass Music Festival — Toronto 2026 | August 15';
    $description = 'The first edition of Afrobass Music Festival. Toronto, Canada. August 15, 2026. Celebrating Afrobeats, Amapiano, and Afro-Caribbean music. Be the first to know.';
    $url         = home_url('/');
    $og_img      = get_template_directory_uri() . '/assets/images/og-image.jpg';
    $ticket_url  = fest_setting('fest_ticket_url') ?: home_url('/tickets');

    // Per-page overrides
    if (is_page('lineup')) {
        $title       = 'Lineup — Afrobass Music Festival Toronto 2026';
        $description = 'Meet the artists performing at Afrobass Music Festival. International Afrobeats, Amapiano, and Afro-Caribbean artists live in Toronto. August 15, 2026.';
        $url         = get_permalink();
    } elseif (is_page('tickets')) {
        $title       = 'Tickets — Afrobass Music Festival Toronto 2026';
        $description = 'Get your tickets for Afrobass Music Festival. General Admission, VIP, and Table packages available. Toronto, August 15, 2026.';
        $url         = get_permalink();
    } elseif (is_page('sponsors')) {
        $title       = 'Sponsorship — Afrobass Music Festival Toronto 2026';
        $description = 'Partner with Afrobass Music Festival 2026. Sponsorship packages available — Platinum, Gold, Silver, Bronze, and In-Kind. Reach thousands of Afrobeats fans in Toronto.';
        $url         = get_permalink();
    } elseif (is_page('about') || is_page('the-festival')) {
        $title       = 'About — Afrobass Music Festival Toronto 2026';
        $description = 'Afrobass Music Festival is a live music and cultural event in Toronto celebrating Afrobeats, Amapiano, and Afro-Caribbean music. First edition: August 15, 2026.';
        $url         = get_permalink();
    }

    $description = esc_attr(wp_strip_all_tags($description));
    $title_esc   = esc_attr($title);
    $url_esc     = esc_url($url);
    $og_img_esc  = esc_url($og_img);
    ?>

    <!-- SEO Core -->
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="Afrobass Music Festival, Afrobeats Toronto, Amapiano Toronto, African music festival Toronto, Afro-Caribbean festival, Toronto music festival 2026, Toronto music event">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Afrobass Inc.">
    <link rel="canonical" href="<?php echo $url_esc; ?>">

    <!-- Open Graph -->
    <meta property="og:type"         content="website">
    <meta property="og:site_name"    content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:title"        content="<?php echo $title_esc; ?>">
    <meta property="og:description"  content="<?php echo $description; ?>">
    <meta property="og:url"          content="<?php echo $url_esc; ?>">
    <meta property="og:image"        content="<?php echo $og_img_esc; ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"    content="Afrobass Music Festival — Toronto 2026">
    <meta property="og:locale"       content="en_CA">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:site"        content="@afrobassca">
    <meta name="twitter:title"       content="<?php echo $title_esc; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image"       content="<?php echo $og_img_esc; ?>">

    <!-- Local / Geo SEO -->
    <meta name="geo.region"      content="CA-ON">
    <meta name="geo.placename"   content="Toronto, Ontario, Canada">
    <meta name="geo.position"    content="43.6532;-79.3832">
    <meta name="ICBM"            content="43.6532, -79.3832">

    <!-- Structured Data — Event -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MusicEvent",
      "name": "Afrobass Music Festival 2026",
      "description": "<?php echo esc_js($description); ?>",
      "startDate": "2026-08-15T20:00:00-04:00",
      "endDate": "2026-08-16T03:00:00-04:00",
      "eventStatus": "https://schema.org/EventScheduled",
      "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
      "image": "<?php echo esc_js($og_img); ?>",
      "url": "<?php echo esc_js(home_url('/')); ?>",
      "location": {
        "@type": "Place",
        "name": "Toronto music event",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Toronto",
          "addressLocality": "Toronto",
          "addressRegion": "ON",
          
          "addressCountry": "CA"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": 43.6532,
          "longitude": -79.3832
        }
      },
      "organizer": {
        "@type": "Organization",
        "name": "Afrobass Inc.",
        "url": "https://afrobass.com",
        "sameAs": [
          "https://instagram.com/afrobass.ca",
          "https://www.youtube.com/@Afrobass",
          "https://www.tiktok.com/@afrobass",
          "https://facebook.com/afrobass.ca",
          "https://x.com/afrobassca"
        ]
      },
      "offers": {
        "@type": "Offer",
        "url": "<?php echo esc_js($ticket_url); ?>",
        "availability": "https://schema.org/InStock",
        "validFrom": "2026-01-01",
        "priceCurrency": "CAD"
      },
      "performer": {
        "@type": "PerformingGroup",
        "name": "International Afrobeats & Amapiano Artists"
      },
      "typicalAgeRange": "19+",
      
      "inLanguage": "en"
    }
    </script>

    <!-- Structured Data — Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Afrobass Inc.",
      "url": "https://afrobass.com",
      "logo": "<?php echo esc_js(get_template_directory_uri() . '/assets/images/favicon.png'); ?>",
      "description": "Canada's premier Afrobeats event production company. Concerts, tours, and live events across Canada since 2018.",
      "foundingDate": "2018",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Toronto",
        "addressRegion": "ON",
        "addressCountry": "CA"
      },
      "sameAs": [
        "https://instagram.com/afrobass.ca",
        "https://www.youtube.com/@Afrobass",
        "https://www.tiktok.com/@afrobass",
        "https://facebook.com/afrobass.ca",
        "https://x.com/afrobassca"
      ]
    }
    </script>

    <?php
}
add_action('wp_head', 'fest_seo_meta', 5);

/* ACF missing notice */
function fest_acf_notice() {
    if (function_exists('acf_add_local_field_group')) return;
    echo '<div class="notice notice-warning is-dismissible"><p><strong>Afrobass Festival Theme:</strong> Please install <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields</a> to enable all features.</p></div>';
}
add_action('admin_notices', 'fest_acf_notice');
