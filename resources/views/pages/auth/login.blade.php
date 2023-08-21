@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
  <div class="animation-effect-1">
    <i class="feather icon-circle effect-icon text-primary"></i>
  </div>
  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://i.pinimg.com/originals/ef/5e/b6/ef5eb621bba282a76f7c850f4211b8e8.gif') }})">
            {{-- <div class="auth-side-wrapper" style="background-image: url({{ url('https://media.licdn.com/dms/image/C560BAQGtDK8mnItqZg/company-logo_200_200/0/1669548642499?e=2147483647&v=beta&t=nUI3BhDEDuCrcPFkpRJH75ti5nDeKJa4pHaW4e5015w') }}); width:2px height:2px;"> --}}

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2"><img src="{{ asset('/favicon.ico') }}" height="27" width="27"> Change<span>Request</span></a>
              <h6 class="text-muted fw-normal mb-4"><b>PT Krakatau Information Technology</b></h6>
              <br>
              @if($errors->any())
                @foreach($errors->all() as $err)
                  <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
              @endif
              <form class="forms-sample" action="{{ route('login') }}" method="post" autocomplete="off">
              @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Username</label>
                  <input type="text" class="form-control" id="userEmail" placeholder="Username" name='name'>
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" name='password'>
                </div>
                <div>
                  <input type="submit" class="btn btn-primary btn-icon-text mb-2 mb-md-0" value='Login'>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection