<?php
/**
 * Created by PhpStorm.
 * User: jj
 * Date: 2016/11/5
 * Time: 13:38
 */

namespace App\Transform;


class LessonTransformer extends Transform
{
    //[$this,'transform']是指$lessons执行该transform方法
    //因为show返回的类型，所以使用这种方法
    public function transform($lesson){
        return [
            'title'=>$lesson['title'],
            'content'=>$lesson['body'],
            'is_free'=>(boolean)$lesson['free']
        ];
    }
}