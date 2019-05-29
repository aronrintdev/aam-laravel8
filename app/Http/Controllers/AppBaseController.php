<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{

    public function sendJsonApiResponse($type, $idName, $objects)
    {

        //assume array of arrays
        if (!key_exists($idName, $objects)) {
            $objList = array_map(function($item) use($type, $idName) {
                return [
                    'type'        => $type,
                    'id'          => $item[$idName],
                    'attributes'  => $item,
                ];
            }, $objects);


            return Response::json([
                    'data' => $objList
            ]);
        }

        return Response::json([
            'data' => [
                'type'         => $type,
                'id'           => $objects[$idName],
                'attributes'   => $objects,
            ]
        ]);
    }

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}
