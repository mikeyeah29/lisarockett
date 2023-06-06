<div class="rwd-admin">

    <?php include('inc/_header.php'); ?>
    <?php include('inc/_notice.php'); ?>

    <div class="rwd-body">

        <form action="" method="POST" id="form-save" class="rwd-form lr-rwd-form">
            <input type="hidden" name="lr_options" value="yes" />

            <div style="display: flex;">
                <div>
                    <h2>Session & Bank Details</h2>

                    <div class="rwd-form-box">

                        <div class="rwd-form-group">
                            <label>Name on Bank Account</label>
                            <input type="text" value="<?php echo $options['BANK_DETAILS_NAME']; ?>" name="lr-bank-name" />
                        </div>

                        <div class="rwd-form-group">
                            <label>Sort Code</label>
                            <input type="text" value="<?php echo $options['BANK_DETAILS_SORT']; ?>" name="lr-bank-sort" />
                        </div>

                        <div class="rwd-form-group">
                            <label>Account Number</label>
                            <input type="text" value="<?php echo $options['BANK_DETAILS_ACCOUNT']; ?>" name="lr-bank-account" />
                        </div>

                        <div class="rwd-form-group">
                            <label>PayPal Email</label>
                            <input type="text" value="<?php echo $options['PAYPAL_EMAIL']; ?>" name="lr-paypal-email" />
                        </div>

                        <div class="rwd-form-group">
                            <label>Session Length</label>
                            <input type="text" value="<?php echo $options['SESSION_LENGTH']; ?>" name="lr-session-length" />
                        </div>

                    </div>
                </div>

                <div style="margin-left: 40px;">
                    <h2>Contact Details</h2>

                    <div class="rwd-form-box">

                        <div class="rwd-form-group">
                            <label>Main email</label>
                            <input type="text" value="<?php echo $options['ADMIN_EMAIL']; ?>" name="lr-email" />
                        </div>

                        <div class="rwd-form-group">
                            <label>Phone</label>
                            <input type="text" value="<?php echo $options['PHONE']; ?>" name="lr-phone" />
                        </div>

                    </div>
                </div>

            </div>

            <button class="rwd-btn">Save</button>
        </form>

    </div>

</div>
