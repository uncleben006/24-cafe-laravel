@extends('layouts/app')

@section('content-admin-nav','active')

@section('style')
<style>
</style>

@endsection

@section('script')
<script src='/js/tinymce/js/tinymce/tinymce.min.js'></script>
<script>
    tinymce.init({
    selector: '#note',
    language: 'zh_TW',
    height : 300
    });
</script>
@endsection


@section('content')

<div class="container spacing"> 
    <div class="row justify-content-center">    
        <div class="col-md-12">
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <h2 class="text-center">貼文編號 {{ $content[0]->id }} </h2>
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">標題</label>
                        <div class="col-12">                            
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $content[0]->title }}" autofocus>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-md-2 col-form-label">內文</label>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" >{{ $content[0]->content }}</textarea>
                                @if ($errors->has('note'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                        </div>                        
                    </div>         
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-secondary" href="javascript: history.back()">取消</a>
                        <button type="submit" class="btn btn-primary text-align-center">新增</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection