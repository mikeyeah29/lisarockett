jQuery(function() {

    var timeMsg = jQuery('#time-msg');

    function setTimeMsg(msg)
    {
        timeMsg.text(msg);
        timeMsg.show();
    }

    function formatDate(dateString) {
        let parts = dateString.split("-");
        let formattedString = `${parts[2]}/${parts[1]}/${parts[0]}`;
        return formattedString;
    }

    var slots = jQuery('.rwd-b-event');

    slots.on('click', function() {

        timeMsg.hide();

        var data = $(this).data('json');
        var earliestTime = data.date_from.split(' ')[1];
        var latestTime = data.date_to.split(' ')[1];
        $('[name="q_date"]').val(data.date);
        $('#data--date').text(formatDate(data.date));
        $('[name="q_time"]').val(earliestTime);

        // Get the time input element
        var timeInput = document.querySelector('.data--time');

        // Add an event listener to the time input
        timeInput.addEventListener('input', function() {
          // Get the selected time value
          var selectedTime = new Date('1970-01-01T' + timeInput.value);

          // Set the minimum and maximum allowed times
          var minTime = new Date('1970-01-01T' + earliestTime);
          var maxTime = new Date('1970-01-01T' + latestTime);

          console.log('from ', earliestTime);
          console.log('to ', latestTime);

          // Compare the selected time with the minimum and maximum times
          if (selectedTime < minTime || selectedTime > maxTime) {
            // Clear the selected time if it's not within the allowed range
            timeInput.value = '';
            setTimeMsg('Time must be between ' + earliestTime.slice(0, -3) + ' and ' + latestTime.slice(0, -3));
          }else{
              timeMsg.hide();
          }
        });

    });

});
