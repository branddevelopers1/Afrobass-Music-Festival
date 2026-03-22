<?php
/**
 * Template Name: Tickets Page
 * Template Post Type: page
 */
get_header();
$ticket_url = fest_setting('fest_ticket_url') ?: '#';
?>
<div style="padding-top:72px;">
  <section class="fest-tickets-section">
    <div class="fest-reveal">
      <div class="fest-kicker">Afrobass Music Festival 2026</div>
      <h1 class="fest-title">Get Your<br>Tickets</h1>
      <p style="font-size:16px;font-weight:300;color:rgba(255,255,255,0.4);margin-top:20px;max-width:480px;line-height:1.7;">
        Saturday, August 15, 2026 · Rebel Entertainment Complex · Toronto, Canada
      </p>
    </div>

    <div class="fest-tickets-grid">
      <!-- General Admission -->
      <div class="fest-ticket-tier fest-reveal">
        <span class="fest-tier-badge">Early Bird</span>
        <div class="fest-tier-name">General Admission</div>
        <div class="fest-tier-price">TBA <span>/ person</span></div>
        <div class="fest-tier-desc">Full access to the festival grounds, all stages, and food & drink vendors.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Festival access — all performances</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Access to all vendor areas</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>General standing floor</div>
        </div>
        <a href="<?php echo esc_url($ticket_url); ?>" class="fest-tier-btn fest-tier-btn-outline">
          Tickets Coming Soon
        </a>
      </div>

      <!-- VIP -->
      <div class="fest-ticket-tier featured fest-reveal fest-d1">
        <span class="fest-tier-badge">Most Popular</span>
        <div class="fest-tier-name">VIP Experience</div>
        <div class="fest-tier-price">TBA <span>/ person</span></div>
        <div class="fest-tier-desc">Premium access with exclusive areas, dedicated bar, and priority entry.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Everything in General Admission</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Dedicated VIP area & bar</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Priority entry — skip the line</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Exclusive VIP lounge access</div>
        </div>
        <a href="<?php echo esc_url($ticket_url); ?>" class="fest-tier-btn fest-tier-btn-fill">
          Tickets Coming Soon
        </a>
      </div>

      <!-- Table / Group -->
      <div class="fest-ticket-tier fest-reveal fest-d2">
        <span class="fest-tier-badge">Groups</span>
        <div class="fest-tier-name">Table Package</div>
        <div class="fest-tier-price">TBA <span>/ table</span></div>
        <div class="fest-tier-desc">Reserved table for your group with bottle service and dedicated host.</div>
        <div class="fest-tier-perks">
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Reserved table for 6-10 guests</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Bottle service included</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Dedicated event host</div>
          <div class="fest-tier-perk"><div class="fest-tier-perk-dot"></div>Best views of the stage</div>
        </div>
        <a href="mailto:<?php echo esc_attr(fest_setting('fest_email') ?: 'contact@afrobass.com'); ?>" class="fest-tier-btn fest-tier-btn-outline">
          Enquire →
        </a>
      </div>
    </div>
  </section>

  <!-- Notify section -->
  <div style="padding:80px 56px;border-top:1px solid #1a1a1a;text-align:center;background:#060606;" class="fest-reveal">
    <div class="fest-kicker" style="justify-content:center;">Prices not announced yet?</div>
    <h2 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(32px,4vw,56px);letter-spacing:2px;color:#fff;text-transform:uppercase;margin:16px 0 16px;">Get Early Access</h2>
    <p style="font-size:15px;font-weight:300;color:rgba(255,255,255,0.4);margin-bottom:32px;">Join the list and be the first to get tickets before public sale.</p>
    <a href="<?php echo esc_url(home_url('/#notify')); ?>" class="fest-btn-primary" style="display:inline-block;">Join the List →</a>
  </div>
</div>
<?php get_footer(); ?>
