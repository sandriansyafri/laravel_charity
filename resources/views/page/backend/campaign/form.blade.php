<x-modal modalSize="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="modalTitle"></x-slot>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="">Judul</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="col-md-6">
                <label for="">Category</label>
                <select name="category_id[]" multiple id="" class=" select2">
                    @foreach ($categories as $category_id => $category)
                    <option value="{{ $category_id }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="">Short Desc</label>
            <textarea name="short_desc" id="" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="">Body</label>
            <textarea id="summernote" class="summernote" name="body"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Publish Date</label>
                    <div class="input-group date datetimepicker" id="publishDate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="publish_date" data-target="#publishDate">
                        <div class="input-group-append" data-target="#publishDate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="" class="custom-select">
                        <option value="">Pilih Salah Statu </option>
                        <option value="public">Publish</option>
                        <option value="pending">Pending</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Goals</label>
                <input type="text" class="form-control" name="goal">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>End Date</label>
                    <div class="input-group date datetimepicker" id="end_date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="end_date" data-target="#end_date">
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tulis Catatan Singkat</label>
                    <textarea name="note" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <label for="">Receiver / Penerima</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="saya" name="receiver" value="saya"  >
                    <label for="saya" class="custom-control-label font-weight-normal">Saya Sendiri</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="keluarga" name="receiver" value="keluarga">
                    <label for="keluarga" class="custom-control-label font-weight-normal">Keluarga / Kerabat</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="organisasi" name="receiver" value="organisasi">
                    <label for="organisasi" class="custom-control-label font-weight-normal">Organisasi / Lembaga</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="lainnya" name="receiver" value="lainnya">
                    <label for="lainnya" class="custom-control-label font-weight-normal">Lainnya</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="path_image">Upload Gambar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input onchange="previewUploadImage('.preview-path_image', this.files[0])" type="file" name="path_image" class="custom-file-input" id="path_image">
                            <label class="custom-file-label" for="path_image">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <img src="" alt="" class="img-fluid preview-path_image">
            </div>
        </div>
    </div>
</x-modal>