@extends('layouts.admin')

@section('title', '素材管理--添加素材')

@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('/test/show')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">新闻标题</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="素材名称" name="c_name">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">新闻内容</label>
        <textarea name="c_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">新闻作者</label>
        <input type="text" name="c_author">
    </div>
    <button type="submit" class="btn btn-default">添加</button>
</form>
</body>
</html>
@endsection