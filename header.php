<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0a0608">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700;900&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
<?php wp_head(); ?>

<!-- Showpass SDK -->
<script type="text/javascript">
(function(window, document, src) {
  var config = window.__shwps;
  if (typeof config === 'undefined') {
    config = function() { config.c(arguments); };
    config.q = [];
    config.c = function(args) { config.q.push(args); };
    window.__shwps = config;
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = src;
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
  }
})(window, document, 'https://www.showpass.com/static/dist/sdk.js');
</script>
</head>
<body <?php body_class('fest-site'); ?> style="background:#0a0608;cursor:none;overflow-x:hidden;">
<?php wp_body_open(); ?>

<div id="fest-cursor"></div>
<div id="fest-cursor-ring"></div>

<?php if (is_front_page()): ?>
<div id="fest-loader" aria-hidden="true">
  <div id="fest-loader-logo">AFROBASS<span>MUSIC FESTIVAL</span></div>
  <div id="fest-loader-bar-wrap"><div id="fest-loader-bar"></div></div>
</div>
<?php endif; ?>

<?php
$current     = $_SERVER['REQUEST_URI'] ?? '';
$ticket_url  = home_url('/tickets');

/* Primary nav — desktop, no Tickets */
$primary_nav = [
  ['Lineup', '/lineup'],
  ['FAQ',    '/faq'],
  ['Join',   '/submissions'],
  ['Contact','/contact'],
];

/* Full menu */
$full_nav = [
  ['Line Up', '/lineup'],
  ['FAQ',     '/faq'],
  ['Join',    '/submissions'],
  ['Contact', '/contact'],
];
?>

<!-- ── NAV BAR ── -->
<header id="fest-nav">
  <!-- Logo -->
  <a href="<?php echo esc_url(home_url('/')); ?>" class="fest-logo" aria-label="Afrobass Fest Home">
    AFROBASS<span>FEST</span>
  </a>

  <!-- Primary links — desktop only, 3 items -->
  <nav class="fest-primary-nav" aria-label="Primary">
    <?php foreach ($primary_nav as $link):
      $active = strpos($current, $link[1]) !== false; ?>
      <a href="<?php echo esc_url(home_url($link[1])); ?>"
         class="fest-nav-link<?php echo $active ? ' active' : ''; ?>">
        <?php echo esc_html($link[0]); ?>
      </a>
    <?php endforeach; ?>
  </nav>

  <!-- Right side: CTA + Menu button -->
  <div class="fest-nav-right">
    <button
      onclick="showpass.tickets.eventPurchaseWidget('afrobass-festival', {'theme-primary': '#FF2D8A', 'keep-shopping': false})"
      class="fest-nav-cta"
      style="border:none; cursor:pointer;">
      Get Tickets
    </button>
    <button id="fest-menu-btn" class="fest-menu-btn" aria-label="Open menu" aria-expanded="false">
      <span class="fest-menu-btn-inner">
        <span></span>
        <span></span>
      </span>
      <span class="fest-menu-btn-label">Menu</span>
    </button>
  </div>
</header>

<!-- ── FULLSCREEN MENU OVERLAY ── -->
<div id="fest-menu" class="fest-menu" aria-hidden="true">
  <div class="fest-menu-inner">

    <!-- Menu links -->
    <nav class="fest-menu-nav" aria-label="Full navigation">
      <?php foreach ($full_nav as $i => $link): ?>
        <a href="<?php echo esc_url(home_url($link[1])); ?>"
           class="fest-menu-link"
           style="transition-delay: <?php echo ($i * 0.05 + 0.1); ?>s;">
          <span class="fest-menu-link-num"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
          <?php echo esc_html($link[0]); ?>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- Menu footer -->
    <div class="fest-menu-footer">
      <div class="fest-menu-footer-info">
        <div class="fest-menu-footer-date">August 15, 2026</div>
        <div class="fest-menu-footer-venue">Rebel Entertainment Complex · Toronto</div>
      </div>
      <button onclick="showpass.tickets.eventPurchaseWidget('afrobass-festival', {'theme-primary': '#FF2D8A', 'keep-shopping': false})" class="fest-menu-cta" style="border:none;cursor:pointer;">
        Get Tickets &rarr;
      </button>
    </div>

  </div>
</div>

<style>
/* ── NAV BAR ── */
#fest-nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  height: 72px;
  padding: 0 48px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  transition: background 0.4s, border-color 0.4s;
  border-bottom: 1px solid transparent;
}
#fest-nav.scrolled {
  background: rgba(10,6,8,0.96);
  backdrop-filter: blur(24px);
  -webkit-backdrop-filter: blur(24px);
  border-bottom-color: rgba(255,255,255,0.05);
}
#fest-nav.menu-open {
  background: transparent !important;
  border-bottom-color: transparent !important;
  backdrop-filter: none !important;
}

