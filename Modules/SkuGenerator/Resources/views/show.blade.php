@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <div class="d-flex">
                            <h4 class="title mr-2">Generated Sku's</h4>
                            <a class="mr-2" href="{{route('sku.export', $cacheKey)}}" target="_blank">Export to Csv</a>
                            <a class="btn btn-sm btn-warning" href="{{route('sku.create')}}">Generate again</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sku</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skus as $index => $sku)
                                <tr>
                                    <td width="50px">{{ $index+1 }}.</td>
                                    <td>{{ $sku }}</td>
                                </tr>
                            @endforeach
                            @if($price)
                                <tr>
                                    <th colspan="2">Sku price: {{$price}}</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection