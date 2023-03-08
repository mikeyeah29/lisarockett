<div id="lr-add-event" class="modal-dialog">
    <div class="modal-content">

        <div class="modal-close"><?php echo esc_html__('Close', 'text-domain'); ?></div>

        <h2><?php echo esc_html__('Add Calendar Event', 'text-domain'); ?></h2>

        <form class="rwd-form" action="" method="POST">
            <input type="hidden" value="yes" name="action-add-event" />
            <div class="rwd-form-group">
                <label for="rwd-type">Event Type</label>
                <select name="rwd-type" id="rwd-event-type">
                    <option value="available">Available Time Slot</option>
                    <option value="booked">Booking</option>
                </select>
            </div>
            <div class="rwd-form-group">
                <label for="the-date">Date:</label>
                <input type="date" name="the-date" id="the-date" class="input-required" value="<?php echo date("Y-m-d"); ?>" />
                <span class="error"></span>
            </div>
            <div class="rwd-form-group">
                <label for="start-time">Start Time:</label>
                <input type="time" name="start-time" id="start-time" class="input-required" />
                <span class="error"></span>
            </div>
            <div class="rwd-form-group">
                <label for="end-time">End Time:</label>
                <input type="time" name="end-time" id="end-time" class="input-required" />
                <span class="error"></span>
            </div>

            <div class="rwd-form-extra">
                <div class="rwd-form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" name="first-name" id="first-name" />
                </div>
                <div class="rwd-form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" name="last-name" id="first-name" />
                </div>
                <div class="rwd-form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" />
                </div>
                <div class="rwd-form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" />
                </div>
            </div>

            <input type="submit" value="Submit" id="add-event-submit" />
        </form>

    </div>
</div>
