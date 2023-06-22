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

        {{-- <h6 class="card-title">Horizontal Form</h6> --}}

        <form class="forms-sample" method="post" action="{{ route('company.update',$company->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Perusahaan</label>
            <div class="col-sm-4">
              <input type="text" name="nama_perusahaan" class="form-control" placeholder="Test" value="{{ $company->nama_perusahaan }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-6">
              <textarea name="alamat"class="form-control" id="exampleFormControlTextarea1" rows="5">{{ $company->alamat }}</textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Simpan</button>
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
@endpush