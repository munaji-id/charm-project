@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="position-relative">
        <figure class="overflow-hidden mb-0 d-flex justify-content-center">
          <img src="{{ url('https://via.placeholder.com/1300x272') }}"class="rounded-top" alt="profile cover">
        </figure>
        <div class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
          <div>
            <img class="wd-70 rounded-circle" src="{{ url('https://via.placeholder.com/70x70') }}" alt="profile">
            <span class="h4 ms-3 text-dark">{{$user->nama_lengkap}}</span>
          </div>
          <div class="d-none d-md-block">
            @php $userID= Crypt::encrypt($user->id); @endphp
            @if( Auth::user()->id == $user->id)
            <a href="{{ route('user.edit', $userID) }}" class="btn btn-primary btn-icon-text">Edit Profile</a>
            @endif
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center p-3 rounded-bottom">
        <ul class="d-flex align-items-center m-0 p-0">
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            <i class="me-1 icon-md" data-feather="user"></i>
            <a class="pt-1px d-none d-md-block text-primary" href="#">About</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            <i class="me-1 icon-md" data-feather="lock"></i>
            <a class="pt-1px d-none d-md-block text-body" href="#">Ganti Password</a>
          </li>
          <li class="ms-3 ps-3 border-start d-flex align-items-center">
            <i class="me-1 icon-md" data-feather="video"></i>
            <a class="pt-1px d-none d-md-block text-body" href="#">Videos</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row profile-body">
  <!-- left wrapper start -->
  <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
    <div class="card rounded">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <h6 class="card-title mb-0">About</h6>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Status:</label>
          <p class="text-muted">
          @if(Cache::has('user-is-online-' . $user->id))
            <span class="text-success">Online</span>
          @else
            <span class="text-secondary">Offline</span>
          @endif</p>
        </div>
        
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Username:</label>
          <p class="text-muted">{{$user->name}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Perusahaan:</label>
          <p class="text-muted">{{$user->company->nama_perusahaan}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Tipe Pengguna:</label>
          <p class="text-muted">{{$user->tipeuser->nama_tipe_user}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
          <p class="text-muted">{{$user->email}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Kontak:</label>
          <p class="text-muted">{{$user->kontak}}</p>
        </div>
        <div class="mt-3">
          <label class="tx-11 fw-bolder mb-0 text-uppercase">Terakhir Masuk:</label>
          <p class="text-muted">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</p>
        </div>
      </div>
    </div>
  </div>
  <!-- left wrapper end -->
  <!-- middle wrapper start -->
  <div class="col-md-8 col-xl-9 middle-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card rounded">
          <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <img class="img-xs rounded-circle" src="{{ url('https://via.placeholder.com/37x37') }}" alt="">													
                <div class="ms-2">
                  <p>Mike Popescu</p>
                  <p class="tx-11 text-muted">1 min ago</p>
                </div>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh" class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2" class="icon-sm me-2"></i> <span class="">Share</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy" class="icon-sm me-2"></i> <span class="">Copy link</span></a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
            <img class="img-fluid" src="{{ url('https://via.placeholder.com/513x365') }}" alt="">
          </div>
          <div class="card-footer">
            <div class="d-flex post-actions">
              <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                <i class="icon-md" data-feather="heart"></i>
                <p class="d-none d-md-block ms-2">Like</p>
              </a>
              <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                <i class="icon-md" data-feather="message-square"></i>
                <p class="d-none d-md-block ms-2">Comment</p>
              </a>
              <a href="javascript:;" class="d-flex align-items-center text-muted">
                <i class="icon-md" data-feather="share"></i>
                <p class="d-none d-md-block ms-2">Share</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- middle wrapper end -->
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush