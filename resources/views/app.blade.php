@include('components.main.header')

@include('components.navbar')
@include('components.sidebar')

<div class="content-wrapper">
    @yield('contain')
</div>
@include('components.main.footer')
