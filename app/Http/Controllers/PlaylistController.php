<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index($username)
    {
        $user = auth()->user();

        $users = User::all();

        $detail = User::where('username', $username)->firstOrFail();
        
        $playlists = Playlist::where('user_id', $detail->id)->with('video')->get();

        return view('home.playlist', [
            'title' => 'Playlist',
            'user' => $user,
            'users' => $users,
            'detail' => $detail,
            'playlists' => $playlists,
        ]);
    }
}
