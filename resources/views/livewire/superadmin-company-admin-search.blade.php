<div>
    <div class="card-body">
        <div>
            <h5>Cari Admin Perusahaan</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan Nama, ID Admin atau ID Perusahaan..">
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
            @foreach ($company_admins as $company_admin)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $company_admin->id }}</td>
                    <td>{{ $company_admin->full_name }}</td>
                    <td>{{ $company_admin->employee_id }}</td>
                    <td>{{ optional($company_admin->company)->company_name ?? 'N/A'  }}</td>
                    <td>{{ $company_admin->email }}</td>
                    <td>{{ $company_admin->phone_number }}</td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('superadmin.company_admin.edit', ['id' => $company_admin->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $company_admin->getId() }}" action="{{ route('superadmin.company_admin.delete', $company_admin->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $company_admin->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $company_admins->links('pagination::bootstrap-4') }}
    </div>
</div>