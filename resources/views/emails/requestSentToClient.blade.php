<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Service Request is Confirmed</title>
</head>
<body>
    <h1>Your Service Request</h1>
    <p>Hello,</p> <!-- Assuming 'name' is a field in your User model linked to a partner -->
    <p>Your request  has been sent.</p>
    <p>Details:</p>
    <ul>
        <li>Service: {{ $service->service }}</li>
        <li>Date: {{ $service->date_service }}</li>
        <li>Category: {{ $service->categorie }}</li>
    </ul>
</body>
</html>
