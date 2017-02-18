<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Online Forum">
 <meta name="author" content="Mamun Hosen">
 <link rel="icon" href="">
 <title>Forum :: @yield('title')</title>
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/app.css')}}">
</head>
<body>
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('public/js/app.js')}}"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
</body>
</html>