@props(['action', 'data', 'user', 'shift'])

<div class="modal-dialog">
    <form id="form-action" action="{{ $action }}" method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </form>
  </div>