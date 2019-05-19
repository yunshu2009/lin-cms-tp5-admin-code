<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use LinCmsTp5\admin\exception\ParameterException;
use think\facade\Request;


/**
 * @return array
 * @throws ParameterException
 */
function paginate()
{
    $count = intval(Request::get('count'));
    $start = intval(Request::get('page'));

    $count = $count >= 15 ? 15 : $count;

    $start = $start * $count;

    if ($start < 0 || $count < 0) throw new ParameterException();

    return [$start, $count];
}