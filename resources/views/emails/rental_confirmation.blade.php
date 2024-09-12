<!DOCTYPE html>
<html>
<head>
    <title>Rental Confirmation</title>
</head>
<body>
    <h1>Rental Confirmation</h1>
    <p>Dear {{ $details['recipientName'] }},</p>
    <p>Thank you for renting a vehicle with us. Here are the details of your rental:</p>
    <ul>
        <li>Vehicle ID: {{ $details['vehicleId'] }}</li>
        <li>Pickup Date: {{ $details['pickupDate'] }}</li>
        <li>Dropoff Date: {{ $details['dropoffDate'] }}</li>
        <li>Pickup Location: {{ $details['pickupLocation'] }}</li>
        <li>Dropoff Location: {{ $details['dropoffLocation'] }}</li>
        <li>Payment Method: {{ $details['paymentMethod'] }}</li>
    </ul>
    <p>Best regards,</p>
    <p>Your Company</p>
</body>
</html>
