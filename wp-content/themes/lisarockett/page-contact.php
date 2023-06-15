<?php
/* Template Name: Contact */
?>

<?php

$contactInfo = LR_Options::get();

$form = new LR_Form('contact_form');
$form->addFormItem('first_name', array());
$form->addFormItem('last_name', array());
$form->addFormItem('email', array('type' => 'email'));
// $form->addFormItem('phone', array('validation_type' => 'none'));
$form->addFormItem('message', array('type' => 'textarea'));

if ($form->hasFormSubmited()) {
    if ($form->isValid()) {

        // $to = "mikerockett@live.com";
        // $subject = "TESTING LR SITE";
        // $message = "Is it working?";
        // wp_mail( $to, $subject, $message );

		try {

	        $to = LR_Options::get('ADMIN_EMAIL');

	        // Call the function you want to execute within the try block
	        RWDCalenderMail::send($to, 'Contact Form', 'contact-form', [
	            '{{name}}' => $form->formItems['first_name']->value . ' ' . $form->formItems['last_name']->value,
	            // '{{date}}' => $data['q_date'],
	            // '{{time}}' => $data['q_time'],
	            '{{email}}' => $form->formItems['email']->value,
				'{{message}}' => $form->formItems['message']->value
	            // '{{phone}}' => $data['q_phone']
	        ]);

	    } catch (Exception $e) {
	        // Handle any exceptions that may have been thrown
	        echo 'Caught exception: ',  $e->getMessage(), "\n";
	        die();
	    }

	    wp_redirect( home_url( '/thankyou' ) );

	}
}

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php get_template_part('template-parts/hero'); ?>

<div class="bg-light py-5">
	<div class="container">

		<?php // the_content(); ?>

		<div class="row">
			<div class="col-sm-5">
				<!-- <p>Get in touch with me, use the contact form or one of the methods below</p> -->
				<ul class="contact-info">
					<li>
						<a href="mailto:<?php echo $contact['ADMIN_EMAIL']; ?>">
							<i class="fas fa-envelope"></i>
							<?php echo $contactInfo['ADMIN_EMAIL']; ?>
						</a>
					</li>
					<li>
						<a href="tel:<?php echo $contact['PHONE']; ?>">
							<i class="fas fa-phone-alt"></i>
							<?php echo $contactInfo['PHONE']; ?>
						</a>
					</li>
					<li>
						<a href="https://www.facebook.com/lisa.rockett.50">
							<i class="fab fa-facebook-f"></i>
							<?php echo 'facebook.com/lisa.rockett.50'; ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-7">
				<form action="" method="POST" class="lr-form">

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<?php $form->formItems['first_name']->render(); ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-2">
								<?php $form->formItems['last_name']->render(); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="form-group mb-2">
								<?php $form->formItems['email']->render(); ?>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<?php $form->formItems['message']->render(); ?>
							</div>
						</div>
					</div>

					<?php $form->displayMsg(); ?>

					<button type="submit" name="contact_form" class="mt-4 btn">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
