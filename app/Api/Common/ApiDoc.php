<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/18
 * Time: 下午3:09
 */

namespace App\Api\Common;

use App\Api\Controllers\BaseController;

/**
 * Class HospitalsController
 * @package App\Api\Controllers
 */
class ApiDoc extends BaseController
{
    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $http = env('MY_API_HTTP_HEAD', 'http://localhost');
        $prefix = 'api/';
        $version = 'v1';
        $url = $http . $prefix . $version;

        $api = [
            '统一说明' => [
                '域名' => $http,
                '数据格式' => 'JSON',
                '数据结构(response字段)' => [
                    'code' => '状态码（1000 | -1）',
                    'info' => '状态信息（success | fail）或报错信息；在HTTP状态码非200时,一般是报错信息',
                    'data' => '数据块',
                    'debug' => '只有内测时某些功能有该字段,用于传递一些非公开数据或调试信息'
                ],
                'url字段' => 'HTTP请求地址; {}表示在链接后直接跟该数据的ID值即可,例:http://api-url/v1/data/77?token=xx,能获取id为77的data信息',
                'method字段' => 'GET / POST',
                'form-data字段' => '表单数据',
                'response字段' => '数据结构',
                'HTTP状态码速记' => [
                    '释义' => 'HTTP状态码有五个不同的类别:',
                    '1xx' => '临时/信息响应',
                    '2xx' => '成功; 200表示成功获取正确的数据; 204表示执行/通讯成功,但是无返回数据',
                    '3xx' => '重定向',
                    '4xx' => '客户端/请求错误; 需检查url拼接和参数; 在我们这会出现可以提示的[message]或需要重新登录获取token的[error]',
                    '5xx' => '服务器错误; 可以提示服务器崩溃/很忙啦~',
                ],
            ],

            '节点' => $this->node($url)
        ];

        return response()->json(compact('api'));
    }

    /**
     * 帮助
     *
     * @param $url
     * @return array
     */
    public function node($url)
    {
        return [

        ];
    }
}
