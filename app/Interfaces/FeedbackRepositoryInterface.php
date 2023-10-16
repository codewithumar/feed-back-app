<?php

namespace App\Interfaces;

interface FeedbackRepositoryInterface
{
    public function all();
    public function store($data);
    public function show($id);
    public function update($id, $data);
    public function destroy($id);
    public function voteCount($id);
}
