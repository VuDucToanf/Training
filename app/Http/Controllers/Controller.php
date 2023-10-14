<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function callApi($url, $method = 'GET', $params = [])
    {
        $baseService = new BaseService();
        $retval = [];

        $url = config('sa.api_url') . $url;
        $response = $baseService->triggerSyncRequest($url, $method, $params);
        if (!empty($response['result'])) {
            $retval = $response['result'];
        }
        return $retval;
    }
}
