<!DOCTYPE html>
<head>
  <title>Jadwal</title>
  <style>
    @font-face {
      font-family: 'Calibri';
      src: url('{{ storage_path('fonts/Calibri.ttf') }}') format('truetype');
    }

    body {
      font-family: 'Calibri', sans-serif;
      font-size: 12px;
    }

    h1 {
      font-size: 18px;
    }

    .date {
      font-size: 12px;
      float: right;
      margin-top: 5px;
    }
    
    h2 {
      font-size: 14px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="date">
    Dicetak pada {{ \Carbon\Carbon::now()->format('d-m-Y') }}
  </div>
  <h2>Penjadwalan Shift Kerja Operator</h2>
  <h1>Superadmin</h1>
  <h2>Seluruh Data Jadwal Shift Kerja Operator Pada Sistem</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>ID Jadwal</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Operator</th>
        <th>ID Shift</th>
        <th>Shift</th>
      </tr>
    </thead>
    <tbody>
      @php $i = 0;
      @endphp
      @foreach($schedules as $schedule)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $schedule->id }}</td>
        <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</td>
        <td>{{ $schedule->user->full_name }}</td>
        <td>{{ $schedule->shift_id }}</td>
        <td>{{ $schedule->shift->shift_name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  * Data jadwal ini diurutkan dari tanggal mulai
</body>
</html>