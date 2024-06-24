@props(['action', 'data', 'user', 'shift'])

<div class="modal-dialog">
    <form id="form-action" action="{{ $action }}" method="post">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Jadwal Operator</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </div>
    </form>
  </div>