<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
</head>
<body>
<a href="{{config('app.url').'/domain-verify/'.$token}}">{{config('app.url').'/domain-verify/'.$token}}</a>
</body>
</html>