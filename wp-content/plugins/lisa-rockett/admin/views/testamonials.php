<div class="rwd-admin">

    <?php include('inc/_header.php'); ?>
    <?php include('inc/_notice.php'); ?>

    <div class="rwd-body">

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Testimonials</h2>
            <a class="rwd-btn" href="?page=lr-testamonials-add">Add</a>
        </div>

        <ul>
            <?php foreach ($testimonials as $index => $testimonial) { ?>

                <li class="lr-testimonial" style="display: flex; justify-content: space-between;">
                    <div>
                        <p><strong><?php echo $testimonial['name']; ?></strong><br>
                        <?php echo $testimonial['quote']; ?></p>
                    </div>
                    <div class="rwd-actions" data-id="32">
                        <a href="?page=lr-testamonials-edit&id=<?php echo $index; ?>" class="rwd-action rwd-action--edit"></a>
                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                            <input name="remove_testimonial" value="<?php echo $index; ?>" type="hidden">
                            <button class="rwd-action rwd-action--delete" type="submit"></button>
                        </form>
    				</div>
                </li>

            <?php } ?>
        </ul>

    </div>

</div>
