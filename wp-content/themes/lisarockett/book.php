<?php
/* Template Name: Book */

$dateInView = null;
if(isset($_GET['date'])) {
    $dateInView = $_GET['date'];
}

$cal = new Calender($dateInView);
$cal->setHoursToDisplay(9, 20);

?>
<?php get_header(); ?>

<section>

    <div class="hero hero--sm d-flex justify-content-center flex-column">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-text d-flex flex-column justify-content-center">
                        <h1>Book</h1>
                        <p>Click on an available slot below</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lr-calender">
        <div class="lr-calender__header d-flex align-items-center justify-content-between">
            <a class="lr-calender__btn" href="?date=<?php echo $cal->prevWeek(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/previous.png" />
            </a>
            <p class="text-md m-0"><?php echo $cal->getMonthLabel() . " " . $cal->getYear(); ?></p>
            <a class="lr-calender__btn" href="?date=<?php echo $cal->nextWeek(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/next.png" />
            </a>
        </div>
        <div class="lr-calender__body">
            <div class="lr-calender-table">
                <div class="lr-calender-days">

                    <?php foreach($cal->getDayLabels() as $label) { ?>
                        <div class="lr-calender-day"><?php echo $label; ?></div>
                    <?php } ?>

                </div>

                <?php for($i=0;$i<7;$i++) { ?>

                    <div class="lr-calender-row">
                        <?php foreach($cal->getHours() as $index => $hour) { ?>
                            <div class="lr-calender-hour <?php echo $index === 3 ? 'is-unavailable' : '' ?>">
                                <div class="lr-calender-hour__inner">
                                    <div class="lr-calender-hour__time">
                                        <?php echo $hour; ?>
                                    </div>
                                    <div class="lr-calender-hour__status">
                                        Available
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>

</section>


<?php get_footer(); ?>
