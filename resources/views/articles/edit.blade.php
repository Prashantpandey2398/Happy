@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials._error')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $article->title }}</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('articles.update', $article->id) }}" novalidate>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Title (Optional)</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="editor1" required class="form-control" name="body">
                            <?php 
                                if(file_exists("uploads/artical/".$article->body)){
                                   echo file_get_contents(url("uploads/artical/".$article->body));
                                }
                            ?>
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
<script>

    ClassicEditor.create( document.querySelector( '#editor1' ),{
        ckfinder: {
            uploadUrl: '{{ url('upload_artical_img?_token='.csrf_token()) }}'
        }
    });
</script>
@endsection
