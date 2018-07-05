<?php

namespace App\Api\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Common\RetJson;

class ClientController extends Controller
{
    public function index()
    {
        return RetJson::format(Client::all());
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
            'client_id' => $request->get('client_id'),
            'time' => $request->get('time')
        ];


        return RetJson::format(Client::create($data));
    }
}
