<?php

namespace App\Api\Controllers;

use App\NodeInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\Common\RetJson;

class NodeInfoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return RetJson::format(NodeInfo::all());
    }

    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = [
            'ip_port' => $request->get('address'),
            'time' => $request->get('time'),
            'client_id' => $request->get('client_id')
        ];


        return RetJson::format(NodeInfo::create($data));
    }
}
