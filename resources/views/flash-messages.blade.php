@if ($message = Session::get('success'))
<div class="alert alert-fill-success alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
@elseif ($message = Session::get('error_pagerole'))
<div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
@endif
@if ($message = Session::get('v'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-fill-danger alert-dismissible fade show" role="alert">
  <strong>{{ $error }}</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>
@endforeach
@endif