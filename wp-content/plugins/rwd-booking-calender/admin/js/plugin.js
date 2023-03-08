jQuery( document ).ready(function() {

    // opens specific modal
    jQuery('.lr-trigger--add-event').on('click', function() {
        jQuery('#lr-add-event').addClass('is-open');
    });

    // closes any modal
    jQuery('.modal-close').on('click', function() {
        var modal = jQuery(this).closest('.modal-dialog');
        modal.removeClass('is-open');
    });

    // editing events

    jQuery('.rwd-b-event').on('click', function() {

        var data = jQuery(this).data('json');

        // fill edit data
        if(data.type === 'available') {
            jQuery('.data-edit-event--h2').text('Edit Available Slot');
        }else{
            jQuery('.data-edit-event--h2').text('Edit Booking');
        }

        jQuery('.data-edit-event--id').val(data.id);
        jQuery('.data-edit-event--type').val(data.type);
        jQuery('.data-edit-event--date').val(new Date(data.date).toISOString().substring(0, 10));
        jQuery('.data-edit-event--start-time').val(data.start_time);
        jQuery('.data-edit-event--end-time').val(data.end_time);

        if(data.type === 'available') {
            jQuery('#lr-edit-event .rwd-form-extra').removeClass('is-open');
        }else{
            jQuery('#lr-edit-event .rwd-form-extra').addClass('is-open');
            jQuery('.data-edit-event--first-name').val(data.first_name);
            jQuery('.data-edit-event--last-name').val(data.last_name);
            jQuery('.data-edit-event--email').val(data.email);
            jQuery('.data-edit-event--phone').val(data.phone);
        }

        jQuery('#lr-edit-event').addClass('is-open');

    });

    // toggle extra

    var etExtra = jQuery('#lr-add-event .rwd-form-extra');

    jQuery('#rwd-event-type').on('change', function() {
        if(jQuery(this).val() === 'booked') {
            etExtra.addClass('is-open');
        }else{
            etExtra.removeClass('is-open');
        }
    });

    jQuery('#lr-add-event form').on('submit', function(e) {

        var inputs = jQuery('#lr-add-event .input-required');
        var startTime = document.querySelector('#start-time');
        var endTime = document.querySelector('#end-time');

        // Loop through all the input elements
        for (var i = 0; i < inputs.length; i++) {
            // Check if the input is empty
            if (!inputs[i].value) {
                // If it is, prevent the form from being submitted
                e.preventDefault();
                // And show an error message
                jQuery(inputs[i]).addClass('invalid');
                inputs[i].nextElementSibling.innerHTML = "This field is required";
            } else if(startTime.value >= endTime.value) {

                e.preventDefault();
                endTime.parentElement.querySelector('.error').innerText = 'End time cannot be before start time.';

            } else {
                // If the input is not empty, remove the error message
                jQuery(inputs[i]).removeClass('invalid');
                inputs[i].nextElementSibling.innerHTML = "";
            }
        }

    });

    jQuery('#lr-edit-event form').on('submit', function(e) {

        var inputs = jQuery('#lr-edit-event .input-required');
        var startTime = document.querySelector('#edit-start-time');
        var endTime = document.querySelector('#edit-end-time');

        // Loop through all the input elements
        for (var i = 0; i < inputs.length; i++) {
            // Check if the input is empty
            if (!inputs[i].value) {
                // If it is, prevent the form from being submitted
                e.preventDefault();
                // And show an error message
                jQuery(inputs[i]).addClass('invalid');
                inputs[i].nextElementSibling.innerHTML = "This field is required";
            } else if(startTime.value >= endTime.value) {

                e.preventDefault();
                endTime.parentElement.querySelector('.error').innerText = 'End time cannot be before start time.';

            } else {
                // If the input is not empty, remove the error message
                jQuery(inputs[i]).removeClass('invalid');
                inputs[i].nextElementSibling.innerHTML = "";
            }
        }

    });

    function setMinMaxTimeInput(id, min, max) {
        // Get the time input element
        var timeInput = document.getElementById(id);

        // Create new Date objects for minimum and maximum times
        var minTimeSplit = min.split(':');
        var minTime = new Date();
        minTime.setHours(minTimeSplit[0]);
        minTime.setMinutes(minTimeSplit[1]);

        var maxTimeSplit = max.split(':');
        var maxTime = new Date();
        maxTime.setHours(maxTimeSplit[0]);
        maxTime.setMinutes(maxTimeSplit[1]);

        // Set the min and max attributes on the time input element
        timeInput.min = minTime.toTimeString().substring(0,5);
        timeInput.max = maxTime.toTimeString().substring(0,5);
    }

    setMinMaxTimeInput('start-time', '8:00', '21:00');
    setMinMaxTimeInput('end-time', '8:00', '22:00');
    setMinMaxTimeInput('edit-start-time', '8:00', '21:00');
    setMinMaxTimeInput('edit-end-time', '8:00', '22:00');

});
