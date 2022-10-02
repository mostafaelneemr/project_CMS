<x-guest-layout>
    {{-- <x-auth-card> --}}
        <x-slot name="logo">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>

<section class="height-100vh d-flex align-items-center page-section-ptb login" >
    <div class="container">
    <div class="row justify-content-center no-gutters vertical-align">
          <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(images/login-inner-bg.jpg);">
            <div class="login-fancy">
                <h2 class="text-white mb-20">Hello Blog!</h2>
                <p class="mb-20 text-white">Create Blog Bolo website with the exclusive multi-purpose responsive template along with powerful features.</p>
                <ul class="list-unstyled  pos-bot pb-30">
                    <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                    <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                </ul>
            </div> 
        </div>

        <div class="col-lg-4 col-md-6 bg-white">
            <div class="login-fancy pb-40 clearfix">
                <h3 class="mb-30">Sign In To Admin Bolo</h3>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    <!-- Email Address -->
                    <div class="section-field mb-20">
                        <x-label for="email" class="mb-10" :value="__('Email')" />

                        <x-input id="email" class="web form-control" type="email" name="email" :value="old('email')" value="admin@mail.com" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="section-field mb-20">
                        <x-label for="password" class="mb-10" :value="__('Password')" />

                        <x-input id="password" class="Password form-control"
                                        type="password"
                                        name="password"
                                        value="123456789"
                                        placeholder="Enter Password"
                                        required autocomplete="current-password" />
                    </div>


                    <div class="section-field">
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                            <a class="float-right" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                            
                            <x-button class="button">
                                <span>{{ __('Log in') }}</span>
                                <i class="fa fa-check"></i>
                            </x-button>
                            
                        </div>
                    </div>            
                </form>

            </div> 
        </div>
    </div>
    </div>
</section>
 
{{-- </x-auth-card> --}}
</x-guest-layout>
