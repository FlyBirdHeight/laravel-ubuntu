<?php
/**
 * Created by PhpStorm.
 * User: jj
 * Date: 2016/11/5
 * Time: 13:33
 */

namespace App\Transform;


abstract class Transform
{
    //字段映射，设置一个抽象类
    public function transformCollection($items){
        return array_map([$this,'transform'],$items);
    }

    public abstract function transform($item);
}