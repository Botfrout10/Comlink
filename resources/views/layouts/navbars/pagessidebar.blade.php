@if (auth()->user()->admin)
    @include('layouts.navbars.sidebar.pagesadmin')
@else
    @include('layouts.navbars.sidebar.pagescom')
@endif
