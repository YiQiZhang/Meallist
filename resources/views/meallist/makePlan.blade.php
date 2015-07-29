@extends('layout.master')

@section('navigation')
    <li class="active"><a href="/">制作计划</a></li>
    <li><a href="/makeMealList">制作餐单</a></li>
@endsection

@section('content')
    <form>
        <div class="form-group">
            <label for="from-date">选择计划</label>
            <select class="form-control">
                <option value="0">我是一个新计划</option>
                <option value="0">2015-07-12~2015-07-15</option>
            </select>
        </div>
        <div class="form-group">
            <label for="from-date">从哪天开始</label>
            <input type="text" class="form-control" id="from-date" name="from-date" placeholder="yyyy-mm-dd">
        </div>
        <div class="form-group">
            <label for="to-date">到哪天结束</label>
            <input type="text" class="form-control" id="to-date" name="to-date" placeholder="yyyy-mm-dd">
        </div>
        <table class="table">
            <tbody>
            @foreach($param['meal_type'] as $k => $meal_type)
                <tr>
                    <th>{{ tpl_language($k) }}:</th>
                    <?php foreach($param['nutrition_type'] as $nutrition_type) { ?>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="{{ $k.'_'.$nutrition_type }}">{{ tpl_language($nutrition_type) }}</label>
                            <input type="text" class="form-control" id="{{ $k.'_'.$nutrition_type }}" placeholder="{{ tpl_language($nutrition_type) }}">
                        </div>
                    </td>
                    <?php } ?>
                </tr>
            @endforeach
            <tr>
                <th>汇总:</th>
                @foreach($param['nutrition_type'] as $nutrition_type)
                    <td>{{ tpl_language($nutrition_type) }}<span class="label label-primary data">0</span>单位</td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">保存修改</button>
        <button type="submit" class="btn btn-success">创建新计划</button>
        <button type="submit" class="btn btn-info">制作餐单</button>
    </form>
@endsection