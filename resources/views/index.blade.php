<x-layouts.rewards-layout>

   <div class="container-fluid col-xxl-11 px-4">
      <div class="row flex-lg-row-reverse align-items-center justify-content-center g-5 py-5 px-3"
         style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.80) 100%), url('{{ asset('images/libro25_unach.jpg') }}'); background-size: cover;">
         <div class="col-10 col-sm-7 col-lg-5">
            <img src="{{ asset('images/rewardslogo.png') }}" class="d-block mx-lg-auto img-fluid" alt="UNACH Rewards logo"
               loading="lazy">
         </div>
         <div class="col-lg-7">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">UNACH Rewards</h1>
            <p class="lead">{!! __('index.lead') !!}</p>
         </div>
      </div>
   </div>

   <div class="container-fluid">
      <div class="row d-flex align-items-center">
         <div class="col d-flex justify-content-center">
            <div class="card text-center mb-3 border-0 w-100 w-full" style="width: 18rem;">
               <div class="card-body">
                  <i class="bi bi-check-circle"
                     style="font-size: 4rem; background: linear-gradient(to right, #ff7e5f, #feb47b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                  <h3 class="card-title"
                     style="background: linear-gradient(to right, #ff7e5f, #feb47b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                     {{ __('index.login-title') }}</h3>
                  <p class="card-text">{{ __('index.login-desc') }}</p>
                  </p>
                  @if (auth()->check())
                     <a class="btn btn-outline-warning" data-bs-toggle="tooltip"
                        data-bs-title="{{ __('index.already-logged') }}">{{ __('index.login-btn') }}</a>
                  @else
                     <a href="{{ route('login') }}" class="btn btn-outline-warning">{{ __('index.login-btn') }}</a>
                  @endif
               </div>
            </div>
         </div>
         <div class="col d-flex justify-content-center">
            <div class="card text-center mb-3 border-0 w-100 w-full" style="width: 18rem;">
               <div class="card-body">
                  <i class="bi bi-person-workspace"
                     style="font-size: 4rem; background: linear-gradient(to right, #d4fc79, #96e6a1); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                  <h3 class="card-title"
                     style="background: linear-gradient(to right, #d4fc79, #96e6a1); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                     {{ __('index.panel-title') }}</h3>
                  <p class="card-text">{{ __('index.panel-desc') }}</p>
                  </p>
                  @if (auth()->check())
                     <a href="{{ route('dashboard') }}"
                        class="btn btn-outline-success">{{ __('index.panel-btn') }}</a>
                  @else
                     <a href="{{ route('login') }}" class="btn btn-outline-success">{{ __('index.panel-btn') }}</a>
                  @endif
               </div>
            </div>
         </div>
         <div class="col d-flex justify-content-center">
            <div class="card text-center mb-3 border-0 w-100 w-full" style="width: 18rem;">
               <div class="card-body">
                  <i class="bi bi-heart"
                     style="font-size: 4rem; background: linear-gradient(to right, #79e2fc, #837afa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                  <h3 class="card-title"
                     style="background: linear-gradient(to right, #79e2fc, #837afa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                     {{ __('index.points-title') }}</h3>
                  <p class="card-text">{{ __('index.points-desc') }}
                  </p>
                  @if (auth()->check())
                     <a href="{{ route('progress') }}" class="btn btn-outline-info">{{ __('index.points-btn') }}</a>
                  @else
                     <a href="{{ route('login') }}" class="btn btn-outline-info">{{ __('index.points-btn') }}</a>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</x-layouts.rewards>
