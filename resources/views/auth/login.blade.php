<x-guest-layout title="">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
          <img src="{{asset('logo.jpg')}}" alt="logo">
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form class="pt-3" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
              <x-text-input id="email" placeholder="Username" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
          </div>
          <div class="form-group">
              <x-text-input id="password" class="block mt-1 w-full"
              type="password"
              name="password"
              placeholder="Password"
              required autocomplete="current-password" />
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
          </div>
          <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
              <label for="remember_me" class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                Keep me signed in
              </label>
            </div>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
            @endif

            
          </div>
          <div class="text-center mt-4 font-weight-light">
            Don't have an account? <a href="{{route("register")}}" class="text-primary">Create</a>
          </div>
        </form>
      </div>
</x-guest-layout>
