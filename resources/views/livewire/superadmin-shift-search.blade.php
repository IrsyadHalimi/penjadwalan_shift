<div>
    <div class="card-body">
        <div>
            <h5>Cari Shift</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama Shift, ID Shift atau ID Departemen..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Shift</th>
                        <th>Departemen</th>
                        <th>Keterangan</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($shifts as $shift)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $shift->id }}</td>
                    <td>{{ $shift->shift_name }}</td>
                    <td>{{ optional($shift->department)->department_name ?? 'N/A'  }}</td>
                    <td>{{ $shift->description }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('superadmin.shift.edit', ['id' => $shift->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $shift->getId() }}" action="{{ route('superadmin.shift.delete', $shift->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $shift->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $shifts->links('pagination::bootstrap-4') }}
    </div>
</div>