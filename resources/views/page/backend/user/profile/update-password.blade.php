<form action="{{ route('user.settings',$user->username) }}" method="post">
    @method('put')
    @csrf
    <div class="tab-pane" id="settings">
        <div class="row">
            <div class="col">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            </div>
        </div>
       <div class="row">
           <div class="col-md-6">
            <div class="mb-3">
                <label for="">Current Password</label>
                <input type="text" name="current_password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">New Password</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="">New Password Confirmation</label>
                <input type="text" name="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary ">Update</button>
            </div>
           </div>
       </div>
    </div>
</form>