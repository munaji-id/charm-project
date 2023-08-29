@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  
  <div>
    <h4 class="mb-3 mb-md-0">@yield('title', $title)</h4>
  </div>
  <form class="forms-sample" method="post" action="{{ route('cr.update',$cr->id) }}" autocomplete="off">
    @csrf
    @method('PUT')
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    @if ($cr->status_id <> 'S8')
    <button type="submit" class="btn btn-primary btn-icon-text me-2 mb-2 mb-md-0" name="sumbit" id="submit">Simpan</button>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle me-2 mb-2 mb-md-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if ($cr->status_id == 'S1')
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>
        @elseif ($cr->status_id == 'S2')
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>                    
        @elseif ($cr->status_id == 'S3')
          {{-- <a class="dropdown-item" href="">Ready to Test in DEV</a>   --}}
          <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>

          @elseif ($cr->status_id == 'S4')
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>    
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenterb{{$cr->id}}">Reset Status Into Development</a>                    
        @elseif ($cr->status_id == 'S5') 
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>                   
        @elseif ($cr->status_id == 'S6')
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>    
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenterb{{$cr->id}}">Reset Status Into Development</a>                    
        @elseif ($cr->status_id == 'S7')
        <a class="dropdown-item" href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$cr->id}}">@yield('set_sts', $set_sts)</a>   
        @endif        
        
      </div>
    </div>
    @endif
    
    <button type="button" class="btn btn-secondary btn-icon-text me-2 mb-2 mb-md-0" onclick="history.back()">
      <i class="btn-icon-prepend" data-feather="arrow-left"></i>
      Kembali
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
      <h6 class="card-title">Status Overview</h6>
      <div class="d-flex justify-content-center p-3 rounded-bottom">
        <ul class="d-flex align-items-center m-0 p-0">
          @foreach($status as $sts)
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="user"></i> --}}
            <a class="pt-1px d-none d-md-block @if ($cr->status_id == $sts->id) text-danger                    
              @endif" href="#">{{ $sts->id }} {{ $sts->nama_status }}</a>
          </li>
          @endforeach
        </ul>
      </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <h6 class="card-title">Detail</h6>
          @csrf
          @method('PUT')
          {{-- <input type="text" name="id" value="{{$id}}"> --}}
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-9">
              <input type="text" name="judul" class="form-control" placeholder="" value="{{ $cr->judul }}">
            </div>
          </div>
          {{-- <input type="hidden" name="perusahaan_id" placeholder="" value="{{ Auth::user()->perusahaan_id}}"> --}}
          <div class="row mb-3">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
              <textarea name="deskripsi"class="form-control" rows="5">{{ $cr->deskripsi }}</textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Proyek</label>
            <div class="col-sm-4">
              <select id="proyek_id" class="form-control" name="proyek_id">
                <option value="">-- Pilih Proyek --</option>
                @foreach ($projects as $id => $project)   
                  <option value="{{ $id }}" @if ($cr->proyek_id == $id) selected                    
                  @endif>{{ $project }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Modul</label>
            <div class="col-sm-4">
              <select id="modul_id" class="form-control" name="modul_id" >
                {{-- <option value="">-- Pilih Modul --</option> --}}
                  @if($moduls->count() > 0 )
                     @foreach($moduls as $id => $modul)
                       <option value="{{$modul->modul_id}}" @if($cr->modul_id == $modul->modul_id  ) selected @endif>{{$modul->nama_modul}}</option>
                     @endforeach
                   @endif
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Functional</label>
            <div class="col-sm-4">
              <select class="form-control" name="tester">
                <option value="">-- Pilih Tester --</option>
                @foreach ($testers as $id => $tester)   
                  <option value="{{ $id }}" @if ($cr->tester == $id) selected                    
                  @endif >{{ $tester }}</option>
                @endforeach
              </select>
            </div>
          </div>
          @if(Auth::user()->tipe_user_id <> 'USE')
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Abaper</label>
            <div class="col-sm-4">
              <select class="form-control" name="developer">
                <option value="">-- Pilih Developer --</option>
                @foreach ($developers as $id => $developer)   
                  <option value="{{ $id }}" @if ($cr->developer == $id) selected                    
                  @endif >{{ $developer }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Basis</label>
            <div class="col-sm-4">
              <select class="form-control" name="it_operator">
                <option value="">-- Pilih IT Operator --</option>
                @foreach ($it_operators as $id => $it_operator)   
                  <option value="{{ $id }}" @if ($cr->it_operator == $id) selected                    
                  @endif>{{ $it_operator }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Batas Waktu</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerStart">
                <input type="text" class="form-control" name="batas_waktu" value=" {{ $cr->batas_waktu }}">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>
          @endif
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Current Processor</label>
            <div class="col-sm-4">
              <select class="form-control" name="current" @readonly(true)>
                @foreach ($currents as $id => $current)   
                  <option value="{{ $id }}">{{ $current }}</option>
                @endforeach
              </select>
            </div>
          </div>
          {{-- <button type="submit" class="btn btn-primary me-2" name="sumbit" id="submit">Simpan</button> --}}
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Attachments --}}
@if(Auth::user()->tipe_user_id <> 'USE')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Lampiran</h6>
        @if ($cr->status_id <> 'S8')
        <div class="d-flex align-items-center flex-wrap text-nowrap">
          <button type="button" class="btn btn-primary btn-xs mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#varyingModal" data-bs-whatever="@fat">
            <i class="btn-icon-prepend" data-feather="clip"></i>
            Lampiran
          </button>
        </div>
        @endif
        <br>
        <div id="" class="overflow-auto border" style="max-width: auto; max-height: 250px;">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Dokumen</th>
                  <th>Judul</th>
                  <th>File</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $n = 1
                @endphp
                @foreach($attachments as $attachment)
                <tr>
                  <td>{{ $n++ }}</td>
                  <td>{{$attachment->tipeattacment->nama_tipe_attachment}}</td>
                  <td>{{$attachment->nama_file}}</td>
                  <td>{{$attachment->path}}</td>
                  <td>
                    <a href="{{ route('cr.download', $attachment->path) }}" style="padding-right: 6px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="link-icon" data-feather="download" style="height: 18px; width: 18px;"></i>Download</a>
                    @if ($cr->status_id <> 'S8')
                    <a href="{{ route('cr.destroy_attachment', $attachment->id) }}" style="padding-right: 6px; color:red" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i class="link-icon" data-feather="edit"></i>Hapus</a>
                    @endif
                    {{-- <a href="{{ route('cr.download', $attachment->path ) }}">Download</a> <a href="{{ route('cr.download', $attachment->path ) }}">Hapus</a> --}}</td>
                </tr>
                @endforeach
                @if ($attachments->count() == 0)
                <td colspan="9" align="center">No Data Found</td>
                @endif
                   
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
{{-- End Attachments --}}
{{-- Logs --}}
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Log</h6>
        <div id="" class="overflow-auto border" style="max-width: auto; max-height: 250px;">
          <ul class="" style="padding: 5px">
            @foreach($logs as $log)
            <li class="" style="padding: 5px">
              <h6 class="" style="padding: 3px">{{$log->created_at}}</h6>
              <p>{{$log->log}}</p>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- End Logs --}}
{{-- Modal Confirmation --}}
<div class="modal fade" id="exampleModalCenter{{$cr->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        @if ($cr->status_id == 'S1')
          Apakah Anda yakin akan merubah status ke <b>Ready to Development ?</b>
        @elseif ($cr->status_id == 'S2')
          Apakah Anda yakin akan merubah status ke <b>In Development ?</b>
        @elseif ($cr->status_id == 'S3')
          Apakah Anda yakin akan merubah status ke <b>Ready to Test in DEV ?</b>
        @elseif ($cr->status_id == 'S4')
          Apakah Anda yakin akan merubah status ke <b>Successfully Testing in DEV ?</b>
        @elseif ($cr->status_id == 'S5')
          Apakah Anda yakin akan merubah status ke <b>Ready to Testing ?</b>
        @elseif ($cr->status_id == 'S6')
          Apakah Anda yakin akan merubah status ke <b>Successfully Tested QA?</b>
        @elseif ($cr->status_id == 'S7')
          Apakah Anda yakin akan merubah status ke <b>Imported Into PROD ?</b>
        @endif        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <form action="{{ route('cr.status_3',$cr->id) }}" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="status_id" @if ($cr->status_id == 'S1')
                                                       value="S2"
                                                       @elseif ($cr->status_id == 'S2')
                                                       value="S3"
                                                       @elseif ($cr->status_id == 'S3')
                                                       value="S4"
                                                       @elseif ($cr->status_id == 'S4')
                                                       value="S5"
                                                       @elseif ($cr->status_id == 'S5')
                                                       value="S6"
                                                       @elseif ($cr->status_id == 'S6')
                                                       value="S7"
                                                       @elseif ($cr->status_id == 'S7')
                                                       value="S8"
                                                       @endif
          >
          <input type="hidden" name="developer" value="{{ $cr->developer }}">
          <input type="hidden" name="tester" value="{{ $cr->tester }}">
          <input type="hidden" name="it_operator" value="{{ $cr->it_operator }}">
          <input type="hidden" name="user_id" value="{{ $cr->user_id }}">
          <input type="hidden" name="proyek_id" value="{{ $cr->proyek_id }}">
          <button type="submit" class="btn btn-danger">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalCenterb{{$cr->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        @if ($cr->status_id == 'S4' OR $cr->status_id == 'S6')
          Apakah Anda yakin akan mengembalikan status ke <b>In Development ?</b>
        @endif        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <form action="{{ route('cr.status_1',$cr->id) }}" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="status_id" value="S3">
          <input type="hidden" name="developer" value="{{ $cr->developer }}">
          <input type="hidden" name="tester" value="{{ $cr->tester }}">
          <input type="hidden" name="it_operator" value="{{ $cr->it_operator }}">
          <input type="hidden" name="user_id" value="{{ $cr->user_id }}">
          <input type="hidden" name="proyek_id" value="{{ $cr->proyek_id }}">
          <button type="submit" class="btn btn-danger">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- End Modal Confirmation --}}
{{-- Modal Attachment --}}
<div class="modal fade" id="varyingModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="varyingModalLabel">Lampirkan Berkas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('cr.upload') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input class="form-control" type="text" name="cr_id" value="{{ $cr->id}}">
          <div class="mb-3">
            <label for="recipient-name" class="form-label">Dokumen:</label>
            <select class="form-control" name="attachment_id">
              @foreach ($tipe_atts as $tipe_att)   
                <option value="{{ $tipe_att->id }}">{{ $tipe_att->nama_tipe_attachment }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="form-label">Judul:</label>
            <textarea class="form-control" id="message-text" name="nama_file"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label" for="formFile">File upload:</label>
            <input class="form-control" type="file" id="formFile" name="file">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- End Modal Attachments --}}
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/demo.js') }}"></script>
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
  <!-- Script -->
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
  <script>
  $(document).ready(function(){

      // Department Change
      $('#proyek_id').change(function(){

           // Department id
           var id = $(this).val();

           // Empty the dropdown
           $('#modul_id').find('option').not(':first').remove();

           // AJAX request 
           $.ajax({
               url: '{{url('getModul')}}/'+id,
               type: 'get',
               dataType: 'json',
               success: function(response){

                   var len = 0;
                   if(response['data'] != null){
                        len = response['data'].length;
                   }

                   if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){

                             var id = response['data'][i].modul_id;
                             var name = response['data'][i].nama_modul;

                             var option = "<option value='"+id+"'>"+name+"</option>";

                             $("#modul_id").append(option); 
                        }
                   }

               }
           });
      });
  });
  </script>
@endpush