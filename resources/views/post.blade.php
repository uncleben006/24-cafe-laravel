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
    } if (json.next_page_url){
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
    <div class="col-md-8 pb-5">
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
    <div class="col-md-8">
      <div class="card-body">
        <form method="POST" action="{{ route('post') }}">
            @csrf

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                <div class="col-md-6">
                    <input id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" value="{{ old('note') }}" required>

                    @if ($errors->has('note'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('note') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>

                <div class="col-md-6">
                    <input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" value="{{ old('author') }}" required>

                    @if ($errors->has('author'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('author') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>  
</div>

@endsection