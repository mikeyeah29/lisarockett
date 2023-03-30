<?php

class LR_Options
{
    public static function get($option_name = false)
    {
        $options = get_option('lr_options', [
            'ADMIN_EMAIL' => '',
            'PHONE' => 'PHONE'
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
            'PHONE' => ( isset($_POST['lr-phone']) ? $_POST['lr-phone'] : '' )
        ]);
    }
}

?>
