<div class="d-flex  align-items-center">
    <label for="" >Tampilkan</label>
    <select   name="rows" id="" class="custom-select mx-3 ">
          <option {{ request('rows') === "5" ? "selected" : '' }}  value="5">5</option>
          <option {{ request('rows') === "10" ? "selected" : '' }}  value="10">10</option>
          <option {{ request('rows') === "25" ? "selected" : '' }}  value="25">25</option>
          <option {{ request('rows') === "50" ? "selected" : '' }}  value="50">50</option>
          <option {{ request('rows') === "100" ? "selected" : '' }}  value="100">100</option>
    </select>
    <label for="" class="mr-2">Entries</label>
</div>

@push('js')
    <script>
        $('select[name=rows]').change(function(){
           $(this).parents('form').submit()
        })
    </script>
@endpush

