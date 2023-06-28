@extends('layout.master')

@push('plugin-styles')
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

        <form class="forms-sample" method="post" action="{{ route('company.store') }}" >
          @csrf
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Perusahaan</label>
            <div class="col-sm-4">
              <input type="text" name="nama_perusahaan" class="form-control" placeholder="">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-6">
              <textarea name="alamat"class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
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
@endpush

@push('custom-scripts')
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