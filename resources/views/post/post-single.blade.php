@extends('layouts/app')

@section('script')
<script>
$(function() {
  $.getJSON('/api/posts/'+{{$id}}, function(data){
    console.log(data)
    console.log(data.update_at)
    $('#post-title').html(data.title);
    $('#post-body').html(data.content);
    $('#post-body').append('<hr>This data was created at : '+data.created_at+'<br>This data was updated at : '+data.updated_at);
  })
});
</script>
@endsection

@section('content')
<div class="container spacing">
  <h1 class="text-center">My post</h1>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">   
        <div class="card-body">    
          <h2 id="post-title"></h2><hr>
          <div id="post-body"></div>
        </div>
      </div>
    </div>
  </div>  
</div>
@endsection