/* Logo */
.fest-logo {
  font-family: 'Unbounded', sans-serif;
  font-size: 15px;
  font-weight: 700;
  letter-spacing: 3px;
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  flex-shrink: 0;
  position: relative;
  z-index: 1100;
}
.fest-logo span { color: #FF2D8A; }

/* Primary nav */
.fest-primary-nav {
  display: flex;
  gap: 36px;
  align-items: center;
}
.fest-nav-link {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.4);
  text-decoration: none;
  transition: color 0.2s;
  position: relative;
}
.fest-nav-link::after {
  content: '';
  position: absolute;
  bottom: -3px; left: 0;
  width: 0; height: 1px;
  background: #FF2D8A;
  transition: width 0.25s;
}
.fest-nav-link:hover,
.fest-nav-link.active { color: #fff; }
.fest-nav-link.active::after,
.fest-nav-link:hover::after { width: 100%; }

/* Right side */
.fest-nav-right {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-shrink: 0;
  position: relative;
  z-index: 1100;
}

/* CTA */
.fest-nav-cta {
  font-family: 'Unbounded', sans-serif;
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  background: #FF2D8A;
  color: #fff;
  padding: 11px 22px;
  border-radius: 100px;
  text-decoration: none;
  white-space: nowrap;
  transition: box-shadow 0.2s, transform 0.2s;
}
.fest-nav-cta:hover {
  box-shadow: 0 8px 28px rgba(255,45,138,0.45);
  transform: translateY(-1px);
}

/* Menu button */
.fest-menu-btn {
  display: flex;
  align-items: center;
  gap: 10px;
  background: none;
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 100px;
  padding: 8px 16px 8px 12px;
  cursor: pointer;
  transition: border-color 0.2s;
}
.fest-menu-btn:hover { border-color: rgba(255,255,255,0.3); }
.fest-menu-btn-inner {
  width: 18px;
  height: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex-shrink: 0;
}
.fest-menu-btn-inner span {
  display: block;
  height: 1.5px;
  background: #fff;
  border-radius: 1px;
  transform-origin: center;
  transition: transform 0.3s cubic-bezier(0.16,1,0.3,1), opacity 0.2s, width 0.3s;
}
.fest-menu-btn-inner span:last-child { width: 75%; }
.fest-menu-btn.open .fest-menu-btn-inner span:first-child {
  transform: translateY(4.25px) rotate(45deg);
}
.fest-menu-btn.open .fest-menu-btn-inner span:last-child {
  width: 100%;
  transform: translateY(-4.25px) rotate(-45deg);
}
.fest-menu-btn-label {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: rgba(255,255,255,0.6);
  transition: color 0.2s;
}
.fest-menu-btn.open .fest-menu-btn-label { color: #fff; }

/* ── FULLSCREEN MENU ── */
.fest-menu {
  position: fixed;
  inset: 0;
  z-index: 999;
  background: #0a0608;
  display: flex;
  flex-direction: column;
  clip-path: inset(0 0 100% 0);
  transition: clip-path 0.7s cubic-bezier(0.76,0,0.24,1);
  pointer-events: none;
}
.fest-menu.open {
  clip-path: inset(0 0 0% 0);
  pointer-events: auto;
}

.fest-menu-inner {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  padding: 100px 56px 56px;
}

/* Menu nav links */
.fest-menu-nav {
  display: flex;
  flex-direction: column;
  gap: 0;
}
.fest-menu-link {
  font-family: 'Unbounded', sans-serif;
  font-size: clamp(32px, 6vw, 72px);
  font-weight: 900;
  text-transform: uppercase;
  letter-spacing: -1px;
  color: rgba(255,255,255,0.2);
  text-decoration: none;
  padding: 12px 0;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  display: flex;
  align-items: baseline;
  gap: 20px;
  transition: color 0.2s, padding-left 0.3s cubic-bezier(0.16,1,0.3,1);
  opacity: 0;
  transform: translateY(20px);
}
.fest-menu.open .fest-menu-link {
  opacity: 1;
  transform: translateY(0);
  transition: color 0.2s, padding-left 0.3s cubic-bezier(0.16,1,0.3,1),
              opacity 0.5s cubic-bezier(0.16,1,0.3,1),
              transform 0.5s cubic-bezier(0.16,1,0.3,1);
}
.fest-menu-link:hover {
  color: #fff;
  padding-left: 12px;
}
.fest-menu-link-num {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.15);
  margin-bottom: 2px;
  flex-shrink: 0;
  width: 28px;
}
.fest-menu-link:hover .fest-menu-link-num { color: #FF2D8A; }

/* Menu footer */
.fest-menu-footer {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 32px;
  padding-top: 40px;
  border-top: 1px solid rgba(255,255,255,0.06);
  opacity: 0;
  transition: opacity 0.4s 0.5s;
}
.fest-menu.open .fest-menu-footer { opacity: 1; }

.fest-menu-footer-date {
  font-family: 'Unbounded', sans-serif;
  font-size: 13px;
  font-weight: 700;
  color: #fff;
  letter-spacing: 1px;
}
.fest-menu-footer-venue {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.3);
  margin-top: 6px;
  text-transform: uppercase;
}
.fest-menu-cta {
  font-family: 'Unbounded', sans-serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  background: #FF2D8A;
  color: #fff;
  padding: 16px 36px;
  border-radius: 100px;
  text-decoration: none;
  white-space: nowrap;
  transition: box-shadow 0.2s;
  flex-shrink: 0;
}
.fest-menu-cta:hover {
  box-shadow: 0 8px 32px rgba(255,45,138,0.45);
}

/* ── CURSOR ── */
#fest-cursor {
  position: fixed; width: 12px; height: 12px;
  background: #FF2D8A; border-radius: 50%;
  pointer-events: none; z-index: 99999;
  transform: translate(-50%,-50%);
  transition: width .3s, height .3s, background .3s, transform .15s;
  mix-blend-mode: screen;
}
#fest-cursor-ring {
  position: fixed; width: 44px; height: 44px;
  border: 1.5px solid rgba(255,45,138,0.4); border-radius: 50%;
  pointer-events: none; z-index: 99998;
  transform: translate(-50%,-50%);
  transition: transform .14s ease-out;
}
@media (hover: none) { #fest-cursor, #fest-cursor-ring { display: none; } }

/* ── LOADER ── */
#fest-loader {
  position: fixed; inset: 0; z-index: 9999;
  background: #0a0608;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center; gap: 28px;
}
#fest-loader-logo {
  font-family: 'Unbounded', sans-serif;
  font-size: 40px; font-weight: 900; letter-spacing: 4px;
  color: #fff; text-transform: uppercase; text-align: center; line-height: 1.1;
  opacity: 0; animation: fFadeIn 0.5s 0.3s ease forwards;
}
#fest-loader-logo span { display: block; font-size: 14px; letter-spacing: 6px; color: #FF2D8A; margin-top: 6px; }
#fest-loader-bar-wrap {
  width: 160px; height: 1px;
  background: rgba(255,255,255,0.08); overflow: hidden;
  opacity: 0; animation: fFadeIn 0.4s 0.5s ease forwards;
}
#fest-loader-bar { height: 100%; width: 0; background: #FF2D8A; animation: fLoadBar 1.4s 0.6s cubic-bezier(0.4,0,0.2,1) forwards; }
@keyframes fFadeIn { to { opacity: 1; } }
@keyframes fLoadBar { to { width: 100%; } }
#fest-loader.fest-hide { animation: fLoaderOut 0.7s 0.2s cubic-bezier(0.76,0,0.24,1) forwards; }
@keyframes fLoaderOut { 0% { clip-path: inset(0 0 0 0); } 100% { clip-path: inset(0 0 100% 0); } }

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
  .fest-primary-nav { display: none; }
  #fest-nav { padding: 0 24px; }
}
@media (max-width: 480px) {
  .fest-nav-cta { display: none; }
  .fest-menu-inner { padding: 88px 32px 40px; }
  .fest-menu-footer { flex-direction: column; align-items: flex-start; gap: 20px; }
}
</style>

