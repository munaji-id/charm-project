@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
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
    <a href="{{ route('tipeattach.create') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="paperclip"></i>
      Tambah
    </a>
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
                <th>ID</th>
                <th>Nama Tipe Lampiran</th>
                <th>Deskripsi</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tipeattachs as $tipeattach)
              <tr>
                <td>{{$tipeattach->id}}</td>
                <td>{{$tipeattach->nama_tipe_attachment}}</td>
                <td>{{$tipeattach->deskripsi}}</td>
                <td align="center">
                  @php $tipeattachID= Crypt::encrypt($tipeattach->id); @endphp
                  <a href="{{ route('tipeattach.edit', $tipeattachID) }}" style="padding-right: 8px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="link-icon" data-feather="edit" style="height: 18px; width: 18px;"></i></a>
                  <a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$tipeattach->id}}"><i class="link-icon" data-feather="trash-2" style="height: 18px; width: 18px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"></i></a>
                </td>
                <div class="modal fade" id="exampleModalCenter{{$tipeattach->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                      </div>
                      <div class="modal-body">
                        Apakah Anda yakin akan menghapus tipeattach <b>{{$tipeattach->id}} - {{$tipeattach->nama_tipe_attachment}} </b> ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <form action="{{ route('tipeattach.destroy', $tipeattach->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Ya</button>
                        </form>
                    </div>
                  </div>
                </div>
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