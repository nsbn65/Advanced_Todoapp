<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
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

    public function search(Request $request)
    {
    $tag = new Tag;
    $tags = $tag->getTags();
    $keyword = $request->input('keyword');
    $tag_name = $request->input('tag_name');
    $user = Auth::user();

    return view('search', 
    [
    'tags' => [],
    'keyword' => $keyword,
    'tag_name' => $tag_name,
    'user' => $user
    ]);
    }

    public function find(Request $request)
    {
    $keyword = $request->input('keyword'); 
    $tag_name = $request->input('tag_name'); 
    $user = Auth::user();

    $query = Todo::query();

    if (isset($keyword)) 
    {
    $query->where('content', 'like', '%' . self::escapeLike($keyword) . '%');
    }
    if (isset($tag_name)) 
    {
    $query->where('tag_name', $tag_name);
    }

    $posts = $query->orderBy('tag_id', 'asc')->paginate(15);

    $tag = new Tag;
    $tags = $tag->getTags();

    return view('search', [
        'posts' => $posts,
        'tags' => $tags,
        'keyword' => $keyword,
        'tag_name' => $tag_name,
        'user' => $user
    ]);
    }
}