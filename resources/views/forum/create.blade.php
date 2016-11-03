@extends('app')
@section('content')
    @include('editor::head')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" role="main">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="/discussions" method="POST">
                    {{csrf_field()}}
                    @include('forum.form')
                    <div>
                        <input type="submit" class="btn btn-info pull-right" value="发表帖子">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@stop