<?php

class RWD_EventItem
{
    public $data;
    public $fromDateTime;
    public $toDateTime;
    public $type;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $details;

    // private $hourHeight = RWD_CAL_HOUR_HEIGHT;
    // private $dayWidth = RWD_CAL_DAY_WIDTH;
    // private $startFromHour = 8;

    private function getEventDate()
    {
        $str = $this->fromDateTime->year;
        $str .= '-' . $this->fromDateTime->month;
        $str .= '-' . $this->fromDateTime->day;

        // '2023-02-01'

        return $str;
    }

    private function getDateObj($dateTime)
    {
        $dateTimeParts = explode(" ", $dateTime);
        $dateParts = explode("-", $dateTimeParts[0]);
        $timeParts = explode(":", $dateTimeParts[1]);

        $obj = new stdClass();
        $obj->year = $dateParts[0];
        $obj->month = $dateParts[1];
        $obj->day = $dateParts[2];
        $obj->hour = $timeParts[0];
        $obj->mins = $timeParts[1];
        return $obj;
    }

    public function fromFormatted()
    {
        return $this->fromDateTime->hour . ':' . $this->fromDateTime->mins;
    }

    public function toFormatted()
    {
        return $this->toDateTime->hour . ':' . $this->toDateTime->mins;
    }

    private function getTop()
    {
        $oneMinAsPx = RWD_CAL_HOUR_HEIGHT / 60;
        $topHour = ($this->fromDateTime->hour - RWD_CAL_DISPLAY_START_HOUR) * RWD_CAL_HOUR_HEIGHT;

        $top = $topHour + ($this->fromDateTime->mins * $oneMinAsPx);
        return $top . 'px';
    }

    private function getLeft()
    {
        $timestamp = strtotime($this->data->date_from);
        $index = date('w', $timestamp);
        $index = ($index == 0 ? 7 : $index);

        return (($index - 1) * RWD_CAL_DAY_WIDTH) . '%';
    }

    private function getHeight()
    {
        // hours
        $lengthInMins = ($this->toDateTime->hour - $this->fromDateTime->hour) * 60;
        // take away the mins into the start of the hour
        $lengthInMins = $lengthInMins - $this->fromDateTime->mins;
        // add the mins after the hour
        $lengthInMins = $lengthInMins + $this->toDateTime->mins;

        $oneMinAsPx = RWD_CAL_HOUR_HEIGHT / 60;

        // dd($oneMinAsPx * $lengthInMins);

        return ($oneMinAsPx * $lengthInMins) . 'px';
    }

    public function getPositionStyle()
    {
        $top = $this->getTop();
        $left = $this->getLeft();
        $height = $this->getHeight();

        $style = "top: " . $top . ";";
        $style .= " left: " . $left . ";";
        $style .= " height: " . $height . ";";

        return $style;
    }

    public function getJson()
    {
        $obj = $this->data;
        $obj->date = $this->getEventDate();
        $obj->start_time = $this->fromDateTime->hour . ':' . $this->fromDateTime->mins;
        $obj->end_time = $this->toDateTime->hour . ':' . $this->toDateTime->mins;

        return htmlspecialchars(json_encode($obj), ENT_QUOTES, 'UTF-8');
    }

    public function __construct($event)
    {
        $fromDate = $this->getDateObj($event->date_from);
        $toDate = $this->getDateObj($event->date_to);

        $this->data = $event;
        $this->fromDateTime = $this->getDateObj($event->date_from);
        $this->toDateTime = $this->getDateObj($event->date_to);
        $this->type = $event->type;
        $this->first_name = $event->first_name;
        $this->last_name = $event->last_name;
        $this->email = $event->email;
        $this->phone = $event->phone;
        $this->details = $event->description;
    }
}

class RWDEvents
{
    public $events = [];

    private function sortBookings($bookings) {
        usort($bookings, function ($a, $b) {
            $a_start = strtotime($a->data->date_from);
            $b_start = strtotime($b->data->date_from);

            if ($a_start == $b_start) {
                return 0;
            }

            return ($a_start < $b_start) ? -1 : 1;
        });

        return $bookings;
    }

