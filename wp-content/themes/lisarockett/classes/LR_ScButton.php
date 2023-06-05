<?php

class LR_ScButton
{
    public function shortcode($atts)
    {
        $attributes = shortcode_atts(array(
            'text' => 'Contact', // Default value for the 'text' attribute
            'url' => '' // Default value for the 'url' attribute
        ), $atts);

        $html = '';

        $html .= '<div class="contact-btn">';
            $html .= '<a href="http://dev.lisarockett-wp.com/contact">Contact</a>';
        $html .= '</div>';

        return $html;
    }

    public function __construct()
    {
        add_shortcode('lr_button', array($this, 'shortcode'));
    }
}

?>
