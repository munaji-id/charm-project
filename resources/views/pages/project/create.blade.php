@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
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

        <form class="forms-sample" method="post" action="{{ route('modul.store') }}" >
          @csrf
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Proyek</label>
            <div class="col-sm-6">
              <input type="text" name="nama_proyek" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Perusahaan</label>
            <div class="col-sm-4">
              <select class="form-control" id="perusahaan_id">
                <option>Pilih Perusahaan</option>
                @foreach ($companies as $id => $company)   
                  <option value="{{ $id }}">{{ $company }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Modul</label>
            <div class="col-sm-4">
              @foreach ($moduls as $id => $modul)  
                <div class="form-check mb-2">
                  <input type="checkbox" class="form-check-input" id="checkChecked" value="{{ $id }}">
                  <label class="form-check-label" for="checkChecked">
                    {{ $modul }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Mulai Proyek</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerStart">
                <input type="text" class="form-control" name="mulai">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Selesai Proyek</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerEnd">
                <input type="text" class="form-control" name="selesai">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
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
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush