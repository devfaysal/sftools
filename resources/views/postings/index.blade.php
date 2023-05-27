@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Posting Schedules</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="{{route('postings.create')}}">Add new posting schedule</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="postings-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>{{ __('Schedule') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Posting account debit') }}</th>
                                        <th>{{ __('Posting account credit') }}</th>
                                        <th>{{ __('Vat') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
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
        $('#postings-table').DataTable({
            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{{route('postings.datatable')}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'schedule', name: 'schedule'},
                {data: 'amount', name: 'amount'},
                {data: 'postingaccount_debit', name: 'postingaccount_debit'},
                {data: 'postingaccount_credit', name: 'postingaccount_credit'},
                {data: 'vat', name: 'vat'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endsection