<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/oov2wcw.css"><!--Link to the family font-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="{{ asset('css/grid_style.css') }}" rel="stylesheet">
    @yield('style')
    @yield('title')
</head>

<header>
    <img src="/img/logo.png" class="logo-img div1">
    @include('common.navbar')
</header>

<body class="div3">




@yield('content')


</body>

<footer>
    @yield('footer')
</footer>

</html>



