<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <title>@yield('title')</title>
</head>
<body>
  <div class="container">
    @yield('container')
    <div class="card">
      <div class = "card-header">
        <p class="todo-title">Todo List</p>
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
      <a class = "btn-search" href = "{{url('/search')}}">タスク検索</a>
      <div class="todo">
        <form action="/create" method="post" class="content-add">
          @csrf
          <input type="text" class="input-add" name="name"/>
          <select class = "select_tag" id = "tag_id" name = "tag_id">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
          </select>
          <input class="btn-add" type="submit" value="追加" />
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
                  <option value="{{ $tag->id }}" @if (old($tag->id == '$tag')) selected @endif>{{ $tag->name }}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <button class="btn-update">更新</button>
              </td>
            </form>
            <td>
              <form action="{{ route('todo.delete', ['id' => $post->id]) }}"method="post">
                @csrf
                <button class="btn-delete">削除</button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</body>
</html>