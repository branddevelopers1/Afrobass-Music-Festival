<?php get_header();
$ticket_url    = fest_setting('fest_ticket_url') ?: home_url('/tickets');
$contact_email = fest_setting('fest_email') ?: 'contact@afrobassfest.com';

$artists = new WP_Query([
    'post_type'      => 'fest_artist',
    'posts_per_page' => 6,
    'meta_key'       => 'fest_artist_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
]);

$sponsors = new WP_Query([
    'post_type'      => 'fest_sponsor',
    'posts_per_page' => -1,
    'meta_key'       => 'fest_sponsor_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
]);
?>

<!-- ── ATMOSPHERE ── -->
<div class="fbg-layer" aria-hidden="true">
  <div class="fbg-glow-1"></div>
  <div class="fbg-glow-2"></div>
  <div class="fbg-glow-3"></div>
  <div class="fbg-grain"></div>
</div>
<div class="fbg-lines" aria-hidden="true"></div>

<!-- ═══════════════════════════════════════════
     1. HERO
════════════════════════════════════════════ -->
<section class="fhero" id="home">

  <div class="fghost fg-1" aria-hidden="true">AFROBEATS</div>
  <div class="fghost fg-2" aria-hidden="true">AMAPIANO</div>
  <div class="fghost fg-3" aria-hidden="true">TORONTO</div>

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
      <div class="fpill">
        <div class="fpill-dot" style="background:#FF6B1A;"></div>
        <span>August 15, 2026</span>
      </div>
      <div class="fpill">
        <div class="fpill-dot" style="background:#FF2D8A;"></div>
        <span>Rebel Entertainment Complex</span>
      </div>
      <div class="fpill">
        <div class="fpill-dot" style="background:#a855f7;"></div>
        <span>Toronto, Canada</span>
      </div>
    </div>

    <div class="factions">
      <button class="fbtn-main" onclick="showpass.tickets.eventPurchaseWidget('afrobass-festival', {'theme-primary': '#FF2D8A', 'keep-shopping': false})" style="border:none;cursor:pointer;">
        Buy Tickets Now &rarr;
      </button>
      <a href="<?php echo esc_url(home_url('/lineup')); ?>" class="fbtn-ghost">
        See the Lineup
      </a>
    </div>
  </div>

  <div class="fscroll-ind" aria-hidden="true">
    <div class="fscroll-line"></div>
    <span class="fscroll-txt">Scroll</span>
  </div>
</section>

<!-- ── TICKER ── -->
<div class="fticker" aria-hidden="true">
  <div class="fticker-track">
    <?php for($i=0;$i<2;$i++): ?>
    <div class="fti hot">Afrobeats <div class="ftdot"></div></div>
    <div class="fti">Amapiano <div class="ftdot"></div></div>
    <div class="fti hot">Afro-Caribbean <div class="ftdot"></div></div>
    <div class="fti">August 15, 2026 <div class="ftdot"></div></div>
    <div class="fti hot">Toronto <div class="ftdot"></div></div>
    <div class="fti">Rebel Entertainment Complex <div class="ftdot"></div></div>
    <div class="fti hot">3,000+ Fans <div class="ftdot"></div></div>
    <div class="fti">First Edition <div class="ftdot"></div></div>
    <div class="fti hot">19+ Event <div class="ftdot"></div></div>
    <div class="fti">Live DJs <div class="ftdot"></div></div>
    <?php endfor; ?>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     2. COUNTDOWN
════════════════════════════════════════════ -->
<div class="fcount-section" style="position:relative;z-index:2;">
  <div class="fcount-label">Counting Down to August 15, 2026</div>
  <div class="fcount-grid">
    <div class="fcd-block"><span class="fcd-num" id="cd-days">--</span><span class="fcd-lbl">Days</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-hours">--</span><span class="fcd-lbl">Hours</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-mins">--</span><span class="fcd-lbl">Minutes</span></div>
    <div class="fcd-block"><span class="fcd-num" id="cd-secs">--</span><span class="fcd-lbl">Seconds</span></div>
  </div>
</div>

<!-- ═══════════════════════════════════════════
     3. LINEUP TEASER
