<div>
    <div class="card-body">
        <div>
            <h5>Cari Jadwal</h5>    
        </div>
        <div>
            <input type="text" class="form-control" wire:model="searchTerm" placeholder="Cari dengan ID Jadwal atau ID Operator..">
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 mx-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Jadwal</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Nama Operator</th>
                        <th>Shift</th>
                        <th>Warna Label</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
            <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td class="text-bold-500">{{ $schedule->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</td>
                    <td>{{ $schedule->user->full_name }}</td>
                    <td>{{ $schedule->shift->shift_name }}</td>
                    <td><button class="btn btn-{{ $schedule->shift->label_color }} px-4"></button></td>
                    <td>
                        <a class="btn icon btn-primary" href="#" data-url="{{ route('superadmin.schedule.edit', ['id' => $schedule->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                            <i class="bi-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteForm-{{ $schedule->getId() }}" action="{{ route('superadmin.schedule.delete', $schedule->getId())}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $schedule->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                            <i class="bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $schedules->links('pagination::bootstrap-4') }}
    </div>
</div>