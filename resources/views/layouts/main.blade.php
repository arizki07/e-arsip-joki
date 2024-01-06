<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body>
    <div id="app">

        @include('layouts.partials.sidebar')

        <div id="main">
            @yield('content')

            @include('layouts.partials.footer')
            @include('layouts.partials.script')
        </div>
    </div>

</body>

</html>
