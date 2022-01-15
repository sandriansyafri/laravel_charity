@include('includes.select2')
@push('css')
<style>
    .select2-results__option,
    .select2-selection__rendered {
        text-transform: capitalize
    }
</style>
@endpush
<form action="{{ route('user.profile',$user->username) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-center my-3">
        <div class="col-6 text-center ">
            <div class="form-group">
                @if ($user->path_image)
                <div class="text-center d-flex w-100  justify-content-center">
                    <div style="width: 250px; height: 250px; overflow: hidden">
                        <img src="{{ asset('images/user/') . '/' . $user->path_image }}" class=" preview-path_image img-rounded rounded-circle w-100 h-100" alt="">
                    </div>
                </div>
                @elseif($user->path_image == null)
                <div class="text-center d-flex w-100  justify-content-center">
                    <div style="width: 250px; height: 250px; overflow: hidden">
                        <img class="img-fluid preview-path_image rounded-circle w-100 h-100 text-center" src="{{ asset('images/user/no-profile.png') }}" alt="">
                    </div>
                </div>
                @endif
                <div class="custom-file mt-4">
                    <input onchange="previewUploadImage('.preview-path_image',this.files[0])" type="file" class="custom-file-input" id="customFile" name="path_image">
                    <label class="custom-file-label text-left" for="customFile">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Role</label>
                <select name="role_id" class="select2 form-control">
                    <option value="">Select</option>
                    @foreach ($roles as $role)
                    <option {{ $user->role_id === $role->id ? "selected" : "" }} value="{{ $role->id }}">
                        <span class="text-uppercase">{{ $role->name }}</span>
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ auth()->user()->username }}">
                @error('username')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Gender</label>
                <select name="gender" class="select2 form-control">
                    <option value="">Select</option>
                    <option {{ $user->gender == 'L' ? "selected" : "" }} value="L">Laki Laki</option>
                    <option {{ $user->gender == 'P' ? "selected" : "" }} value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jobs</label>
                <input type="text" class="form-control" name="job" value="{{ old('job',$user->job) }}">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <textarea type="text" class="form-control" name="address" rows="4" value="{{ old('address',$user->address) }}"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-primary btn-block py-2">Update</button>
        </div>
    </div>
</form>

@push('js')
<script>
    function previewUploadImage(target, file) {
        let filename = file.name;
        $('.custom-file-label').html(`<span class="text-sm">${filename}</span>`)
        $(target).attr('src', window.URL.createObjectURL(file))
    }
</script>
@endpush