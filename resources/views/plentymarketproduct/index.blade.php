@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Plentymarket Products</h4>
                        <a class="btn btn-success btn-oval btn-sm ml-auto" href="{{route('plentyMarketProducts.create')}}">{{__('Add new product')}}</a>
                        <a class="btn btn-info btn-oval btn-sm ml-auto" href="{{route('plentyMarketProducts.import')}}">{{__('Import product')}}</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="postings-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>{{ __('Product Name') }}</th>
                                        <th>{{ __('MU-Varient') }}</th>
                                        <th>{{ __('MS-Varient') }}</th>
                                        <th>{{ __('ON-Varient') }}</th>
                                        <th>{{ __('Stock') }}</th>
                                        <th>{{ __('Minimum Stock') }}</th>
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
            ajax: '{{route('plentyMarketProducts.datatable')}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'product_name', name: 'product_name'},
                {data: 'mu_varient', name: 'mu_varient'},
                {data: 'ms_varient', name: 'ms_varient'},
                {data: 'on_varient', name: 'on_varient'},
                {data: 'stock', name: 'stock'},
                {data: 'minimum_stock', name: 'minimum_stock'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endsection