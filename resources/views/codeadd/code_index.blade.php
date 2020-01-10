@extends('layouts.admin')

@section('title', '素材管理--添加素材')

@section('content')

    <h3>素材添加</h3>
    <table class="table table-bordered table-hover table-condensed">
        <tr>
            <td>渠道id</td>
            <td>渠道名称</td>
            <td>渠道标识</td>
            <td>渠道二维码</td>
            <td>关注人数</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v['channel _id']}}</td>
                <td>{{$v['channel_name']}}</td>
                <td>{{$v['channel_status']}}</td>
                <td><img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{$v['ticket']}}" width="100px"></td>
                 <td></td>
            </tr>
            @endforeach
    </table>

@endsection