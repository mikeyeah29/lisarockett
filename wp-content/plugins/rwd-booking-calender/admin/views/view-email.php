<a class="swpfd-backlink" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">< Back to email list</a>

<?php

$generated = false;

if(isset($_GET['template'])) {

    $templateName = $_GET['template'];

    if(isset($_POST['generate_email'])) {

        $options = LR_Options::get();

        $html_template = plugin_dir_path( __FILE__ ) . 'emails/' . $templateName . '.html';
        $message = file_get_contents($html_template);
        // Replace placeholders in the template with actual values
        $message = strtr($message, [
            '{{date}}' => $_POST['date'],
            '{{time}}' => $_POST['time_from'],
            '{{duration}}' => $options['SESSION_LENGTH'],
            '{{total_amount}}' => $_POST['total-amount'],
            '{{paypal_email}}' => $options['PAYPAL_EMAIL'],
            '{{bank_details_name}}' => $options['BANK_DETAILS_NAME'],
            '{{bank_details_sort}}' => $options['BANK_DETAILS_SORT'],
            '{{bank_details_account}}' => $options['BANK_DETAILS_ACCOUNT'],
            '{{zoom_link}}' => $_POST['zoom-link']
        ]);

        echo $message;

        $generated = true;
    }

}

?>

<div class="wrap">

    <h1></h1>

    <div class="rwd-body">

        <p class="h1">Generate <?php echo $templateName; ?> Email</p>

        <form action="" method="post" style="margin-top: 20px;">

            <input type="hidden" name="generate_email" />

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" id="date" value="">
            </div>
            <div class="form-group">
                <label for="time-from">Time From:</label>
                <input type="time" class="form-control" name="time_from" id="date_from" value="">
            </div>
            <div class="form-group">
                <label for="zoom-link">Zoom Link:</label>
                <input type="text" class="form-control" name="zoom-link" id="zoom-link" value="">
            </div>
            <div class="form-group">
                <label for="total-amount">Total Amount</label>
                <input type="text" class="form-control" name="total-amount" id="total-amount" value="">
            </div>


            <button type="submit" class="rwd-btn">Generate</button>

        </form>

    </div>

</div>
