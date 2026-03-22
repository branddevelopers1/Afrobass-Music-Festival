<!-- BOTTOM BAR -->
<div class="fest-bottom-bar" style="position:relative;z-index:2;padding:32px 56px;border-top:1px solid rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;">
  <div style="font-family:'Unbounded',sans-serif;font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.15);">
    © <?php echo date('Y'); ?> Afrobass Inc. · Afrobass Music Festival
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap;">
    <?php
    $socials = [
      ['https://instagram.com/afrobass.ca','Instagram','<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/></svg>'],
      ['https://www.youtube.com/@Afrobass','YouTube','<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.2 2.8 12 2.8 12 2.8s-4.2 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.6 21.8 12 21.8 12 21.8s4.2 0 6.8-.3c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.3v-2C23.3 9.1 23 7 23 7zM9.7 15.5v-7.4l8.1 3.7-8.1 3.7z"/></svg>'],
      ['https://www.tiktok.com/@afrobass','TikTok','<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V9.02a8.16 8.16 0 004.77 1.52V7.1a4.85 4.85 0 01-1-.41z"/></svg>'],
      ['https://facebook.com/afrobass.ca','Facebook','<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.41 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.49h-2.79V24C19.61 23.1 24 18.1 24 12.07z"/></svg>'],
      ['https://x.com/afrobassca','X','<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.736-8.849L2 2.25h6.946l4.26 5.632L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>'],
    ];
    foreach ($socials as $s):
    ?>
      <a href="<?php echo esc_url($s[0]); ?>" target="_blank" rel="noopener"
         style="display:flex;align-items:center;gap:6px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);padding:8px 16px;border-radius:100px;font-family:'Space Grotesk',sans-serif;font-size:11px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.3);text-decoration:none;transition:color 0.2s,border-color 0.2s;"
         onmouseover="this.style.color='#FF2D8A';this.style.borderColor='rgba(255,45,138,0.3)';"
         onmouseout="this.style.color='rgba(255,255,255,0.3)';this.style.borderColor='rgba(255,255,255,0.06)';">
        <span style="width:13px;height:13px;display:flex;flex-shrink:0;"><?php echo $s[2]; ?></span>
        <?php echo esc_html($s[1]); ?>
      </a>
    <?php endforeach; ?>
  </div>
  <div style="font-size:11px;color:rgba(255,255,255,0.12);letter-spacing:1px;font-family:'Space Grotesk',sans-serif;">
    afrobassfestival.com · Presented by <a href="https://afrobass.com" style="color:rgba(255,45,138,0.5);text-decoration:none;">Afrobass</a>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
