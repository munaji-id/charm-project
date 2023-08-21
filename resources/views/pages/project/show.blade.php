@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
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
    <h4 class="mb-3 mb-md-0">@yield('title', $title) {{$project->id}}</h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          {{-- <input type="text" name="id" value="{{$id}}"> --}}
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Proyek</label>
            <div class="col-sm-9" >
              <div class="p-2"> : {{$project->nama_proyek}} </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Perusahaan</label>
            <div class="col-sm-9">
              <div class="p-2"> :  {{$project->company->nama_perusahaan}} </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Mulai Proyek</label>
            <div class="col-sm-9">
              <div class="p-2"> : {{$project->mulai}}</div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Tanggal Selesai Proyek</label>
            <div class="col-sm-9">
              <div class="p-2"> : {{$project->selesai}} </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="col-md-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Modul</h6>
        </div><br>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Modul</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $n = 1
              @endphp
              @foreach ($project_moduls as $projectmod) 
              <tr>
                <td>{{ $n++ }}</td>
                <td>{{$projectmod->modul->nama_modul}}</td>
                <td>{{$projectmod->modul->deskripsi}}</td>
                <td>
                  <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$projectmod->modul_id}}"><i class="link-icon" data-feather="trash-2" style="height: 18px; width: 18px"></i></a>
                </td>
              </tr>
              <div class="modal fade" id="exampleModalCenter{{$projectmod->modul_id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                      Apakah Anda yakin akan menghapus Modul <b>{{$projectmod->modul->nama_modul}}</b> dari Proyek <b>{{$project->nama_proyek}}</b> ?
                    </div>
                    <div class="modal-footer">
                      <form action="{{ route('projectmod.destroy', $projectmod->modul_id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="proyek_id" value="{{$projectmod->proyek_id}}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                      </form>
                  </div>
                </div>
              </div>
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
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush