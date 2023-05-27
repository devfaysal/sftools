<li class="{{ (request()->is('dashboard')) ? 'active open' : '' }}">
    <a href="/dashboard">
        <i class="fa fa-th-large"></i> {{ __('Dashboard') }} </a>
</li>
@can('send_sms')
<li class="{{ (request()->is('sms*')) ? 'active open' : '' }}">
    <a href="/sms">
        <i class="fa fa-comment"></i> {{ __('SMS') }} </a>
</li>
@endcan
@can('manage_posting')
<li class="{{ (request()->is('postings*')) ? 'active open' : '' }}">
    <a href="/postings">
        <i class="fa fa-th-large"></i> {{ __('Postings') }} </a>
</li>
@endcan
@can('manage_zettle_transactions')
<li class="{{ (request()->is('zettle*')) ? 'active open' : '' }}">
    <a href="/zettle">
        <i class="fa fa-th-large"></i> {{ __('Zettle Transactions') }} </a>
</li>
@endcan
@can('manage_sku_generator')
<li class="{{ (request()->is('skugenerator*')) ? 'active open' : 'ff' }}">
    <a href="/skugenerator/create">
        <i class="fa fa-th-large"></i> {{ __('Sku Generator') }} </a>
</li>
@endcan
@can('manage_plentymarket')
<li class="{{ (request()->is('plentymarket/products*')) ? 'active open' : 'ff' }}">
    <a href="/plentymarket/products">
        <i class="fa fa-th-large"></i> {{ __('Plentymarket') }} </a>
</li>
@endcan