<script>
(function(){
  /* ── NAV scroll state ── */
  var nav = document.getElementById('fest-nav');
  window.addEventListener('scroll', function(){
    if (!nav) return;
    nav.classList.toggle('scrolled', window.scrollY > 60);
  }, {passive: true});

  /* ── Menu open/close ── */
  var btn  = document.getElementById('fest-menu-btn');
  var menu = document.getElementById('fest-menu');
  if (!btn || !menu) return;

  function openMenu() {
    menu.classList.add('open');
    menu.setAttribute('aria-hidden', 'false');
    btn.classList.add('open');
    btn.setAttribute('aria-expanded', 'true');
    nav.classList.add('menu-open');
    document.body.style.overflow = 'hidden';
  }
  function closeMenu() {
    menu.classList.remove('open');
    menu.setAttribute('aria-hidden', 'true');
    btn.classList.remove('open');
    btn.setAttribute('aria-expanded', 'false');
    nav.classList.remove('menu-open');
    document.body.style.overflow = '';
  }

  btn.addEventListener('click', function(){
    btn.classList.contains('open') ? closeMenu() : openMenu();
  });

  /* Close on any menu link click */
  menu.querySelectorAll('a').forEach(function(a){
    a.addEventListener('click', closeMenu);
  });

  /* Close on Escape */
  document.addEventListener('keydown', function(e){
    if (e.key === 'Escape') closeMenu();
  });
})();
</script>
