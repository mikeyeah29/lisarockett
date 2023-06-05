<?php

class RWDCalenderMail
{
    static private function debug_wpmail() {

		global $ts_mail_errors, $phpmailer;

		if ( ! isset($ts_mail_errors) )
			$ts_mail_errors = array();

		if ( isset($phpmailer) )
			$ts_mail_errors[] = $phpmailer->ErrorInfo;

		print_r('<pre>');
		print_r($ts_mail_errors);
		print_r('</pre>');
	}

    static public function send($to, $subject, $templateName, $placeholders = [])
    {
        $html_template = plugin_dir_path( __FILE__ ) . '../admin/views/emails/' . $templateName . '.html';
        $message = file_get_contents($html_template);

        // Replace placeholders in the template with actual values
        $message = strtr($message, $placeholders);

        $headers = array(
            'Content-Type: text/html; charset=UTF-8'
            // 'From: Your Hotel <booking@yourhotel.com>',
            // 'Reply-To: Your Hotel <booking@yourhotel.com>',
            // 'X-Mailer: PHP/' . phpversion()
        );

        $res = wp_mail($to, $subject, $message, $headers);

        if (!$res) {
            // Error sending email

            Self::debug_wpmail();

            $error_message = 'Failed to send email to ' . $to;
            trigger_error($error_message, E_USER_ERROR);
        }

        dd($message);

    }
}

?>
