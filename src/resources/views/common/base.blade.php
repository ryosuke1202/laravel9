<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body class="bg-red-50">
    @include('common.header')

    @yield('content')

    @include('common.footer')
</body>

</html>
