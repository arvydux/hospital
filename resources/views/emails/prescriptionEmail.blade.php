<!DOCTYPE html>
<html>
<head>
    <title>Prescription assigned</title>
</head>
<body>
<h1>Mail from hospital</h1>
<p>Hello, {{ $details['patient-name'] }}</p>
<p>Hello, Your prescription is assigned.</p>
<p><strong>Prescription information:</strong></p>
<p><strong>Drug name:</strong> {{ $details['drug-name'] }}</p>
<p><strong>Doctor name:</strong> {{ $details['doctor-name'] }}</p>
<p>Thank you and stay healthy!</p>
</body>
</html>
