@auth()
    @include('layouts.navbars.pagesnavs.auth')
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest
