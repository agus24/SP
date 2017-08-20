<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('app_name')}}</title>
    <link rel="stylesheet" type="text/css" href="<?=asset('css/app.css')?>">
</head>
<body>
@use('partials.nav')
@yield('login')
<script src="<?=asset('js/app.js')?>"></script>
{{script()}}
</body>
</html>
