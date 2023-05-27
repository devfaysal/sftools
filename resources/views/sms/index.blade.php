@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">SMS</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="{{route('sms.create')}}">Write new SMS</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="sms-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>{{ __('Message') }}</th>
                                        <th>{{ __('Recipients') }}</th>
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
        $('#sms-table').DataTable({
            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{route('sms.datatable')}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'message', name: 'message'},
                {data: 'recipients', name: 'recipients'}
            ]
        });
    </script>
@endsection