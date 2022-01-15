@push('css_vendor')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('js_vendor')
<!-- Select2 -->
<script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>
@endpush

@push('js')
<script>
    $('.select2').select2({
        theme : 'bootstrap4',
        placeholder: 'Select',
        allowClear: true,
        closeOnSelect: true,
    })
</script>
@endpush