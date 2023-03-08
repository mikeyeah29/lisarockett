<?php

class RWD_Helpers
{
    static public function sanitize($data)
    {
        $type = gettype($data);

        switch ($type) {
            case 'string':
                $filter = FILTER_SANITIZE_STRING;
                break;
            case 'int':
                $filter = FILTER_SANITIZE_NUMBER_INT;
                break;

            case 'boolean':
                $filter = FILTER_SANITIZE_BOOLEAN;
                break;
            case 'email':
                $filter = FILTER_SANITIZE_EMAIL;
                break;
            default:
                return false;
        }
        $data = filter_var($data, $filter);
        $data = htmlspecialchars($data);
        return $data;
    }

    static public function getPost()
    {
        $sanitizedData = [];

        foreach ($_POST as $key => $value) {
            $sanitizedData[$key] = Self::sanitize($value);
        }

        return $sanitizedData;
    }

    static public function dd($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        die();
    }
}

?>
