<?php

class LR_Helpers
{
    static function sanitize($data)
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
}

?>
