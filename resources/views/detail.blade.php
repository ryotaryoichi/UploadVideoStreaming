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
                <div class="row">
                    <div class="col-12"><a href="{{ route('list.video') }}" class="btn btn-outline-primary btn-small">Back</a></div>
                </div>
               @if ($message = Session::get('success'))
                   <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
                   </div>
               @endif

              <div class="row">
                <div class="col-md-6 form-group">
                   <label>Title:</label>
                   <input type="text" name="title" class="form-control" value="{{ $video->title }}" readonly disabled/>
                </div>
                <div class="col-md-12 form-group">
                    <video width="320" height="240" src="{{ \Illuminate\Support\Facades\Storage::url($video->path) }}" controls>
                    </video>
                </div>
                <div class="col-md-6 form-group">
                   <a href="{{ route('edit.video', $video->id) }}" class="btn btn-success">Edit</a>
                </div>
              </div>
            </div>
         </div>
      </div>
   </body>
</html>
