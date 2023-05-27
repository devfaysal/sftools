@extends('laravel-admin::layouts.app')
@section('content')
<section class="section">
    <form method="POST" action="{{ route('postings.update', $posting) }}">
        @csrf
        @method('PATCH')
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-12 col-xl-12">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">Update Posting Schedule</h4>
                        </div>
                        @include('postings.form', [
                            'posting' => $posting
                        ])
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-success" value="Update">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection