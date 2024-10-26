<?php

namespace App\Http\Controllers;

use App\Models\VidTube;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        $user = auth()->user();
        return view('studio.upload', [
            'title' => 'Content',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'video' => 'required',
            'thumbnail' => 'required|image',
            'title' => 'required|min:5|max:100',
            'description' => 'required|min:5|max:1000',
        ]);

        // Simpan video
        $validatedData['video'] = $request->file('video')->store('videos');
        
        // Simpan thumbnail
        $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        $validatedData['user_id'] = $user->id;

        VidTube::create($validatedData);

        return redirect("/");
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
    public function edit(VidTube $vidTube)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VidTube $vidTube)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VidTube $vidTube)
    {
        //
    }
}
