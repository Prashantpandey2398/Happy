@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials._error')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new Article</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('articles.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea required class="form-control" id="body" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
