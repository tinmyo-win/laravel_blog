<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestComment;

class TestCommentController extends Controller
{
    public function create() {
        $comment = new TestComment();
        $comment->content = request()->content;
        $comment->test_id = request()->test_id;
        $comment->save();

        return back();
    }

    public function delete($id) {
        $comment = TestComment::find($id);
        $comment->delete();

        return back();
    }
}
