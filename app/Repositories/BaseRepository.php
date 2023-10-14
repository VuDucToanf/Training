<?php
namespace App\Repositories;
use Utils;

use Exception;

class BaseRepository {

    protected $model;

    public function getAll($filters, $paginate = true)
    {
        $retVal = [];
        $this->prepareFilter($filters);
        $query = $this->model::filters($filters);
        $query = $this->customQuery($query, $filters);
        if ($paginate) {
            $retVal = $query->customPaginate($filters);
        } else {
            $retVal = $query->get();
        }

        $this->prepareList($retVal);

        return $retVal;
    }

    protected function prepareList(&$items)
    {
        # code...
    }

    protected function customQuery($query, $filters)
    {
        return $query;
    }

    protected function prepareFilter(&$filters)
    {
        # code...
    }

    public function create($args = null) {
        if ($args == null) {
            throw new \InvalidArgumentException('Missing argument');
        }
        $retVal = false;
        try {
            $this->prepareEdit($args);
            $retVal = $this->model::create($args);
            $this->editSuccess($retVal, $args);
        } catch(Exception $ex) {
            \Log::info($ex->getMessage() . ' line: ' . $ex->getLine());
        }
        return $retVal;
    }

    public function update($id, $params) {
        if ($params == null) {
            throw new \InvalidArgumentException('Missing argument');
        }
        $retVal = null;
        try {
            $item = $this->model::find($id);
            if (!empty($item)) {
                $this->prepareEdit($params, $item);
                $item->update($params);
                $item->fresh();
                $this->editSuccess($item, $params, 'update');
            }
            $retVal = $item;
        } catch(Exception $ex) {
            \Log::info($ex->getMessage() . ' line: ' . $ex->getLine());
        }
        return $retVal;
    }

    protected function editSuccess($item, $params, $type = 'create')
    {
        # code...
    }

    protected function prepareEdit(&$params, $item = [])
    {
        if (isset($params['auth_key'])) {
            unset($params['auth_key']);
        }
    }

    public function delete($id = null) {
        if ($id == null) {
            throw new \InvalidArgumentException('Missing argument');
        }
        $retVal = false;
        try {
            if (!is_array($id)) {
                $item = $this->model::find($id);
                if ($item) {
                    $retVal = $item->delete();
                }
                if ($retVal) {
                    $this->deleteSuccess($id);
                }
            } else {
                $items = $this->model::whereIn('id', $id);
                if (!empty($items)) {
                    $retVal = $items->delete();
                }
            }
        } catch(Exception $ex) {

        }
        return $retVal;
    }

    public function selectById($id) {
        $item = [];
        if (!empty($id)) {
            $item = $this->model::find($id);
            if (!empty($item)) {
                $this->prepareSelect($item);
            }
        }
        return $item;
    }

    protected function prepareSelect(&$item) {
        // build data item before return
    }

    public function getFirst($args = null) {
        if ($args == null) {
            throw new \InvalidArgumentException('Missing argument');
        }
        $query = $this->model::query();
        foreach ($args as $key => $value) {
            $query->where($key, '=', $value);
        }
        $item = $query->first();
        if (!empty($item)) {
            $this->prepareSelect($item);
        }
        return $item;
    }

    public function getLast($args = null) {
        if ($args == null) {
            throw new \InvalidArgumentException('Missing argument');
        }
        $builder = (call_user_func(static::MODEL . '::query'));
        foreach ($args as $key => $value) {
            $builder->where($key, '=', $value);
        }
        return $builder->last();
    }

    protected function deleteSuccess($itemId)
    {
        # code...
    }

    public function getCategoryBreadcrumb($params)
    {
        if (!empty($params['id'])) {
            $category = \DB::table('category')->where('id', $params['id'])->first();
        } else if (!empty($params['slug'])) {
            $category = \DB::table('category')->where('slug', $params['slug'])->first();
        }
        $breadcrumbs = collect();

        if (!empty($category)) {
            $breadcrumbs = \DB::table('category')->where('_lft', '<=', $category->_lft)->where('_rgt', '>=', $category->_rgt)->orderBy('_lft', 'ASC')->get(['slug', 'name']);
            if (!empty($breadcrumbs)) {
                foreach ($breadcrumbs as $item) {
                    if (isset($item->slug)) {
                        $item->slug = '/c-'. $item->slug;
                    }
                }
            }
        }
        return $breadcrumbs;
    }

    protected function triggerAsyncRequest($url, $method = "GET", $params = [], $headers = [])
    {
        $channel = curl_init();
        curl_setopt($channel, CURLOPT_URL, $url);
        // curl_setopt($channel, CURLOPT_NOSIGNAL, 1);
        curl_setopt($channel, CURLOPT_TIMEOUT, 12000);
        curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
        if ($method == "post" || $method == "POST") {
            curl_setopt($channel, CURLOPT_POST, true);
            curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($params));
        }
        if ($headers) {
            curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($channel);
        curl_close($channel);
        return json_decode($data, true);
    }
}
