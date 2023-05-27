<li class="{{ (request()->is('admin/dashboard')) ? 'active open' : '' }}">
    <a href="/admin/dashboard">
        <i class="fa fa-th-large"></i> {{ __('Dashboard') }} </a>
</li>
@can('manage_users')
<li class="{{ (request()->is('admin/users*')) ? 'active open' : '' }}">
    <a href="/admin/users">
        <i class="fa fa-users"></i> {{ __('Users') }} </a>
</li>
@endcan