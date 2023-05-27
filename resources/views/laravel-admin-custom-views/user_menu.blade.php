@if(Auth::guard('admin')->check())
<a class="dropdown-item" href="{{route('admins.changePassword')}}">
    <i class="fa fa-lock icon"></i> Change Password </a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa fa-power-off icon"></i> Logout </a>
    <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
        @csrf
    </form>
@else
<a class="dropdown-item" href="{{route('clients.changePassword')}}">
    <i class="fa fa-lock icon"></i> Change Password </a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="{{route('clients.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa fa-power-off icon"></i> Logout </a>
    <form id="logout-form" action="{{route('clients.logout')}}" method="POST" style="display: none;">
        @csrf
    </form>
@endif