════════════════════════════════════════════ -->
<section style="position:relative;z-index:2;padding:100px 56px;border-top:1px solid rgba(255,255,255,0.04);">

  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;" class="fest-reveal">
    <div>
      <div class="fest-kicker">Afrobass Music Festival 2026</div>
      <h2 style="font-family:'Unbounded',sans-serif;font-size:clamp(36px,5vw,64px);font-weight:900;letter-spacing:-1px;color:#fff;text-transform:uppercase;line-height:0.95;margin-top:12px;">The<br><em style="color:#FF2D8A;font-style:italic;">Lineup</em></h2>
    </div>
    <a href="<?php echo esc_url(home_url('/lineup')); ?>"
       style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;display:flex;align-items:center;gap:10px;transition:color 0.2s;white-space:nowrap;"
       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Full Lineup &rarr;</a>
  </div>

  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2px;background:rgba(255,255,255,0.04);">
    <?php
    if ($artists->have_posts()):
      while ($artists->have_posts()): $artists->the_post();
        $role = get_field('fest_artist_role') ?: 'Headliner';
        $origin = get_field('fest_artist_origin') ?: '';
        $tba  = get_field('fest_artist_tba');
        $head = in_array($role, ['Headliner','Co-Headliner']);
    ?>
      <div class="fest-reveal" style="background:#080808;position:relative;overflow:hidden;aspect-ratio:3/4;display:flex;flex-direction:column;justify-content:flex-end;">
        <?php if (!$tba && has_post_thumbnail()): ?>
          <?php the_post_thumbnail('fest-artist',['style'=>'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:top;filter:grayscale(15%);']); ?>
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(8,8,8,0.95) 0%,rgba(8,8,8,0.3) 55%,transparent 100%);"></div>
        <?php else: ?>
          <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;">
            <div style="width:68px;height:68px;border-radius:50%;border:1px solid rgba(255,255,255,0.07);display:flex;align-items:center;justify-content:center;">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.12)" stroke-width="1"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
            </div>
            <div style="font-family:'Unbounded',sans-serif;font-size:9px;font-weight:700;letter-spacing:5px;color:rgba(255,255,255,0.08);text-transform:uppercase;">Coming Soon</div>
          </div>
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(8,8,8,0.98) 0%,transparent 60%);"></div>
        <?php endif; ?>
        <div style="position:absolute;top:16px;left:16px;background:<?php echo $head ? '#FF2D8A' : 'rgba(255,255,255,0.07)'; ?>;padding:4px 12px;border-radius:1px;">
          <span style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#fff;"><?php echo esc_html($role); ?></span>
        </div>
        <div style="position:relative;z-index:2;padding:20px 24px;">
          <div style="font-family:'Unbounded',sans-serif;font-size:clamp(16px,1.8vw,24px);font-weight:900;color:<?php echo $tba?'rgba(255,255,255,0.12)':'#fff'; ?>;text-transform:uppercase;letter-spacing:-0.5px;line-height:1.1;"><?php echo $tba ? 'TBA' : get_the_title(); ?></div>
          <?php if ($origin && !$tba): ?><div style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:5px;"><?php echo esc_html($origin); ?></div><?php endif; ?>
        </div>
      </div>
    <?php endwhile; wp_reset_postdata();
    else:
      for ($s=0;$s<6;$s++): $head = $s < 2; ?>
      <div class="fest-reveal" style="background:#080808;position:relative;overflow:hidden;aspect-ratio:3/4;display:flex;flex-direction:column;justify-content:flex-end;">
        <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;">
          <div style="width:68px;height:68px;border-radius:50%;border:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
          </div>
          <div style="font-family:'Unbounded',sans-serif;font-size:9px;font-weight:700;letter-spacing:5px;color:rgba(255,255,255,0.07);text-transform:uppercase;">Coming Soon</div>
        </div>
        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(8,8,8,0.98) 0%,transparent 60%);"></div>
        <div style="position:absolute;top:16px;left:16px;background:<?php echo $head?'rgba(255,45,138,0.15)':'rgba(255,255,255,0.05)'; ?>;border:1px solid <?php echo $head?'rgba(255,45,138,0.25)':'rgba(255,255,255,0.05)'; ?>;padding:4px 12px;border-radius:1px;">
          <span style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:<?php echo $head?'rgba(255,45,138,0.7)':'rgba(255,255,255,0.2)'; ?>;"><?php echo $head?'Headliner':'Artist'; ?></span>
        </div>
        <div style="position:relative;z-index:2;padding:20px 24px;">
          <div style="font-family:'Unbounded',sans-serif;font-size:22px;font-weight:900;color:rgba(255,255,255,0.1);text-transform:uppercase;">TBA</div>
        </div>
      </div>
    <?php endfor; endif; ?>
  </div>

  <div style="margin-top:36px;text-align:center;" class="fest-reveal">
    <a href="<?php echo esc_url(home_url('/lineup')); ?>"
       style="display:inline-flex;align-items:center;gap:12px;font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;border:1px solid rgba(255,255,255,0.08);padding:16px 32px;border-radius:100px;transition:color 0.2s,border-color 0.2s;"
       onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.2)'"
       onmouseout="this.style.color='rgba(255,255,255,0.3)';this.style.borderColor='rgba(255,255,255,0.08)'">
      Full Artist Lineup &rarr;
    </a>
  </div>

