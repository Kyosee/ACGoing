@extends('dashboard.layouts.default')

@section('content')
    @section('section_title', '网站类型')
    <form class="ui form" method="post">
        <div class="field">
            <div class="two fields">
                <div class="field three wide">
                    <input type="text" name="name" class="type_name" placeholder="请输入类型名称">
                </div>
                <div class="field">
                    <input type="submit" class="ui black button" name="" value="保存">
                    <a href="javascript:location.reload()" class="ui green button">刷新</a>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" class="type_id" value="">
        {{ csrf_field() }}
    </form>
    <table class="ui compact celled table">
        <thead>
            <tr>
                <th>ID</th>
                <th>类型名称</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_list as $type)
                <tr data-id="{{ $type['id'] }}" data-name="{{ $type['name'] }}">
                    <td>{{ $type['id'] }}</td>
                    <td>{{ $type['name'] }}</td>
                    <td>{{ $type['created_at'] }}</td>
                    <td>
                        <button type="button" class="ui inverted blue button change-btn" data-type="edit">修改</button>
                        <button type="button" class="ui inverted red button change-btn" data-type="delete">删除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        $(".change-btn").click(function() {
            var _this = $(this)
            var _data = _this.parents('tr');

            switch (_this.data('type')) {
                case 'edit':
                    $(".type_id").val(_data.data('id'));
                    $(".type_name").val(_data.data('name'));
                    break;

                case 'delete':
                    $.ajax({
                        type: 'post',
                        data: {
                            id: _data.data('id'),
                            _method: 'DELETE'
                        },
                        success: function(data){
                            data.state ? location.reload() : layer.msg('删除失败请稍后重试')
                        }
                    })
                    break;
            }
        });
    </script>
@endsection
