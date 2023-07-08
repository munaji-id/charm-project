@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
@endpush

@section('content')
<!-- Title -->
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <form class="forms-sample" method="post" action="{{ route('cr.store') }}" >
  <div>
    <h4 class="mb-3 mb-md-0">@yield('title', $title)</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="submit" class="btn btn-primary btn-icon-text me-2 mb-2 mb-md-0" name="sumbit" id="submit">Simpan</button>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle me-2 mb-2 mb-md-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Set Ready to Development</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>
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
            <a class="pt-1px d-none d-md-block" href="#">{{ $sts->id }} {{ $sts->nama_status }}</a>
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
          {{-- <input type="text" name="id" value="{{$id}}"> --}}
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-9">
              <input type="text" name="judul" class="form-control" placeholder="">
            </div>
          </div>
          {{-- <input type="hidden" name="perusahaan_id" placeholder="" value="{{ Auth::user()->perusahaan_id}}"> --}}
          <div class="row mb-3">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Deskripsi</label>
            <div class="col-sm-9">
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
            <label class="col-sm-3 col-form-label">Tester</label>
            <div class="col-sm-4">
              <select class="form-control" name="tester">
                <option>-- Pilih Tester --</option>
                @foreach ($testers as $id => $tester)   
                  <option value="{{ $id }}" @if ($mst->user_id == $id) selected                    
                  @endif>{{ $tester }}</option>
                @endforeach
              </select>
            </div>
          </div>
          @if(Auth::user()->tipe_user_id <> '0')
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Developer</label>
            <div class="col-sm-4">
              <select class="form-control" name="developer">
                <option>-- Pilih Developer --</option>
                @foreach ($developers as $id => $developer)   
                  <option value="{{ $id }}" @if ($mst->user_id == $id) selected                    
                  @endif>{{ $developer }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Developer</label>
            <div class="col-sm-4">
              <select class="form-control" name="it_operator">
                <option>-- Pilih Developer --</option>
                @foreach ($developers as $id => $developer)   
                  <option value="{{ $id }}" @if ($mst->user_id == $id) selected                    
                  @endif>{{ $developer }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Current Processor</label>
            <div class="col-sm-4">
              <select class="form-control" name="current">
                @foreach ($currents as $id => $current)   
                  <option value="{{ $id }}">{{ $current }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Batas Waktu</label>
            <div class="col-sm-2">
              <div class="input-group date datepicker" id="datePickerStart">
                <input type="text" class="form-control" name="batas_waktu">
                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
              </div>
            </div>
          </div>
          @endif
          {{-- <button type="submit" class="btn btn-primary me-2" name="sumbit" id="submit">Simpan</button> --}}
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Log</h6>
        <div id="" class="overflow-auto border" style="max-width: auto; max-height: 250px;">
          <ul class="">
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
            <li class="">
              <h6 class="">Registration</h6>
              <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
            </li>
            <li class="event" data-date="2:30 - 4:00pm">
              <h6 class="title">Opening Ceremony</h6>
              <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
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