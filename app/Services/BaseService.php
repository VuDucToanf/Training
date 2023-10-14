<?php

namespace App\Services;

class BaseService
{
    public function triggerSyncRequest($url, $method = 'GET', $params = [], $headers = []) {
        $ch = curl_init();
        $timeout = 200;
        if($method == "GET" && !empty($params)){
            $url .= '?' . http_build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }
}