</section>

<!-- ═══════════════════════════════════════════
     5. TICKET TIERS
════════════════════════════════════════════ -->
<section style="position:relative;z-index:2;padding:100px 56px;border-top:1px solid rgba(255,255,255,0.04);">

  <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;" class="fest-reveal">
    <div>
      <div class="fest-kicker">Get In</div>
      <h2 style="font-family:'Unbounded',sans-serif;font-size:clamp(36px,5vw,64px);font-weight:900;letter-spacing:-1px;color:#fff;text-transform:uppercase;line-height:0.95;margin-top:12px;">Your<br><em style="color:#FF2D8A;font-style:italic;">Tickets</em></h2>
    </div>
    <a href="<?php echo esc_url(home_url('/tickets')); ?>"
       style="font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;display:flex;align-items:center;gap:10px;transition:color 0.2s;white-space:nowrap;"
       onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">All Ticket Options &rarr;</a>
  </div>

  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2px;background:rgba(255,255,255,0.04);">

    <div class="fest-reveal" style="background:#080808;padding:40px 36px 48px;position:relative;">
      <span style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);display:block;margin-bottom:20px;">General Admission</span>
      <div style="font-family:'Unbounded',sans-serif;font-size:clamp(26px,3vw,40px);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:4px;">TBA</div>
      <div style="font-size:11px;color:rgba(255,255,255,0.2);margin-bottom:28px;">per person</div>
      <div style="display:flex;flex-direction:column;gap:11px;margin-bottom:36px;">
        <?php foreach(['Full festival access','All performances','General standing floor','Access to all vendors'] as $p): ?>
          <div style="display:flex;gap:11px;align-items:flex-start;font-size:13px;color:rgba(255,255,255,0.45);">
            <div style="width:4px;height:4px;border-radius:50%;background:#FF6B1A;margin-top:6px;flex-shrink:0;"></div><?php echo esc_html($p); ?>
          </div>
        <?php endforeach; ?>
      </div>
      <button onclick="showpass.tickets.eventPurchaseWidget('afrobass-festival', {'theme-primary': '#FF2D8A', 'keep-shopping': false})"
         style="display:block;width:100%;font-family:'Space Grotesk',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;background:transparent;color:rgba(255,255,255,0.4);border:1px solid rgba(255,255,255,0.1);padding:15px;border-radius:2px;text-align:center;cursor:pointer;transition:color 0.2s,border-color 0.2s;"
         onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.3)'"
         onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderColor='rgba(255,255,255,0.1)'">Buy Tickets &rarr;</button>
    </div>

    <div class="fest-reveal fest-d1" style="background:#0d0d0d;padding:40px 36px 48px;position:relative;">
      <div style="position:absolute;top:0;left:0;right:0;height:2px;background:#FF2D8A;"></div>
      <span style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#FF2D8A;display:block;margin-bottom:20px;">VIP Experience &nbsp;&#9733;</span>
      <div style="font-family:'Unbounded',sans-serif;font-size:clamp(26px,3vw,40px);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:4px;">TBA</div>
      <div style="font-size:11px;color:rgba(255,255,255,0.2);margin-bottom:28px;">per person</div>
      <div style="display:flex;flex-direction:column;gap:11px;margin-bottom:36px;">
        <?php foreach(['Everything in GA','Dedicated VIP area & bar','Priority entry','Exclusive VIP lounge'] as $p): ?>
          <div style="display:flex;gap:11px;align-items:flex-start;font-size:13px;color:rgba(255,255,255,0.55);">
            <div style="width:4px;height:4px;border-radius:50%;background:#FF2D8A;margin-top:6px;flex-shrink:0;"></div><?php echo esc_html($p); ?>
          </div>
        <?php endforeach; ?>
      </div>
      <button onclick="showpass.tickets.eventPurchaseWidget('afrobass-festival', {'theme-primary': '#FF2D8A', 'keep-shopping': false})"
         style="display:block;width:100%;font-family:'Space Grotesk',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;background:#FF2D8A;color:#fff;padding:15px;border-radius:2px;text-align:center;border:none;cursor:pointer;transition:box-shadow 0.2s;"
         onmouseover="this.style.boxShadow='0 8px 28px rgba(255,45,138,0.4)'" onmouseout="this.style.boxShadow='none'">Buy Tickets &rarr;</button>
    </div>

    <div class="fest-reveal fest-d2" style="background:#080808;padding:40px 36px 48px;position:relative;">
      <span style="font-family:'Space Grotesk',sans-serif;font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.25);display:block;margin-bottom:20px;">Table Package</span>
      <div style="font-family:'Unbounded',sans-serif;font-size:clamp(26px,3vw,40px);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:4px;">TBA</div>
      <div style="font-size:11px;color:rgba(255,255,255,0.2);margin-bottom:28px;">per table</div>
      <div style="display:flex;flex-direction:column;gap:11px;margin-bottom:36px;">
        <?php foreach(['Table for 6-10 guests','Bottle service included','Dedicated event host','Best stage views'] as $p): ?>
          <div style="display:flex;gap:11px;align-items:flex-start;font-size:13px;color:rgba(255,255,255,0.45);">
            <div style="width:4px;height:4px;border-radius:50%;background:#a855f7;margin-top:6px;flex-shrink:0;"></div><?php echo esc_html($p); ?>
          </div>
        <?php endforeach; ?>
      </div>
      <a href="mailto:<?php echo esc_attr($contact_email); ?>?subject=Table Package Enquiry"
         style="display:block;font-family:'Space Grotesk',sans-serif;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;background:transparent;color:rgba(255,255,255,0.4);border:1px solid rgba(255,255,255,0.1);padding:15px;border-radius:2px;text-align:center;text-decoration:none;transition:color 0.2s,border-color 0.2s;"
         onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.3)'"
         onmouseout="this.style.color='rgba(255,255,255,0.4)';this.style.borderColor='rgba(255,255,255,0.1)'">Enquire &rarr;</a>
    </div>

  </div>

