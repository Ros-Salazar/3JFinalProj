$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-0d',
        autoclose: true
    });
});

let selectedTherapist = '';

function selectTherapist(name) {
    selectedTherapist = name; // Store the selected therapist's name
    alert("Selected Therapist: " + name);
}
function goToStep1() {
    document.getElementById('step-1').style.display = 'block';
    document.getElementById('step-2').style.display = 'none';
    document.getElementById('step-3').style.display = 'none';
}

function goToStep2() {
    document.getElementById('step-1').style.display = 'none';
    document.getElementById('step-2').style.display = 'block';
    document.getElementById('step-3').style.display = 'none';
}

function goToStep3() {
    document.getElementById('step-1').style.display = 'none';
    document.getElementById('step-2').style.display = 'none';
    document.getElementById('step-3').style.display = 'block';
}

function updateTimeSlots() {
    const date = document.getElementById('date').value;
    const timeSlots = document.getElementById('time-slots');

    // Clear existing options
    timeSlots.innerHTML = '';

    // Check if a date is selected
    if (date) {
        // Example logic to populate time slots
        // You can replace this with an AJAX call to fetch available time slots from the server
        const availableSlots = ['10:00 AM', '11:00 AM', '1:00 PM', '2:00 PM', '3:00 PM']; // Example slots

        availableSlots.forEach(slot => {
            const option = document.createElement('option');
            option.value = slot;
            option.textContent = slot;
            timeSlots.appendChild(option);
        });
    } else {
        // If no date is selected, you can disable the time slots dropdown
        timeSlots.innerHTML = '<option value="">Select a date first</option>';
    }
}

function goToStep3() {
    document.getElementById('step-2').style.display = 'none';
    document.getElementById('step-3').style.display = 'block';
}

function confirmBooking() {
    // Gather data from the form
    const service_id = document.getElementById('service').value;
    const therapist_id = selectedTherapist; // Store the selected therapist in a variable
    const appointment_date = document.getElementById('date').value;
    const start_time = document.getElementById('time-slots').value; // Assuming you have a time slot selected
    const end_time = calculateEndTime(start_time); // Implement this function based on your logic
    const promo_code = document.getElementById('promo-code').value;
    const payment_method = document.getElementById('payment-method').value;

    // Send data to the PHP backend using AJAX
    $.ajax({
        url: 'process_booking.php', // Your PHP script
        method: 'POST',
        data: {
            service_id: service_id,
            therapist_id: therapist_id,
            appointment_date: appointment_date,
            start_time: start_time,
            end_time: end_time,
            promo_code: promo_code,
            payment_method: payment_method
        },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.status === 'success') {
                alert(result.message);
                // Optionally redirect or update the UI
            } else {
                alert(result.message);
            }
        },
        error: function() {
            alert('An error occurred while processing your booking.');
        }
    });
}

function calculateEndTime(startTime) {
    // Implement your logic to calculate the end time based on the selected start time
    return startTime; // Placeholder
}

function openDatePicker() {
    document.getElementById('datePickerModal').style.display = 'block';
}

function closeDatePicker() {
    document.getElementById('datePickerModal').style.display = 'none';
}

function setDate() {
    const selectedDate = document.getElementById('modal-date').value;
    document.getElementById('date').value = selectedDate; // Set the selected date in the main input
    closeDatePicker(); // Close the modal after selecting the date
}