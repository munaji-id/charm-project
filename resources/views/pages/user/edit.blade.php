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

        {{-- <h6 class="card-title">Horizontal Form</h6> --}}

        <form class="forms-sample" method="post" action="{{ route('user.update',$user->id) }}">
          @csrf
          @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Langkap</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nama_lengkap" value="{{ $user->nama_lengkap }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Perusahaan</label>
            <div class="col-sm-4">
              <select class="form-control" name="perusahaan_id">
                <option>Pilih Perusahaan</option>
                @foreach ($companies as $id => $company)   
                  <option value="{{ $id }}" @if ($user->perusahaan_id == $id) selected                    
                  @endif>{{ $company }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tipe Pengguna</label>
            <div class="col-sm-4">
              <select class="form-control" name="tipe_user_id">
                <option>Pilih Tipe Pengguna</option>
                @foreach ($utypes as $id => $utype)   
                  <option value="{{ $id }}" @if ($user->tipe_user_id == $id) selected                    
                  @endif>{{ $utype }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
              <input type="email" class="form-control" autocomplete="off" name="email" value="{{ $user->email }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Kontak</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="kontak" value="{{ $user->kontak }}">
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