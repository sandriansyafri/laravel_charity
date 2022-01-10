<div>
    <div class="input-group">
        <input type="text" class="form-control rounded-0" name="q" value="{{ request('q') }}">
        <button type="button" id="btn-find" class="btn btn-primary rounded-0">Cari</button>
        </div>
</div>

@push('js')
    <script>
        $('#btn-find').click(function(){
            $(this).parents('form').submit()
        })
    </script>
@endpush