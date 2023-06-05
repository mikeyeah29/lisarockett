<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section>

    <?php get_template_part('template-parts/hero'); ?>

</section>

<div class="lr-page">

    <div class="container container-narrow">

        <?php the_content(); ?>

    </div>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
