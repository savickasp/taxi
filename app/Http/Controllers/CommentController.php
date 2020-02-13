<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class CommentController extends Controller
{
    public function index(Comment $comment)
    {

        $comment = $comment
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->get();

        return response($comment, 200);
    }

    public function store(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'body' => 'required|string',
            'user_id' => 'required|integer',
            'parrent_id' => 'nullable',
        ]);

        $user_id = $data['user_id'];

        $comment->create($data);

        $comment = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.name')
            ->where('user_id', $user_id)
            ->latest('created_at')
            ->first();

        return response($comment, 200);
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'body' => 'required|string'
        ]);
        $comment->body = $data['body'];
        $comment->save();

        return response('updated',200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response( 'deleted',200);
    }
}
