@extends('dashboard.layouts.default')

@section('content')
    @section('section_title', '规则详情')
    <form class="ui form" method="post">
        <div class="field">
            <label>网站名称</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="site_name" class="required" data-msg="请输入网站名称" value="{{ $data ? $data['site_name'] : '' }}" placeholder="网站名称">
                </div>
            </div>
        </div>
        <div class="field">
            <label>URL</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="site_url" class="required" data-msg="请输入URL" value="{{ $data ? $data['site_url'] : '' }}" placeholder="URL">
                </div>
            </div>
        </div>
        <div class="field">
            <label>所属采集分类</label>
            <div class="two fields">
                <div class="field">
                    <select name="site_type_id">
                    @foreach ($type_list as $key)
                        <option @if($data && $data['site_type_id'] == $key['id']) selected @endif value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">基本过滤规则[列表中采集]</h4>
        <div class="field box">
            <div class="two fields">
                <div class="field">
                    <button type="button" class="ui inverted blue button clone-btn" name="button">新增字段过滤规则</button>
                </div>
            </div>
        @if($data && $data['base_filter'])
            @foreach($data['base_filter']['title'] as $key => $value)
            <div class="two fields">
                <div class="field one wide">
                    <button type="button" class="ui button red del-btn">删除</button>
                </div>
                <div class="field">
                    <input type="text" class="required" data-msg="请输入基本规则字段名" name="base_filter[title][]" value="{{ $data['base_filter']['title'][$key] }}" placeholder="规则字段名">
                </div>
                <div class="field">
                    <input type="text" class="required" data-msg="请输入基本规则过滤内容" name="base_filter[content][]" value="{{$data['base_filter']['content'][$key] }}" placeholder="过滤内容">
                </div>
            </div>
            @endforeach
        @else
            <div class="two fields">
                <div class="field one wide">
                    <button type="button" class="ui button red del-btn">删除</button>
                </div>
                <div class="field">
                    <input type="text" class="required" data-msg="请输入基本规则字段名" name="base_filter[title][]" placeholder="规则字段名">
                </div>
                <div class="field">
                    <input type="text" class="required" data-msg="请输入基本规则过滤内容" name="base_filter[content][]" placeholder="过滤内容">
                </div>
            </div>
        @endif
        </div>
        <h4 class="ui dividing header">内容过滤规则[若要采集每个列表条目URL中的页面内容请配置此规则]</h4>
        <div class="field box">
            <div class="two fields">
                <div class="field">
                    <button type="button" class="ui inverted blue button clone-btn" name="button">新增字段过滤规则</button>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="info_filter[title][]" placeholder="规则字段名">
                </div>
                <div class="field">
                    <input type="text" name="info_filter[content][]" placeholder="规则内容">
                </div>
            </div>
        </div>
        <div class="ui segment">
            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="status" value="1" checked="checked" class="hidden">
                    <label>是否启用当前网站规则</label>
                </div>
            </div>
        </div>
        <input type="submit" value="提交保存" class="ui button green">
        <input type="hidden" name="id" value="{{ $data ? $data['id'] : '' }}">
        {{ csrf_field() }}
    </form>

    <script type="text/javascript">
        $('.ui.checkbox').checkbox();
        $(".clone-btn").click(function() {
            var _this = $(this);
            _this.parents('.box').append(_this.parents('.fields').next('.fields').clone());
        });

        $(".field").delegate('.del-btn', 'click', function() {
            $(this).parents('.fields').remove();
        });

        $('.form').submit(function() {
            var state = true
            $(".required").each(function(index, el) {
                if(!$(el).val()){
                    state = false;
                    $(el).focus();
                    layer.msg($(el).data('msg'));
                    return false;
                }
            });
            return state;
        });
    </script>
@endsection
