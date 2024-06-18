<div>
    <input type="text" wire:model="searchTerm" placeholder="Cari Jadwal..">
    <ul>
        @foreach ($schedules as $schedule)
            <li>{{ $schedule->id }}</li>
        @endforeach
    </ul>
</div>
