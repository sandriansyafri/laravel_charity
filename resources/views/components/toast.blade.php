@push('css')
    <link rel="stylesheet" href="{{ asset('/') }}plugins/toastr/toastr.min.css">
@endpush

@push('js')
<script src="{{ asset('/') }}plugins/toastr/toastr.min.js"></script>
    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}")
    </script>
    @elseif(session('error'))
    <script>
        toastr.success("{{ session('error') }}")
    </script>
    @endif
@endpush