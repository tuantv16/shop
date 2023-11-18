<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Head Contents -->
  @vite('resources/js/app.js')
</head>
<body>
  <div id="app">
    <example-component />
  </div>

</body>
</html>
