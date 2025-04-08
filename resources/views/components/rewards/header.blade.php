<header class="sticky-top">
   <nav class="navbar navbar-expand-lg align-items-center" style="background-color: #003070;">
      <div class="container-fluid">
         <a href="{{ route('home') }}"
            class="d-flex align-items-center justify-content-evenly link-body-emphasis text-decoration-none">
            <img src="{{ asset('images/unach-logo.png') }}" class="w-25 h-auto" alt="UNACH Rewards">
            <p class="text-light m-0 ms-2">UNACH Rewards</p>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: #fff;"></span>
         </button>
         <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
               <h5 class="offcanvas-title" id="offcanvasNavbarLabel">UNACH Rewards</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body justify-content-lg-end">
               {{-- <ul class="navbar-nav nav nav-pills mx-lg-auto mb-2 mb-lg-0 flex-column flex-lg-row gap-3">
                  <li class="nav-item"><a href="#" class="btn btn-primary fw-bold" aria-current="page"><i
                           class="bi bi-stars me-2"></i>Ganar</a></li>
                  <li class="nav-item"><a href="#" class="btn btn-outline-warning"><i
                           class="bi bi-bag-dash-fill me-2"></i>Canjear</a></li>
                  <li class="nav-item"><a href="#" class="btn btn-outline-warning"><i
                           class="bi bi-person-fill-check me-2"></i>Estado</a></li>
                  <li class="nav-item"><a href="#" class="btn btn-outline-warning"><i
                           class="bi bi-trophy-fill me-2"></i>Ganadores</a></li>
               </ul> --}}
               @if (Route::has('login'))
                  <div class="btn-group">
                     @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary text-light">
                           {{__('header.dashboard')}}
                        </a>
                        <div class="btn-group" role="group">
                           <button class="btn btn-outline-primary dropdown-toggle w-100" type="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <span class="rounded-2 me-1 bg-body-secondary p-1 text-light">{{ auth()->user()->initials() }}</span>
                              <span class="text-light">{{ auth()->user()->name }}</span>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-lg-end w-100 p-1">
                              <li><a href="{{ route('settings.profile') }}" class="btn btn-outline-primary w-100 mb-1"><i
                                       class="bi bi-person-vcard me-2"></i>{{ __('header.profile') }}</a></li>
                              <li>
                                 <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100"><i
                                          class="bi bi-door-open me-2"></i>{{ __('header.logout') }}</button>
                                 </form>
                              </li>
                           </ul>
                        </div>
                     @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary text-light">
                           {{__('header.login')}}
                        </a>

                        @if (Route::has('register'))
                           <a href="{{ route('register') }}" class="btn btn-outline-primary text-light">
                              {{__('header.register')}}
                           </a>
                        @endif
                     @endauth
                  </div>
               @endif
            </div>
         </div>
      </div>
   </nav>
</header>
