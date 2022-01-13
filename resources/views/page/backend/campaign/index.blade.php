@extends('layouts.backend.main')

@section('title')
Campaign
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Campaign</li>
@endsection

@include('includes/datatable')
@include('includes/select2')
@include('includes/summernote')
@include('includes/tempusdominus')
@include('includes.sweeatalert')

@section('content')
<x-card>
    <x-slot name="header">
        <button onclick="addForm(`{{ route('campaign.store') }}`,'Add Campaign')" type="button" class="btn btn-primary">Add Campaigns</button>
    </x-slot>
    <x-table>
        <x-slot name="thead">
            <tr>
                <th style="width: 10px">#</th>
                <th style="width: 15%">Image</th>
                <th style="width: 25%">Desc</th>
                <th style="width: 15%">Publish</th>
                <th style="width: 10%" class="text-center">Status</th>
                <th style="width: 10%" class="text-center">Author</th>
                <th class="text-center">Action</th>
            </tr>
        </x-slot>
    </x-table>
</x-card>

@include('page.backend.campaign.form')

@endsection

@push('js')
<script>
    const modal = '#modal';
    let table;

    table = $('table.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: "{{ route('campaign.data') }}",
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            {
                data: 'path_image',
                searchable: false,
                orderable: false
            },
            {
                data: 'short_desc',
                searchable: false,
                orderable: false
            },
            {
                data: 'publish_date',
                searchable: false,
                orderable: false
            },
            {
                class: 'text-center',
                data: 'status',
                searchable: false,
                orderable: false
            },
            {
                class: 'text-center',
                data: 'author.name',
                searchable: false,
                orderable: false
            },
            {
                class: 'text-center',
                data: 'action',
                searchable: false,
                orderable: false
            },
        ]
    })

    $('.custom-file-input').change(function () {
        const filename = $(this).val().split('\\').pop();
        $(this)
            .next('.custom-file-label')
            .addClass('selected')
            .html(filename)
    })

    function toggleModal(value) {
        $(modal).modal(value);
    }

    function resetForm(form){
        $(form)[0].reset();
        $('select.select2').val('').trigger('change')
    }

    function addForm(url, title = 'Form') {
        resetForm($(`${modal} form`))

        toggleModal('show');
        $(`${modal} form`).attr('action', url);
        $(`${modal} .modal-title`).text(title);
        $(`${modal} .btn-submit`).text('Submit');
        $(`${modal} form [name=_method]`).val('POST');
        $(`${modal} form`).attr(url);
    }

    function loadForm(fields) {
        for (field in fields) {
            if($(`[name=${field}]`).attr('type') == 'radio'){
                $(`[name=${field}][value='${fields[field]}']`).prop('checked',true)
            }
            if ($(`[name=${field}]`).attr('type') !== 'file') {
                if ($(`[name=${field}]`).hasClass('summernote')) {
                    $(`[name=${field}]`).summernote('code', fields[field])
                }
                $(`[name=${field}]`).val(fields[field])
            }
            if ($(`[name=${field}]`).attr('type') === 'file') {
                $(`.preview-${field}`).attr('src', `{{ asset('images/campaign/${fields[field]}') }}`)
            }
           
        }
    }

    function editForm(url, title = 'Form') {
        $(`${modal} form`).attr('action', url);
        $(`${modal} .modal-title`).text(title);
        $(`${modal} .btn-submit`).text('Update');
        $(`${modal} form [name=_method]`).val('PUT');
        toggleModal('show');

        $.get(url)
            .done((res) => {
                if (res.ok) {
                    resetForm($(`${modal} form`));
                    loadForm(res.data);
                    let category_id = [];
                    res.data.campaign_category.forEach((item) => {
                       category_id.push(item.pivot.category_id)
                    })
                    $('select.select2').val(category_id).trigger('change')
                }
            })
    }

    function deleteItem(url){
        if(confirm('delete')){
            $.post({
                url,
                type : 'DELETE',
            })
            .done((res) => {
               if(res.ok){
                table.ajax.reload();
                toastr.success(res.message)
               }
            })
            .fail((e) => console.log(e))
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function submitForm(originalForm) {
        $.post({
                url: $(originalForm).attr('action'),
                data: new FormData(originalForm),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false
            })
            .done((res) => {
                if (res.ok) {
                    toastr.success(res.message);
                    table.ajax.reload();
                    toggleModal('hide');
                } 
            })
            .fail(({
                responseJSON
            }) => {

                if (!responseJSON.ok) {
                      showAlert(responseJSON.status, responseJSON.message);
                    loopErrors(responseJSON.errors);

                }
            })
    }


    function loopErrors(errors) {
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        for (let error in errors) {
            $(`[name=${error}]`).addClass('is-invalid');

            if ($(`[name*=${error}]`).hasClass('select2')) {
                $(`[name*=${error}]`).addClass('is-invalid');
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name*=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass('summernote')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else if ($(`[name=${error}]`).hasClass('datetimepicker-input')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());

            } else {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`));
            }

        }
    }

    function showAlert(status, message) {
        if (status === 'success' || status === 200) {
            toastr.success(message)
        }
        if (status === 'error' || status === 422) {
            toastr.error(message)
        }
    }

    function previewUploadImage(target, file) {
        $(target).attr('src', window.URL.createObjectURL(file))
    }
</script>
@endpush