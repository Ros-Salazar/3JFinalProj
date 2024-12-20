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
    document.getElementById('progress-bar').style.width = '20%'; // Update progress
    document.getElementById('progress-bar').textContent = 'What can we do for you?'; // Update text
}

function goToStep2() {
    document.getElementById('step-1').style.display = 'none';
    document.getElementById('step-2').style.display = 'block';
    document.getElementById('step-3').style.display = 'none';
    document.getElementById('progress-bar').style.width = '60%'; // Update progress
    document.getElementById('progress-bar').textContent = 'What time?'; // Update text
}

function goToStep3() {
    document.getElementById('step-1').style.display = 'none';
    document.getElementById('step-2').style.display = 'none';
    document.getElementById('step-3').style.display = 'block';
    document.getElementById('progress-bar').style.width = '90%'; // Update progress
    document.getElementById('progress-bar').textContent = 'Nearly done!'; // Update text
}

function updateTimeSlots() {
    const date = document.getElementById('date').value;
    const timeSlots = document.getElementById('time-slots');

    // Clear existing options
    timeSlots.innerHTML = '';

    // Check if a date is selected
    if (date) {
        // Example logic to populate time slots
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

document.addEventListener('DOMContentLoaded', function() {
    const serviceDropdown = document.getElementById('service_id');
    const therapistDropdown = document.getElementById('therapist_id');

    // Function to toggle dropdown animation
    function toggleDropdown(dropdown) {
        if (dropdown.classList.contains('open')) {
            dropdown.classList.remove('open');
            dropdown.classList.add('closed');
        } else {
            dropdown.classList.remove('closed');
            dropdown.classList.add('open');
        }
    }

    // Add event listeners to dropdowns
    serviceDropdown.addEventListener('focus', () => {
        serviceDropdown.classList.add('open');
        serviceDropdown.classList.remove('closed');
    });

    serviceDropdown.addEventListener('blur', () => {
        serviceDropdown.classList.remove('open');
        serviceDropdown.classList.add('closed');
    });

    therapistDropdown.addEventListener('focus', () => {
        therapistDropdown.classList.add('open');
        therapistDropdown.classList.remove('closed');
    });

    therapistDropdown.addEventListener('blur', () => {
        therapistDropdown.classList.remove('open');
        therapistDropdown.classList.add('closed');
    });
});