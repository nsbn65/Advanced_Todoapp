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
        $user = Auth::user();
        $tags = Tag::all();
        return view('index',
        [
        'posts' => $posts,
        'user' => $user,
        'tags' => $tags
        ]);
    }

    public function create(PostRequest $request)
    {
        $form = $request->all();
        $form['user_id'] = Auth::id();
        unset($form['_token']);
        Todo::create($form);
        return redirect('/');
    }

    public function update(PostRequest $request)
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

    public function search()
    {
        $posts = Todo::all();
        $user = Auth::user();
        $tags = Tag::all();
        return view('search',
        [
        'posts' => $posts,
        'user' => $user,
        'tags' => $tags,
        'keyword' => ''
        ]);
        
    }
    public function find(PostRequest $request)
    {
        $input = $request->all();
        //Todo::find($input);

        $tags = $request->input('tags');
        $keyword = $request->input('keyword');
        
        $query = Todo::query();
        $query->join('tag', function ($query) use ($request) {
        $query->on('todo.tags_id', '=', 'tag.id');
        });
        
        if(!empty($tags)) {
            $query->where('tags', 'LIKE', $tags);
        }
        if(!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();
        
        $tag_list = Tag::all();
        
        return view('search',compact('posts','tags','tag','tag_list'));
    }
}