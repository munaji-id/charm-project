@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
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
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button>
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Assign to Me</h6>
        </div>
        <div class="row align-items-start mb-2">
          {{-- <div class="col-md-7">
            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
          </div> --}}
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Nomor CR</th>
                <th>Proyek</th>
                <th>Modul</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Create At</th>
              </tr>
            </thead>
            <tbody>
              @php
                $n = 1
              @endphp
              @foreach($crs as $cr)
              <tr>
                <td>{{ $n++ }}</td>
                <td>{{$cr->id}}</td>
                <td>{{$cr->nama_proyek}}</td>
                <td>{{$cr->modul->nama_modul}}</td>
                <td>{{$cr->judul}}</td>
                <td>
                  <a href="{{ route('cr.edit', $cr->id) }}"
                  <span 
                      @if ($cr->status_id == 'S1')
                        class="badge bg-primary"
                      @elseif($cr->status_id == 'S2')
                        class="badge bg-secondary"            
                      @elseif($cr->status_id == 'S3')
                        class="badge bg-warning"            
                      @elseif($cr->status_id == 'S4')
                        class="badge bg-info"            
                      @elseif($cr->status_id == 'S5')
                        class="badge bg-success"            
                      @elseif($cr->status_id == 'S6')
                        class="badge bg-info"            
                      @elseif($cr->status_id == 'S8')
                        class="badge bg-danger"            
                      @elseif($cr->status_id == 'S9')
                        class="badge bg-dark"            
                      @endif
                  >{{$cr->status->nama_status}}</span></a></td>
                <td>{{$cr->batas_waktu}}</td>                
                <td>{{$cr->created_at}}</td>
              </tr>
              @endforeach
              @if ($crs->count() == 0)
              <td colspan="9" align="center">No Data Found</td>
              @endif
                 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush