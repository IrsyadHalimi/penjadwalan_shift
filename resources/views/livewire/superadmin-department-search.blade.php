<div>
    <div class="card-body">
        <div>
            <h5>Cari Departemen</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama Departemen, ID Departemen atau ID Perusahaan..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Departemen</th>
                        <th>ID Perusahaan</th>
                        <th>Keterangan</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($departments as $department)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $department->id }}</td>
                    <td>{{ $department->department_name }}</td>
                    <td>{{ optional($department->company)->company_name ?? 'N/A'  }}</td>
                    <td>{{ $department->description }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('superadmin.department.edit', ['id' => $department->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $department->getId() }}" action="{{ route('superadmin.department.delete', $department->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $department->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $departments->links('pagination::bootstrap-4') }}
    </div>
</div>