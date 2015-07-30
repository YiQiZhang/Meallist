<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Food;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rule_arr = [
            'energy' => 90,
            'protein' => 2,
            'fat' => 0.5,
            'carbohydrate' => 19
        ];
        $dataArr = [
            ['大米', 25],
            ['土豆', 125],
            ['绿豆', 25],
            ['挂面', 25],
            ['标准粉', 25],
            ['咸面包', 37.5],
            ['鲜仔介', 150],
            ['仔介', 150],
            ['荞麦面', 25],
            ['干莲子', 25],
            ['籼米', 25],
            ['小米', 25],
            ['馒头', 35],
            ['茨菇', 75],
            ['赤小豆', 25],
            ['生面条', 30],
            ['干红枣', 30],
            ['干银耳', 25],
            ['鲜山药', 125],
            ['梗米', 25],
            ['藕粉', 25],
            ['饼干', 25],
            ['青稞', 25],
            ['玉米面', 25],
            ['干粉条', 25],
            ['蔗糖', 20]
        ];
        $this->putInDB(1, $rule_arr, $dataArr);

        $rule_arr = [
            'energy' => 80,
            'protein' => 5,
            'carbohydrate' => 15
        ];
        $dataArr = [
            ['大白菜', 500],
            ['西葫芦', 500],
            ['卷心菜', 500],
            ['番茄', 500],
            ['油菜', 500],
            ['芥菜', 200],
            ['甜椒', 350],
            ['黄瓜', 500],
            ['柸蓝', 500],
            ['南瓜', 350],
            ['白萝卜', 350],
            ['龙须菜', 500],
            ['鲜蘑菇', 500],
            ['工豆', 250],
            ['青菜', 500],
            ['菠菜', 500],
            ['苦瓜', 500],
            ['莴笋', 500],
            ['冬瓜', 500],
            ['扁豆', 250],
            ['绿豆芽', 500],
            ['浸海带', 75],
            ['四季豆', 250],
            ['菜花', 500],
            ['丝瓜', 300],
            ['芹菜', 500],
            ['韭菜', 500],
            ['冬笋', 250],
            ['苦瓜', 500]
        ];
        $this->putInDB(2, $rule_arr, $dataArr);

        $rule_arr = [
            'energy' => 90,
            'protein' => 1,
            'carbohydrate' => 21
        ];
        $dataArr = [
            ['苹果', 200],
            ['杏子', 300],
            ['草莓', 300],
            ['桃子', 175],
            ['鲜枣', 100],
            ['桔子', 275],
            ['鸭梨', 250],
            ['山楂', 100],
            ['李子', 200],
            ['猕猴桃', 250],
            ['火龙果', 250]
        ];
        $this->putInDB(3, $rule_arr, $dataArr);

        $rule_arr = [
            'energy' => 80,
            'protein' => 9,
            'fat' => 5
        ];
        $dataArr = [
            ['廋猪肉', 25],
            ['牛肉干', 23],
            ['白条鸡', 75],
            ['猪肉松', 25],
            ['豆腐丝', 50],
            ['猪肝', 70],
            ['鸡肉', 50],
            ['兔肉', 50],
            ['酱鸭', 50],
            ['猪心', 70],
            ['叉烧肉', 40],
            ['廋羊肉', 50],
            ['大肉肠', 85],
            ['廋牛肉', 50],
            ['豆腐干', 50],
            ['鸭肉', 50],
            ['猪舌', 25],
            ['香肠', 20],
            ['鸡翅', 80],
            ['鲢鱼', 80],
            ['大排骨', 25],
            ['南豆腐', 125],
            ['腌春蛋', 55],
            ['大腊肠', 80],
            ['酱羊肉', 40],
            ['酱肉', 25],
            ['鸡蛋', 55],
            ['黄豆', 20],
            ['鲳鱼', 50],
            ['蛤蜊肉', 100],
            ['豆腐脑', 200],
            ['北豆腐', 100],
            ['盐水鸭', 55],
            ['鸭蛋', 55],
            ['肉松', 20],
            ['鹅蛋', 55],
            ['虾仁', 75],
            ['青鱼', 75]
        ];
        $this->putInDB(4, $rule_arr, $dataArr);

        $rule_arr = [
            'energy' => 80,
            'protein' => 4,
            'fat' => 5,
            'carbohydrate' => 6
        ];
        $dataArr = [
            ['鲜牛奶', 110],
            ['酸牛奶', 110],
            ['全脂奶粉', 15],
            ['豆浆', 200],
            ['豆浆粉', 20]
        ];
        $this->putInDB(5, $rule_arr, $dataArr);

        $rule_arr = [
            'energy' => 80,
            'fat' => 9
        ];
        $dataArr = [
            ['豆油', 9],
            ['麻油', 9],
            ['菜油', 9],
            ['花生油', 9],
            ['花生米', 15],
            ['芝麻酱', 15],
            ['南瓜籽', 30],
            ['核桃仁', 12.5],
            ['葵花籽', 30]
        ];
        $this->putInDB(6, $rule_arr, $dataArr);
    }

    private function putInDB($food_type, $ruleArr, $dataArr) {
        //
        $keyArr = [
            'energy', 'protein', 'fat', 'carbohydrate'
        ];

        foreach($dataArr as $data) {
            $insert_data = ['type' => $food_type];
            foreach($keyArr as $field) {
                $insert_data[$field] = 0;
            }
            foreach($ruleArr as $nutrition => $val) {
                $insert_data[$nutrition] = $val/$data[1];
            }
            $insert_data['name'] = $data[0];
            Food::create($insert_data);
        }
    }
}
