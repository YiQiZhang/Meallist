@extends('/layout.master')

@section('navigation')
<li><a href="/">制作计划</a></li>
<li class="active"><a href="/makeMealList">制作餐单</a></li>
@endsection

@section('content')
<form>
    <div class="form-group">
        <label for="from-date">选择计划</label>
        <select class="form-control" name="plan_id" id="plan_id">
            @foreach($param['plan_list'] as $plan)
                <option value="{{ $plan->id }}" @if($param['plan_id'] == $plan->id) selected @endif>{{ $plan->name }}</option>
            @endforeach
        </select>
    </div>
    <table class="table" id="meal-list">
        <tbody>
        @foreach($param['meal_type'] as $k => $meal_type)
        <tr>
            <th class="meal-type-desc">
                <p class="meal-type-name">{{ tpl_language($k) }}</p>
                <button type="button" class="btn btn-default add-food" data-toggle="modal" data-target="#addFoodModal" data-meal-type="{{ $meal_type }}">添加食物</button>
                <ul class="need-nutrition-list">
                    @foreach($param['nutrition_type'] as $nutrition_type)
                    <li class="nutrition-item">
                        <span class="header">{{ tpl_language($nutrition_type) }}:</span>
                        <span class="body"><span class="require-data">0</span>{{ $param['nutrition_unit'][$nutrition_type] }}</span>
                    </li>
                    @endforeach
                </ul>
            </th>
            <td colspan="3">
                <ul class="food-list food-item-container" data-meal-type="{{ $meal_type }}">
                </ul>
            </td>
            <td>
                @foreach($param['nutrition_type'] as $nutrition_type)
                <div class="nutrition-type-item">
                    <p class="nutrition-type">{{ tpl_language($nutrition_type) }}</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                            <span class="sr-only">45% Complete</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </td>
        </tr>
        @endforeach
        <tr>
            <th>汇总:</th>
            @foreach($param['nutrition_type'] as $nutrition_type)
            <td>{{ tpl_language($nutrition_type) }}<span class="label label-primary data">0</span>{{ $param['nutrition_unit'][$nutrition_type] }}</td>
            @endforeach
        </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">保存修改</button>
    <button type="submit" class="btn btn-success">创建新计划</button>
    <button type="submit" class="btn btn-info">制作餐单</button>
</form>

<div class="modal fade" id="addFoodModal" tabindex="-1" role="dialog" aria-labelledby="addFoodModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加食物</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="input-food-type">食物种类</label>
                        <select class="form-control " name="modal-food-type-selector" id="modal-food-type-selector">
                            <option value="0">请选择一种食物种类</option>
                            @foreach($param['food_type'] as $food_type => $food_type_id)
                                <option value="{{ $food_type_id }}">{{ tpl_language($food_type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input-food-type">食物</label>
                        <select class="form-control " id="modal-food-selector">
                        </select>
                    </div>
                    <div class="form-group">
                        <ul class="nutrition-desc-list">
                            @foreach($param['nutrition_type'] as $nutrition_type)
                                <li class="nutrition-desc">
                                    <span class="header">{{ tpl_language($nutrition_type) }}</span>
                                    <span class="body"><span class="data">0</span><span class="unit">{{ $param['nutrition_unit'][$nutrition_type] }}/g</span></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="input-food-amount">数量</label>
                        <input type="text" class="form-control" id="input-food-amount" placeholder="单位g">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="modal-add-food-action">添加</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="selected-meal-type-id" id="selected-meal-type-id" value="0">

@endsection

@section('js')
<script>
var foodListData = <?php echo json_encode($param['food_list_data'], JSON_UNESCAPED_UNICODE) ?>;


function addFoodToList(mealTypeId, data)
{
    var li = '  <li class="food-item">\
                    <div class="food-desc">\
                        <p class="food-name">玉米</p>\
                        <span class="glyphicon glyphicon-remove remove-btn"></span>\
                        <div class="amount-container">\
                            <input class="form-control food-amount" placeholder="单位g">\
                        </div>\
                    </div>\
                    <ul class="nutrition-desc-list">\
                        @foreach($param['nutrition_type'] as $nutrition_type)
                        <li class="nutrition-desc">\
                        <span class="header">{{ tpl_language($nutrition_type) }}:</span>\
                        <span class="body"><span class="data">1.2</span><span class="unit">{{ $param['nutrition_unit'][$nutrition_type] }}/g</span></span>\
                        </li>\
                        @endforeach
                    </ul>
                </li>';
    jQuery('.food-list.food-item-container[data-meal-type="' + mealTypeId + '"]').append(li);
}

jQuery(function(){
    var meal_id_container = jQuery("#selected-meal-type-id");

    // 激活食品添加框
    jQuery(".meal-type-desc>.add-food").click(function(){
        var _ = jQuery(this),
            meal_id = _.attr("data-meal-type");

        meal_id_container.val(meal_id);
    });

    // 选中食品类型，改变食品列表
    jQuery("#modal-food-type-selector").change(function(){
        var _ = jQuery(this),
            foodTypeId = _.val(),
            options = '<option value="0">请选择一种食物</option>';

        for(var i = 0; i < foodListData.length; i++) {
            var d = foodListData[i];
            if(d['type'] == foodTypeId) {
                options += '<option value="' + d['id'] + '">' + d['name'] + '</option>';
            }
        }

        jQuery("#modal-food-selector").html(options);
    });

    jQuery("#modal-add-food-action").click(function(){
         // 检查
        var _ = jQuery(this),
            meal_id = meal_id_container.val(),
            container = ;
    });
})
</script>
@endsection