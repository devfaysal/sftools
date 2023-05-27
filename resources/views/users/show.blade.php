@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title"> {{$user->name}}</h4>
                        <a class="btn btn-sm btn-oval btn-info mx-1 ml-auto" href="{{ route('users.edit', $user) }}"> Edit</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table class="table">
                                <tr>
                                    <th width="120px">Title</th>
                                    <td width="10px">:</td>
                                    <td>{{$user->title ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>First Name</th>
                                    <td>:</td>
                                    <td>{{$user->first_name ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>:</td>
                                    <td>{{$user->last_name ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td>:</td>
                                    <td>{{$user->company ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>:</td>
                                    <td>{{$user->phone ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{$user->email ?? 'N/A'}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="title-block d-flex">
                        <form class="mx-1 ml-auto" method="POST" action="/user/users/{{$user->id}}">
                            @method('DELETE')
                            @csrf
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-oval btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Roles</h4>

                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12 mb-3">
                            @foreach ($user->roles as $role)
                                <span class="badge badge-success">{{$role->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Permission</h4>

                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12 mb-3">
                            @foreach ($user->permissions as $permission)
                                <span class="badge badge-success">{{$permission->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection