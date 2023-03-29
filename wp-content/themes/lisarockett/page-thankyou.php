<?php
/* Template Name: Thank you */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part('template-parts/hero'); ?>


<!-- <div class="lr-page">
    <div class="container">

        <?php // the_content(); ?>

    </div>
</div> -->

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
