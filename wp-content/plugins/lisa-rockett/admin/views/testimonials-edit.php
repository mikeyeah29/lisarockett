<div class="rwd-admin">

    <?php include('inc/_header.php'); ?>
    <?php include('inc/_notice.php'); ?>

    <div class="rwd-body">

        <h2>Edit Testimonial</h2>

    	<form method="post" action="" class="rwd-form">
            <input type="hidden" name="testimonial_index" value="<?php echo $_GET['id']; ?>" />
            <div class="rwd-form-group">
        		<label for="name">Name:</label>
        		<input type="text" name="q_name" id="name" value="<?php echo $testimonial['name']; ?>"><br>
            </div>
            <div class="rwd-form-group">
        		<label for="message">Message:</label>
        		<textarea name="q_message" id="message"><?php echo $testimonial['quote']; ?></textarea><br>
            </div>
    		<input type="submit" name="submit_update" value="Update Testimonial">
    	</form>

    </div>

</div>
