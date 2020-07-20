<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link href="{{ url('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/styles.css') }}" rel="stylesheet">
    <link href="{{ url('public/css/toastr.min.css') }}" rel="stylesheet">

    <!--Custom Font-->
    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">-->
    @if (!empty($plugincss)) 
    @foreach ($plugincss as $value) 
    @if(!empty($value))
    <link rel="stylesheet" href="{{ url('public/plugins/'.$value) }}">
    @endif
    @endforeach
    @endif
    <script>
        var baseurl = "{{ asset('/') }}";
    </script>
    @if (!empty($css)) 
    @foreach ($css as $value) 
    @if(!empty($value))
    <link rel="stylesheet" href="{{ url('public/css/'.$value) }}">
    @endif
    @endforeach
    @endif
</head>