<div class="wrap wa-admin">

    <?php include('inc/_notice.php'); ?>
    <?php include('inc/_header.php'); ?>

    <div class="swpfd-body">

        <p>Showing records between <?php echo $showingFrom; ?> and <?php echo $showingTo; ?></p>

        <table class="swpfd-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>To</th>
                    <th>Subject</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($records as $record) { ?>

                    <?php

                        $time = strtotime($record->sent_date);
                        $sentDate = date("m/d/y g:i A", $time);

                    ?>

                    <tr>
                        <td><?php echo $sentDate; ?></td>
                        <td><?php echo $record->to_email; ?></td>
                        <td><?php echo $record->subject; ?></td>
                        <td>
                            <a target="_blank" href="/wp-admin/admin.php?page=swpfd-email&email_id=<?php echo $record->id; ?>">View Email</a>
                        </td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="delete_email" value="yes" />
                                <input type="hidden" name="email_id" value="<?php echo $record->id; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this email?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>
        </table>

        <form action="" method="get" class="swpfd-pagination">

            <input type="hidden" name="page" value="swpfd-data" />

            <label>Get Page</label>
            <input type="number" name="page_number" min="1" value="<?php echo $pageNumber; ?>" />
            <button class="rwd-btn">Get Results</button>
        </div>

    </div>

</div>
