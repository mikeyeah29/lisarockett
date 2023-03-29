<?php

class RWD_Event
{
    static private $table_name = 'rwd_calender_events';

    static private function addOneHourToTime($time)
    {
        // create a DateTime object with the initial time
        $datetime = new DateTime($time);

        // create a DateInterval object representing one hour
        $interval = new DateInterval('PT1H');

        // add the interval to the DateTime object
        $datetime->add($interval);

        // format the result as a string in the same format as the input time
        return $datetime->format('H:i:s');
    }

    static private function formatDate($date_str, $format = 'd/m/y')
    {
        $date_timestamp = strtotime($date_str);
        return date($format, $date_timestamp);
    }

    static public function create($data)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);

        $date = $data['date'];
        $timeFrom = $data['date_from'];

        if(isset($data['date_to'])) {
            $timeTo = $data['date_to'];
        }else{
            $timeTo = Self::addOneHourToTime($data['date_from']);
        }

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

    static public function findById($id)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);
        $res = $dbModel->read('id = ' . $id);

        if(sizeOf($res) > 0) {
            return $res[0];
        }

        return null;
    }

    static public function findByWeek($dateInView)
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);
        $oneWeekLater = date('Y-m-d', strtotime($dateInView . ' +7 days'));

        return $dbModel->read("date_from BETWEEN '" . $dateInView . " 00:00:00' AND '" . $oneWeekLater . " 00:00:00'");
    }

    static public function findFutureBookings()
    {
        $dbModel = new RWDCalenderDbModel(Self::$table_name);

        $where = "date_from > '" . date("Y-m-d h:m:s") . "' AND type != 'available' ORDER BY date_from";

        $bookings = $dbModel->read($where);

        foreach ($bookings as $index => $b) {
            $bookings[$index]->date = Self::formatDate($b->date_from);
            $bookings[$index]->time_from = Self::formatDate($b->date_from, 'H:i');
            $bookings[$index]->time_to = Self::formatDate($b->date_to, 'H:i');
        }

        return $bookings;
    }

    static public function approve($id)
    {

    }
}
