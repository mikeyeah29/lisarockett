<?php

class SWPFD_SaveData
{
    public static function saveMail($to, $subject, $msg)
    {
        $dbs = new SWPFD_Database();
        $dbs->saveData($to, $subject, $msg);
    }
}

?>
