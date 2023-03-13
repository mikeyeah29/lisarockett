jQuery(function() {

    var slots = jQuery('.rwd-b-event');

    slots.on('click', function() {
        var data = $(this).data('json');
        var time = data.date_from.split(' ')[1];
        $('[name="q_date"]').val(data.date);
        $('[name="q_time"]').val(time);
    });

});
