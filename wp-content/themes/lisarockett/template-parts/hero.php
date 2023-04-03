<div class="hero d-flex justify-content-center flex-column">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-text d-flex flex-column justify-content-center">
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">

                <?php the_content(); ?>

                <?php if(is_front_page()) { ?>
                    <div class="contact-btn">
                        <a href="<?php echo home_url(); ?>/book">Book Session</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
