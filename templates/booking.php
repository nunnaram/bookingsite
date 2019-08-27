<?php get_header(); ?>
  <?php while(have_posts()): the_post(); ?>
   <div class="container">
        <h1>Prsonal Details</h1>
        <?php print_r($_POST); ?>
   </div>
  <?php endwhile; ?>
<?php get_footer(); ?>