@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Users</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="{{route('users.create')}}">Create new</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="users-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('First Name') }}</th>
                                        <th>{{ __('Last Name') }}</th>
                                        <th>{{ __('Company') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Roles') }}</th>
                                        <th>{{ __('Last Login') }}</th>
                                        <th>{{ __('IP') }}</th>
                                        <th class="hide">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    $('#users-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{route('users.datatable')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'company', name: 'company'},
            {data: 'email', name: 'email'},
            {data: 'roles', name: 'roles'},
            {data: 'last_login_at', name: 'last_login_at'},
            {data: 'last_login_ip', name: 'last_login_ip'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [
            { responsivePriority: -1, targets: 6 }
        ]
    });
</script>
@endsection