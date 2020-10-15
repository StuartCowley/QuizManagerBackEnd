<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\User;

class ApiController extends Controller
{
    public function authUser($name, $password) {
        if (User::where('username', $name)->exists()) {
            $user = User::where('username', $name)->first();
            $verify = password_verify($password, $user->password);

            if ($verify) {
                $screen_name = $user->username;
                $perm = $user->permission;
                return response()->json([
                    "message" => "User authenticated",
                    "name" => $screen_name,
                    "permission" => $perm
                ]);
            }
        }
        return response()->json([
            "message" => "Username or password incorrect"
        ], 404);

    }

    public function getAllQuizzes() {
        $quizzes = Quiz::get()->toJson(JSON_PRETTY_PRINT);
        return response($quizzes, 200);
    }

    public function createQuiz(Request $request) {
        $quiz = new Quiz;
        $quiz->quiz_title = $request->quiz_title;
        $quiz->save();

        return response()->json(["message" => "Quiz created"], 201);
    }

    public function getQuiz($id) {
        if (Quiz::where('id', $id)->exists()) {
            $quiz = Quiz::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($quiz, 200);
        }
        return response()->json([
            "message" => "Quiz not found"
        ], 404);

    }

    public function updateQuiz(Request $request, $id) {
        if (Quiz::where('id', $id)->exists()) {
            $quiz = Quiz::find($id);
            $quiz->quiz_title = is_null($request->quiz_title) ? $quiz->quiz_title : $request->quiz_title;
            $quiz->save();

            return response()->json([
                "message" => "Quiz updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Quiz not updated"
            ], 404);

        }
    }

    public function deleteQuiz ($id) {
        if(Quiz::where('id', $id)->exists()) {
            $quiz = Quiz::find($id);
            $quiz->delete();
            $relatedQuestions = Quiz\Question::where('quiz_id', $id);
            $relatedQuestions->delete();

            return response()->json([
                "message" => "Quiz deleted"
            ],202);
        } else {
            return response()->json([
                "message" => "Quiz not found"
            ], 404);
        }
    }

    // Questions logic
    public function getAllQuestions() {
        $questions = Quiz\Question::all();
        return $questions;
    }

    public function updateQuestion(Request $request, $id) {
        if(Quiz\Question::where('id', $id)->exists()) {
            $question = Quiz\Question::find($id);
            $question->quiz_id = is_null($request->quiz_id) ? $question->quiz_id : $request->quiz_id;
            $question->question_text = is_null($request->question_text) ? $question->question_text : $request->question_text;
            $question->question_answer_a = is_null($request->question_answer_a) ? $question->question_answer_a : $request->question_answer_a;
            $question->question_answer_b = is_null($request->question_answer_b) ? $question->question_answer_b : $request->question_answer_b;
            $question->question_answer_c = is_null($request->question_answer_c) ? $question->question_answer_c : $request->question_answer_c;
            $question->question_answer_d = is_null($request->question_answer_d) ? NULL : $request->question_answer_d;
            $question->question_answer_e = is_null($request->question_answer_e) ? NULL : $request->question_answer_e;
            $question->save();

            return response()->json([
                "message" => "Question updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Question not updated"
            ], 404);
        }
    }

    public function updateQuestionText(Request $request, $id) {
        if(Quiz\Question::where('id', $id)->exists()) {
            $question = Quiz\Question::find($id);
            $question->question_text = is_null($request->question_text) ? $question->question_text : $request->question_text;
            $question->save();

            return response()->json([
                "message" => "Question text updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Question text not updated"
            ], 404);
        }
    }


    public function deleteQuestion ($id) {
        if(Quiz\Question::where('id', $id)->exists()) {
            $question = Quiz\Question::find($id);
            $question->delete();

            return response()->json([
                "message" => "Question deleted"
            ],202);
        } else {
            return response()->json([
                "message" => "Question not found"
            ], 404);
        }
    }

    public function addQuestion (Request $request) {
        $question = new Quiz\Question;
        $question->quiz_id = $request->quiz_id;
        $question->question_text = $request->question_text;
        $question->question_answer_a = $request->question_answer_a;
        $question->question_answer_b = $request->question_answer_b;
        $question->question_answer_c = $request->question_answer_c;
        $question->question_answer_d = $request->question_answer_d;
        $question->question_answer_e = $request->question_answer_e;
        $question->save();

        return response()->json(["message" => "Question created"], 201);
    }
}
