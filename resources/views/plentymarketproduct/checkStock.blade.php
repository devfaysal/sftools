@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title mr-3">{{ __('Status') }}</h4>
                        <a class="btn btn-sm btn-info" href="{{ route('plentyMarketProducts.index') }}">Return to products</a>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p><a href="https://www.matratzenunion.de">https://www.matratzenunion.de</a>
                            @if(200 == $mu_status)
                                <span class="badge badge-success">Stock updated</span>
                            @else
                                <span class="badge badge-danger">Stock update failed</span>
                            @endif
                            </p>
                            <p><a href="https://www.markenschlaf.de">https://www.markenschlaf.de</a>
                            @if(200 == $ms_status)
                                <span class="badge badge-success">Stock updated</span>
                            @else
                                <span class="badge badge-danger">Stock update failed</span>
                            @endif
                            </p>
                            <p><a href="https://www.onletto.de">https://www.onletto.de</a>
                            @if(200 == $on_status)
                                <span class="badge badge-success">Stock updated</span>
                            @else
                                <span class="badge badge-danger">Stock update failed</span>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection