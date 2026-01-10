<!DOCTYPE html>
<html lang="en">
@include('fixed.head')
<body>
<div class="wrapper">

    @include('fixed.nav')
    @if(session()->has("admin"))
        @php $rola = "admin"; @endphp
        @if(request()->routeIs('user'))
            <div class="container">
                <div class="row">
                    @include('fixed.message')
                    @yield('content')
                </div>
            </div>

        @else
            @include('fixed.adminPageLinks')
            <div class="container">
                <div class="row">
                    @include('fixed.message')
                    @yield('content')
                </div>
            </div>
        @endif

    @elseif(session()->has("user"))
        @php $rola = "user"; @endphp

        <div class="container">
            <div class="row">
                @include('fixed.message')
                @yield('content')
            </div>
        </div>

    @elseif(!session()->has("user") && !session()->has("admin"))
        <div class="container">
            <div class="row">
                @include('fixed.404')
            </div>
        </div>

    @endif
        @include('fixed.footer')
        @include('fixed.scripts')

</div>
</body>

</html>
