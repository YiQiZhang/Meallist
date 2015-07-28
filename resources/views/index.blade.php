<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>宝宝的餐单</title>

    <!-- Bootstrap -->
    <link href="/static/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="/static/css/common.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">宝宝的餐单</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">制作计划</a></li>
                <li><a href="/makeMealList">制作餐单</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container" id="main-container">


</div><!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/js/jquery-1.11.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/css/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
</body>
</html>

@extends('layout.master')

@section('navigation')

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