<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0a0608">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700;900&family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
<?php wp_head(); ?>
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

<div class="fest-topbar" id="fest-nav">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="fest-topbar-logo">AFROBASS<span>FEST</span></a>
  <div class="fest-topbar-social">
    <a href="https://instagram.com/afrobass.ca" target="_blank" rel="noopener">Instagram</a>
    <a href="https://www.tiktok.com/@afrobass" target="_blank" rel="noopener">TikTok</a>
    <a href="https://x.com/afrobassca" target="_blank" rel="noopener">X</a>
  </div>
</div>

<style>
.fest-topbar{position:fixed;top:0;left:0;right:0;z-index:100;padding:24px 56px;display:flex;align-items:center;justify-content:space-between;background:linear-gradient(to bottom,rgba(10,6,8,0.9) 0%,transparent 100%);transition:background 0.4s;}
.fest-topbar.fest-scrolled{background:rgba(10,6,8,0.95);backdrop-filter:blur(20px);}
.fest-topbar-logo{font-family:'Unbounded',sans-serif;font-size:16px;font-weight:700;letter-spacing:3px;color:#fff;text-decoration:none;text-transform:uppercase;}
.fest-topbar-logo span{color:#FF2D8A;}
.fest-topbar-social{display:flex;gap:24px;}
.fest-topbar-social a{font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:500;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.35);text-decoration:none;transition:color 0.2s;}
.fest-topbar-social a:hover{color:#FF2D8A;}
#fest-cursor{position:fixed;width:12px;height:12px;background:#FF2D8A;border-radius:50%;pointer-events:none;z-index:99999;transform:translate(-50%,-50%);transition:width .3s,height .3s,background .3s,transform .15s;mix-blend-mode:screen;}
#fest-cursor-ring{position:fixed;width:44px;height:44px;border:1.5px solid rgba(255,45,138,0.4);border-radius:50%;pointer-events:none;z-index:99998;transform:translate(-50%,-50%);transition:transform .14s ease-out;}
@media(hover:none){#fest-cursor,#fest-cursor-ring{display:none;}}
#fest-loader{position:fixed;inset:0;z-index:9999;background:#0a0608;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:28px;}
#fest-loader-logo{font-family:'Unbounded',sans-serif;font-size:40px;font-weight:900;letter-spacing:4px;color:#fff;text-transform:uppercase;text-align:center;line-height:1.1;opacity:0;animation:fFadeIn 0.5s 0.3s ease forwards;}
#fest-loader-logo span{display:block;font-size:14px;letter-spacing:6px;color:#FF2D8A;margin-top:6px;}
#fest-loader-bar-wrap{width:160px;height:1px;background:rgba(255,255,255,0.08);overflow:hidden;opacity:0;animation:fFadeIn 0.4s 0.5s ease forwards;}
#fest-loader-bar{height:100%;width:0;background:#FF2D8A;animation:fLoadBar 1.4s 0.6s cubic-bezier(0.4,0,0.2,1) forwards;}
@keyframes fFadeIn{to{opacity:1;}}
@keyframes fLoadBar{to{width:100%;}}
#fest-loader.fest-hide{animation:fLoaderOut 0.7s 0.2s cubic-bezier(0.76,0,0.24,1) forwards;}
@keyframes fLoaderOut{0%{clip-path:inset(0 0 0 0);}100%{clip-path:inset(0 0 100% 0);}}
@media(max-width:768px){.fest-topbar{padding:20px 24px;}.fest-topbar-social{gap:14px;}}
</style>
