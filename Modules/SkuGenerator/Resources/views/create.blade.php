@extends('laravel-admin::layouts.app')

@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title">Sku Generator</h4>
                        <p>Add one item in each line and seperate the product name using hash(#) e.g DX#Betten Jumbo King deluxe</p>
                    </div>
                    <form method="POST" action="{{ route('sku.generate') }}">
                        @csrf
                        @livewire('sku-options')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
