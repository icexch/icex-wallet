<?php
/**
 * Created by PhpStorm.
 * User: m1x
 * Date: 15.11.2017
 * Time: 15:28
 */

namespace Icex\IcexWallet\Http\Controllers;

use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    /**
     * Build right, pretty Json response
     *
     * @param  array $data
     * @param  string $name
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     * @internal param bool $result
     */
    protected function responseJson ($data, $name, $status = 200)
    {
        $arguments = request()->all();

        $response = [
            'result' => $status == 200 ? true : false,
            "name" => $name,
            "data" => $data
        ];

        $response = array_merge($response, $arguments);

        return response()->json($response, $status, [ ], JSON_PRETTY_PRINT);
    }
}