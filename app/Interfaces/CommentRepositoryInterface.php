<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function all();
    public function store($data);
    public function show($id);
    public function update($id,  $data);
    public function destroy($id);

    public function getCommentsForFeedback($id, $page, $limit);
}
