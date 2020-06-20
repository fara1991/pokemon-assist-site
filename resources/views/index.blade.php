<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ID=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    {{--    <link rel="icon" type="image/png" href="/">--}}
    {{--    <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
    <script>
        window.Laravel = {
            scrfToken: "{{ csrf_token() }}"
        };
    </script>
</head>
<body>
<div id="app">
</div>
</body>
<script src="{{ mix('js/vue.js') }}"></script>
</html>
