@extends('layouts/app')

@section('content-admin-nav','active')

@section('style')
<style>
#btn-pre {
    display: none;
}
#btn-next {
    display: none;
}

/* * {
    border: solid 1px;
}     */
.list-group-item:last-child {
    margin-bottom: -1px;
}
/* Tables
================================== */
.Rtable {
    display: flex;
    flex-wrap: wrap;
    margin: 0 0 3em 0;
    padding: 0px;
}
.Rtable-cell {
    box-sizing: border-box;
    flex-grow: 1;
    width: 100%; 
    padding: 0.1rem 0.25rem;
    list-style: none;
    border: solid 1px black;
    background: fade(slategrey,20%);
    max-height: 15vh;
    overflow: auto;
    > h1, > h2, > h3, > h4, > h5, > h6 { margin: 0; }
}
.Rtable-cell hr {
    margin: 5px auto;
}

/* Table column sizing
================================== */
.Rtable--2cols > .Rtable-cell  { width: 50%; }
.Rtable--3cols > .Rtable-cell  { width: 33.33%; }
.Rtable--4cols > .Rtable-cell  { width: 25%; }
.Rtable--5cols > .Rtable-cell  { width: 20%; }
.Rtable--6cols > .Rtable-cell  { width: 16.6%; }

@media(max-width: 500px) {
    .Rtable--6cols > .Rtable-cell  { width: 100%; }
}
</style>
<script src='http://cloud.tinymce.com/5-testing/tinymce.min.js'></script>
<script>
    tinymce.init({
    selector: '#note'
    });
</script>
@endsection

@section('script')
@endsection


@section('content')

<div class="container spacing"> 
    <div class="row justify-content-center">    
        <div class="col-md-12">
            <div class="card-body">
                <form method="POST" action="{{ route('post') }}">
                    @csrf
                    <h2 class="text-center">Posting</h2>
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label">Title</label>
                        <div class="col-12">
                            
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-md-2 col-form-label">Note</label>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" id="note" type="text" class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" value="{{ old('note') }}"></textarea>
                            </div>

                            @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>         
                    <button type="submit" class="btn btn-primary text-align-center">Submit</button>
                </form>
            </div>
        </div>
    </div>  
</div>

@endsection