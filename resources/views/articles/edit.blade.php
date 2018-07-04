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
                            <textarea id="editor1" required class="form-control summernote" name="body">
                            <?php 
                                if(file_exists("uploads/artical/".$article->body)){
                                   echo file_get_contents(url("uploads/artical/".$article->body));
                                }
                                else{
                                    echo $article->body;
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
<script>

    $('#editor1').summernote({
        height: 200,
        callbacks: {
            onImageUpload: function(files) {
                sendFile(files);
            }
        }
    });

    function sendFile(files) {
        
        data = new FormData();
        for(x in files){
            data.append("file[]", files[x]);
        }
        
        $.ajax({
            data: data,
            type: "POST",
            url: "{{ secure_url('upload_artical_img?_token='.csrf_token()) }}",
            cache: false,
            contentType: false,
            processData: false,
            success: function(urls) {
                for(x in urls){
                    var imgNode = $('<img>').attr('src',urls[x]);
                    $('#editor1').summernote('insertNode', imgNode[0]);
                }
            }
        });
    }
</script>
@endsection
