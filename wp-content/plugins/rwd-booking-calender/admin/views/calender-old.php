<div class="wrap">

    <div class="rwd-booking">

        <h1>Booking Calender</h1>

        <?php include('inc/_header.php'); ?>

        <div class="rwd-booking-body">

            <?php include('inc/_notice.php'); ?>

            <div class="rwd-booking-setting">

                <h2>Available Days / Times</h2>
                <p class="rwd-booking-setting__info">
                    These are the days and times that will display on the calender as available to book, unless there are bookings already made for a particular date
                </p>

                <?php

                    $cal = new RWDCalender();

                ?>

                <div class="lr-calender">
                    <div class="lr-calender__body">
                        <div class="lr-calender-days">

                            <div class="lr-calender-time-col"></div>

                            <div class="lr-calender-day">Mondays</div>
                            <div class="lr-calender-day">Tuesdays</div>
                            <div class="lr-calender-day">Wednesdays</div>
                            <div class="lr-calender-day">Thursdays</div>
                            <div class="lr-calender-day">Fridays</div>
                            <div class="lr-calender-day">Saturdays</div>
                            <div class="lr-calender-day">Sundays</div>

                        </div>

                        <div class="lr-calender-grid">

                            <div class="lr-calender-row">
                                <?php foreach($cal->getHours() as $index => $hour) { ?>
                                    <div class="lr-calender-hour bg-transparent">
                                        <div class="lr-calender-hour__inner">
                                            <div class="lr-calender-hour__time">
                                                <?php echo $hour; ?>
                                            </div>
                                            <div class="lr-calender-hour__status">
                                                <!-- Available -->
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                            <?php for($i=0;$i<7;$i++) { ?>

                                <div class="lr-calender-row">
                                    <?php foreach($cal->getHours() as $index => $hour) { ?>
                                        <div class="lr-calender-hour">
                                            <div class="lr-calender-hour__inner">
                                                <!-- <div class="lr-calender-hour__time">
                                                    <?php // echo $hour; ?>
                                                </div>
                                                <div class="lr-calender-hour__status">

                                                </div> -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            <?php } ?>

                            <?php

                                $available = [
                                    array(
                                        'day' => 'Monday',
                                        'start_hour' => 13,
                                        'start_mins' => 20,
                                        'end_hour' => 15,
                                        'end_mins' => 35,
                                    )
                                ];

                                $rwdEvents = new RWDEvents($available);

                                $rwdEvents->render();

                            ?>

                        </div>

                    </div>
                </div>


                <div id="opening-times" class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-close"><?php echo esc_html__('Close', 'text-domain'); ?></div>

                        <h2><?php echo esc_html__('Add Opening Time', 'text-domain'); ?></h2>

                        <form action="" method="POST">
                            <input type="hidden" value="yes" name="action-add-opening-time" />
                            <div>
                                <label for="rwd-day">Day:</label>
                                <select name="rwd-day" id="rwd-day">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div>
                                <label for="start-time">Start Time:</label>
                                <input type="time" name="start-time" id="start-time" />
                            </div>
                            <div>
                                <label for="end-time">End Time:</label>
                                <input type="time" name="end-time" id="end-time" />
                            </div>
                            <input type="submit" value="Submit" />
                        </form>

                    </div>
                </div>



                <!-- <div class="rwd-booking-btn">Add</div>

                <div class="rwd-booking-avail-list">
                    <div class="rwd-booking-avail-item">
                        <span>Mondays 7am - 11am</span>
                        <span class="rwd-booking-avail-actions">
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/edit.svg'; ?>" class="rwd-booking-edit" />
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/delete.svg'; ?>" class="rwd-booking-remove" />
                        </span>
                    </div>
                    <div class="rwd-booking-avail-item">
                        <span>Mondays 7am - 11am</span>
                        <span class="rwd-booking-avail-actions">
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/edit.svg'; ?>" class="rwd-booking-edit" />
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/delete.svg'; ?>" class="rwd-booking-remove" />
                        </span>
                    </div>
                    <div class="rwd-booking-avail-item">
                        <span>Mondays 7am - 11am</span>
                        <span class="rwd-booking-avail-actions">
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/edit.svg'; ?>" class="rwd-booking-edit" />
                            <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/delete.svg'; ?>" class="rwd-booking-remove" />
                        </span>
                    </div>
                </div> -->

            </div>

        </div>

    </div>

</div>
