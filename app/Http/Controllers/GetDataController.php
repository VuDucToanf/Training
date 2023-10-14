<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GetDataController extends Controller
{
    public function getDataByImei(Request $request)
    {
        $retval = [];
        $imei = $request->get('imei');
        if (!empty($imei)) {
            $retval = Redis::command('HGETALL', [
                $imei
            ]);
        }
        return $retval;
    }

    public function getAccessHistory(Request $request)
    {
        $retval = [];
        $imei = $request->get('imei');
        $from = $request->get('from', 0);
        $to = $request->get('to', -1);
        if (!empty($imei)) {
            $data = Redis::command($to > -1 ? 'ZRANGEBYSCORE' : 'ZRANGE', [
                'imei:' . $imei,
                $from,
                $to
            ]);
            $retval = $this->convertData($data);
        }
        return $retval;
    }

    public function getDataByTarget(Request $request)
    {
        $retval = [];
        $target = $request->get('target');
        $from = $request->get('from', 0);
        $to = $request->get('to', -1);
        if (!empty($target)) {
            $data = Redis::command($to > -1 ? 'ZRANGEBYSCORE' : 'ZRANGE', [
                'target:' . $target,
                $from,
                $to
            ]);
            $retval = $this->convertData($data);
        }
        return $retval;
    }

    protected function convertData($data)
    {
        $retval = [];
        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $contents = explode(':', $item);
                if (!empty($contents)) {
                    $count = 0;
                    while ($count < 8) {
                        if ($contents[$count] == 'created_at')
                            $retval[$key][$contents[$count]] = date('Y-m-d H:i:s', $contents[$count + 1]);
                        else
                            $retval[$key][$contents[$count]] = $contents[$count + 1];
                        $count += 2;
                    }
                }
            }
        }
        return $retval;
    }
}
