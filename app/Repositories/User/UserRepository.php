<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function getAll($filters, $paginate = true)
    {
        $page_id = $filters['page_id'] ?? 1;
        $page_size = $filters['page_size'] ?? 10;
        $email = $filters['email'] ?? '';
        $full_name = $filters['full_name'] ?? '';
        $status = $filters['status'] ?? '';
        $gender = $filters['gender'] ?? '';
        $offset = ($page_id - 1) * $page_size;
        $query = \DB::table('user');
        if (!empty($email)) {
            $query->where('email', 'like', "%$email%");
        }
        if (!empty($full_name)) {
            $query->where('full_name', 'like', "%$full_name%");
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }
        if (!empty($gender)) {
            $query->where('gender', $gender);
        }
        return $query->limit($page_size)
            ->offset($offset)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getTotal($filters)
    {
        $email = $filters['email'] ?? '';
        $full_name = $filters['full_name'] ?? '';
        $status = $filters['status'] ?? '';
        $gender = $filters['gender'] ?? '';
        $query = \DB::table('user');
        if (!empty($email)) {
            $query->where('email', 'like', "%$email%");
        }
        if (!empty($full_name)) {
            $query->where('full_name', 'like', "%$full_name%");
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }
        if (!empty($gender)) {
            $query->where('gender', $gender);
        }
        return $query->count();
    }

    public function create($filters)
    {
        return User::create([
            'email' => $filters['email'],
            'gender' => $filters['gender'],
            'address' => $filters['location'],
            'status' => $filters['status'] ?? 'PENDING',
            'full_name' => $filters['full_name'],
        ]);
    }

    public function edit($filters, $id)
    {
        User::where('id', $id)->update([
            'email' => $filters['email'],
            'gender' => $filters['gender'],
            'address' => $filters['location'],
            'status' => $filters['status'] ?? 'PENDING',
            'full_name' => $filters['full_name'],
        ]);

        return \DB::table('user')->where('id', $id)->first();
    }
}
