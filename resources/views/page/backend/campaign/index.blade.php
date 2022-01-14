@extends('layouts.backend.main')

@push('css')
    <style>

        .note-editor.is-invalid{
            margin-bottom: 0 !important;
            border: 1px solid red !important;
        }
     
    </style>
@endpush

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

        <div class="row align-items-center">
            <div class="col-md-4">
                <button onclick="addForm(`{{ route('campaign.store') }}`,'Add Campaign')" type="button" class="btn btn-primary">Add Campaigns</button>
            </div>
            <div class="col">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="filter_status" class="custom-select">
                                <option value="">Select </option>
                                <option value="public">Publish</option>
                                <option value="pending">Pending</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 d-flex" style="column-gap: 20px">
                        <div class="form-group">
                            <label>Publish Date</label>
                            <div class="input-group datepicker" id="filter_publishDate" data-target-input="nearest">
                                <input  type="text" class="form-control datetimepicker-input" data-target="#filter_publishDate" name="filter_publishDate" />
                                <div class="input-group-append" data-target="#filter_publishDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <div class="input-group datepicker" id="filter_endDate" data-target-input="nearest">
                                <input  type="text" class="form-control datetimepicker-input" name="filter_endDate" data-target="#filter_endDate" />
                                <div class="input-group-append" data-target="#filter_endDate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


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
        ajax: {
            url: "{{ route('campaign.data') }}",
            data: function (d) {
                d.status = $(`[name=filter_status]`).val();
                d.publish_date = $(`[name=filter_publishDate]`).val();
                d.end_date = $(`[name=filter_endDate]`).val();
            }
        },
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
        ],
    })

    $('[name=filter_status]').change(function () {
        table.ajax.reload();
    })

    $('.datepicker').on('change.datetimepicker',function(){
        table.ajax.reload();
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

    function resetForm(form) {
        $(form)[0].reset();
        $('select.select2').val('').trigger('change')
        $('.preview-path_image').attr('src','')
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
            if ($(`[name=${field}]`).attr('type') == 'radio') {
                $(`[name=${field}][value='${fields[field]}']`).prop('checked', true)
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

    function deleteItem(url) {
        if (confirm('delete')) {
            $.post({
                    url,
                    type: 'DELETE',
                })
                .done((res) => {
                    if (res.ok) {
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
                $('.note-editor').addClass('is-invalid');
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } 
            else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
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