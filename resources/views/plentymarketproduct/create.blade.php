@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row sameheight-container">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title">{{ __('Add product') }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            @livewire('manage-plenty-market-product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection