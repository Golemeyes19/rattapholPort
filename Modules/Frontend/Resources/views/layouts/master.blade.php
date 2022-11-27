

<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend::layouts.global.header')
        @include('frontend::layouts.global.style')

    </head>
    <body>

        @include('frontend::layouts.assets.nav')

        @yield('content')

        @include('frontend::layouts.assets.footer')
        @include('frontend::layouts.global.script')
    </body>
</html>
