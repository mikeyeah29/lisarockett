<?php

class RWDBookingCalenderAdminMenu
{
    private $title;
    private $menu_title;
    private $permissions = 'manage_options';
    private $slug = 'rwd-booking-calender-settings';
    private $callback;

    private function renderView($view, $vars)
    {
        $page = (isset($_GET['page']) ? $_GET['page'] : '');
        $message = $vars['message'];
        $error = $vars['error'];
        // $data = (isset($vars['data']) ? $vars['data'] : [] );

        include_once( plugin_dir_path( __FILE__ ) . '../admin/views/' . $view );
    }

    public function admin_menu_view()
    {
        $message = '';
        $error = false;

        if(isset($_POST['approve_booking'])) {
            // RWD_Event::approve();
            $message = 'Booking confirmed';
            // TODO: send email to client
        }

        if(isset($_POST['delete_booking'])) {

            $id = $_POST['delete_booking'];
            RWD_Event::delete($id);

            $message = 'Booking Deleted';

        }

        $this->renderView('bookings.php', [
            'message' => $message,
            'error' => $error,
            'events' => RWD_Event::findFutureBookings()
        ]);
    }

    public function submenu_edit_view()
    {
        $message = '';
        $error = false;

        if(isset($_POST['update_booking'])) {

            $data = RWD_Helpers::getPost();
            $bookingId = $data['update_booking'];

            // validate date_from and date_to
            if (strtotime($data['date_from']) > strtotime($data['date_to'])) {
                $message = 'The start date must be before the end date.';
                $error = true;
            }

            // $type = 'booked';
            //
            // if(isset($data['confirm_booking'])) {
            //     $type = 'booked';
            // }

            if (!$error) {
                RWD_Event::update([
                    'date' => $data['date'],
                    'date_from' => $data['date_from'],
                    'date_to' => $data['date_to'],
                    'type' => 'booked',
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'description' => $data['description']
                ], $bookingId);

                $message = 'Booking updated';
            }

        }

        if(!isset($_GET['booking-id'])) {
            dd('No booking id');
        }

        $booking = RWD_Event::findById($_GET['booking-id']);

        $this->renderView('edit.php', [
            'message' => $message,
            'error' => $error,
            'booking' => $booking
        ]);
    }

    public function submenu_calender_view()
    {
        $message = '';
        $error = false;

        if(isset($_POST['action-add-event'])) {

            $data = RWD_Helpers::getPost();

            $eventObj = [
                'type' => $data['rwd-type'],
                'date' => $data['the-date'],
                'date_from' => $data['start-time'],
                'date_to' => $data['end-time'],
                'first_name' => $data['first-name'],
                'last_name' => $data['last-name'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ];

            if(RWD_Event::create($eventObj)) {
                $message = 'Event Created';
            }else{
                $message = 'Something went wrong';
                $error = true;
            }

        }

        if(isset($_POST['action-edit-event'])) {

            $data = RWD_Helpers::getPost();

            $eventObj = [
                'date' => $data['the-date'],
                'type' => $data['event-type'],
                'date_from' => $data['start-time'],
                'date_to' => $data['end-time'],
                'first_name' => $data['first-name'],
                'last_name' => $data['last-name'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ];

            if(RWD_Event::update($eventObj, $data['event-id'])) {
                $message = 'Event Updated';
            }else{
                $message = 'Something went wrong';
                $error = true;
            }

        }

        if(isset($_POST['delete-event-id'])) {
            if(RWD_Event::delete($_POST['delete-event-id'])) {
                $message = 'Event Deleted';
            }else{
                $message = 'Something went wrong';
                $error = true;
            }
        }

        $dateInView = date("Y-m-d h:m:s");
        if(isset($_GET['date'])) {
            $dateInView = $_GET['date'];
        }

        // $events = RWD_Event::findByWeek($dateInView);

        $this->renderView('calender.php', [
            'message' => $message,
            'error' => $error,
            // 'events' => $events,
            'dateInView' => $dateInView
        ]);
    }

    public function admin_menu()
    {
        add_menu_page(
            'Booking Calender Bookings', // title
            'Booking Calender', // menu title
            $this->permissions, // permissions
            $this->slug, // slug
            array($this, 'admin_menu_view'), // callbacl
            'dashicons-calendar', // dash icon
            4 // position
        );
        add_submenu_page(
            $this->slug, // parent slug
            'Opening Times', // title
            'Calender', // menu title
            $this->permissions,
            'rwd-booking-calender-view', // slug
            array($this, 'submenu_calender_view')
        );

        add_submenu_page(
            $this->slug, // parent slug
            'Edit Booking', // title
            '', // menu title
            $this->permissions,
            'rwd-booking-calender-edit', // slug
            array($this, 'submenu_edit_view')
        );
        // add_submenu_page(
        //     $this->slug, // parent slug
        //     'Calender', // title
        //     'Calender', // menu title
        //     $this->permissions,
        //     'rwd-booking-calender-view', // slug
        //     array($this, 'submenu_calender_view')
        // );
    }

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
    }
}

?>
