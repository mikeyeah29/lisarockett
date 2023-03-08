<div class="wrap">

    <div class="rwd-booking">

        <h1>Booking Calender</h1>

        <?php include('inc/_header.php'); ?>

        <div class="rwd-booking-body">

            <?php include('inc/_notice.php'); ?>

            <div class="rwd-booking-setting">

                <div class="rwd-d-flex">
                    <h2>Availability</h2>
                    <div class="rwd-btn lr-trigger--add-event">Add Event +</div>
                </div>
                <!-- <p class="rwd-booking-setting__info">
                    These are the days and times that will display on the calender as available to book, unless there are bookings already made for a particular date
                </p> -->

                <?php

                    $cal = new RWDCalender($vars['dateInView']);
                    $hours = $cal->getHours();

                    // RWD_Helpers::dd($vars['events']);

                    $calEvents = new RWDEvents($vars['events']);

                ?>

            </div>

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

                        <?php foreach ($calEvents->events as $e) { ?>

                            <?php if($e->type === 'available') { ?>

                                <div class="rwd-b-event" style="<?php echo $e->getPositionStyle(); ?>" data-json="<?php echo $e->getJson(); ?>">
                                    <p>Available between <?php echo $e->fromFormatted(); ?> to <?php echo $e->toFormatted(); ?></p>
                                </div>

                            <?php }else{ ?>

                                <div class="rwd-b-event rwd-b-event--booking" style="<?php echo $e->getPositionStyle(); ?>" data-json="<?php echo $e->getJson(); ?>">
                                    <p><?php echo $e->first_name . ' ' . $e->last_name; ?></p>
                                    <p><?php echo $e->fromFormatted(); ?> to <?php echo $e->toFormatted(); ?></p>
                                </div>

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

    </div>

    <?php include('inc/modals/add-event.php'); ?>
    <?php include('inc/modals/edit-event.php'); ?>

</div>
