<?php get_header(); ?>

<?php
$ticket_url = fest_setting('fest_ticket_url') ?: '#notify';
?>

<!-- BG ATMOSPHERE -->
<div class="fbg-layer" aria-hidden="true">
  <div class="fbg-glow-1"></div>
  <div class="fbg-glow-2"></div>
  <div class="fbg-glow-3"></div>
  <div class="fbg-grain"></div>
</div>
<div class="fbg-lines" aria-hidden="true"></div>

<!-- HERO -->
<section class="fhero" id="home">

  <!-- Floating ghost words -->
  <div class="fghost fg-1" aria-hidden="true">AFROBEATS</div>
  <div class="fghost fg-2" aria-hidden="true">AMAPIANO</div>
  <div class="fghost fg-3" aria-hidden="true">TORONTO</div>

  <!-- Rotating ring -->
  <svg class="fring" viewBox="0 0 500 500" aria-hidden="true">
    <defs>
      <path id="fcp" d="M 250 250 m -200 0 a 200 200 0 1 1 400 0 a 200 200 0 1 1 -400 0"/>
    </defs>
    <text fill="rgba(255,255,255,0.5)" font-family="'Space Grotesk',sans-serif" font-size="13" font-weight="500" letter-spacing="8">
      <textPath href="#fcp">
        AFROBASS MUSIC FESTIVAL · TORONTO 2026 · AUGUST 15 · REBEL ENTERTAINMENT COMPLEX · AFROBEATS · AMAPIANO · AFRO-CARIBBEAN ·
      </textPath>
    </text>
  </svg>

  <div class="fhero-content">
    <div class="feyebrow">First Edition · Toronto, Canada</div>

    <h1 class="fh1">
      <span class="fh1-1">AFROBASS</span>
      <span class="fh1-2">MUSIC</span>
      <span class="fh1-3">FESTIVAL</span>
    </h1>

    <div class="fmeta">
      <div class="fpill"><div class="fpill-dot" style="background:#FF6B1A;"></div><span>August 15, 2026</span></div>
      <div class="fpill"><div class="fpill-dot" style="background:#FF2D8A;"></div><span>Toronto, Canada</span></div>
    </div>

    <div class="factions">
      <button class="fbtn-main" onclick="document.getElementById('notify').scrollIntoView({behavior:'smooth'})">
        Get Notified →
      </button>
      <button class="fbtn-ghost" onclick="document.getElementById('notify').scrollIntoView({behavior:'smooth'})">
        Early Access
      </button>
    </div>
  </div>

  <div class="fscroll-ind" aria-hidden="true">
    <div class="fscroll-line"></div>
    <span class="fscroll-txt">Scroll</span>
  </div>
</section>

<!-- TICKER -->
<div class="fticker" aria-hidden="true">
  <div class="fticker-track">
    <?php for($i=0;$i<2;$i++): ?>
    <div class="fti hot">Afrobeats <div class="ftdot"></div></div>
    <div class="fti">Amapiano <div class="ftdot"></div></div>
    <div class="fti hot">Afro-Caribbean <div class="ftdot"></div></div>
    <div class="fti">Toronto 2026 <div class="ftdot"></div></div>
    <div class="fti hot">August 15 <div class="ftdot"></div></div>
    <div class="fti">First Edition <div class="ftdot"></div></div>
    <div class="fti hot">International Artists <div class="ftdot"></div></div>
    <div class="fti">Live DJs <div class="ftdot"></div></div>
    <?php endfor; ?>
  </div>
</div>

<!-- COUNTDOWN -->
<div class="fcount-section">
  <div class="fcount-label">Counting Down to August 15, 2026</div>
  <div class="fcount-grid">
    <div class="fcd-block"><span class="fcd-num" id="cd-days">--</span><span class="fcd-lbl">Days</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-hours">--</span><span class="fcd-lbl">Hours</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-mins">--</span><span class="fcd-lbl">Minutes</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-secs">--</span><span class="fcd-lbl">Seconds</span></div>
  </div>
</div>

<!-- EMAIL CAPTURE -->
<div class="fcapture" id="notify">
  <div class="fcap-left">
    <div class="fcap-tag">
      <div class="fcap-tag-dot"></div>
      <span>Limited Early Access</span>
    </div>
    <div class="fcap-title">Be First<br>to Know.<br><em>Drop Incoming.</em></div>
    <p class="fcap-desc">Lineup announcements. Presale tickets. Exclusive updates. All dropping before the public knows anything.</p>
  </div>

  <div class="fcap-right">
    <form id="fest-capture-form" novalidate>
      <div class="fform-row">
        <div class="fform-field">
          <input type="text" name="first_name" id="ffn" placeholder=" ">
          <label for="ffn">First Name</label>
        </div>
        <div class="fform-field">
          <input type="text" name="last_name" id="fln" placeholder=" ">
          <label for="fln">Last Name</label>
        </div>
      </div>
      <div class="fform-field">
        <input type="email" name="email" id="fem" placeholder=" " required>
        <label for="fem">Email Address</label>
      </div>
      <div class="fform-field">
        <input type="text" name="city" id="fct" placeholder=" ">
        <label for="fct">Your City</label>
      </div>
      <!-- Honeypot -->
      <input type="text" name="website" style="display:none;position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">
      <button type="submit" class="fest-capture-submit">Notify Me When Tickets Drop →</button>
      <div class="fest-form-msg" role="alert"></div>
    </form>
  </div>
</div>

<?php get_footer(); ?>
