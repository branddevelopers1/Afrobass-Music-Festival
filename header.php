<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#080808">
<?php wp_head(); ?>
</head>
<body <?php body_class('fest-site'); ?>>
<?php wp_body_open(); ?>

<div id="fest-cursor"></div>
<div id="fest-cursor-ring"></div>

<?php if (is_front_page()): ?>
<div id="fest-loader" aria-hidden="true">
  <div id="fest-loader-logo">
    AFROBASS
    <span>MUSIC FESTIVAL</span>
  </div>
  <div id="fest-loader-bar-wrap"><div id="fest-loader-bar"></div></div>
</div>
<?php endif; ?>

<nav id="fest-nav" role="navigation">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="fest-nav-logo">
    AFROBASS
    <span class="fest-nav-logo-sub">Music Festival · Toronto 2026</span>
  </a>

  <ul class="fest-nav-links">
    <li><a href="<?php echo esc_url(home_url('/lineup')); ?>">Lineup</a></li>
    <li><a href="<?php echo esc_url(home_url('/tickets')); ?>">Tickets</a></li>
    <li><a href="<?php echo esc_url(home_url('/sponsors')); ?>">Sponsors</a></li>
    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
  </ul>

  <div class="fest-nav-right">
    <?php
    $ticket_url = fest_setting('fest_ticket_url') ?: home_url('/tickets');
    ?>
    <a href="<?php echo esc_url($ticket_url); ?>" class="fest-btn-tickets">
      Get Tickets
    </a>
  </div>

  <button class="fest-hamburger" aria-label="Toggle menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div id="fest-mobile-nav">
  <a href="<?php echo esc_url(home_url('/lineup')); ?>" class="fest-mobile-link">Lineup</a>
  <a href="<?php echo esc_url(home_url('/tickets')); ?>" class="fest-mobile-link">Tickets</a>
  <a href="<?php echo esc_url(home_url('/sponsors')); ?>" class="fest-mobile-link">Sponsors</a>
  <a href="<?php echo esc_url(home_url('/about')); ?>" class="fest-mobile-link">About</a>
  <a href="<?php echo esc_url($ticket_url); ?>" class="fest-mobile-ticket">Get Tickets →</a>
</div>
