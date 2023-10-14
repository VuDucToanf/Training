<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class ImportDataController extends Controller
{
    public function index()
    {
        $retval = [
            'status' => 'failed'
        ];
        //get data from db
        $data = \DB::table('sb_user_viewed_tmp')->get();
        Redis::command('flushall');
        if (!empty($data)) {
            foreach ($data as $item) {
                $timestamp = strtotime($item->created_at);
                Redis::command('HSET', [
                    $item->imei,
                    'ip',
                    $item->ip,
                    'user_agent',
                    $item->user_agent
                ]);
                $value = 'imei:' . $item->imei . ':ip:' . $item->ip . ':user_agent:' . $item->user_agent . ':created_at:' . $timestamp;
                Redis::command('ZADD', [
                    'target:' . $item->target,
                    $timestamp,
                    $value
                ]);
                $value = 'target:' . $item->target . ':ip:' . $item->ip . ':user_agent:' . $item->user_agent . ':created_at:' . $timestamp;
                Redis::command('ZADD', [
                    'imei:' . $item->imei,
                    $timestamp,
                    $value
                ]);
                $retval = [
                    'status' => 'success'
                ];
            }
        }
        return $retval;
    }
}
