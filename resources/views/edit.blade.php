<!DOCTYPE html>
<html>
<head>
    <title>Upload Video Streaming</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Upload Video Streaming</h2>
        </div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('update.video', $video->id) }}" method="POST" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control" value="{{ $video->title }}"/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Select Video:</label>
                            <input type="file" name="video" class="form-control" value="{{ $video->path }}"/>
                            <video width="320" height="240" src="{{ \Illuminate\Support\Facades\Storage::url($video->path) }}" controls>
                            </video>
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
