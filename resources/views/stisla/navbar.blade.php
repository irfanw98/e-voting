 <nav class="navbar navbar-expand-lg main-navbar">
     <form class="form-inline mr-auto">
         <ul class="navbar-nav mr-3">
             <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
             <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
         </ul>
     </form>
     <ul class="navbar-nav navbar-right">
         <?php 
            $users = \Auth::user()->role;
            // dd($users);
            $cekId = \DB::select("SELECT * from voting where user_id > 0");

            $mahasiswa = \DB::select("SELECT * from m_mahasiswa");
         ?>

         @if ($users == "mahasiswa")
         <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell countNotif"> {{ count($cekId) }}</i></a>
            @foreach($cekId as $cek)
             <div class="dropdown-menu dropdown-list dropdown-menu-right">
                 <div class="dropdown-header">Notifikasi</div>
                 <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item">
                      <div class="dropdown-item-icon bg-success text-white">
                        <i class="fas fa-check p-3"></i>
                      </div>
                      <div class="dropdown-item-desc">
                        <p>Terimakasih, sudah berpartisipasi dalam pemilihan BEM.</p>
                      </div>
                    </a>
                 </div>
             </div>
             @endforeach
         </li>
         @else
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell countNotif"> {{ count($cekId) }}</i></a>
            @foreach($mahasiswa as $mhs)
             <div class="dropdown-menu dropdown-list dropdown-menu-right">
                 <div class="dropdown-header">Notifikasi</div>
                 <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item">
                      <div class="dropdown-item-icon bg-success text-white">
                        <i class="fas fa-check p-3"></i>
                      </div>
                      <div class="dropdown-item-desc">
                        <p>{{ $mhs->nama }} telah selesai melakukan voting.</p>
                      </div>
                    </a>
                 </div>
             </div>
             @endforeach
         </li>
         @endif
         
         <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

            @if(\Auth::user()->foto == '')
             <img alt="image" src="{{ asset('assets/img/avatar/avatar-3.png') }}" class="rounded-circle mr-1" height="30px">
             @else
             <img alt="image" src="{{ asset('storage') }}/{{ Auth::user()->foto }}" class="rounded-circle mr-1" height="30px">
            @endif
                 
                 <div class="d-sm-none d-lg-inline-block">
                     {{ Auth::user()->name }}
                 </div>
             </a>
             <div class="dropdown-menu dropdown-menu-right">
                 <a href="{{ url('setting') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                 </a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </div>
         </li>
     </ul>
 </nav>