    private function bookingsForSlot($slot)
    {
        $bookingsFound = [];
        foreach ($this->events as $e) {
            if($e->type === 'booked') {

                $bookingStartTime = strtotime($e->data->date_from);
                $bookingEndTime = strtotime($e->data->date_to);
                $slotStartTime = strtotime($slot->data->date_from);
                $slotEndTime = strtotime($slot->data->date_to);

                if($bookingStartTime >= $slotStartTime && $bookingStartTime < $slotEndTime ) {
                    $bookingsFound[] = $e;
                }
            }
        }
        return $this->sortBookings($bookingsFound);
    }
    //
    // private function splitSlotByBookings($bookings, $slot)
    // {
    //     $slots = [];
    //
    //     $slotData = new stdClass();
    //     $slotData->id = $slot->data->id;
    //     $slotData->date_from = $slot->data->date_from;
    //     $slotData->date_to = $slot->data->date_to;
    //     $slotData->type = 'available';
    //
    //     foreach ($bookings as $booking) {
    //
    //     }
    //
    //     return $slots;
    // }

    private function createEventObj($from, $to, $slot_id)
    {
        $obj = new stdClass();
        $obj->id = $slot_id;
        $obj->date_from = date('Y-m-d H:i:s', $from);
        $obj->date_to = date('Y-m-d H:i:s', $to);
        $obj->type = 'available';
        $obj->first_name = '';
        $obj->last_name = '';
        $obj->email = '';
        $obj->phone = '';
        $obj->description = '';
        return $obj;
    }

    private function getSplitSlots($slot, $bookings)
    {
        $slots = [];
        $start = strtotime($slot->data->date_from);
        $end = strtotime($slot->data->date_to);
        $current = $start;
        $slot_id = $slot->data->id;

        foreach($bookings as $booking) {
            $booking_start = strtotime($booking->data->date_from);
            $booking_end = strtotime($booking->data->date_to);

            // 10.30 - 13.00

            // RWD_Helpers::dd(date('Y-m-d h:m:s', $current) . ' ' . $booking->data->date_from);
            // RWD_Helpers::dd(date('Y-m-d H:i:s', $current));
            // RWD_Helpers::dd($booking->data->date_from);

            if ($current < $booking_start) {
                $obj = $this->createEventObj($current, $booking_start, $slot_id);
                $slots[] = new RWD_EventItem($obj);
                // $slots[] = [
                //     'slot_id' => $slot_id,
                //     'from' => date('Y-m-d H:i:s', $current),
                //     'to' => date('Y-m-d H:i:s', $booking_start)
                // ];
            }

            // 10.30
            $current = $booking_end;
        }

        if ($current < $end) {

            $obj = $this->createEventObj($current, $end, $slot_id);
            $slots[] = new RWD_EventItem($obj);
        }

        // RWD_Helpers::dd($slots);

        // if (empty($slots)) {
        //     $slots[] = [
        //         'slot_id' => $slot_id,
        //         'from' => date('Y-m-d H:i:s', $start),
        //         'to' => date('Y-m-d H:i:s', $end)
        //     ];
        // }

        // RWD_Helpers::dd($slots);

        return $slots;
    }

    private function splitSlotsWithBookings()
    {
        $events = [];
        foreach ($this->events as $index => $e) {
            if($e->type === 'available') {

                $bookings = $this->bookingsForSlot($e);

                // RWD_Helpers::dd($bookings);

                if(!empty($bookings)) {

                    // there are one or more bookings in this slot,
                    // so we need to add multiple available slots

                    foreach ($this->getSplitSlots($e, $bookings) as $slot) {
                        $events[] = $slot;
                    }

                }else{
                    // no bookings - add to events
                    $events[] = $e;
                }
            }else{
                // booking - add to events
                $events[] = $e;
            }
        }

        $this->events = $events;
    }

    public function render()
    {

        foreach ($this->events as $e) { ?>

            <div class="rwd-b-event" style="<?php echo $e->getPositionStyle(); ?>">
                <p><?php // echo $e->getLabel(); ?></p>
            </div>

        <?php }
    }

    public function __construct($events)
    {
        foreach ($events as $e) {
            $this->events[] = new RWD_EventItem($e);
        }

        if(!is_admin()) {
            // on frontend - remove bookings from display
            $this->splitSlotsWithBookings();
        }
    }
}

?>
