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
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/dashboard') }}" class="nav-link">
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
      <li class="nav-item {{ active_class(['cr2']) }}">
        <a href="{{ url('cr') }}" class="nav-link">
          <i class="link-icon" data-feather="search"></i>
          <span class="link-title">Pencarian CR</span>
        </a>
      </li>
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
      {{-- <li class="nav-item {{ active_class(['company']) }} or {{ active_class(['company/create']) }} ">
        <a href="{{ url('company') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Perusahaan</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item {{ active_class(['modul']) }} or {{ active_class(['modul/create']) }} ">
        <a href="{{ url('modul') }}" class="nav-link">
          <i class="link-icon" data-feather="layers"></i>
          <span class="link-title">Modul</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item {{ active_class(['project']) }} or {{ active_class(['project/create']) }}">
        <a href="{{ url('project') }}" class="nav-link">
          <i class="link-icon" data-feather="trello"></i>
          <span class="link-title">Proyek</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item {{ active_class(['status']) }} or {{ active_class(['status/create']) }} ">
        <a href="{{ url('status') }}" class="nav-link">
          <i class="link-icon" data-feather="chevrons-right"></i>
          <span class="link-title">Status</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['tipeuser']) }}">
        <a href="{{ url('tipeuser') }}" class="nav-link">
          <i class="link-icon" data-feather="user-check"></i>
          <span class="link-title">Tipe Pengguna</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['user']) }} "> 
        <a href="{{ url('user') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Pengguna</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['tipeattach']) }}">
        <a href="{{ url('tipeattach') }}" class="nav-link">
          <i class="link-icon" data-feather="paperclip"></i>
          <span class="link-title">Jenis Lampiran</span>
        </a>
      </li> --}}

      <li class="nav-item nav-category">repositori</li>
      <li class="nav-item {{ active_class(['general/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#general" role="button" aria-expanded="{{ is_active_route(['general/*']) }}" aria-controls="general">
          <i class="link-icon" data-feather="file"></i>
          <span class="link-title">Functional Spec</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['general/*']) }}" id="general">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/general/blank-page') }}" class="nav-link {{ active_class(['general/blank-page']) }}">Blank page</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/general/faq') }}" class="nav-link {{ active_class(['general/faq']) }}">Faq</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/general/invoice') }}" class="nav-link {{ active_class(['general/invoice']) }}">Invoice</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/general/profile') }}" class="nav-link {{ active_class(['general/profile']) }}">Profile</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/general/pricing') }}" class="nav-link {{ active_class(['general/pricing']) }}">Pricing</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/general/timeline') }}" class="nav-link {{ active_class(['general/timeline']) }}">Timeline</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['auth/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" role="button" aria-expanded="{{ is_active_route(['auth/*']) }}" aria-controls="auth">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Technical Doc</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['auth/*']) }}" id="auth">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/auth/login') }}" class="nav-link {{ active_class(['auth/login']) }}">Login</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/auth/register') }}" class="nav-link {{ active_class(['auth/register']) }}">Register</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['error/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#error" role="button" aria-expanded="{{ is_active_route(['error/*']) }}" aria-controls="error">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">User Manual</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['error/*']) }}" id="error">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/error/404') }}" class="nav-link {{ active_class(['error/404']) }}">404</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/error/500') }}" class="nav-link {{ active_class(['error/500']) }}">500</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="https://www.nobleui.com/laravel/documentation/docs.html" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
<!-- <nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted mb-2">Sidebar:</h6>
    <div class="mb-3 pb-3 border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="https://www.nobleui.com/laravel/template/demo1/">
        <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="https://www.nobleui.com/laravel/template/demo2/">
        <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
      </a>
    </div>
  </div>
</nav> -->