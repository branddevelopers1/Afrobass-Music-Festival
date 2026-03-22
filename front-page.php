<?php get_header(); ?>

<?php
$hero_video  = fest_setting('fest_hero_video') ? get_field('fest_hero_video', 'option') : null;
$ticket_url  = fest_setting('fest_ticket_url') ?: home_url('/tickets');
?>

<!-- ═══ HERO COVER ═══ -->
<section class="fest-cover" id="home">
  <div class="fest-cover-video-wrap">
    <?php if (!empty($hero_video['url'])): ?>
      <video class="fest-cover-video" autoplay muted loop playsinline>
        <source src="<?php echo esc_url($hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php else: ?>
      <div class="fest-cover-fallback"></div>
    <?php endif; ?>
    <div class="fest-cover-grain"></div>
  </div>
  <div class="fest-cover-overlay"></div>

  <div class="fest-cover-content">
    <div class="fest-cover-edition">First Edition · Toronto, Canada</div>
    <h1 class="fest-cover-h1">
      AFROBASS
      <em>MUSIC<br>FESTIVAL</em>
    </h1>
    <div class="fest-cover-meta">
      <div class="fest-cover-meta-item"><strong>August 15</strong>, 2026</div>
      <div class="fest-cover-meta-item">Toronto, Canada</div>
      <div class="fest-cover-meta-item">Rebel Entertainment Complex</div>
      <div class="fest-cover-meta-item">1,500+ Attendees</div>
    </div>
    <div class="fest-cover-actions">
      <a href="<?php echo esc_url($ticket_url); ?>" class="fest-btn-primary">Get Tickets →</a>
      <button class="fest-btn-ghost" onclick="document.getElementById('notify').scrollIntoView({behavior:'smooth'})">
        <div class="arrow-ring">↓</div>
        Stay Updated
      </button>
    </div>
  </div>

  <div class="fest-scroll-ind" aria-hidden="true">
    <div class="fest-scroll-line"></div>
    <span class="fest-scroll-text">Scroll</span>
  </div>
</section>

<!-- ═══ TICKER ═══ -->
<div class="fest-ticker" aria-hidden="true">
  <div class="fest-ticker-track">
    <?php for ($i = 0; $i < 2; $i++): ?>
    <div class="fest-ticker-item">
      Afrobeats <span class="fest-ticker-sep">✦</span>
      Amapiano <span class="fest-ticker-sep">✦</span>
      Afro-Caribbean <span class="fest-ticker-sep">✦</span>
      Toronto 2026 <span class="fest-ticker-sep">✦</span>
      August 15 <span class="fest-ticker-sep">✦</span>
      Rebel Entertainment Complex <span class="fest-ticker-sep">✦</span>
      1,500+ Attendees <span class="fest-ticker-sep">✦</span>
      First Edition <span class="fest-ticker-sep">✦</span>
      International Artists <span class="fest-ticker-sep">✦</span>
    </div>
    <?php endfor; ?>
  </div>
</div>

<!-- ═══ COUNTDOWN ═══ -->
<div class="fest-countdown-section fest-reveal">
  <div class="fest-countdown-label">Counting Down to August 15, 2026</div>
  <div class="fest-countdown-grid">
    <div class="fest-cd-block">
      <span class="fest-cd-num" id="cd-days">--</span>
      <span class="fest-cd-lbl">Days</span>
    </div>
    <div class="fest-cd-block">
      <span class="fest-cd-num" id="cd-hours">--</span>
      <span class="fest-cd-lbl">Hours</span>
    </div>
    <div class="fest-cd-block">
      <span class="fest-cd-num" id="cd-mins">--</span>
      <span class="fest-cd-lbl">Minutes</span>
    </div>
    <div class="fest-cd-block">
      <span class="fest-cd-num" id="cd-secs">--</span>
      <span class="fest-cd-lbl">Seconds</span>
    </div>
  </div>
</div>

