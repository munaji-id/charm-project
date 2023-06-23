@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">@yield('title', $title)</h4>
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
@endpush

@push('custom-scripts')
@endpush