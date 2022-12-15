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
      <div class="todo">
        <form action="/find" method="POST" class="content-find">
          @csrf
          <input type="text" class="input-add" name="keyword" value="{{ $keyword }}"/>
          <select class = "select_tag" id = "tag_id" value = "{{$tag_name}}" name = "tag_id">
            <option value =""></option>
            @foreach ($tags as $id => $tag_name)
              <option value="{{ $id }}" @if($tags == '{{ $tags_item->getTags() }}') selected @endif>{{ $tag_name }}</option>
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
          @if (!empty($posts))
          @foreach($posts as $post)
          <tr>
            <td>
              {{ $post->created_at }}
            </td>
            <form action="{{ route('todo.update', ['id' => $post->id]) }}" method="post">
              @csrf
              <td>
                <input type="text" class="input-update" value="{{ $post->name }}" name="content"/>
              </td>
              <td>
                <select class = "select_tag" name = "tag_id">
                  @foreach ($tags as $tags_item)
                  <option value="{{ $tags_item->getTags() }}" @if($tags == '{{ $tags_item->getTags() }}') selected @endif>{{ $tags_item->tag_name }}</option>
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
          @endif
        </table>
        <a class = "btn-back" href = "{{url('/')}}">戻る</a>
      </div>
    </div>
  </div>
</body>
</html>