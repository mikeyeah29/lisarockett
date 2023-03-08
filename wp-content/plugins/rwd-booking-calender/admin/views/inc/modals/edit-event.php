<div id="lr-edit-event" class="modal-dialog">
    <div class="modal-content">

        <div class="modal-close"><?php echo esc_html__('Close', 'text-domain'); ?></div>

        <h2 class="data-edit-event--h2">Edit</h2>

        <div>
            <!-- <div style="font-size: 14px; padding: 6px 12px; border-radius: 6px; margin-bottom: 15px;" class="rwd-btn rwd-btn--danger">Delete Event</div> -->

            <form action="" method="POST" onsubmit="return confirm('Are you sure?');">
                <input type="hidden" name="delete-event-id" class="data-edit-event--id">
                <input style="font-size: 14px; padding: 6px 12px; border-radius: 6px; margin-bottom: 15px;" class="rwd-btn rwd-btn--danger" type="submit" value="Delete">
            </form>

        </div>

        <form class="rwd-form" action="" method="POST">
            <input type="hidden" value="yes" name="action-edit-event" />
            <input type="hidden" class="data-edit-event--id" name="event-id" />
            <input type="hidden" class="data-edit-event--type" name="event-type" />

            <div class="rwd-form-group">
                <label for="the-date">Date:</label>
                <input class="data-edit-event--date input-required" type="date" name="the-date" id="the-date" value="<?php echo date("Y-m-d"); ?>" />
                <span class="error"></span>
            </div>
            <div class="rwd-form-group">
                <label for="edit-start-time">Start Time:</label>
                <input class="data-edit-event--start-time input-required" type="time" name="start-time" id="edit-start-time" />
                <span class="error"></span>
            </div>
            <div class="rwd-form-group">
                <label for="edit-end-time">End Time:</label>
                <input class="data-edit-event--end-time input-required" type="time" name="end-time" id="edit-end-time" />
                <span class="error"></span>
            </div>

            <div class="rwd-form-extra">
                <div class="rwd-form-group">
                    <label for="edit-first-name">First Name</label>
                    <input type="text" class="data-edit-event--first-name" name="first-name" id="edit-first-name" />
                </div>
                <div class="rwd-form-group">
                    <label for="edit-last-name">Last Name</label>
                    <input type="text" class="data-edit-event--last-name" name="last-name" id="edit-last-name" />
                </div>
                <div class="rwd-form-group">
                    <label for="edit-email">Email</label>
                    <input type="text" class="data-edit-event--email" name="email" id="edit-email" />
                </div>
                <div class="rwd-form-group">
                    <label for="edit-phone">Phone</label>
                    <input type="text" class="data-edit-event--phone" name="phone" id="edit-phone" />
                </div>
            </div>

            <input type="submit" value="Update" id="edit-event-submit" />
        </form>

    </div>
</div>
