<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{

    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $comments = $this->commentRepository->all();

        return response()->json($comments);
    }

    public function store(CreateCommentRequest $request)
    {
        $data = $request->all();

        $comment = $this->commentRepository->store($data);

        return response()->json($comment);
    }

    public function show($id)
    {
        $comment = $this->commentRepository->show($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment record not found.'], 404);
        }

        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $comment = $this->commentRepository->update($id, $data);

        if (!$comment) {
            return response()->json(['message' => 'Comment record not found.'], 404);
        }

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $this->commentRepository->destroy($id);

        return response()->json(['message' => 'Comment record deleted successfully.']);
    }

    public function getCommentsForFeedback(Request $request, $id)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 5);

        $comments = $this->commentRepository->getCommentsForFeedback($id, $page, $limit);

        return response()->json($comments);
    }
}
