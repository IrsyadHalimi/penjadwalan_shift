<div>
    <div class="card-body">
        <div>
            <h5>Cari Supervisor</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama, ID Supervisor, atau ID Departemen..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Pegawai</th>
                        <th>Departemen</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($supervisors as $supervisor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $supervisor->id }}</td>
                    <td>{{ $supervisor->full_name }}</td>
                    <td>{{ $supervisor->employee_id }}</td>
                    <td>{{ optional($supervisor->department)->department_name ?? 'N/A' }}</td>
                    <td>{{ $supervisor->email }}</td>
                    <td>{{ $supervisor->phone_number }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('admin.supervisor.edit', ['id' => $supervisor->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $supervisor->getId() }}" action="{{ route('admin.supervisor.delete', $supervisor->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $supervisor->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $supervisors->links('pagination::bootstrap-4') }}
    </div>
</div>