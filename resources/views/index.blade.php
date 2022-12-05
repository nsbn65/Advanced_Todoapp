<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <style>
    body {
      background-color:rgb(47,11,124);
      width: 100%;
      margin: 0 auto;
    }
    

    .card {
      position: absolute;
      background-color:#fff;
      width:55%;
      top:50%;
      left:50%;
      transform:translate(-50%,-50%);
      border-radius:10px;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    .todo-title {
      font-weight: bold;
      font-size: 27px;
      margin-left: 20px;
    }

    .auth {
      display: flex;
      align-items: center;
      margin-right: 40px; 
    }
    
    .auth>.auth-user {
      margin-right: 1rem;
    }

    .btn-logout {
      text-align: left; 
      font-size:12px;
      color: red;
      border:2px solid red;
      border-radius:5px;
      background-color:#fff;
      padding:7px 14px;
      font-weight: bold;
      cursor: pointer;
      outline: none;
    }

    .btn-logout:hover {   
      background-color: red;
      border-color: red;
      color: #fff;
    }

    .btn-search {
      font-size: 12px;
      display: inline-block;
      border: 2px solid #cdf119;
      color: #cdf119;
      border-radius:5px;
      padding:8px 16px;
      font-weight: bold;
      cursor: pointer;
      outline: none;
      text-decoration: none;
      margin-left: 20px;
      margin-bottom: 10px;
    }

    .btn-search:hover {
      background-color: #cdf119;
      border-color: #cdf119;
      color: #fff;
    }

    .input-add {
      width: 75%;
      height: 30px;
      padding: 3px;
      margin-left: 20px;
      border-radius:5px;
      border: 1px solid #ccc;
      appearance: none;
      font-size: 14px;
      outline: none; 
    }

    .select_tag {
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
    }

    .btn-add {
      text-align: left; 
      font-size:12px;
      color:#FA6FEC;
      border:2px solid #FA6FEC;
      border-radius:5px;
      background-color:#fff;
      padding:7px 14px;
      font-weight: bold;
      cursor: pointer;
      outline: none;
    }
    
    .btn-add:hover{
      background-color: #FA6FEC;
      border-color: #FA6FEC;
      color: #fff;
    }

    table {
      width: 100%;
      text-align: center;
      margin-top: 20px;
      border-collapse: separate;
      border-spacing: 40px 10px;
    }

    .input-update {
      width: 75%;
      height: 30px;
      padding: 5px;
      left: 10px;
      border-radius:5px;
      border: 1px solid #ccc;
      appearance: none;
      font-size: 12px;
      outline: none; 
    }

    .btn-update {
      font-size:11px;
      color:#faa628;
      border:2px solid #faa628;
      border-radius:5px;
      background-color:#fff;
      padding:7px 13px;
      font-weight: bold;
      cursor: pointer;
      outline: none;
    }

    .btn-update:hover {
      background-color: #faa628;
      border-color: #faa628;
      color: #fff;
    }

    .btn-delete {
      font-size:11px;
      color: #21e0ed;
      border:2px solid #21e0ed;
      border-radius:4px;
      background-color:#fff;
      padding:7px 13px;
      font-weight: bold;
      cursor: pointer;
      outline: none;
    }

    .btn-delete:hover {
      background-color: #21e0ed;
      border-color: #21e0ed;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class = "card-header">
        <p class="todo-title">Todo List</p>
        <div class = "auth">
          <p class = "auth-user"> {{$user->name}}でログイン中</p>
          <form method = "post" action = "/logout">
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
      <a class = "btn-search" href = "http://127.0.0.1:8000/search">タスク検索</a>
      <div class="todo">
        <form action="/create" method="post" class="content-add">
          @csrf
          <input type="text" class="input-add" name="name"/>
          <select name = "tag_id" class = "select_tag">
            <option value = "1">家事</option>
            <option value = "2">勉強</option>
            <option value = "3">運動</option>
            <option value = "4">食事</option>
            <option value = "5">移動</option>
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
                <select name = "tag_id" class = "select_tag">
                  <option value = "1">家事</option>
                  <option value = "2">勉強</option>
                  <option value = "3">運動</option>
                  <option value = "4">食事</option>
                  <option value = "5">移動</option>
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