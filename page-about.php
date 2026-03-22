<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 */
get_header();
$hero_video = fest_setting('fest_hero_video') ? get_field('fest_hero_video', 'option') : null;
?>
<div style="padding-top:72px;">

  <!-- About Split -->
  <section class="fest-about-section">
    <div class="fest-about-visual">
      <div class="fest-about-visual-inner">
        <?php if (!empty($hero_video['url'])): ?>
          <video autoplay muted loop playsinline style="width:100%;height:100%;object-fit:cover;opacity:0.6;">
            <source src="<?php echo esc_url($hero_video['url']); ?>" type="video/mp4">
          </video>
        <?php endif; ?>
        <div class="fest-about-visual-fallback"></div>
      </div>
      <div class="fest-about-visual-overlay"></div>
    </div>

    <div class="fest-about-content">
      <div class="fest-kicker fest-reveal">The Festival</div>
      <h1 class="fest-title fest-reveal">About<br>Afrobass<br>Music Festival</h1>
      <div class="fest-about-body fest-reveal">
        Afrobass Music Festival is a <strong>live music and cultural event</strong> based in Toronto, Canada celebrating Afrobeats, Amapiano, and Afro-Caribbean music.
        <br><br>
        The festival brings together international artists, DJs, and performers to connect with one of the <strong>fastest growing Afrobeats audiences in North America</strong>. Toronto has become a major hub for African music culture with a large African and Caribbean diaspora and a vibrant nightlife scene.
        <br><br>
        The festival will feature international African artists, DJs, and Canadian performers, creating a <strong>large-scale cultural music experience</strong>. Now, we are proud to invite you to be part of the first edition of the Afrobass Music Festival.
      </div>

      <div class="fest-about-stats fest-reveal">
        <div class="fest-about-stat">
          <div class="fest-about-stat-num">1<span class="acc">,500</span>+</div>
          <div class="fest-about-stat-lbl">Attendees</div>
        </div>
        <div class="fest-about-stat">
          <div class="fest-about-stat-num">3<span class="acc">-6</span></div>
          <div class="fest-about-stat-lbl">Artists & DJs</div>
        </div>
        <div class="fest-about-stat">
          <div class="fest-about-stat-num"><span class="acc">1</span></div>
          <div class="fest-about-stat-lbl">Stage · 1 Night</div>
        </div>
        <div class="fest-about-stat">
          <div class="fest-about-stat-num">20<span class="acc">26</span></div>
          <div class="fest-about-stat-lbl">First Edition</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Venue Info -->
  <section style="padding:80px 56px;border-top:1px solid #1a1a1a;border-bottom:1px solid #1a1a1a;background:#060606;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;">
      <div class="fest-reveal">
        <div class="fest-kicker">The Venue</div>
        <h2 class="fest-title" style="margin-bottom:24px;">Venue<br>TBA</h2>
        <p style="font-size:15px;font-weight:300;color:rgba(255,255,255,0.4);line-height:1.8;margin-bottom:24px;">
          A world-class live music and event venue in Toronto — the perfect home for Afrobass Music Festival's inaugural edition. More details coming soon.
        </p>
        <p style="font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.25);">
          Toronto, Ontario, Canada
        </p>
      </div>
      <div class="fest-reveal fest-d2" style="background:#0d0d0d;padding:40px;border:1px solid #1a1a1a;">
        <div style="display:flex;flex-direction:column;gap:0;">
          <?php
          $venue_facts = [
            ['Venue', 'Toronto, Canada (TBA)'],
            ['City', 'Toronto, Ontario, Canada'],
            ['Capacity', 'TBA'],
            ['Date', 'Saturday, August 15, 2026'],
            ['Time', 'Doors Open TBA'],
          ];
          foreach ($venue_facts as $f):
          ?>
            <div style="display:flex;gap:24px;padding:16px 0;border-bottom:1px solid #1a1a1a;">
              <span style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.25);min-width:80px;padding-top:2px;"><?php echo esc_html($f[0]); ?></span>
              <span style="font-size:14px;color:#fff;font-weight:400;"><?php echo esc_html($f[1]); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Powered by Afrobass -->
  <div class="fest-powered-by">
    <div class="fest-reveal">
      <div class="fest-powered-label">Produced By</div>
      <div class="fest-powered-logo">AFRO<span>BASS</span></div>
    </div>
    <p class="fest-powered-desc fest-reveal fest-d1">
      Since 2018, Afrobass has produced world-class Afrobeats concerts and tours across Canada — from sold-out shows at El Mocambo and The Opera House to national artist tours. The Afrobass Music Festival is the natural next step in that journey.
    </p>
    <a href="https://afrobass.com" target="_blank" rel="noopener" class="fest-powered-link fest-reveal fest-d2">
      Visit Afrobass.com →
    </a>
  </div>

  <!-- CTA -->
  <div style="text-align:center;padding:80px 56px;border-top:1px solid #1a1a1a;" class="fest-reveal">
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(36px,5vw,64px);letter-spacing:2px;color:#fff;text-transform:uppercase;margin-bottom:32px;">Be Part of History</h2>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo esc_url(fest_setting('fest_ticket_url') ?: home_url('/tickets')); ?>"
         class="fest-btn-primary" style="display:inline-block;">Get Tickets →</a>
      <a href="<?php echo esc_url(home_url('/sponsors')); ?>"
         style="display:inline-block;font-family:'Barlow Condensed',sans-serif;font-size:13px;font-weight:700;letter-spacing:3px;text-transform:uppercase;background:transparent;color:rgba(255,255,255,0.4);border:1px solid #1a1a1a;padding:17px 48px;border-radius:2px;text-decoration:none;transition:color 0.2s,border-color 0.2s;"
         onmouseover="this.style.color='#fff';this.style.borderColor='#333'" onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderColor='#1a1a1a'">
        Become a Sponsor
      </a>
    </div>
  </div>

</div>
<?php get_footer(); ?>
