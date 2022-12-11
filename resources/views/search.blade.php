<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <title>TodoApp</title>
</head>
<body>
  <div class="container">
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
        <form action="/search" method="GET" class="content-find">
          @csrf
          <input type="text" class="input-add" name="キーワード" value="{{ $keyword }}"/>
          <select class = "select_tag" id = "tag_id" name = "tag_id">
            <option value =""></option>
            @foreach ($tags as $tag)
              <option value="{{ $tag->getTag() }}" @if($tag_category == '{{ $tag->getTag() }}') selected @endif>{{ $tag->getTag() }}</option>
            @endforeach
          </select>
          <input class="btn-add" type="submit" value="検索" />
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
                <select class = "select_tag" name = "tag_id">
                  @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}" @if($tag->id == $post->tag_id) selected @endif>{{ $tag->name }}</option>
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
</body>
</html>