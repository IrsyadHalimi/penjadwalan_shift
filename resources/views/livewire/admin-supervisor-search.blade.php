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
            @foreach ($supervisors as $supervisor)
                <tr>
                    <td class="text-bold-500">{{ $supervisor->id }}</td>
                    <td>{{ $supervisor->full_name }}</td>
                    <td>{{ $supervisor->employee_id }}</td>
                    <td>{{ $supervisor->department->department_name }}</td>
                    <td>{{ $supervisor->email }}</td>
                    <td>{{ $supervisor->phone_number }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="{{route('admin.supervisor.edit', ['id'=> $supervisor->id])}}"><i class="bi-pen"></i></a>
                    </td>    
                    <td>
                        <form action="{{ route('admin.supervisor.delete', $supervisor->id)}}" method="POST">
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
        {{ $supervisors->links('pagination::bootstrap-4') }}
    </div>
</div>