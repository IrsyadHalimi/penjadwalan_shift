@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif
</div>
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hoverable rows</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table
                        rows
                        within a
                        <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                    </p>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['company'] as $companies)
                            <tr>
                                <td class="text-bold-500">{{ $companies->getId() }}</td>
                                <td>{{ $companies->getCompanyName() }}</td>
                                <td>{{ $companies->getCompanyAddress() }}</td>
                                <td>
                                    <a href="{{route('admin.company.edit', ['id'=> $companies->getId()])}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection