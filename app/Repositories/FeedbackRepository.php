<?php

namespace App\Repositories;

use App\Interfaces\FeedbackRepositoryInterface;

use App\Models\Feedback;


class FeedbackRepository implements FeedbackRepositoryInterface
{

    public function all()
    {
        return Feedback::all();
    }

    public function store($data)
    {
        $feedbackData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'vote_count' => 0,
            'user_id' => $data['user_id']
        ];

        $feedback = Feedback::create($feedbackData);
        return $feedback;
    }

    public function show($id)
    {
        return Feedback::find($id);
    }

    public function update($id, $data)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback record not found.'], 404);
        }
        $feedback->update($data);
        return $feedback;
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback record not found.'], 404);
        }
        $feedback->delete();
        return $feedback;
    }

    public function voteCount($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['message' => 'Feedback record not found.'], 404);
        }
        $feedback->vote_count = $feedback->vote_count + 1;
        $feedback->save();
        return $feedback;
    }
}
