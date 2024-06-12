<!DOCTYPE html>
<html>
<head>
    <title>Service Confirmation</title>
</head>
<body>
    <h1>Service Confirmation</h1>
    <p>The service of {{ $metier }} between you and the client {{ $client_name }} has been confirmed.</p>
    <p>Here are the details of the service:</p>
    <ul>
        <li>Client Name: {{ $client_name }}</li>
        <li>Client Phone: {{ $client_phone }}</li>
        <li>Client Address: {{ $client_address }}</li>
    </ul>
</body>
</html>
