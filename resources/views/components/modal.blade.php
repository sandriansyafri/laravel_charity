  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" {{ $attributes->merge() }}>
    <div class="modal-dialog {{ $modalSize ?? '' }}">
      <form  action="" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="_method" value="">
        <div class="modal-content">
            @isset($modalTitle)
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">
                    {{ $modalTitle }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endisset
            <div class="modal-body">
                  {{ $slot }}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button  onclick="submitForm(this.form)" type="button" class="btn btn-primary btn-submit" ></button>
            </div>
          </div>
      </form>
    </div>
  </div>