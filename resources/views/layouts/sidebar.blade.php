@php
    $activeMenu = $activeMenu ?? '';
    $kodeJenisPengguna = auth()->user()->jenisPengguna->id_jenis_pengguna ?? '';
@endphp

<div class="sidebar" style="background-color: #1e293b; color: white;">
    <!-- Sidebar Search Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar" style="background: #4b5563; color: #ffffff;">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav nav-pills nav-sidebar flex-column mt-3" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard untuk Admin -->
        @if(Auth::user()->id_jenis_pengguna == 1)
            <li class="nav-item">
                <a href="{{ url('/dashboard_admin') }}" class="nav-link {{ ($activeMenu == 'dashboard_admin') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'dashboard_admin') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        @endif
        <!-- Dashboard untuk Pimpinan -->
        @if(Auth::user()->id_jenis_pengguna == 2)
            <li class="nav-item">
                <a href="{{ url('/kegiatan_pimpinan') }}" class="nav-link {{ ($activeMenu == 'kegiatan_pimpinan') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'kegiatan_pimpinan') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        @endif

        <!-- Dashboard untuk User -->
        @if(Auth::user()->id_jenis_pengguna == 3)
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'dashboard') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        @endif

        <!-- Data Master -->
        @if(Auth::user()->id_jenis_pengguna == 1)
            <li class="nav-item {{ str_contains($activeMenu, 'data-master') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ str_contains($activeMenu, 'data-master') ? 'active' : '' }}" style="color: {{ str_contains($activeMenu, 'data-master') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Data Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/jenis_pengguna') }}" class="nav-link {{ ($activeMenu == 'data-master-jenis-pengguna') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'data-master-jenis-pengguna') ? '#3b82f6' : '#ffffff' }};">
                            <i class="nav-icon fas fa-user-tag"></i>
                            <p>Jenis Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/pengguna') }}" class="nav-link {{ ($activeMenu == 'data-master-pengguna') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'data-master-pengguna') ? '#3b82f6' : '#ffffff' }};">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/kategori_kegiatan') }}" class="nav-link {{ ($activeMenu == 'data-master-kategori-kegiatan') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'data-master-kategori-kegiatan') ? '#3b82f6' : '#ffffff' }};">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Kategori Kegiatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/jabatan_kegiatan') }}" class="nav-link {{ ($activeMenu == 'data-master-jabatan-kegiatan') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'data-master-jabatan-kegiatan') ? '#3b82f6' : '#ffffff' }};">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Jabatan Kegiatan</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <!-- Statistik Kinerja -->
        @if(in_array(Auth::user()->id_jenis_pengguna, [1, 2]))
            <li class="nav-item">
                <a href="{{ url('/kinerja-dosen') }}" class="nav-link {{ ($activeMenu == 'kinerja-dosen') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'kinerja-dosen') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>Statistik Kinerja</p>
                </a>
            </li>
        @endif

        <!-- Kegiatan -->
        @if(in_array(Auth::user()->id_jenis_pengguna, [1, 3]))
            <li class="nav-item">
                <a href="{{ url('/kegiatan') }}" class="nav-link {{ ($activeMenu == 'kegiatan') ? 'active' : '' }}" style="color: {{ ($activeMenu == 'kegiatan') ? '#3b82f6' : '#ffffff' }};">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Kegiatan</p>
                </a>
            </li>
        @endif

        <!-- Keluar -->
        @if(in_array(Auth::user()->id_jenis_pengguna, [1, 2, 3]))
            <li class="nav-item">
                <a href="{{ url('/logout') }}" 
                    class="nav-link {{ ($activeMenu == 'logout') ? 'active' : '' }}" 
                    style="background-color: #f87171; color: #ffffff; font-weight: bold;">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
            </li>
        @endif    
    </ul>
</div> 
<style>
    .sidebar {
        position: fixed;
        /* top: 0;
        left: 0; */
        /* height: 100%; Pastikan sidebar penuh dari atas ke bawah */
        /* overflow-y: auto; Agar konten dalam sidebar dapat di-scroll jika panjang */
        width: 250px; /*Sesuaikan dengan lebar sidebar Anda */
        background-color: #1e293b; /* Warna latar sidebar */
        color: white;
        /* z-index: 1000; Pastikan sidebar berada di atas elemen lain */
    } 
    .content-wrapper {
        margin-left: 250px; /* Sesuaikan dengan lebar sidebar */
        padding: 20px; /* Opsional: Tambahkan padding untuk estetika */
    }

    #searchInput {
        margin-bottom: 10px; /* Beri jarak di bawah */
        width: 100%;         /* Sesuaikan lebar */
        max-width: 300px;    /* Jika ingin batas maksimal */
        box-sizing: border-box;
    }

</style>