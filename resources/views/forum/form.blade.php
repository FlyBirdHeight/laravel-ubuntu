<div class="form-group">
    <label>标 题：</label>
    <input type="text" class="form-control" name="title">
</div>
<div class="form-group">
    <label>内 容：</label>
    <div class="editor">
        {!! Form::textarea('body','',['class'=>'form-control','id'=>'myEditor']) !!}
    </div>
</div>