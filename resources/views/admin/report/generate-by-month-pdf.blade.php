<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Jadwal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header, .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .header {
            top: 0px;
        }
        .footer {
            bottom: 0px;
        }
        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>
<body>

    <div>
        <h1>Laporan Jadwal Bulanan</h1>
        <h1>Bulan: {{ $selectedMonth }}</h1>
        <p>Departemen: {{ $departmentName }}</p>
        <p>Jenis Operator: {{ $operatorTypeName }}</p>
        <p>Total Jadwal: {{ $scheduleCount }}</p>
        <p>Total Operator: {{ $operatorCount }}</p>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Operator</th>
                    <th>Shift</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $index => $schedule)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $schedule->user->full_name }}</td>
                        <td>{{ $schedule->shift->shift_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Halaman <span class="pagenum"></span></p>
    </div>

</body>
</html>
