<!DOCTYPE html>
<html lang="en">

<head>
  <title>Laravel</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')
  @livewireStyles
</head>

<body>
  @yield('content')
  @livewireScripts
</body>

</html>
