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
                        <a class="btn icon btn-primary" href="{{route('superadmin.department.edit', ['id'=> $department->id])}}"><i class="bi-pen"></i></a>
                    </td>    
                    <td>
                        <form action="{{ route('superadmin.department.delete', $department->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn icon btn-danger">
                                <i class="bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $departments->links('pagination::bootstrap-4') }}
    </div>
</div>