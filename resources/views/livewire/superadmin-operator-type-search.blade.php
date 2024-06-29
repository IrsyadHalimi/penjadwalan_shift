<div>
    <div class="card-body">
        <div>
            <h5>Cari Jenis Operator</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama Jenis Operator, ID Jenis Operator atau ID Departemen..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Jenis Operator</th>
                        <th>ID Departemen</th>
                        <th>Keterangan</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($operator_types as $operator_type)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $operator_type->id }}</td>
                    <td>{{ $operator_type->operator_name_type }}</td>
                    <td>{{ $operator_type->department_id }}</td>
                    <td>{{ $operator_type->description }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('superadmin.operator_type.edit', ['id' => $operator_type->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $operator_type->getId() }}" action="{{ route('superadmin.operator_type.delete', $operator_type->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $operator_type->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $operator_types->links('pagination::bootstrap-4') }}
    </div>
</div>