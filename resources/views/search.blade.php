@extends('index')

@section('card')

<div class="card">
  <div class = "card-header">
    <p class="todo-title">タスク検索</p>
      <div class = "auth">
        <p class = "auth-user"> {{$user->name}}でログイン中</p>
        <form action = "{{ route('logout') }}" method = "post">
          @csrf
          <input class = "btn-logout" type = "submit" value = "ログアウト">
        </form>
      </div>
    </div>
    @if (count($errors) > 0)
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
    @endif
    <div class="todo">
      <form action="/find" method="post" class="content-find">
        @csrf
        <input type="text" class="input-find" name="name"/>
        <select class = "select_tag" id = "tag_id" name = "tag_id">
          @foreach ($tags as $tag)
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
        </select>
        <input class="btn-find" type="submit" value="検索" />
      </form>
      <table>
        <tr>
          <th>作成日</th>
          <th>タスク名</th>
          <th>タグ</th>
          <th>更新</th>
          <th>削除</th>
        </tr>
        @foreach($posts as $post)
        <tr>
          <td>
            {{ $post->created_at }}
          </td>
          <form action="{{ route('todo.update', ['id' => $post->id]) }}" method="post">
            @csrf
            <td>
              <input type="text" class="input-update" value="{{ $post->name }}" name="name"/>
            </td>
            <td>
              <select class = "select_tag" id = "tag_id" name = "tag_id">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <button class="btn-update">更新</button>
            </td>
          </form>
          <td>
            <form action="{{ route('todo.delete', ['id'=>$post->id]) }}"method="post">
              @csrf
              <button class="btn-delete">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
      <a class = "btn-back" href = "{{url('/')}}">戻る</a>
    </div>
  </div>
</div>

@endsection