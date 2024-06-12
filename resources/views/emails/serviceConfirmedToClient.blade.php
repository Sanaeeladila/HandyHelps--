<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Confirmation</title>
</head>
<body>
    <h1>Service Confirmation</h1>
    <p>Hello, {{ $service->client->name }}</p>
    <p>Your service with {{ $partner->name }} for {{ $service->description }} has been confirmed for {{ $service->date_service }}.</p>
    <p>Details:</p>
    <ul>
        <li>Service: {{ $service->service }}</li>
        <li>Date: {{ $service->date_service }}</li>
        <li>Category: {{ $service->category }}</li>
    </ul>
</body>
</html>
