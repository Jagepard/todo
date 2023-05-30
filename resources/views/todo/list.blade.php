<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Jagepard">
<meta name="generator" content="Hugo 0.84.0">
<meta name="_token" content="{!! csrf_token() !!}" />

<title>{{ $title }}</title>

<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">

<!-- Bootstrap core CSS -->
<link href="https://bootswatch.com/5/lumen/bootstrap.min.css" rel="stylesheet">

<!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<meta name="theme-color" content="#7952b3">

<style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: #ffffff;
        background: #2196f3;
        padding: 3px 7px;
        border-radius: 3px;
    }
    .bootstrap-tagsinput {
        width: 100%;
    }

    .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    }

    @media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex text-dark text-decoration-none">
        <h1 class="fs-4">ToDo</h1>
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <form id="form" action="/create" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="user" name="user" value="{{ optional(Auth::user())->id }}">
            <div class="row">
                <div class="col">
                <input type="text" id="task" class="form-control" placeholder="Укажите описание задачи..." name="task">
                </div>
                <div class="col">
                <button type="submit" class="btn btn-primary" id="btn-save">Добавить задачу</button>
                </div>
            </div>
            </form> 
            <hr>

            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    </tr>
                </thead>

                <tbody id="list" name="list">
                    @foreach ($items as $item)
                    <tr class="align-middle">
                    <td>{{ $item->id }}</td>
                    <td>
                        @if($item->img)
                        <a class="text-decoration-none" href="{{ url('/storage/'.$item->img) }}" target="_blank">
                        <img src="{{ url('/storage/'.$item->thumb) }}" alt="{{ $item->name }}">
                        </a>
                        <a href="{{ url('/remove_image/'.$item->id) }}"><button type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/></svg>
                        </button></a>
                        @endif
                    </td>
                    
                    <td>
                        <form enctype="multipart/form-data" action="upload_image" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $item->id }}" name="id">
                            <div class="input-group">
                            <input class="form-control w-25" width="50" type="file" name="upload">
                            <button type="submit" class="btn btn-success">загрузить</button>
                            </div>
                        </form>
                    </td>
                    <td class="w-25">
                        <form action="{{ url('update') }}" method="POST" id="{{ $item->id }}">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $item->id }}" name="id">
                            <input type="text" class="form-control input-lg" name="task" placeholder="{{ $item->text }}">
                        </form>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success" form="{{ $item->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>
                        </button>
                        <a href="{{ url('/delete/'.$item->id) }}">
                        <button type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/></svg>
                        </button></a>
                    </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>

            {!! $items->links() !!}


            <form action="search" method="post">
                {{ csrf_field() }}
                <div class="row">
                <div class="col">
                <input class="form-control" type="text" name="search" placeholder="Поиск по названию задачи...">
                </div>
                <div class="col">
                <button type="submit" class="btn btn-primary" id="btn-save">Поиск</button>
                </div>
            </div>
            </form>
        </div>

    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
     Jagepard &copy; 2023
    </footer>
  </div>
</main>

<script>
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            task: $('#task').val(),
            user: $('#user').val(),
        }

        console.log(formData);

        $.ajax({
            type: "POST",
            url: "/create",
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var task = '<tr class="align-middle"><td>' + data.id + '</td><td></td>';
                task += '<td><form enctype="multipart/form-data" action="upload_image" method="post">{{ csrf_field() }}'
                task += '<input type="hidden" value="' + data.id + '" name="id">'
                task += '<div class="input-group"><input class="form-control" width="50" type="file" name="upload">'
                task += '<button type="submit" class="btn btn-success">загрузить</button></div></form></td>'
                task += '<td class="w-25"><form action="{{ url("update") }}" method="POST" id="'+ data.id +'">{{ csrf_field() }}<input type="hidden" value="'+ data.id +'" name="id"><input type="text" class="form-control input-lg" name="task" placeholder="'+ data.text +'"></form></td>'
                task += '<td><button type="submit" class="btn btn-success" form="'+ data.id +'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></button>';
                task += '&nbsp;<a href="{{ url("/delete/") }}/' + data.id  + '"><button type="button" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16"><path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/></svg></button></td></tr></a>';

                $('#list').prepend(task);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</body>
</html>
