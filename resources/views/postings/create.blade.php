@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <form method="POST" action="{{ route('postings.store') }}">
        @csrf
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Create new Posting Schedule</h4>
                        </div>
                        @include('postings.form', [
                            'posting' => new App\Models\Posting(),
                            'accounts' => $accounts
                        ])
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-success" value="Create">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection