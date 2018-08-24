@extends('layouts/app')


@section('script')
<script>  

$(function() {
  var url_string = window.location.href
  // console.log(url_string)
  var url = new URL(url_string);
  // console.log(url)
  // console.log(url.searchParams.get("page"))
  var para = url.searchParams.get("page");
  // console.log(para)


  $.getJSON('/api/posts/?page='+para, function(json){  
    // console.log(json);
    // console.log(json.data);
    var data = json.data;
    for( var index in data){
      $('#tbody').append('\
      <tr>\
        <td>'+ data[index].id +'</td>\
        <td><a href="/posts/'+ data[index].id +'">'+ data[index].title +'</a></td>\
        <td>'+ data[index].note +'</td>\
      <tr>\
      ')
    }

    // console.log(json.next_page_url)
    $('#btn-pre').hide();
    $('#btn-next').hide();
    if (json.prev_page_url) {
      $('#btn-pre').attr('href', json.prev_page_url.replace('api/',''));      
      $('#btn-pre').show();
    } else if (json.next_page_url){
      $('#btn-next').attr('href', json.next_page_url.replace('api/',''));
      $('#btn-next').show();
    } 
    
    
    
    
  })  
});
</script>
@endsection


@section('content')

<div class="container">
  <h1 class="text-center">All my post</h1>
  <div class="row justify-content-center">    
    <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>note</th>
          </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
      <a class="btn btn-primary" id="btn-pre">Previous</a>
      <a class="btn btn-primary" id="btn-next">Next</a>
    </div>
  </div>  
</div>

@endsection