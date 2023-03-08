<?php

// class Calender
// {
//     private $dayLabels = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
//     private $startFromHour = 9;
//     private $endToHour = 20;
//     public $dateInView = 0;
//
//     private function getWeekStart()
//     {
//         return date("Y-m-d", strtotime($this->dateInView . " -1 monday"));
//     }
//
//     public function prevWeek()
//     {
//         return date("Y-m-d", strtotime($this->dateInView . " -1 week"));
//     }
//
//     public function nextWeek()
//     {
//         return date("Y-m-d", strtotime($this->dateInView . " +1 week"));
//     }
//
//     public function getMonthLabel()
//     {
//         $mon = date("M", strtotime($this->dateInView . " -1 monday"));
//         $fri = date("M", strtotime($this->dateInView . " +1 friday"));
//         $months = $mon;
//         if($mon !== $fri) {
//             $months = $mon . '/' . $fri;
//         }
//         return $months;
//     }
//
//     public function getYear()
//     {
//         return date("Y", strtotime($this->dateInView));
//     }
//
//     public function getDayLabels()
//     {
//         $start = $this->getWeekStart();
//
//         $labels = [];
//         foreach ($this->dayLabels as $index => $label) {
//             $labels[] = $label . ' ' . date("d", strtotime($start . " +" . $index . " days"));
//         }
//
//         return $labels;
//     }
//
//     public function getHours()
//     {
//         $hours = [];
//         for($i=$this->startFromHour; $i<=$this->endToHour; $i++) {
//             $hours[] = $i . ':00';
//         }
//         return $hours;
//     }
//
//     public function setHoursToDisplay($from, $to)
//     {
//         $this->startFromHour = $from;
//         $this->endToHour = $to;
//     }
//
//     public function __construct($dateInView = null)
//     {
//         if(!$dateInView) {
//             // defaults to today
//             $this->dateInView = date("Y-m-d h:m:s");
//         }else{
//             $this->dateInView = $dateInView;
//         }
//     }
// }

function dd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}

?>
