
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" href="{{route('dashboard')}}"><img src="{{asset('logo.jpg')}}" class="mr-2" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img src="{{asset('logo.jpg')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
     
      <ul class="navbar-nav navbar-nav-right">
        
        <x-notification>
           <x-notification-msg :msg="'Application Error'" :time="'2sec'" :icon="'airballoon'"/>
        </x-notification-msg>
        
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
           {{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{route('profile')}}">
              <i class="ti-settings text-primary"></i>
              Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <a class="dropdown-item" :href="route('logout')" onclick="event.preventDefault();
            this.closest('form').submit();">
              <i class="ti-power-off text-primary"></i>
              Logout
            </a>
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>