<?php get_header(); ?>
<div style="padding:160px 56px 120px;">
  <div class="fest-kicker">Afrobass Music Festival</div>
  <h1 class="fest-title" style="margin-bottom:48px;"><?php wp_title(''); ?></h1>
  <?php if (have_posts()): while(have_posts()): the_post(); ?>
    <div style="padding:24px 0;border-bottom:1px solid #1a1a1a;">
      <a href="<?php the_permalink(); ?>" style="font-family:'Barlow Condensed',sans-serif;font-size:22px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#fff;"><?php the_title(); ?></a>
    </div>
  <?php endwhile; else: ?>
    <p style="color:rgba(255,255,255,0.3);">Nothing here yet.</p>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
