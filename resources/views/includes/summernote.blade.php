@push('css_vendor')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote-bs4.min.css">
@endpush

@push('js_vendor')
<!-- Summernote -->
<script src="{{ asset('/') }}plugins/summernote/summernote-bs4.min.js"></script>
@endpush

@push('js')
<script>
    $('#summernote').summernote({
        placeholder: 'Add Description',
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', '', '']],
            ['view', ['fullscreen', '', 'help']]
        ]
    })
</script>
@endpush