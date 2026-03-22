<?php
/**
 * Template Name: Sponsors Page
 * Template Post Type: page
 */
get_header();
$contact_email = fest_setting('fest_email') ?: 'contact@afrobass.com';
$contact_phone = fest_setting('fest_phone') ?: '416.846.6483';
?>
<div style="padding-top:72px;">
  <section class="fest-sponsors-section">
    <div class="fest-reveal">
      <div class="fest-kicker">Partner With Us</div>
      <h1 class="fest-title">Sponsorship<br>Packages</h1>
      <p style="font-size:16px;font-weight:300;color:rgba(255,255,255,0.4);margin-top:20px;max-width:560px;line-height:1.7;">
        Place your brand in front of 1,500+ passionate Afrobeats fans in Toronto. Afrobass Music Festival is the largest Afrobeats cultural event of its kind in Canada.
      </p>
    </div>

    <div class="fest-sponsor-tiers">

      <!-- PLATINUM -->
      <div class="fest-sponsor-tier fest-reveal" style="border-top:1px solid #1a1a1a;">
        <div>
          <div class="fest-sponsor-tier-name">Platinum</div>
          <div class="fest-sponsor-tier-badge">Headline Partner · 1 Slot Available</div>
        </div>
        <div class="fest-sponsor-benefits">
          Exclusive naming rights ("Presented by [Brand]") · Largest logo on stage banners, LED screens, and all marketing · Dedicated social media posts · VIP tickets + backstage passes · Custom brand activation space · Co-branded recap video · On-stage acknowledgment by MC
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Platinum Sponsorship — Afrobass Festival 2026" class="fest-sponsor-cta-btn">
          Get in Touch →
        </a>
      </div>

      <!-- GOLD -->
      <div class="fest-sponsor-tier fest-reveal">
        <div>
          <div class="fest-sponsor-tier-name">Gold</div>
          <div class="fest-sponsor-tier-badge">Official Partner · 2 Slots Available</div>
        </div>
        <div class="fest-sponsor-benefits">
          Logo on event banners, stage backdrop, and select marketing materials · Social media mentions and branded posts · Logo on LED screens · Product sampling or activation space · VIP tickets for company representatives · Recognition during opening/closing ceremonies
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Gold Sponsorship — Afrobass Festival 2026" class="fest-sponsor-cta-btn">
          Get in Touch →
        </a>
      </div>

      <!-- SILVER -->
      <div class="fest-sponsor-tier fest-reveal">
        <div>
          <div class="fest-sponsor-tier-name">Silver</div>
          <div class="fest-sponsor-tier-badge">Supporting Partner · 3 Slots Available</div>
        </div>
        <div class="fest-sponsor-benefits">
          Logo on event posters, flyers, and select banners · Recognition in promotional materials and social media · Company logo on festival website · Verbal acknowledgment during event · VIP hospitality access for limited guests
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Silver Sponsorship — Afrobass Festival 2026" class="fest-sponsor-cta-btn">
          Get in Touch →
        </a>
      </div>

      <!-- BRONZE -->
      <div class="fest-sponsor-tier fest-reveal">
        <div>
          <div class="fest-sponsor-tier-name">Bronze</div>
          <div class="fest-sponsor-tier-badge">Community Partner · 5 Slots Available</div>
        </div>
        <div class="fest-sponsor-benefits">
          Recognition during the event · Logo on promotional material · Company logo and brief description on festival website · Complimentary General Admission passes for company representatives
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Bronze Sponsorship — Afrobass Festival 2026" class="fest-sponsor-cta-btn">
          Get in Touch →
        </a>
      </div>

      <!-- IN-KIND -->
      <div class="fest-sponsor-tier fest-reveal">
        <div>
          <div class="fest-sponsor-tier-name">In-Kind</div>
          <div class="fest-sponsor-tier-badge">Product / Service Exchange</div>
        </div>
        <div class="fest-sponsor-benefits">
          Airline tickets · Hotel accommodation · Catering services · Audio/visual equipment · Photography · Videography · Any relevant products or services. Custom package tailored to your offering.
        </div>
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=In-Kind Sponsorship — Afrobass Festival 2026" class="fest-sponsor-cta-btn">
          Get in Touch →
        </a>
      </div>

    </div>

    <!-- CTA contact block -->
    <div style="margin-top:80px;padding:56px;background:#0d0d0d;border:1px solid #1a1a1a;display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center;" class="fest-reveal">
      <div>
        <div class="fest-kicker">Ready to Partner?</div>
        <h2 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(32px,4vw,52px);letter-spacing:2px;color:#fff;text-transform:uppercase;line-height:0.92;margin-bottom:16px;">Let's Build<br>Something Together</h2>
        <p style="font-size:14px;font-weight:300;color:rgba(255,255,255,0.4);line-height:1.7;">Custom packages available. We'll work with you to create a sponsorship that meets your specific marketing goals and budget.</p>
      </div>
      <div style="display:flex;flex-direction:column;gap:16px;">
        <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Sponsorship Enquiry — Afrobass Festival 2026"
           style="display:block;background:#FF4500;color:#fff;font-family:'Barlow Condensed',sans-serif;font-size:14px;font-weight:700;letter-spacing:3px;text-transform:uppercase;padding:18px 40px;border-radius:2px;text-align:center;text-decoration:none;">
          Email Us →
        </a>
        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/','',$contact_phone)); ?>"
           style="display:block;background:transparent;color:rgba(255,255,255,0.4);font-family:'Barlow Condensed',sans-serif;font-size:14px;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:18px 40px;border-radius:2px;text-align:center;border:1px solid #1a1a1a;text-decoration:none;">
          <?php echo esc_html($contact_phone); ?>
        </a>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
