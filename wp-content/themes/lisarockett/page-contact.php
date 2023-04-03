<?php
/* Template Name: Contact */
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part('template-parts/hero'); ?>

<div class="container">
	<ul class="contact-info">
		<li><strong>Phone:</strong> 555-555-5555</li>
		<li><strong>Email:</strong> info@example.com</li>
		<li><strong>Facebook:</strong> <a href="https://www.facebook.com/yourpage/">facebook.com/yourpage</a></li>
	</ul>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
