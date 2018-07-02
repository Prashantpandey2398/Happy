@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials._flash')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Articles
                    <a class="pull-right btn btn-success btn-xs" href="{{ route('articles.create') }}">+ New Article</a>
                </div>
                <div class="panel-body">
                    @if($articles->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                    <tr class='clickable-row' data-href='{{route('articles.show', $article->id)}}'>
                                        <td>
                                            {{ $article->title }}
                                        </td>
                                        <td>{{ $article->created_at->format('l jS \\of F Y') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('articles.destroy', $article->id) }}" accept-charset="UTF-8" class="form-inline pull-right">
                                                {{ method_field('DELETE') }}
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-xs btn-danger confirm-delete"><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        No Articles Found
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection
