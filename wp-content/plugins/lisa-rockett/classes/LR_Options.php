<?php

class LR_Options
{
    public static function get($option_name = false)
    {
        $options = get_option('lr_options', [
            'ADMIN_EMAIL' => '',
            'PHONE' => 'PHONE',
            'BANK_DETAILS_NAME' => '',
            'BANK_DETAILS_SORT' => '',
            'BANK_DETAILS_ACCOUNT' => '',
            'PAYPAL_EMAIL' => '',
            'SESSION_LENGTH' => '1 Hour'
        ]);

        if($option_name) {
            return (isset($options[$option_name]) ? $options[$option_name] : '');
        }

        // no option set so return all options
        return $options;
    }

    public static function update()
    {
        update_option('lr_options', [
            'ADMIN_EMAIL' => ( isset($_POST['lr-email']) ? $_POST['lr-email'] : '' ),
            'PHONE' => ( isset($_POST['lr-phone']) ? $_POST['lr-phone'] : '' ),
            'BANK_DETAILS_NAME' => ( isset($_POST['lr-bank-name']) ? $_POST['lr-bank-name'] : '' ),
            'BANK_DETAILS_SORT' => ( isset($_POST['lr-bank-sort']) ? $_POST['lr-bank-sort'] : '' ),
            'BANK_DETAILS_ACCOUNT' => ( isset($_POST['lr-bank-account']) ? $_POST['lr-bank-account'] : '' ),
            'PAYPAL_EMAIL' => ( isset($_POST['lr-phone']) ? $_POST['lr-paypal-email'] : '' ),
            'SESSION_LENGTH' => ( isset($_POST['lr-phone']) ? $_POST['lr-session-length'] : '' )
        ]);
    }
}

?>
