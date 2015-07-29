@extends('/layout.master')

@section('navigation')
<li><a href="/">制作计划</a></li>
<li class="active"><a href="/makeMealList">制作餐单</a></li>
@endsection

@section('content')
<form>
    <table class="table" id="meal-list">
        <tbody>
        @foreach($param['meal_type'] as $k => $meal_type)
        <tr>
            <th class="meal-type-desc">
                <p class="meal-type-name">{{ tpl_language($k) }}</p>
                <button type="button" class="btn btn-default add-food" data-toggle="modal" data-target="#addFoodModal">添加食物</button>
                <ul class="need-nutrition-list">
                    @foreach($param['nutrition_type'] as $nutrition_type)
                    <li class="nutrition-item">
                        <span class="header">{{ tpl_language($nutrition_type) }}:</span>
                        <span class="body">500单位</span>
                    </li>
                    @endforeach
                </ul>
            </th>
            <td colspan="3" class="food-list-container">
                <ul class="food-list">
                    <li class="food-item">
                        <div class="food-desc">
                            <p class="food-name">玉米</p>
                            <span class="glyphicon glyphicon-remove remove-btn"></span>
                            <div class="amount-container">
                                <input class="form-control food-amount" placeholder="单位G">
                            </div>
                        </div>
                        <ul class="nutrition-desc-list">
                            @foreach($param['nutrition_type'] as $nutrition_type)
                                <li class="nutrition-desc">
                                    <span class="header">{{ tpl_language($nutrition_type) }}:</span>
                                    <span class="body"><span class="data">1.2</span><span class="unit">单位/g</span></span>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="food-item">
                        <div class="food-desc">
                            <p class="food-name">玉米</p>
                            <span class="glyphicon glyphicon-remove remove-btn"></span>
                            <div class="amount-container">
                                <input class="form-control food-amount" placeholder="单位G">
                            </div>
                        </div>
                        <ul class="nutrition-desc-list">
                            @foreach($param['nutrition_type'] as $nutrition_type)
                                <li class="nutrition-desc">
                                    <span class="header">{{ tpl_language($nutrition_type) }}:</span>
                                    <span class="body"><span class="data">1.2</span><span class="unit">单位/g</span></span>
                                </li>
                            @endforeach
                        </ul>
                    </li>
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
            <td>{{ tpl_language($nutrition_type) }}<span class="label label-primary data">0</span>单位</td>
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
                        <select class="form-control " id="input-food-type">
                            <option value="0">请选择一种食物种类</option>
                            <option value="1">谷物</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input-food-type">食物</label>
                        <select class="form-control " id="input-food-type">
                            <option value="0">请选择一种食物</option>
                            <option value="1">大米</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <ul class="nutrition-desc-list">
                            @foreach($param['nutrition_type'] as $nutrition_type)
                                <li class="nutrition-desc">
                                    <span class="header">{{ tpl_language($nutrition_type) }}</span>
                                    <span class="body"><span class="data">0</span><span class="unit">单位/g</span></span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="input-food-amount">数量</label>
                        <input type="text" class="form-control" id="input-food-amount" placeholder="单位g">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">添加</button>
            </div>
        </div>
    </div>
</div>

<script>
    // 初始化mealListData
    var mealListData = {};


</script>
@endsection