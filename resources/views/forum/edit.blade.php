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
                {{--<form action="{{url('/discussions/'.$discussion->id)}}" method="post">--}}
                {!! Form::model($discussion,['url'=>'/discussions/'.$discussion->id,'method'=>'PATCH']) !!}
                <div class="form-group">
                    <label>标题：</label>
                    <input type="text" class="form-control" name="title" value="{{$discussion->title}}">
                </div>
                <div class="editor">
                    <div class="form-group">
                        <label>内容：</label>
                        <textarea class="form-control" rows="10" name="body" id="myEditor">{{$discussion->body}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>标 签：</label>
                    {!! Form::select('tag_list[]',$tags,null,['class'=>'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
                </div>
                <div>
                    <input type="submit" class="btn btn-info pull-right" value="更新帖子">
                </div>
                {!! Form::close() !!}
                {{--</form>--}}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@stop