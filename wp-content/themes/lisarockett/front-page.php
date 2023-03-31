<?php get_header(); ?>

<section>

    <?php get_template_part('template-parts/hero'); ?>

</section>

<?php if(get_field('content_section_1')) { ?>
    <section class="content-section">
        <div class="container container-narrow">
            <div class="row">

                <div class="d-md-flex align-items-center flex-sm-row-reverse">
                    <div class="blob-img">
                        <img src="<?php bloginfo('template_url'); ?>/img/avatar.png" />
                    </div>
                    <div class="panel">
                        <?php the_field('content_section_1'); ?>
                    </div>
                </div>

            </div>

        </div>
    </section>
<?php } ?>

<?php if(get_field('content_section_2')) { ?>
    <section class="content-section">
        <div class="container container-narrow">
            <div class="row">

                <div class="row mt-0 mt-md-0">

                    <div class="d-md-flex align-items-center">
                        <div class="blob-img blob-img-flip">
                            <img src="<?php bloginfo('template_url'); ?>/img/avatar.png" />
                        </div>
                        <div class="panel panel-flip">
                            <?php the_field('content_section_2'); ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<?php } ?>

<section class="content-section content-section--solid">
    <div class="container container-narrow">
        <div class="testimonals">
            <h2 class="mb-4">Testimonials</h2>

            <?php $testmionials = LR_Testamonials::get(); ?>

            <div class="testimonial-slider" id="testimonials">

                <?php foreach ($testmionials as $testmionial) { ?>
                    <div>
                    <div class="d-flex align-items-center">
                        <div class="testimonial mb-3">
                            <p class="testimonial-quote mb-2">
                                <?php echo $testmionial['quote']; ?>
                            </p>
                            <span class="m-0 testimonial-author">- <?php echo $testmionial['name']; ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- <div class="col-sm-4">
                    <div class="testimonial mb-3">
                        <p class="testimonial-quote mb-2">
                            Lorum ipsum Lorum ipsum Lorum ipsum
                        </p>
                        <span class="m-0 testimonial-author">- Margret Lowe</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="testimonial mb-3">
                        <p class="testimonial-quote mb-2">
                            Lorum ipsum Lorum ipsum Lorum ipsum
                        </p>
                        <span class="m-0 testimonial-author">- Margret Lowe</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="testimonial mb-3">
                        <p class="testimonial-quote mb-2">
                            Lorum ipsum Lorum ipsum Lorum ipsum
                        </p>
                        <span class="m-0 testimonial-author">- Margret Lowe</span>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
