<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('dashboard') }}">KAMPUSKU</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">VT</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DASHBOARD</li>
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link"><i class="fa fa-fire"></i><span>Dashboard</span></a>
                <!-- <ul class="dropdown-menu">
                    <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul> -->
            </li>
            <li class="menu-header">VOTING</li>
            <li class="nav-item">
                @if(auth()->user()->role == 'admin')
                    <a href="{{ url('mahasiswa') }}" class="nav-link"><i class="fa fa-list-alt"></i> <span>Mahasiswa</span></a>
                    <a href="{{ url('kandidat') }}" class="nav-link"><i class="fa fa-address-card"></i> <span>Kandidat</span></a>
                    <a href="{{ url('periode') }}" class="nav-link"><i class="fa fa-calendar"></i> <span>Periode Pemilihan</span></a>
                    <a href="{{ url('hasil') }}" class="nav-link"><i class="fa fa-columns"></i> <span>Hasil Pemilihan</span></a>
                    <a href="{{ url('keluar') }}" class="nav-link"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                @endif
                @if(auth()->user()->role == 'mahasiswa')
                    <a href="{{ url('pemilihan') }}" class="nav-link"><i class="fa fa-pencil"></i> <span>Pemilihan</span></a>
                    <a href="{{ url('keluar') }}" class="nav-link"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
                @endif
            </li>
        </ul>
    </aside>
</div>