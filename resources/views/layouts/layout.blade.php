<!DOCTYPE html>
<html lang="en">
    @include('fixed.head')
<body>
<div class="wrapper">
    @include('fixed.nav')
    @yield('slider')
    <div class="container">
        @include('fixed.message')
        @yield('content')
    </div>
    @include('fixed.footer')
    @include('fixed.scripts')
</div>
</body>

</html>
