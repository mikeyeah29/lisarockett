<div class="rwd-admin">

    <?php include('inc/_header.php'); ?>
    <?php include('inc/_notice.php'); ?>

    <div class="rwd-body">

        <h2>Contact Details</h2>

        <form action="" method="POST" id="form-save" class="rwd-form">
            <input type="hidden" name="lr_options" value="yes" />

            <div class="rwd-form-group">
                <label>Main email</label>
                <input type="text" value="<?php echo $options['ADMIN_EMAIL']; ?>" name="lr-email" />
            </div>

            <div class="rwd-form-group">
                <label>Phone</label>
                <input type="text" value="<?php echo $options['PHONE']; ?>" name="lr-phone" />
            </div>

            <button class="rwd-btn">Save</button>
        </form>

    </div>

</div>
