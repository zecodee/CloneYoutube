<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\User;
use App\Models\VidTube;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $videos = VidTube::all();

        $users = User::all();

        $user = auth()->user();
    
        foreach ($videos as $vid) {
            $vid->days_since_creation = Carbon::parse($vid->created_at)->diffForHumans();
        }

        return view('home.home', [
            'title' => 'Home',
            'videos' => $videos,
            'user' => $user,
            'users' => $users,
        ]);
    }

    public function search(Request $request)
    {
        $users = User::all();

        $user = auth()->user();

        $searchQuery = $request->input('query');
        $videos = VidTube::where('title', 'like', "%$searchQuery%")->orWhereHas('user', function ($query) use ($searchQuery) {
            $query->where('username', 'like', "%$searchQuery%");
        })->get();
    
        if ($videos->isEmpty()) {
            return view('home.home', [
                'title' => 'Home',
                'videos' => $videos,
                'query' => $searchQuery,
                'message' => 'No results found.',
                'user' => $user,
                'users' => $users,
            ]);
        }

        return view('home.home', [
            'title' => 'Home',
            'videos' => $videos,
            'query' => $searchQuery,
            'user' => $user,
            'users' => $users,
        ]);
    }
}
