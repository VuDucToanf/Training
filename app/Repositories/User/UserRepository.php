<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getAll($filters, $paginate = true)
    {
        $page_id = $filters['page_id'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;
        $offset = ($page_id - 1) * $page_size;
        return \DB::table('user')
            ->limit($page_size)
            ->offset($offset)
            ->get();
    }

    public function getTotal($filters)
    {
        return \DB::table('user')
            ->count();
    }
}
