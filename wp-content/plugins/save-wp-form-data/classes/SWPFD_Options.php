<?php

class SWPFD_Options
{
    public static function get($option_name = false)
    {
        $options = get_option('swpfd_options', [
            'DATA_SAVING_ON' => ''
        ]);

        if($option_name) {
            return (isset($options[$option_name]) ? $options[$option_name] : '');
        }

        // no option set so return all options
        return $options;
    }

    public static function update()
    {
        update_option('swpfd_options', [
            'DATA_SAVING_ON' => ( isset($_POST['swpfd_saving_on']) ? $_POST['swpfd_saving_on'] : '' )
        ]);
    }
}

?>
