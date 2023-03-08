<?php

class LR_Options
{
    public static function get($option_name = false)
    {
        $options = get_option('lr_options', [
            'PHONE_UK' => '',
            'PHONE_INTERNATIONAL' => '',
            'EMAIL' => '',
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
            'PHONE_UK' => ( isset($_POST['wa-phone-uk']) ? $_POST['wa-phone-uk'] : '' ),
            'PHONE_INTERNATIONAL' => ( isset($_POST['wa-phone-international']) ? $_POST['wa-phone-international'] : '' ),
            'EMAIL' => ( isset($_POST['wa-email']) ? $_POST['wa-email'] : '' )
        ]);
    }
}

?>
