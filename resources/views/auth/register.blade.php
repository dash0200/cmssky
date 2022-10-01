<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
</style>

<x-guest-layout title="Sign Up">
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <!-- Session Status -->
              <x-auth-session-status class="mb-4 text-danger" :status="session('status')" />

              <!-- Validation Errors -->
              <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
        <div class="brand-logo">
          <img src="{{asset('logo.jpg')}}" alt="logo">
        </div>
        <h4>New here?</h4>
        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
        <form class="pt-3" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="form-group">
            <x-text-input id="name" placeholder="Name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
          </div>
          <div class="form-group"> 
            <x-text-input id="email" autocomplete="off" placeholder="Phone" class="block mt-1 w-full" type="number" name="email" :value="old('email')" required />
          </div>
          <div class="form-group">
            <x-text-input id="password" class="block mt-1 w-full"
              type="password"
              placeholder="Password"
              name="password"
              required autocomplete="new-password" />
          </div>
          <div class="form-group">
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
            type="password"
            placeholder="Confirm Password"
            name="password_confirmation" required />
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
          </div>
          <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="{{route("login")}}" class="text-primary">Login</a>
          </div>
        </form>
      </div>
</x-guest-layout>
