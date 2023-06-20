@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0"></h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    
    <!-- <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button> -->
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="user-plus"></i>
      Tambah
    </button>
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
                <th>Nama</th>
                <th>Perusahaan</th>
                <th>Role</th>
                <th>Modul</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Munaji</td>
                <td>PT Krakatau Information Technlogy</td>
                <td>Abaper</td>
                <td>Technical Modul</td>
                <td>munaji.id@gmail.com</td>
                <td>085215929889</td>
                <td>                </td>
              </tr>
              <tr>
                <td>Erpan Gustira</td>
                <td>PT Krakatau Information Technlogy</td>
                <td>Functional</td>
                <td>Controlling</td>
                <td>erpan.g@gmail.com</td>
                <td>085215929880</td>
                <td>                </td>
              </tr>
              <tr>
                <td>Ucu Yudi</td>
                <td>PT Krakatau Information Technlogy</td>
                <td>Functional</td>
                <td>Financial</td>
                <td>munaji.id@gmail.com</td>
                <td>085215929889</td>
                <td>                </td>
              </tr>
              <tr>
                <td>Dewi Bulan</td>
                <td>PT Krakatau Sarana Properti</td>
                <td>End User</td>
                <td>Financial</td>
                <td>dewi.bulan@gmail.com</td>
                <td>085215929889</td>
                <td>                </td>
              </tr>
              <tr>
                <td>Munaji</td>
                <td>PT Krakatau Information Technlogy</td>
                <td>Abaper</td>
                <td>Technical Modul</td>
                <td>munaji.id@gmail.com</td>
                <td>085215929889</td>
                <td>                </td>
              </tr>
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