<?php

namespace App\Interfaces;


interface UserRepositoryInterface
{
    public function all();
    public function create($data);
    public function update($data, $id);
    public function delete($id);
    public function show($id);

    public function login($data);
    public function logout($request);
}
