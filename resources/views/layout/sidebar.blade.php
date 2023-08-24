<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Change<span>Request</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['dashboard']) }}">
        <a href="{{ url('dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item nav-category">Apps</li>
      <li class="nav-item {{ active_class(['cr']) }}">
        <a href="{{ url('cr') }}" class="nav-link">
          <i class="link-icon" data-feather="git-pull-request"></i>
          <span class="link-title">Change Request</span>
        </a>
      </li>
      {{-- <li class="nav-item {{ active_class(['cr2']) }}">
        <a href="{{ url('cr') }}" class="nav-link">
          <i class="link-icon" data-feather="search"></i>
          <span class="link-title">Pencarian CR</span>
        </a>
      </li> --}}
      <li class="nav-item nav-category">master data</li>
      <li class="nav-item {{ active_class(['company*']) }} or
        {{ active_class(['modul*']) }} or
        {{ active_class(['project*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#masterdata" role="button" aria-expanded="{{ is_active_route(['company*']) }} or
        {{ is_active_route(['modul*']) }} or 
        {{ is_active_route(['project*']) }} or
        {{ is_active_route(['status*']) }} or
        {{ is_active_route(['tipeuser*']) }} or
        {{ is_active_route(['user*']) }} or
        {{ is_active_route(['tipeattach*']) }}
        " aria-controls="masterdata">
          <i class="link-icon" data-feather="database"></i>
          <span class="link-title">Master Data</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['company*']) }} or
        {{ show_class(['modul*']) }} or 
        {{ show_class(['project*']) }} or
        {{ show_class(['status*']) }} or
        {{ show_class(['tipeuser*']) }} or
        {{ show_class(['tipeuser*']) }} or
        {{ show_class(['user*']) }} or
        {{ show_class(['tipeattach*']) }}" id="masterdata">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('company') }}" class="nav-link {{ active_class(['company*']) }}">Perusahaan</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('modul') }}" class="nav-link {{ active_class(['modul*']) }}">Modul</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('project') }}" class="nav-link {{ active_class(['project*']) }}">Proyek</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('status') }}" class="nav-link {{ active_class(['status*']) }}">Status</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('tipeuser') }}" class="nav-link {{ active_class(['tipeuser*']) }}">Tipe Pengguna</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('user') }}" class="nav-link {{ active_class(['user*']) }}">Pengguna</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('tipeattach') }}" class="nav-link {{ active_class(['tipeattach*']) }}">Tipe Lampiran</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">repositori</li>
      <li class="nav-item {{ active_class(['fs']) }}">
        <a href="{{ url('fs') }}" class="nav-link" >
          <i class="link-icon" data-feather="file"></i>
          <span class="link-title">Documents</span>
        </a> 
      </li>
    </ul>
  </div>
</nav>