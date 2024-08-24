<!DOCTYPE html>
<html>
<head>
    <title>Activity Reminder</title>
</head>
<body>
    <h1>Reminder: Upcoming Activity</h1>
    <p>Dear {{ $booking->user_name }},</p>
    <p>This is a reminder for your upcoming activity:</p>
    <p><strong>Activity Name:</strong> {{ $booking->activity->name }}</p>
    <p><strong>Location:</strong> {{ $booking->activity->location }}</p>
    <p><strong>Start Date:</strong> {{ $booking->activity->start_date->format('F j, Y, g:i a') }}</p>
    <p><strong>Slots Booked:</strong> {{ $booking->slots_booked }}</p>
    <p>Thank you for booking with us!</p>
</body>
</html>