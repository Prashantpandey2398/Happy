@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials._flash')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a href="{{ route('articles.index') }}" class="btn btn-default btn-xs"><- Back</a>
            <div class="panel panel-default">
                <div class="panel-heading">Details
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default btn-xs pull-right">Edit</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <td>{{ $article->id }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $article->title }}</td>
                        </tr>
                        <tr>
                            <th>Body</th>
                            <td>{{ $article->body }}</td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $article->created_at->format('l jS \\of F Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
