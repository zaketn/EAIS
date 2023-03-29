<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Document</title>
</head>
<body>
{!! $sTable !!}

<script src="{{ asset('js/plugins/jquery-3.6.4.js') }}"></script>
<script src="{{ asset('js/scripts/process-tables.js') }}"></script>
</body>
</html>
