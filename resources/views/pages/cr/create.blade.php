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
    <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control border-primary bg-transparent">
    </div>
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-secondary btn-icon-text mb-2 mb-md-0" onclick="history.back()">
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
          <li class="ms-3 ps-3 d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="user"></i> --}}
            <a class="pt-1px d-none d-md-block text-primary" href="#">1. Create</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="lock"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">2. Ready to Development</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">3. In development</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">4. Ready to Test DEV</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">5. Seccessfully Tested DEV</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">6. Ready to Test QA</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">7. Seccessfully Tested QA</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">8. Imported Into PROD</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            {{-- <i class="me-1 icon-md" data-feather="video"></i> --}}
            <a class="pt-1px d-none d-md-block text-body" href="#">9. Reject</a>
          </li>
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

        <form class="forms-sample" method="post" action="{{ route('cr.store') }}" >
          @csrf
          {{-- <input type="text" name="id" value="{{$id}}"> --}}
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-6">
              <input type="text" name="judul" class="form-control" placeholder="">
            </div>
          </div>
          <input type="hidden" name="perusahaan_id" placeholder="" value="{{ Auth::user()->perusahaan_id}}">
          <div class="row mb-3">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-6">
              <textarea name="deskripsi"class="form-control" rows="5"></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Proyek</label>
            <div class="col-sm-4">
              <select id="proyek_id" class="form-control" name="proyek_id">
                <option value="0">-- Pilih Proyek --</option>
                @foreach ($projects as $id => $project)   
                  <option value="{{ $id }}" @if ($mst->proyek_id == $id) selected                    
                  @endif>{{ $project }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Modul</label>
            <div class="col-sm-4">
              <select id="modul_id" class="form-control" name="modul_id" >
                <option value="0">-- Pilih Modul --</option>
                {{-- @foreach ($moduls as $id => $modul)   
                  <option value="{{ $id }}" @if ($mst->modul_id == $id) selected                    
                  @endif>{{ $modul }}</option>
                @endforeach --}}
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Developer</label>
            <div class="col-sm-4">
              <select class="form-control" name="user_id">
                <option>Pilih Developer</option>
                @foreach ($developers as $id => $developer)   
                  <option value="{{ $id }}" @if ($mst->user_id == $id) selected                    
                  @endif>{{ $developer }}</option>
                @endforeach
              </select>
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
  {{-- <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script> --}}
@endpush

@push('custom-scripts')
  {{-- <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script>
    $(document).ready(function(){
      $("form").submit(function() {
          $(this).submit(function() {
            return false;
          });
          return true;
      }); 
    });
  </script> --}}
  <!-- Script -->
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
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
               url: 'http://localhost:8000/getModul/'+id,
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

                             var id = response['data'][i].id;
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