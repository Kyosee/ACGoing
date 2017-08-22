@extends('dashboard.layouts.default')

@section('content')
    @section('section_title', '网站规则')
    <form class="ui form">
        <div class="field">
            <div class="two fields">
                <div class="field three wide">
                    <input type="text" name="" placeholder="请输入网站名称查询">
                </div>
                <div class="field">
                    <input type="submit" class="ui blue button" name="" value="查询">
                    <a href="{{ route('site_details') }}" class="ui black button">新增规则</a>
                </div>
            </div>
        </div>
    </form>
    <table class="ui compact celled table">
        <thead>
            <tr>
                <th>ID</th>
                <th>网站名称</th>
                <th>URL</th>
                <th>采集快讯数</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($site_list as $site)
            <tr>
                <td>{{ $site->id }}</td>
                <td>{{ $site->site_name }}</td>
                <td>{{ $site->site_url }}</td>
                <td>约翰·莉丽亚</td>
                <td>{{ $site->created_at }}</td>
                <td>{{ $site->updated_at }}</td>
                <td>
                    <a href="{{ route('site_details', $site->id) }}" class="ui inverted blue button" name="button">修改</a>
                    <button class="ui inverted red button" name="button">删除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="">
        {{ $site_list->links() }}
    </div>
@endsection
