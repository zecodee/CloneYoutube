<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\VidTube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = auth()->user();
 
        $videos = VidTube::where('user_id', $user->id)->get();

        foreach ($videos as $vid) {
            $vid->days_since_creation = Carbon::parse($vid->created_at)->diffForHumans();
        }
        
        return view('studio.dashboard', [
            'title' => 'Dashboard',
            'user' => $user,
            'videos' => $videos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VidTube $vidTube)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username, VidTube $dashboard)
    {
        $user = auth()->user();
        return view('studio.edit', [
            'title' => 'Edit',
            'user' => $user,
            'vidtube' => $dashboard,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($username, Request $request, VidTube $dashboard)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:1000',
        ]);

        $validatedData['user_id'] = $user->id;

        $dashboard->update($validatedData);

        return redirect("/" . $user->username . "/dashboard");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username, VidTube $dashboard)
    {
        // dd($dashboard);
        
        $user = auth()->user();
        
        $dashboard->likes()->delete();
     
        $dashboard->comments()->delete();

        $dashboard->dislikes()->delete();

        $dashboard->playlists()->delete();

        $dashboard->delete();

        if($dashboard->thumbnail) {
            Storage::delete($dashboard->thumbnail);
        }
        
        if($dashboard->video) {
            Storage::delete($dashboard->video);
        }
 
        return redirect("/" . $user->username . "/dashboard");
    }
}