</section>

<!-- ═══════════════════════════════════════════
     8. EMAIL SIGNUP
════════════════════════════════════════════ -->
<section style="position:relative;z-index:2;padding:100px 56px;border-top:1px solid rgba(255,255,255,0.04);" id="notify">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;max-width:1200px;margin:0 auto;">

    <div class="fest-reveal">
      <div class="fcap-tag" style="display:inline-flex;margin-bottom:28px;">
        <div class="fcap-tag-dot"></div>
        <span>Join the List</span>
      </div>
      <div class="fcap-title">Be First<br>to Know.<br><em>Drop Incoming.</em></div>
      <p class="fcap-desc" style="margin-top:20px;">Lineup announcements. Presale access. Exclusive updates. Everything drops to the list first.</p>
      <div style="display:flex;gap:10px;margin-top:36px;flex-wrap:wrap;">
        <?php foreach (fest_social_icons() as $name => $s): ?>
          <a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener"
             style="width:38px;height:38px;border-radius:50%;border:1px solid rgba(255,255,255,0.07);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.25);text-decoration:none;transition:color 0.2s,border-color 0.2s;"
             onmouseover="this.style.color='#FF2D8A';this.style.borderColor='rgba(255,45,138,0.35)'"
             onmouseout="this.style.color='rgba(255,255,255,0.25)';this.style.borderColor='rgba(255,255,255,0.07)'">
            <span style="width:14px;height:14px;display:flex;"><?php echo $s['svg']; ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="fest-reveal fest-d1">
      <form id="fest-capture-form" novalidate style="display:flex;flex-direction:column;gap:0;">
        <div class="fform-row">
          <div class="fform-field"><input type="text" name="first_name" id="ffn" placeholder=" "><label for="ffn">First Name</label></div>
          <div class="fform-field"><input type="text" name="last_name" id="fln" placeholder=" "><label for="fln">Last Name</label></div>
        </div>
        <div class="fform-field">
          <input type="email" name="email" id="fem" placeholder=" " required>
          <label for="fem">Email Address</label>
        </div>
        <div class="fform-field">
          <input type="tel" name="phone" id="fph" placeholder=" ">
          <label for="fph">Phone <span style="color:rgba(255,255,255,0.2);font-size:9px;">(optional)</span></label>
        </div>
        <input type="text" name="website" style="display:none;position:absolute;left:-9999px;" tabindex="-1" autocomplete="off">
        <button type="submit" class="fest-capture-submit" style="margin-top:32px;">Notify Me When Tickets Drop &rarr;</button>
        <div class="fest-form-msg" role="alert"></div>
      </form>
    </div>

  </div>
</section>

<?php get_footer(); ?>
