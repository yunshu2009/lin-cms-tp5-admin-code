<?php
/**
 * Created by PhpStorm.
 * User: 沁塵
 * Date: 2019/4/26
 * Time: 21:42
 */

namespace LinCmsTp5\admin\model;

use think\Model;

class LinLog extends Model
{
    protected $createTime = 'time';
    protected $updateTime = false;
    protected $autoWriteTimestamp = 'datetime';

    /**
     * @param $params
     * @return array
     * @throws \think\exception\DbException
     */
    public static function getLogs($params)
    {
        $filter = [];
        if (isset($params['name'])) {
            $filter ['user_name'] = $params['name'];
        }

        if (isset($params['start']) && isset($params['end'])) {
            $filter['time'] = [$params['start'], $params['end']];
        }

        $userList = self::withSearch(['user_name', 'time'], $filter)
            ->order('time desc')
            ->paginate($params['count'], false, ['page' => $params['page']]);

        $result = [
            'collection' => $userList->items(),
            'total_nums' => $userList->total()
        ];
        return $result;

    }

    public function searchUserNameAttr($query, $value, $data)
    {
        if (!empty($value)) {
            $query->where('user_name', $value);
        }
    }

    public function searchTimeAttr($query, $value, $data)
    {
        if (!empty($value)) {
            $query->whereBetweenTime('time', $value[0], $value[1]);
        }
    }
}