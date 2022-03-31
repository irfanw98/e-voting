 <header id="header" id="home">
     <div class="scrollTop" onclick="scrollToTop();"></div>
     <div class="header-top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
                 </div>
                 <div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
                     <a href=""><span class="lnr lnr-phone-handset"></span> <span class="text">+0231 8512191</span></a>
                     <a href=""><span class="lnr lnr-envelope"></span> <span class="text">Kampusku@ac.id</span></a>
                 </div>
             </div>
         </div>
     </div>
     <div class="container main-menu">
         <div class="row align-items-center justify-content-between d-flex">
             <div id="logo">
                 <a href="#home"><img src="{{ asset('frontend/img/logo2020.png') }}" class="img-thumbnail rounded-circle" alt="" title="" width="60px" /></a>
             </div>
             <nav id="nav-menu-container">
                 <ul class="nav-menu">
                    <li>
                         <div class="flex-center position-ref full-height">
                            <a href="#paslon" class="login">CALON</a>
                         </div>
                     </li>
                     <li>
                         <div class="flex-center position-ref full-height">
                            <a href="#vm" class="login">VISI&MISI</a>
                         </div>
                     </li>
                     <li>
                         <div class="flex-center position-ref full-height">
                            <a href="#hasil" class="login">HASIL</a>
                         </div>
                     </li>
                     <li>
                         <div class="flex-center position-ref full-height">
                            <a href="#voting" class="login">VOTING</a>
                         </div>
                     </li>
                     <li>
                         <div class="flex-center position-ref full-height">
                            <a href="{{ route('login') }}" class="login">Login</a>
                         </div>
                     </li>
                 </ul>
             </nav><!-- #nav-menu-container -->
         </div>
     </div>
 </header><!-- #header -->