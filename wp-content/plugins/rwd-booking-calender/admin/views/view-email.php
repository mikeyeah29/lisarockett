<a class="swpfd-backlink" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">< Back to email list</a>

<?php

$generated = false;

if(isset($_GET['template'])) {

    $templateName = $_GET['template'];

    if(isset($_POST['generate_email'])) {

        // echo '<button onclick="copyToClipboard()">Copy HTML</button>';

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
            '{{zoom_link}}' => $_POST['zoom-link'],
            '{{zoom_password}}' => $_POST['zoom-pass']
        ]);

        echo '<div id="email-html">';
        echo $message;
        echo '</div>';

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
                <label for="zoom-pass">Zoom Password:</label>
                <input type="text" class="form-control" name="zoom-pass" id="zoom-pass" value="">
            </div>
            <div class="form-group">
                <label for="total-amount">Total Amount</label>
                <input type="text" class="form-control" name="total-amount" id="total-amount" value="">
            </div>


            <button type="submit" class="rwd-btn">Generate</button>

        </form>

    </div>

</div>

<script>

function copyToClipboard() {
  // Get the formatted text content from the element
  const element = document.getElementById("email-html");
  const formattedText = element.innerText;

  // Create a temporary textarea element
  const textarea = document.createElement("textarea");
  textarea.value = formattedText;

  // Append the textarea to the document
  document.body.appendChild(textarea);

  // Select and copy the content
  textarea.select();
  document.execCommand("copy");

  // Remove the temporary textarea
  document.body.removeChild(textarea);
}

</script>
