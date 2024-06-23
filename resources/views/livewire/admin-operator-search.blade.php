<div>
    <div class="card-body">
        <div>
            <h5>Cari Operator</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama, ID Operator, ID Departemen, atau ID Jenis Operator..">
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
                        <th>Jenis Operator</th>
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
            @foreach ($operators as $operator)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $operator->id }}</td>
                    <td>{{ $operator->full_name }}</td>
                    <td>{{ $operator->employee_id }}</td>
                    <td>{{ optional($operator->department)->department_name ?? 'N/A'  }}</td>
                    <td>{{ optional($operator->operatorType)->operator_name_type ?? 'N/A' }}</td>
                    <td>{{ $operator->email }}</td>
                    <td>{{ $operator->phone_number }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="{{route('admin.operator.edit', ['id'=> $operator->id])}}"><i class="bi-pen"></i></a>
                    </td>    
                    <td>
                        <form action="{{ route('admin.operator.delete', $operator->id)}}" method="POST">
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
        {{ $operators->links('pagination::bootstrap-4') }}
    </div>
</div>