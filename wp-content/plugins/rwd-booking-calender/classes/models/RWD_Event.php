<?php

class RWD_Event
{
    static private $table_name = 'rwd_calender_events';

    static public function create($data)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);

        $date = $data['date'];
        $timeFrom = $data['date_from'];
        $timeTo = $data['date_to'];

        $dateFrom = date('Y-m-d H:i:s', strtotime("$date $timeFrom"));
        $dateTo = date('Y-m-d H:i:s', strtotime("$date $timeTo"));

        // echo 'TYPE';
        // RWD_Helpers::dd($data['type']);

        return $dbModel->create([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'type' => ( isset($data['type']) ? $data['type'] : null ),
            'first_name' => ( isset($data['first_name']) ? $data['first_name'] : null ),
            'last_name' => ( isset($data['last_name']) ? $data['last_name'] : null ),
            'email' => ( isset($data['email']) ? $data['email'] : null ),
            'phone' => ( isset($data['phone']) ? $data['phone'] : null ),
            'description' => ( isset($data['description']) ? $data['description'] : null )
        ]);
    }

    static public function update($data, $id)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);

        $date = $data['date'];
        $timeFrom = $data['date_from'];
        $timeTo = $data['date_to'];

        $dateFrom = date('Y-m-d H:i:s', strtotime("$date $timeFrom"));
        $dateTo = date('Y-m-d H:i:s', strtotime("$date $timeTo"));

        return $dbModel->update([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'type' => ( isset($data['type']) ? $data['type'] : null ),
            'first_name' => ( isset($data['first_name']) ? $data['first_name'] : null ),
            'last_name' => ( isset($data['last_name']) ? $data['last_name'] : null ),
            'email' => ( isset($data['email']) ? $data['email'] : null ),
            'phone' => ( isset($data['phone']) ? $data['phone'] : null ),
            'description' => ( isset($data['description']) ? $data['description'] : null )
        ], array(
            'id' => $id
        ));
    }

    static public function delete($id)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);
        return $dbModel->delete(['id' => $id]);
    }

    static public function findByWeek($dateInView)
    {
        // if(!$dateInView) {
        //     $dateInView = date("Y-m-d");
        // }

        $dbModel = new RWDCalenderDbModel(Self::$table_name);
        $oneWeekLater = date('Y-m-d', strtotime($dateInView . ' +7 days'));

        // dd($dateInView);

        return $dbModel->read("date_from BETWEEN '" . $dateInView . " 00:00:00' AND '" . $oneWeekLater . " 00:00:00'");
    }
}
