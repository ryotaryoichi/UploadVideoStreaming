<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::get();
        return view('index')->with(['list' => $video]);
    }

    public function getVideoUploadForm()
    {
        return view('video-upload');
    }

    public function uploadVideo(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
        ]);

        $filePath = 'videos/' . $request->video->hashName();

        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video), 'public');

        // File URL to access the video in frontend
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {
            $video = new Video();
            $video->title = $request->title;
            $video->path = $filePath;
            $video->save();

            return back()->with('success','Video has been successfully uploaded.');
        }

        return back()->with('error','Unexpected error occured');
    }

    public function view($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return back()->with('error','Video not found');;
        }

        return view('detail')->with(['video' => $video]);

    }

    public function edit($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return redirect('/')->with('error','Video not found');;
        }

        return view('edit')->with(['video' => $video]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'video' => 'file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
        ]);

        $video = Video::find($id);
        if (!$video) {
            return back()->with('error','Video not found');;
        }

        if ($request->filled('video')) {
            $filePath = 'videos/' . $request->video->hashName();
            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video), 'public');
            if (!$isFileUploaded) {
                return back()->with('error','Unexpected error occured');
            }

            $video->path = $filePath;
        }

        $video->title = $request->title;
        $video->save();

        return redirect()->route('view.video', $video->id)->with('success','Video has been successfully uploaded.');
    }

    public function delete($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return back()->with('error','Video not found');;
        }

        $video->delete();

        return redirect()->route('list.video')->with('success','Video has been successfully deleted.');

    }
}
