<?php

    $thumbnail = get_the_post_thumbnail_url();

    $heroBg = "linear-gradient(to right, rgb(81 24 90), rgb(229 208 255))";

    if($thumbnail) {
        $heroBg = "linear-gradient(to top, rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('";
        $heroBg .= $thumbnail;
        $heroBg .= "') no-repeat center center";
    }

?>

<div class="hero d-flex justify-content-center flex-column"
     style="background: <?php echo $heroBg; ?>;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-text d-flex flex-column justify-content-center">
                    <h1><?php the_title(); ?></h1>
                    <?php the_field('hero_content'); ?>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">

                <?php if(is_front_page()) { ?>
                    <div class="contact-btn contact-btn--center-self">
                        <a href="<?php echo home_url(); ?>/contact">Book Session</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
