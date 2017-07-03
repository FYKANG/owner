<?php

namespace App\Http\Controllers;	//
use App\Owner;	//MOdel的调用
use App\search;	//MOdel的调用
use Illuminate\Support\Facades\DB;	//查询构造器的调用
class OwnerController extends Controller
{
    public function mysql()
    {
    	//all()获取全部数据
    	//$workout=search::all();

    	//find()根据主键获取数据
    	//$workout=search::find(1);

    	//findOrFail()根据主键查找，如果没有此主键则报错
    	//$workout=search::findOrFail(1);

    	//查询构造器get()查询全部数据
    	// $workout=search::get();

    	 $workout=search::where('id','>=','1')->get();
		

    	/* chunk(num,function($workout){})
    		其中num为需要查询出来的条数，$workout为返回的结果
    	$workout=search::chunk(2,function($search){
    		dd($search);
    	});
    	*/

    	//聚合函数

    	//count()查询结果的条数
    	//$num=search::count();//返回条数

    	//max('字段')获取此字段中最大值并输出所在行
    	//min('字段')获取此字段中最小值并输出所在行


    	//使用模型新增数据
    	// $search=new search();
    	// $search->userName='ormTest2';
    	// $bool=$search->save();返回bool值

    	//使用create方法新增数据
    	// $workout=search::create(
    	// 	['userName'=>'createteset2']
    	// 	);

    	//使用firstOrCreate()，查询指定字段，如果存在则返回实例，如果不存在则新增数据
    	// $workout=search::firstOrCreate(
    	// 	['userName'=>'ok']
    	// 	);

    	//使用firstOrNew(),与firstOrCreate()基本一致但出现不存在时不会自动保存数据需手动使用save();
    	// $workout=search::firstOrNew(
    	// 	['userName'=>'okok']
    	// 	);


    	// //通过模型更新数据
    	// $workout=search::find(17);
    	// $workout->userName='addNews';
    	// $bool=$workout->save();//返回布尔值

    	//批量更新
    	// $workout=search::where('id','>','10')->update(
    	// 	['userName'=>'groupUpdate']
    	// 	);//返回被修改的条数

    	//通过模型删除数据
    	// $workout=search::find(17);
    	// $bool=$workout->delete();//返回bool值

    	//通过主键删除
    	// $num=search::destroy(10);//返回被删的条数，如果失败则报错(可多条删除如destroy([10,9])表示删除主键为10和9的数据)

    	//删除指定条件数据
    	// $num=search::where('userName','=','test')
    	// 	->delete();//返回没删除的条数

    	//将数据转换为数组形式
    	// $arr=$workout->toArray();

    	// 向模板中传递数据
    	// dd($workout->first()->userName);
    	return view('owner/mysql',[
    		'workout'=>$workout
    		]);

    }
}
