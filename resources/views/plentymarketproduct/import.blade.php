@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block d-flex">
                        <h4 class="title">Import Products</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p class="text-info font-weight-bold">Csv/Excel Structure. Heading row is required</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>product_name</th>
                                        <th>mu_varient</th>
                                        <th>ms_varient</th>
                                        <th>on_varient</th>
                                        <th>minimum_stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Can be empty</td>
                                        <td>Required</td>
                                        <td>Required</td>
                                        <td>Required</td>
                                        <td>Can be empty</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            @livewire('plenty-market-prodcut-import')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
    
@endsection