<div class="container-fluid">
   <footer class="py-3 mt-4">

      <div
         class="container d-flex justify-content-between align-items-center border-bottom border-light pb-3 mb-2">
         <a href="{{ route('home') }}"
            class="d-flex align-items-center justify-content-evenly link-body-emphasis text-decoration-none">
            <img src="{{ asset('images/unach-logo.png') }}" class="w-25 h-auto" alt="UNACH Rewards">
            <p class="text-light m-0 ms-2">UNACH Rewards</p>
         </a>
         <div class="justify-content-center text-center">
            <div class="col">
               <a class="text-reset text-decoration-none fw-bold">{{ __('footer.support') }}</a>
            </div>
            <div class="col flex-row">
               <ul class="nav list-unstyled">
                  <li><a class="text-light" href="#"><i class="bi bi-youtube" style="font-size: 1.8rem;"></i></a>
                  </li>
                  <li class="ms-3"><a class="text-light" href="#"><i class="bi bi-twitter-x"
                           style="font-size: 1.8rem;"></i></a>
                  </li>
                  <li class="ms-3"><a class="text-light" href="#"><i class="bi bi-facebook"
                           style="font-size: 1.8rem;"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
      <ul class="nav justify-content-center">
         <li class="nav-item"><a href="#" class="nav-link px-2 text-light">{{ __('footer.privacy_policy') }}</a>
         </li>
         <li class="nav-item"><a href="#" class="nav-link px-2 text-light">{{ __('footer.terms_of_service') }}</a>
         </li>
      </ul>
   </footer>
</div>
