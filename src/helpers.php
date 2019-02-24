<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/2/22
 * Time: 15:02
 */

namespace Ccb\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * 成功响应
 *
 * @param        $data
 * @param string $message
 *
 * @return \Illuminate\Http\JsonResponse
 */
function success($data=[], $message = "ok")
{
    return \Response::json([
        "code"    => 200,
        "message" => $message,
        "data"    => $data
    ]);
}

/**
 * 错误响应
 *
 * @param $code
 * @param $message
 * @param $status_code
 *
 * @return \Illuminate\Http\JsonResponse
 */
function error($code, $message, $status_code = 400)
{
    return \Response::json([
        "err_code" => $code,
        "error"    => $message,
    ], $status_code);
}

/**
 * 获取当前登录用户
 */
function user()
{

}

/**
 * 记录用户活动日志
 */
function activity()
{

}

/**
 * 分页处理
 *
 * @param LengthAwarePaginator $paginator
 * @param array                $data
 *
 * @return array
 */
function paginate(LengthAwarePaginator $paginator, $data = [])
{
    $results = $paginator->toArray();

    if (empty($data)) {
        $data = $results['data'];
    }

    unset($results['data']);

    $pagination = $results;

    return [
        "data"       => $data,
        "pagination" => $pagination
    ];
}

/**
 * 无限级分类处理
 *
 * @param $cates
 * @param $pid
 *
 * @return array
 */
function generate_tree($cates, $pid)
{
    $results = [];

    foreach ($cates as $cate) {
        if ($cate['pid'] == $pid) {
            $cate['children'] = generate_tree($cates, $cate['id']);
            $results[]        = $cate;
        }
    }

    return $results;
}

/**
 * @param $default
 * @param $min
 * @param $max
 *
 * @return int
 * @throws OutLimitException
 */
function limit($default = 10, $min = 1, $max = 20)
{
    $limit = intval(\Request::input("limit", $default));

    if ($limit == 0) {
        $limit = $default;
    }

    if ($limit < $min || $limit > $max) {
        throw new OutLimitException("超出分页范围");
    }
    return $limit;
}