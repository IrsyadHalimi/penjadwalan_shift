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
            @foreach ($schedules as $schedule)
                <tr>
                    <td class="text-bold-500">{{ $schedule->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</td>
                    <td>{{ $schedule->user->full_name }}</td>
                    <td>{{ $schedule->shift->shift_name }}</td>
                    <td><button class="btn btn-{{ $schedule->shift->label_color }} px-4"></button></td>
                    <td>
                        <a class="btn icon btn-primary" href="{{route('admin.schedule.edit', ['id'=> $schedule->id])}}"><i class="bi-pen"></i></a>
                    </td>    
                    <td>
                        <form action="{{ route('admin.schedule.delete', $schedule->id)}}" method="POST">
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
        {{ $schedules->links('pagination::bootstrap-4') }}
    </div>
</div>