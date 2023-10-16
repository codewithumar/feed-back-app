<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackRequest;
use App\Repositories\FeedbackRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FeedbackController extends Controller
{

    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }
    public function voteCount($id)
    {
        $feedback = $this->feedbackRepository->voteCount($id);
        return response()->json($feedback);
    }

    public function index()
    {
        $feedback = $this->feedbackRepository->all();

        return response()->json($feedback);
    }

    public function store(CreateFeedbackRequest $request)
    {
        $feedback = $this->feedbackRepository->store($request->all());

        return response()->json($feedback);
    }

    public function show($id)
    {
        $feedback = $this->feedbackRepository->show($id);

        if (!$feedback) {
            return response()->json(['message' => 'Feedback record not found.'], 404);
        }

        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $feedback = $this->feedbackRepository->update($id, $request->all());

        if (!$feedback) {
            return response()->json(['message' => 'Feedback record not found.'], 404);
        }

        return response()->json($feedback);
    }

    public function destroy($id)
    {
        $this->feedbackRepository->destroy($id);

        return response()->json(['message' => 'Feedback record deleted successfully.']);
    }
}
