@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="text-center">
                    <div id="validation-errors"></div>
                    <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
                    {!! Form::open(['url'=>'user/avatar/change','files'=>true,'id'=>'avatar']) !!}
                    <div class="text-center">
                        <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像</button>
                    </div>
                    {!! Form::file('avatar',['class'=>'avatar','id'=>'image']) !!}
                    {!! Form::close() !!}
                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="post" action="/user/infor">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Email：</label>
                        <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" disabled>
                    </div>
                    <div class="form-group">
                        <label>用户名：</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label>真实姓名：</label>
                        <input type="text" class="form-control" name="realname" value="{{Auth::user()->realname}}">
                    </div>
                    <div class="form-group">
                        <label>电话：</label>
                        <input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}">
                    </div>
                    <div class="form-group">
                        <label>个人站点：</label>
                        <input type="text" class="form-control" name="web" value="{{Auth::user()->web}}">
                    </div>
                    <div class="form-group">
                        <label>个人描述</label>
                        <textarea class="form-control" name="discuss" rows="10">{{Auth::user()->discuss}}</textarea>
                    </div>
                    <input type="submit" class="btn btn-success form-control" value="更新我的资料">
                </form>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/crop/api'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img
                                        src="/asset/images/timg.jpg"
                                        class="ui centered image" id="cropbox" >
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function(){
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });
        });
        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
                var cropBox = $("#cropbox");
                cropBox.attr('src',response.avatar);
                $('#photo').val(response.image);
                $('#upload-avatar').html('更换新头像');
                $('#exampleModal').modal('show');
                cropBox.Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    setSelect: [120,120,10,10]
                });
                $('.jcrop-holder img').attr('src',response.avatar);


//添加的两个function
                function updateCoords(c)
                {
                    $('#x').val(c.x);
                    $('#y').val(c.y);
                    $('#w').val(c.w);
                    $('#h').val(c.h);
                }
                function checkCoords()
                {
                    if (parseInt($('#w').val())) return true;
                    alert('请选择图片.');
                    return false;
                }
            }
        }
    </script>
@stop