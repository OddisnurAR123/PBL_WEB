@php
    $activeMenu = $activeMenu ?? '';
@endphp

<div class="sidebar">

  <!-- SidebarSearch Form -->
  <div class="form-inline mt-2">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <!-- Manajemen Jenis Kegiatan -->
      <li class="nav-item">
        <a href="{{ url('/jenis_kegiatan') }}" class="nav-link {{ ($activeMenu == 'manajemen-jenis-kegiatan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tasks"></i>
          <p>Jenis Kegiatan</p>
        </a>
      </li>

      <!-- Manajemen Jenis Pengguna -->
      <li class="nav-item">
        <a href="{{ url('/jenis_pengguna') }}" class="nav-link {{ ($activeMenu == 'manajemen-jenis-pengguna') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-tag"></i>
          <p>Jenis Pengguna</p>
        </a>
      </li>

      <!-- Manajemen Jabatan Kegiatan -->
      <li class="nav-item">
        <a href="{{ url('/jabatan_kegiatan') }}" class="nav-link {{ ($activeMenu == 'manajemen-jabatan-kegiatan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-shield"></i>
          <p>Jabatan Kegiatan</p>
        </a>
      </li>

      <!-- Manajemen Data Pengguna -->
      <li class="nav-item">
        <a href="{{ url('/manajemen-data-pengguna') }}" class="nav-link {{ ($activeMenu == 'manajemen-data-pengguna') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Data Pengguna</p>
        </a>
      </li>
      <!-- Manajemen Kegiatan -->
      <li class="nav-item {{ ($activeMenu == 'manajemen-kegiatan') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ ($activeMenu == 'manajemen-kegiatan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tasks"></i>
          <p>Kegiatan<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('/kegiatan') }}" class="nav-link {{ ($activeMenu == 'kegiatan') ? 'active' : '' }}">
              <i class="far fa-calendar-alt nav-icon"></i>
              <p>Input Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/agenda') }}" class="nav-link {{ ($activeMenu == 'agenda-kegiatan') ? 'active' : '' }}">
              <i class="far fa-calendar-alt nav-icon"></i>
              <p>Agenda Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/progres-kegiatan') }}" class="nav-link {{ ($activeMenu == 'progres-kegiatan') ? 'active' : '' }}">
              <i class="far fa-chart-bar nav-icon"></i>
              <p>Progres Kegiatan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/kegiatan-eksternal') }}" class="nav-link {{ ($activeMenu == 'kegiatan-eksternal') ? 'active' : '' }}">
              <i class="fas fa-external-link-alt nav-icon"></i>
              <p>Kegiatan Eksternal</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Daftar Kegiatan -->
      <li class="nav-item {{ ($activeMenu == 'daftar-kegiatan') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ ($activeMenu == 'daftar-kegiatan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-list"></i>
          <p>Daftar Kegiatan<i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('/laporkan-progres-agenda') }}" class="nav-link {{ ($activeMenu == 'laporkan-progres-agenda') ? 'active' : '' }}">
              <i class="fas fa-clipboard-check nav-icon"></i>
              <p>Laporkan Progres Agenda</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/detail-kegiatan') }}" class="nav-link {{ ($activeMenu == 'detail-kegiatan') ? 'active' : '' }}">
              <i class="fas fa-info-circle nav-icon"></i>
              <p>Detail Kegiatan</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Statistik Kinerja -->
      <li class="nav-item">
        <a href="{{ url('/statistik-kinerja') }}" class="nav-link {{ ($activeMenu == 'statistik-kinerja') ? 'active' : '' }}">
          <i class="nav-icon fas fa-chart-line"></i>
          <p>Statistik Kinerja</p>
        </a>
      </li>

      <!-- Dokumen Draft Surat Tugas -->
      <li class="nav-item">
        <a href="{{ url('/dokumen-draft-surat-tugas') }}" class="nav-link {{ ($activeMenu == 'dokumen-draft-surat-tugas') ? 'active' : '' }}">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>Dokumen Draft Surat Tugas</p>
        </a>
      </li>

      <!-- Unggah Surat Tugas -->
      <li class="nav-item">
        <a href="{{ url('/unggah-surat-tugas') }}" class="nav-link {{ ($activeMenu == 'unggah-surat-tugas') ? 'active' : '' }}">
          <i class="nav-icon fas fa-upload"></i>
          <p>Unggah Surat Tugas</p>
        </a>
      </li>

      <!-- Pengaturan Profil -->
      <li class="nav-item">
        <a href="{{ url('/pengaturan-profil') }}" class="nav-link {{ ($activeMenu == 'pengaturan-profil') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user-cog"></i>
          <p>Pengaturan Profil</p>
        </a>
      </li>

      <!-- Keluar -->
      <li class="nav-item">
        <a href="{{ url('/logout') }}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
      </li>

  </ul>
</div>
