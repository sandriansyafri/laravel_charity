@include('includes.sweeatalert')
@push('js')
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