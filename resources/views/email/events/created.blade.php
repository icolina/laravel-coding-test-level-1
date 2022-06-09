<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <h2>Hi, a new event has been created with the following details:</h2>
    <p>Name: {{ $event->name }}</p>
    <p>Slug: {{ $event->slug }}</p>
    <p>Click <span><a href="{{ route('events.show', $event) }}">here</a> to view your events full details.</span></p>
</body>
</html>