<!-- ═══ LINEUP TEASER ═══ -->
<?php
$artists = new WP_Query([
  'post_type'      => 'fest_artist',
  'posts_per_page' => 3,
  'meta_key'       => 'fest_artist_order',
  'orderby'        => 'meta_value_num',
  'order'          => 'ASC',
]);
?>
<?php if ($artists->have_posts()): ?>
<section style="padding:100px 56px;border-top:1px solid #1a1a1a;border-bottom:1px solid #1a1a1a;">
  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;" class="fest-reveal">
    <div>
      <div class="fest-kicker">Who's Playing</div>
      <div class="fest-title">The Lineup</div>
    </div>
    <a href="<?php echo esc_url(home_url('/lineup')); ?>" class="fest-view-all">Full Lineup <span class="arr">→</span></a>
  </div>
  <div class="fest-artists-grid">
    <?php while ($artists->have_posts()): $artists->the_post();
      $role     = get_field('fest_artist_role')   ?: 'Headliner';
      $origin   = get_field('fest_artist_origin') ?: '';
      $tba      = get_field('fest_artist_tba');
    ?>
      <div class="fest-artist-card fest-reveal">
        <div class="fest-artist-img-wrap">
          <?php if ($tba): ?>
            <div class="fest-artist-img-placeholder">
              <svg viewBox="0 0 80 80" fill="none" style="width:64px;height:64px;color:#1a1a1a;"><circle cx="40" cy="30" r="16" stroke="currentColor" stroke-width="1.5"/><path d="M8 72c0-17.7 14.3-32 32-32s32 14.3 32 32" stroke="currentColor" stroke-width="1.5"/></svg>
            </div>
          <?php elseif (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('fest-artist', ['class'=>'fest-artist-img']); ?>
          <?php else: ?>
            <div class="fest-artist-img-placeholder">
              <svg viewBox="0 0 80 80" fill="none" style="width:64px;height:64px;color:#1a1a1a;"><circle cx="40" cy="30" r="16" stroke="currentColor" stroke-width="1.5"/><path d="M8 72c0-17.7 14.3-32 32-32s32 14.3 32 32" stroke="currentColor" stroke-width="1.5"/></svg>
            </div>
          <?php endif; ?>
          <span class="fest-artist-role-badge"><?php echo esc_html($role); ?></span>
          <div class="fest-artist-overlay"></div>
        </div>
        <div class="fest-artist-info">
          <div class="fest-artist-name"><?php echo $tba ? 'TBA' : get_the_title(); ?></div>
          <?php if ($origin && !$tba): ?>
            <div class="fest-artist-origin"><?php echo esc_html($origin); ?></div>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<!-- ═══ FESTIVAL INFO ═══ -->
<section style="padding:100px 56px;border-bottom:1px solid #1a1a1a;background:#060606;">
  <div class="fest-reveal" style="margin-bottom:56px;">
    <div class="fest-kicker">The Details</div>
    <div class="fest-title">Festival Info</div>
  </div>
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:#1a1a1a;" class="fest-reveal">
    <?php
    $info = [
      ['Date',      'Saturday, August 15, 2026'],
      ['Venue',     'Rebel Entertainment Complex'],
      ['City',      'Toronto, Canada'],
      ['Capacity',  '1,500+ Attendees'],
    ];
    foreach ($info as $i => $item):
    ?>
      <div style="background:#0d0d0d;padding:40px 36px;">
        <div style="font-family:'Barlow Condensed',sans-serif;font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:12px;"><?php echo esc_html($item[0]); ?></div>
        <div style="font-family:'Bebas Neue',sans-serif;font-size:22px;letter-spacing:1px;color:#fff;line-height:1.2;"><?php echo esc_html($item[1]); ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ═══ EMAIL CAPTURE ═══ -->
<section class="fest-capture-section" id="notify">
  <div class="fest-capture-left fest-reveal">
    <div class="fest-kicker">Be First to Know</div>
    <div class="fest-capture-title">Tickets Drop<br>Before the<br>Announcement</div>
    <p class="fest-capture-desc" style="margin-top:20px;">
      Join the list and get early access to tickets, lineup announcements, and exclusive presale codes before anyone else.
    </p>
  </div>
  <div class="fest-reveal fest-d2">
    <form id="fest-capture-form" class="fest-capture-form" novalidate>
      <div class="fest-input-row">
        <input type="text" name="first_name" class="fest-input" placeholder="First name" required>
        <input type="text" name="last_name" class="fest-input" placeholder="Last name">
      </div>
      <input type="email" name="email" class="fest-input" placeholder="Email address" required>
      <input type="text" name="city" class="fest-input" placeholder="Your city">
      <!-- Honeypot -->
      <input type="text" name="website" style="display:none;position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">
      <button type="submit" class="fest-capture-submit">Notify Me →</button>
      <div class="fest-form-msg" role="alert"></div>
    </form>
  </div>
</section>

<!-- ═══ POWERED BY AFROBASS ═══ -->
<div class="fest-powered-by">
  <div class="fest-reveal">
    <div class="fest-powered-label">Presented By</div>
    <div class="fest-powered-logo">AFRO<span>BASS</span></div>
  </div>
  <p class="fest-powered-desc fest-reveal fest-d1">
    Afrobass Music Festival is produced by Afrobass — Canada's premier Afrobeats event production company. Since 2018, we've been bringing world-class African music and culture to Canadian audiences coast to coast.
  </p>
  <a href="https://afrobass.com" target="_blank" rel="noopener" class="fest-powered-link fest-reveal fest-d2">
    Visit Afrobass.com →
  </a>
</div>

<?php get_footer(); ?>
