<x-landing-layout>
    <x-slot name="links">
        <link rel="stylesheet" href="{{asset('assets/landing/css/neumorphism-auth.css')}}">
    </x-slot>
    <div class="segment">
        <form action="{{route('login.store')}}" method="post">
            @csrf
            <div class="segment">
                <img src="{{asset('assets/landing/img/logo.png')}}" alt="">
            </div>

            <label>
                <input name="email" type="text" placeholder="ایمیل یا شماره موبایل">
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </label>
            <label>
                <input name="password" type="password" placeholder="رمز عبور">
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </label>
            <label>
                <input class="checkbox-xl" type="checkbox" name="remember"> <span class="remember-color mx-1">مرا بخاطر بسپار</span>
            </label>
            <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}"></div>
            <br/>
            @if(Session::has('g-recaptcha-response'))
                <p class="text-danger">{{Session::get('g-recaptcha-response')}}</p>
            @endif
            <a class="btn btn-danger google-btn mb-3" href="{{route('auth.google')}}"><i class="fa fa-google-plus mx-2"></i>ورود با اکانت گوگل</a>
            <button class="main">ورود</button>
        </form>
        <a href="{{route('password.request')}}">رمز عبور خود را فراموش کرده‌اید؟ بازیابی</a><br><br>
        <a href="{{route('register')}}">عضو سایت نیستید؟ عضویت</a>
    </div>
    <x-slot name="scripts">
        <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>
    </x-slot>
</x-landing-layout>
