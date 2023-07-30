<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog @if(isset($typeModal)) {{$typeModal}} @endif">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $dataTitle }}</h5>
          <button type="button" style="background:none;border:none" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
        </div>
        <div class="modal-body">
          <p>
             {{$dataText}}
          </p>
        </div>
        @if(isset($actionUrl) && isset($actionText))
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="{{$actionUrl}}"><button type="button" class="btn btn-primary">{{ $actionText }}</button></a>
          </div>
        @endif
      </div>
    </div>
</div>