<div>
    <div class="card-body">
        <div>
            <h5>Cari Perusahaan</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama Perusahaan atau ID Perusahaan..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat Perusahaan</th>
                        <th>Keterangan</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($companies as $company)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $company->id }}</td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->company_address }}</td>
                    <td>{{ $company->description }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="{{route('superadmin.company.edit', ['id'=> $company->id])}}"><i class="bi-pen"></i></a>
                    </td>    
                    <td>
                        <form action="{{ route('superadmin.company.delete', $company->id)}}" method="POST">
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
        {{ $companies->links('pagination::bootstrap-4') }}
    </div>
</div>