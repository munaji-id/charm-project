@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">@yield('title', $title)</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="button" class="btn btn-secondary btn-icon-text mb-2 mb-md-0" onclick="history.back()">
      <i class="btn-icon-prepend" data-feather="arrow-left"></i>
      Kembali
    </button>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample" method="post" action="{{ route('tipeuser.store') }}" >
          @csrf
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID</label>
            <div class="col-sm-1">
              <input type="text" name="id" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Tipe User</label>
            <div class="col-sm-4">
              <input type="text" name="nama_tipe_user" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-6">
              <textarea name="deskripsi"class="form-control" rows="5"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2" name="submit" id="submit">Simpan</button>
        </form>

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
  <script>
    $(document).ready(function(){
      $("form").submit(function() {
          $(this).submit(function() {
            return false;
          });
          return true;
      }); 
    });
  </script>
@endpush