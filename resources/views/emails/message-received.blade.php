<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mensaje recibido</title>
</head>
<body>
  @auth
    <p>Recibiste un mensaje de: {{ auth()->user()->name }} <{{ auth()->user()->email }}> </p>
  @endauth
  @guest
    <p>Recibiste un mensaje de: {{ $msg['name'] }} <{{ $msg['email'] }}> </p>
  @endguest
  <p>
    <strong>Asunto:</strong> {{ $msg['subject'] }}
  </p>
  <p>
    {{ $msg['content'] }}
  </p>
</body>
</html>
