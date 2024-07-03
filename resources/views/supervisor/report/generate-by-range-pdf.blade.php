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
    
    .blue-line {
      width: 100%;
      height: 10px;
      background-color: #8dc6ff;
      margin-bottom: 10px;
    }
    
    .footer {
        width: 100%;
        text-align: center;
        position: fixed;
        bottom: 0px;
    }
    .pagenum:before {
        content: counter(page);
    }
  </style>
</head>
<body>
  <div class="blue-line"></div>
  <div class="date">
    Dicetak oleh {{ Auth::user()->full_name }} (supervisor) pada {{ \Carbon\Carbon::now()->format('H:i:s d-m-Y') }}
  </div>
  <h2>Penjadwalan Shift Kerja Operator</h2>
  <h1>{{ Auth::user()->company->company_name ?? 'N/A' }}</h1>
  <h2>Data Jadwal Shift Kerja Operator<br>
  Departemen: {{ $departmentName }}<br>
  Jenis Operator: {{ $operatorTypeName }}<br>
  Jumlah Jadwal: {{ $scheduleCount }}<br>
  Jumlah Operator: {{ $operatorCount }}<br>
  Berdasarkan rentang waktu dari {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} hingga {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h2><br>
  * Data jadwal ini diurutkan dari tanggal mulai
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Operator</th>
        <th>Nomor Pegawai</th>
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
        <td>{{ $schedule->user->employee_id }}</td>
        <td>{{ $schedule->shift->shift_name }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
    <div class="footer">
        <p><span class="pagenum"></span></p>
    <div class="blue-line"></div>
    </div>
</body>
</html>