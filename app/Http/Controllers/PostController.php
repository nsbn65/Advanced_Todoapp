<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Todo::all();
        /**return view('index', ['posts' => $posts]);**/
        $tags = Tag::all();
        $user = Auth::user();
        $posts = Todo::paginate(4);
        $param = ['posts' => $posts, 'user' =>$user, 'tag' =>$tags];
        return view('index', $param);
    }

    public function create(PostRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::create($form);
        return redirect('/');
    }

    public function update($id, PostRequest $request)
    {
        $form = $request->all();
        Todo::find($request->id)->update($form);
        return redirect('/');
    }

    public function delete($id)
    {
        $form = Todo::find($id);
        $form->delete();
        return redirect('/');
    }

    public function find()
    {
        
    }
    public function search()
    {
        
    }
}