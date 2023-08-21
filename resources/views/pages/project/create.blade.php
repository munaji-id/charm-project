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

        {{-- <h6 class="card-title">Horizontal Form</h6> --}}

        <form class="forms-sample" method="post" action="{{ route('project.store') }}" >
          @csrf
          <input type="hidden" name="id" value="{{$id}}">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Proyek</label>
            <div class="col-sm-6">
              <input type="text" name="nama_proyek" value="{{$mst->nama_proyek}}" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Perusahaan</label>
            <div class="col-sm-4">
              <select class="form-control" name="perusahaan_id">
                <option>Pilih Perusahaan</option>
                @foreach ($companies as $id => $company)   
                  <option value="{{ $id }}" @if ($mst->perusahaan_id == $id) selected                    
                  @endif>{{ $company }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Modul</label>
            <div class="col-sm-4">
              @foreach ($moduls as $modul)  
                <div class="form-check mb-2">
                  <input type="checkbox" class="form-check-input" id="checkChecked" @if(cek_modul($mst->id,$modul->id)>0) checked @endif value="{{ $modul->id }}" name="modul_id[]">
                  <label class="form-check-label" for="checkChecked">
                    {{ $modul->nama_modul }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Mulai Proyek</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerStart">
                <input type="text" class="form-control" name="mulai" value="{{$mst->mulai}}">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Selesai Proyek</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerEnd">
                <input type="text" class="form-control" name="selesai" value="{{$mst->selesai}}">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2" name="sumbit" id="submit">Simpan</button>
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