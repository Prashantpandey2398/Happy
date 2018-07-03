@extends('layouts.app')

@section('styles')
    <style>
        .panel-body > p > img {
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
<div class="container">
    @include('partials._flash')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            @if(!Auth::guest())
                <a href="{{ route('articles.index') }}" class="btn btn-primary btn-xs custom-btn"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>
                         <strong>{!! $article->title?$article->title:'&nbsp'!!}</strong>
                    </span>
                        @if(!Auth::guest() && Auth::User()->id == $article->user_id)
                        <span class="pull-right">
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        <a href="{{ route('articles.setting', $article->id) }}"  class="btn btn-primary btn-xs"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                        </span>
                        @endif

                </div>
                <div class="panel-body">
                    <?php 
                        if(file_exists("uploads/artical/".$article->body)){
                            echo file_get_contents(url("uploads/artical/".$article->body));
                        }
                        else{
                            echo $article->body;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
