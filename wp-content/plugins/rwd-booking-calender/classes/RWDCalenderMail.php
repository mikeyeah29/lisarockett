<?php

class RWDCalenderMail
{
    static public function send($to, $subject, $templateName, $placeholders = [])
    {
        $html_template = plugin_dir_path( __FILE__ ) . '../admin/views/emails/' . $templateName . '.html';
        $message = file_get_contents($html_template);

        // Replace placeholders in the template with actual values
        $message = strtr($message, $placeholders);

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: Your Hotel <booking@yourhotel.com>',
            'Reply-To: Your Hotel <booking@yourhotel.com>',
            'X-Mailer: PHP/' . phpversion()
        );

        // dd($message);

        // Send the email and handle errors
        if (!wp_mail($to, $subject, $message, $headers)) {
            // Error sending email
            $error_message = 'Failed to send email to ' . $to;
            trigger_error($error_message, E_USER_ERROR);
        }

        return true;
    }
}

?>
