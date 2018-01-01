@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials._error')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Setting {{ $article->title }}</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('articles.update', $article->id) }}" novalidate>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="title">Make Public (Optional)</label>
                                <select name="make_public" id="" class="form-control">
                                    <option value="0" {{$article->make_public == 0? 'selected': ''}} >No</option>
                                    <option value="1" {{$article->make_public == 1? 'selected': ''}} >Yes</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
