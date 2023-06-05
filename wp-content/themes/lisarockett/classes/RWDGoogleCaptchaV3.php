<?php

class RWDGoogleCaptchaV3
{
    static public function validate($recaptchaResponse) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => GOOGLE_CAPTCHA_SECRET_KEY,
            'response' => $recaptchaResponse
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseData = json_decode($response, true);

        return $responseData['success'] ?? false;
    }
}

?>
