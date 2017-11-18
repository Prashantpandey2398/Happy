@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials._error')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $article->title }}</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('articles.update', $article->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Title (Optional)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" required class="form-control" id="body">{{ $article->body }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
