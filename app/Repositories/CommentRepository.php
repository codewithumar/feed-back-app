<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function all()
    {
        return Comment::all();
    }

    public function store($data)
    {
        $commentdata = [
            'feedback_id' => $data['feedback_id'],
            'user_id' => $data['user_id'],
            'content' => $data['content'],
        ];
        $comment = Comment::create($commentdata);
        return $comment;
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment record not found.'], 404);
        }
        return $comment;
    }

    public function update($id, $data)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment record not found.'], 404);
        }

        $comment->content = $data['content'];

        $comment->save();

        return $comment;
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment record not found.'], 404);
        }

        $comment->delete();
    }


    public function getCommentsForFeedback($id, $page, $limit)
    {
        $query = Comment::where('feedback_id', $id);

        $comments = $query->paginate($limit, page: $page);

        return $comments;
    }
}
