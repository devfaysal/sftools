@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title mr-3">{{ __('Edit product') }}</h4>
                        <div>
                            <x-laravel-admin::form-button method="DELETE" :action="route('plentyMarketProducts.delete', $product)" class="btn btn-sm btn-oval btn-danger">
                                Delete
                            </x-laravel-admin::form-button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            @livewire('manage-plenty-market-product', ['product' => $product])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection