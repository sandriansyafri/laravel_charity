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
                <th>#</th>
                <th>Desc</th>
                <th>Publish</th>
                <th>Status</th>
                <th>Author</th>
                <th>Action</th>
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

    table = $('table.table').DataTable()

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

    function addForm(url, title = 'Form') {
        toggleModal('show');
        $(`${modal} form`).attr('action', url);
        $(`${modal} .modal-title`).text(title);
        $(`${modal} .btn-submit`).text('Submit');
        $(`${modal} form [name=_method]`).val('POST');
        $(`${modal} form`).attr(url);
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
                toastr.success("Data berhasil ditambahkan")
                if (res.ok) {
                    toggleModal('hide');
                    showAlert(res.status, res.message);
                }

            })
            .fail(({
                responseJSON
            }) => {

                if (!responseJSON.ok) {
                    //   showAlert(responseJSON.status, responseJSON.message);
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
             
            } 
            else {
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