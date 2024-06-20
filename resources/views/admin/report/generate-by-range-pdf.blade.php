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
    Dicetak pada {{ \Carbon\Carbon::now()->format('H:i:s d-m-Y') }}
  </div>
  <h2>Penjadwalan Shift Kerja Operator</h2>
  <h1>{{ Auth::user()->company->company_name ?? 'N/A' }}</h1>
  <h2>Data Jadwal Shift Kerja Seluruh Operator dari {{ \Carbon\Carbon::parse(request('start_date'))->format('d-m-Y') }} hingga {{ \Carbon\Carbon::parse(request('end_date'))->format('d-m-Y') }}</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Operator</th>
        <th>Shift</th>
      </tr>
    </thead>
    <tbody>
      @php $i = 0;
      @endphp
      @foreach($schedules as $schedule)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d-m-Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d-m-Y') }}</td>
        <td>{{ $schedule->user->full_name }}</td>
        <td>{{ $schedule->shift->shift_name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <br>
  * Data jadwal ini diurutkan dari tanggal mulai
</body>
</html>