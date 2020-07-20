<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link href="{{ url('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/styles.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/toastr.min.css') }}" rel="stylesheet">
    <style>.error{color:red}</style>
</head>
<body>

    @yield('content')


    <script src="{{ url('public/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ url('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/js/toastr.min.js') }}"></script>


    @if (!empty($pluginjs)) 
    @foreach ($pluginjs as $value) 
    <script src="{{ url('public/plugins/'.$value) }}" type="text/javascript"></script>
    @endforeach
    @endif
    @if (!empty($js)) 
    @foreach ($js as $value) 
    <script src="{{ url('public/js/'.$value) }}" type="text/javascript"></script>
    @endforeach
    @endif
    
    <!--<script src="{{ url('public/admin/assets/js/toastr.min.js') }}" type="text/javascript"></script>-->
    <!--<script src="{{ url('public/admin/assets/js/comman_function.js') }}" ></script>-->
    
    <script>
        jQuery(document).ready(function() {
        @if (!empty($funinit))
                @foreach ($funinit as $value)
        {{  $value }}
        @endforeach
                @endif
        });
    </script>
</body>
</html>
