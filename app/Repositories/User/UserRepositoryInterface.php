<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getAll($filters, $paginate);
    public function getTotal($filters);
    public function create($filters);
    public function edit($filters, $id);
}
