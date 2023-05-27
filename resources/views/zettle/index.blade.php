@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <div class="row">
        <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
            <div class="card" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title">Zettle Transactions</h4>
                        <div class="mt-3">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <x-date-field name="start_date" value="{{ request('start_date')}}" label="Start Date"/>
                                    </div>
                                    <div class="col-md-4">
                                        <x-date-field name="end_date" value="{{ request('end_date')}}" label="End Date"/>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-info">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-12 col-sm-12">
                            <table id="transactions-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="hide">#</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Transaction Type') }}</th>
                                        <th>{{ __('Transaction Uuid') }}</th>
                                        <th>{{ __('Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $index => $transaction)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>€ {{ $transaction['amount'] / 100 }}</td>
                                            <td>{{ $transaction['originatorTransactionType'] }}</td>
                                            <td>{{ $transaction['originatingTransactionUuid'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaction['timestamp'])->format('Y-m-d h:i:s a') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
        $('#transactions-table').DataTable({
            order: [[ 0, "asc" ]],
            responsive: true
        });
    </script>
@endsection