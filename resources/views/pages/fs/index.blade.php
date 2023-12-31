@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table td {
        word-break: break-word;
        vertical-align: top;
        white-space: normal !important;
    }
  </style>
  @endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">@yield('title', $title) </h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    
    <!-- <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button> -->
    {{-- <a href="{{ route('modul.create') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="layers"></i>
      Tambah
    </a> --}}
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <!-- <h6 class="card-title">Data Table</h6>
        <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Tipe Dokumen</th>
                <th>Judul</th>
                <th>Nama File</th>
                <th align="center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($attachments as $attachment)
              <tr>
                <td>{{$attachment->attachment_id}}</td>
                <td>{{$attachment->nama_file}}</td>
                <td>{{$attachment->path}}</td>
                <td align="center">
                  <a href="{{ route('cr.download', $attachment->path) }}" style="padding-right: 6px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="link-icon" data-feather="download" style="height: 18px; width: 18px;"></i></a>
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

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush