<?php
$ticket_url = fest_setting('fest_ticket_url') ?: home_url('/tickets');
$socials    = fest_social_icons();
?>

<footer class="fest-footer" role="contentinfo">
  <div class="fest-footer-top">
    <div class="fest-footer-brand">
      <div class="fest-footer-logo">AFROBASS<span> FEST</span></div>
      <div class="fest-footer-sub">Toronto, Canada · August 15, 2026</div>
    </div>
    <div class="fest-footer-links">
      <div class="fest-footer-col">
        <h4>Festival</h4>
        <a href="<?php echo esc_url(home_url('/lineup')); ?>">Lineup</a>
        <a href="<?php echo esc_url(home_url('/tickets')); ?>">Tickets</a>
        <a href="<?php echo esc_url(home_url('/about')); ?>">About</a>
      </div>
      <div class="fest-footer-col">
        <h4>Partner</h4>
        <a href="<?php echo esc_url(home_url('/sponsors')); ?>">Sponsorship</a>
        <a href="https://afrobass.com/book-talent" target="_blank" rel="noopener">Artist Booking</a>
        <a href="https://afrobass.com" target="_blank" rel="noopener">Afrobass.com</a>
      </div>
      <div class="fest-footer-col">
        <h4>Contact</h4>
        <a href="mailto:<?php echo esc_attr(fest_setting('fest_email') ?: 'contact@afrobass.com'); ?>">
          <?php echo esc_html(fest_setting('fest_email') ?: 'contact@afrobass.com'); ?>
        </a>
        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', fest_setting('fest_phone') ?: '4168466483')); ?>">
          <?php echo esc_html(fest_setting('fest_phone') ?: '416.846.6483'); ?>
        </a>
      </div>
    </div>
  </div>

  <div class="fest-footer-bottom">
    <span class="fest-footer-copy">© <?php echo date('Y'); ?> Afrobass Inc. All Rights Reserved. · Presented by Afrobass</span>
    <nav class="fest-footer-socials" aria-label="Social media">
      <?php foreach ($socials as $key => $s): ?>
        <a href="<?php echo esc_url($s['url']); ?>"
           class="fest-social-link" target="_blank" rel="noopener"
           aria-label="<?php echo esc_attr(ucfirst($key)); ?>">
          <?php echo $s['svg']; ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
