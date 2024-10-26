<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Dislike;
use App\Models\VidTube;
use App\Models\Playlist;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DetailController extends Controller
{
    public function detail($title)
    {
        $user = auth()->user();
        
        $videos = VidTube::all();

        foreach ($videos as $vid) {
            $vid->days_since_creation = Carbon::parse($vid->created_at)->diffForHumans();
        }
        
        $detail = VidTube::where('title', $title)->firstOrFail();

        $detail->days_since_creation = Carbon::parse($detail->created_at)->diffForHumans();
        
        $save_status = [];
        if($user) {
            $save_status[$detail->id] = Playlist::where('vid_tubes_id', $detail->id)->where('user_id', $user->id)->exists();
        }
        
        $like_status = [];
        $total_like = [];

        if($user) {
            $like_status[$detail->id] = Like::where('vid_tubes_id', $detail->id)->where('user_id', $user->id)->exists();
        }
        $total_like[$detail->id] = Like::where('vid_tubes_id', $detail->id)->count();
        
        $dislike_status = [];
        $total_dislike = [];
        if($user) {
            $dislike_status[$detail->id] = Dislike::where('vid_tubes_id', $detail->id)->where('user_id', $user->id)->exists();
        }
        $total_dislike[$detail->id] = Dislike::where('vid_tubes_id', $detail->id)->count();


        $total_comment = [];
        $total_comment[$detail->id] = Comment::where('vid_tubes_id', $detail->id)->count();
        $comments = Comment::where('vid_tubes_id', $detail->id)->get();

        return view('home.detail', [
            'user' => $user,
            'videos' => $videos,
            'detail' => $detail,
            'save_status' => $save_status,
            'like_status' => $like_status,
            'total_like' => $total_like,
            'dislike_status' => $dislike_status,
            'total_dislike' => $total_dislike,
            'total_comment' => $total_comment,
            'comments' => $comments,
        ]);
    }

    public function like(Request $request)
    {
        $user = auth()->user();
        
        $detail_id = $request->input('detail_id');
    
        $detail = VidTube::find($detail_id);
    
        Dislike::where('vid_tubes_id', $detail_id)->where('user_id', $user->id)->delete();
    
        $vid_like = Like::where('vid_tubes_id', $detail_id)->where('user_id', $user->id)->first();
    
        if($vid_like) {
            $vid_like->delete();
        } else {
            Like::create([
                'vid_tubes_id' => $detail_id,
                'user_id' => $user->id,
                'create_date' => Carbon::now(),
            ]);
        }
        return redirect('/' . $detail->title);
    }
    
    public function dislike(Request $request)
    {
        $user = auth()->user();
        
        $detail_id = $request->input('detail_id');
    
        $detail = VidTube::find($detail_id);
    
        Like::where('vid_tubes_id', $detail_id)->where('user_id', $user->id)->delete();
    
        $vid_dislike = Dislike::where('vid_tubes_id', $detail_id)->where('user_id', $user->id)->first();
    
        if($vid_dislike) {
            $vid_dislike->delete();
        } else {
            Dislike::create([
                'vid_tubes_id' => $detail_id,
                'user_id' => $user->id,
                'create_date' => Carbon::now(),
            ]);
        }
        return redirect('/' . $detail->title);
    }
    
    public function comment(Request $request)
    {
        $user = auth()->user();
        $detail_id = $request->input('detail_id');
    
        $detail = VidTube::find($detail_id);

        Comment::create([
            'vid_tubes_id' => $detail->id,
            'user_id' => $user->id,
            'comment' => $request->comment,
            'create_date' => Carbon::now(),
        ]);

        return redirect('/' . $detail->title);
    }

    public function playlist(Request $request)
    {
        $user = auth()->user();
        
        $detail_id = $request->input('detail_id'); 
        
        $detail = VidTube::find($detail_id);

        $detail_save = Playlist::where('vid_tubes_id', $detail->id)->where('user_id', $user->id)->first();

        if($detail_save) {
            $detail_save->delete();
        } 
        else {
            Playlist::create([
                'vid_tubes_id' => $detail->id,
                'user_id' => $user->id,
                'create_date' => Carbon::now(),
            ]);
        }

        return redirect('/' . $detail->title);
    }
}