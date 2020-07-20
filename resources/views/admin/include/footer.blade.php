<script src="{{ url('public/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ url('public/js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ url('public/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/js/chart.min.js') }}"></script>
<script src="{{ url('public/js/chart-data.js') }}"></script>
<script src="{{ url('public/js/easypiechart.js') }}"></script>
<script src="{{ url('public/js/easypiechart-data.js') }}"></script>
<script src="{{ url('public/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('public/js/custom.js') }}"></script>
<script src="{{ url('public/js/jquery.dataTables.js') }}"></script>
<script src="{{ url('public/js/jquery.dataTables.min-bkp.js') }}"></script>


@if (!empty($js)) 
@foreach ($js as $value) 
<script src="{{ url('public/js/'.$value) }}" type="text/javascript"></script>
@endforeach
@endif


<!--<script src="{{ url('public/admin/assets/js/comman_function.js') }}" ></script>-->

<script>
    jQuery(document).ready(function() {
    @if (!empty($funinit))
    @foreach ($funinit as $value)
        {{ $value }}
    @endforeach
    @endif
    }
    );
</script>