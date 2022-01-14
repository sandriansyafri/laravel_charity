@push('css_vendor')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endpush

@push('js_vendor')
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
@endpush

@push('js')
<script>
    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        autoclose : true,
        locale : 'id',
        icons: {
            time: "fa fa-clock",
        }
    })
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
    })
</script>
@endpush