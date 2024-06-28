@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">{{ $viewData['subtitle'] }}</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data operator kerja operator dari departemen {{ $viewData['department_data']->getDepartmentName() }}
                </p>
            </div>
            <div class="card-content">
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Operator</th>
                                <th>Nomor Pegawai</th>
                                <th>Jenis Operator</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($viewData['operator'] as $operators)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-bold-500">{{ $operators->getId() }}</td>
                                <td>{{ $operators->getName() }}</td>
                                <td>{{ $operators->getEmployeeId() }}</td>
                                <td>{{ $operators->operatorType ? $operators->operatorType->operator_name_type : 'N/A' }}</td>
                                <td>{{ $operators->getEmail() }}</td>
                                <td>{{ $operators->getPhoneNumber() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $viewData['operator']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection