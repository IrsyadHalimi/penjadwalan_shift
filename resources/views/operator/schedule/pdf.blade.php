<!DOCTYPE html>
<head>
  <title>Jadwal</title>
</head>
<body>
  <h1>Jadwal dari {{ request('start_date') }} hingga {{ request('end_date') }}</h1>
  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Operator</th>
        <th>Shift</th>
      </tr>
    </thead>
    <tbody>
      @foreach($schedules as $schedule)
      <tr>
        <td>{{ $schedule['start_date'] }} - {{ $schedule['end_date'] }}</td>
        <td>{{ $schedule['operator'] }}</td>
        <td>{{ $schedule['shift'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>