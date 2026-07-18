@props(['title' => ''])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>.: {{ $title ?? ' Ticket ' }} :.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ></script>
</head>
    <body class="bg-body-tertiary">
        {{ $slot }}
    </body>
</html>
