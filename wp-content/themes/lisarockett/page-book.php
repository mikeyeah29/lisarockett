<?php
/* Template Name: Book */

$dateInView = null;
if(isset($_GET['date'])) {
    $dateInView = $_GET['date'];
}

$cal = new RWDCalender($dateInView);
$hours = $cal->getHours();

if(isset($_POST['make_booking'])) {

    // RWD_Helpers::dd($_POST);

    // Create event with type pending and all the details

    $data = RWD_Helpers::getPost();

    $eventObj = [
        'type' => 'pending',
        'date' => $data['q_date'],
        'date_from' => $data['q_time'],
        'first_name' => $data['q_first_name'],
        'last_name' => $data['q_last_name'],
        'email' => $data['q_email'],
        'phone' => $data['q_phone']
    ];

    RWD_Event::create($eventObj);

    try {

        // Call the function you want to execute within the try block
        RWDCalenderMail::send('mikerockett@live.com', 'Booking Request', 'booking_request', [
            '{{name}}' => $data['q_first_name'] . ' ' . $data['q_last_name'],
            '{{date}}' => $data['q_date'],
            '{{time}}' => $data['q_time'],
            '{{email}}' => $data['q_email'],
            '{{phone}}' => $data['q_phone']
        ]);

    } catch (Exception $e) {
        // Handle any exceptions that may have been thrown
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        die();
    }

    wp_redirect( home_url( '/thankyou' ) );

}

?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section id="page-booking">

    <div class="hero-2 hero-2--sm">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-text">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="rwd-b-calendar">

            <p class="rwd-b-month-heading"><?php echo $cal->getMonthLabel(); ?> <?php echo $cal->getYear(); ?></p>

            <div class="rwd-b-calendar__header">

                <div class="rwd-b-nav rwd-b-nav-left">
                    <a href="?page=rwd-booking-calender-view&date=<?php echo $cal->prevWeek(); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/img/previous.png" />
                    </a>
                </div>
                <div class="rwd-b-days">
                    <?php foreach($cal->getDayLabels() as $label) { ?>
                        <div class="rwd-b-day"><?php echo $label; ?></div>
                    <?php } ?>
                </div>
                <div class="rwd-b-nav rwd-b-nav-right">
                    <a href="?page=rwd-booking-calender-view&date=<?php echo $cal->nextWeek(); ?>">
                        <img src="<?php bloginfo('template_url'); ?>/img/next.png" />
                    </a>
                </div>
            </div>

            <div class="rwd-b-calendar__body">

                <div class="rwd-b-hour-labels">
                    <?php foreach ($hours as $hour) { ?>
                        <div class="rwd-b-hour">
                            <p><?php echo $hour; ?></p>
                        </div>
                    <?php } ?>
                </div>

                <div class="rwd-b-day-cols">

                    <?php // $calEvents->render(); ?>

                    <?php foreach ($cal->events as $e) { ?>

                        <?php if($e->type === 'available') { ?>

                            <div class="rwd-b-event"
                                 style="<?php echo $e->getPositionStyle(); ?>"
                                 data-json="<?php echo $e->getJson(); ?>"
                                 data-bs-toggle="modal" data-bs-target="#bookModal">
                                <p>Available between <?php echo $e->fromFormatted(); ?> to <?php echo $e->toFormatted(); ?></p>
                            </div>

                        <!-- <?php //}else{ ?>

                            <div class="rwd-b-event rwd-b-event--booking" style="<?php //echo $e->getPositionStyle(); ?>" data-json="<?php // echo $e->getJson(); ?>">
                                <p>Booked</p>
                                <p><?php //echo $e->fromFormatted(); ?> to <?php //echo $e->toFormatted(); ?></p>
                            </div> -->

                        <?php } ?>

                    <?php } ?>

                    <?php for ($i=0; $i < 7; $i++) { ?>

                        <div class="rwd-b-day">
                            <?php foreach ($hours as $hour) { ?>
                                <div class="rwd-b-cell"></div>
                            <?php } ?>
                        </div>

                    <?php } ?>



                </div>

            </div>

        </div>
    </div>

    <!-- <div class="lr-calender">
        <div class="lr-calender__header d-flex align-items-center justify-content-between">
            <a class="lr-calender__btn" href="?date=<?php// echo $cal->prevWeek(); ?>">
                <img src="<?php //bloginfo('template_url'); ?>/img/previous.png" />
            </a>
            <p class="text-md m-0"><?php //echo $cal->getMonthLabel() . " " . $cal->getYear(); ?></p>
            <a class="lr-calender__btn" href="?date=<?php //echo $cal->nextWeek(); ?>">
                <img src="<?php// bloginfo('template_url'); ?>/img/next.png" />
            </a>
        </div>
        <div class="lr-calender__body">
            <div class="lr-calender-table">
                <div class="lr-calender-days">

                    <?php //foreach($cal->getDayLabels() as $label) { ?>
                        <div class="lr-calender-day"><?php //echo $label; ?></div>
                    <?php //} ?>

                </div>

                <?php //for($i=0;$i<7;$i++) { ?>

                    <div class="lr-calender-row">
                        <?php //foreach($cal->getHours() as $index => $hour) { ?>
                            <div class="lr-calender-hour <?php //echo $index === 3 ? 'is-unavailable' : '' ?>">
                                <div class="lr-calender-hour__inner">
                                    <div class="lr-calender-hour__time">
                                        <?php //echo $hour; ?>
                                    </div>
                                    <div class="lr-calender-hour__status">
                                        Available
                                    </div>
                                </div>
                            </div>
                        <?php //} ?>
                    </div>

                <?php// } ?>
            </div>
        </div>
    </div> -->

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal">
      Launch demo modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <p class="modal-title fs-5" id="exampleModalLabel">Make a Booking</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

              <form action="" method="POST">

                  <input type="hidden" name="make_booking" />

                  <div class="row">
                      <div class="col-sm-6 mb-3">
                          <!-- Date -->
                          <label>Date <span class="txt-danger">*</span></label>
                          <input type="date" class="form-control data--date" name="q_date" required="required" />
                      </div>
                      <div class="col-sm-6 mb-3">
                          <!-- Time ( will be one hour lone ) -->
                          <label>Time <span class="txt-danger">*</span></label>
                          <input type="time" class="form-control data--time" name="q_time" required="required" />
                      </div>
                      <div class="col-sm-6 mb-3">
                          <!-- First Name -->
                          <label>First Name <span class="txt-danger">*</span></label>
                          <input type="text" class="form-control data--first-name" name="q_first_name" required="required" />
                      </div>
                      <div class="col-sm-6 mb-3">
                          <!-- Last Name -->
                          <label>Last Name <span class="txt-danger">*</span></label>
                          <input type="text" class="form-control data--last-name" name="q_last_name" required="required" />
                      </div>
                      <div class="col-sm-6 mb-3">
                          <!-- First Name -->
                          <label>Email <span class="txt-danger">*</span></label>
                          <input type="email" class="form-control data--email" name="q_email" required="required" />
                      </div>
                      <div class="col-sm-6 mb-3">
                          <!-- Last Name -->
                          <label>Phone Number</label>
                          <input type="text" class="form-control data--phone" name="q_phone" />
                      </div>
                  </div>

                  <div class="rwd-modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

              </form>

          </div>
        </div>
      </div>
    </div>

</section>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
