@extends('layout.master')

@section('navigation')
    <li class="active"><a href="/">制作计划</a></li>
    <li><a href="/makeMealList">制作餐单</a></li>
@endsection

@section('content')
    <form action="/makePlanAction" method="post" id="makePlanActionForm">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="from-date">选择计划</label>
            <select class="form-control" name="plan_id" id="plan_id">
                <option value="0" selected>我是一个新计划</option>
                @foreach($param['plan_list'] as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="from-date">从哪天开始</label>
            <input type="text" class="form-control" id="from_date" name="from_date" placeholder="yyyy-mm-dd">
        </div>
        <div class="form-group">
            <label for="to-date">到哪天结束</label>
            <input type="text" class="form-control" id="to_date" name="to_date" placeholder="yyyy-mm-dd">
        </div>
        <table class="table">
            <tbody>
            @foreach($param['meal_type'] as $k => $meal_type)
                <tr>
                    <th>{{ tpl_language($k) }}:</th>
                    <?php foreach($param['nutrition_type'] as $nutrition_type) { ?>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="{{ meal_nutrition_input_name($k, $nutrition_type) }}">{{ tpl_language($nutrition_type) }}</label>
                            <input type="number" class="form-control nutrition-input {{ $k }} {{ $nutrition_type }}" data-meal="{{ $k }}" data-meal-id="{{ $meal_type }}" data-nutrition="{{ $nutrition_type }}" id="{{ meal_nutrition_input_name($k, $nutrition_type) }}" name="{{ meal_nutrition_input_name($k, $nutrition_type) }}" value="" placeholder="{{ tpl_language($nutrition_type) }}" >
                        </div>
                    </td>
                    <?php } ?>
                </tr>
            @endforeach
            <tr>
                <th>汇总:</th>
                @foreach($param['nutrition_type'] as $nutrition_type)
                    <td class="total-container">{{ tpl_language($nutrition_type) }}<span class="label label-primary data" data-nutrition="{{ $nutrition_type }}">0</span>{{ $param['nutrition_unit'][$nutrition_type] }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">保存修改</button>
    </form>
@endsection


@section('js')
<script>
var nutrition_type = [@foreach($param['nutrition_type'] as $k => $nutrition)
    {{ $k > 0 ? ',' : '' }}"{{ $nutrition }}"
    @endforeach];
var meal_type = {
    @foreach($param['meal_type'] as $meal_type => $meal_id)
    {{ $meal_id > 1 ? ',' : '' }} {{ $meal_id }} : "{{ $meal_type }}"
    @endforeach
};

var planData = {},
    planDetailData = {},
    planId = 0;

function resetData()
{
    updatePlanData(0);
}

function redrawView()
{
    for(var i = 0; i < nutrition_type.length; i++) {
        planData[nutrition_type[i]] = 0;
    }
    for(var i = 0; i < planDetailData.length; i++) {
        var d = planDetailData[i];
        for(var j = 0; j < nutrition_type.length; j++) {
            // 更新
            var num = parseInt(d[nutrition_type[j]]);
            jQuery(".nutrition-input." + nutrition_type[j] + "." + meal_type[d['type']]).val(num > 0 ? num : '');
            l(".nutrition-input." + nutrition_type[j] + "." + meal_type[d['type']]);
            planData[nutrition_type[j]] = parseInt(planData[nutrition_type[j]]) + num;
        }
    }

    // 更新汇总结果
    jQuery(".total-container>.data").each(function(index){
        var _ = jQuery(this),
            ntype = _.attr("data-nutrition");

        _.html(planData[ntype]);
    });

    // 更新日期
    jQuery("#from_date").val(planData["from_date"]);
    jQuery("#to_date").val(planData["to_date"]);
}

function updatePlanData(plan_id)
{
    jQuery.ajax({
        url : "/api/getPlanDetail",
        data : {
            "plan_id" : plan_id
        },
        dataType : "json",
        success : function(data) {
            planData = data['plan'];
            planDetailData = data['plan_detail'];
            redrawView();
        }
    });
}

resetData();

jQuery(function(){
    jQuery(".nutrition-input").change(function(){
        var _ = jQuery(this),
            meal_id = _.attr("data-meal-id"),
            nutrition = _.attr("data-nutrition");
        for(var i = 0; i < planDetailData.length; i++) {
            var d = planDetailData[i];
            if(d['type'] == meal_id) {
                planDetailData[i][nutrition] = parseInt(_.val());
                break;
            }
        }
        redrawView();
    });
    jQuery("#plan_id").change(function(){
        var _ = jQuery(this),
            plan_id = _.val();

        planId = plan_id;
        updatePlanData(planId);
    });
    jQuery("#from_date,#to_date").change(function(){
        var _ = jQuery(this),
            name = _.attr("name");
        planData[name] = _.val();
    });
});
</script>
@endsection