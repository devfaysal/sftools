@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title mb-2">Posting Details</h4>
                        <a class="btn btn-sm btn-oval btn-info" href="{{route('postings.edit', $posting)}}">Edit</a>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="postings-table" class="table table-hover" style="width:100%">
                                <tbody>
                                    <tr>
                                        <th width="250px">Amount</th>
                                        <th width="20px">:</th>
                                        <td>{{ $posting->amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vat</th>
                                        <th>:</th>
                                        <td>{{ $posting->vat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Posting Account debit</th>
                                        <th>:</th>
                                        <td>{{ $posting->postingaccount_debit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Posting Account credit</th>
                                        <th>:</th>
                                        <td>{{ $posting->postingaccount_credit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Posting Text</th>
                                        <th>:</th>
                                        <td>{{ $posting->postingtext }}</td>
                                    </tr>
                                    <tr>
                                        <th>Schedule</th>
                                        <th>:</th>
                                        <td>{{ $posting->schedule }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>:</th>
                                        <td>{{ $posting->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <x-laravel-admin::form-button class="btn btn-sm btn-warning btn-oval" :action="route('postings.postNow', $posting)">
                                Post now
                            </x-laravel-admin::form-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection