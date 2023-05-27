@if(Auth::guard('admin')->check())
    @include('laravel-admin-custom-views.admin-menus')
@else
    @include('laravel-admin-custom-views.client-menus')
@endif