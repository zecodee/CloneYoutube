<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\VidTube;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index($username)
    {
        $detail = User::where('username', $username)->firstOrFail();

        $videos = VidTube::where('user_id', $detail->id)->get();

        $total_video = VidTube::where('user_id', $detail->id)->count();

        $users = User::all();

        $user = auth()->user();

        foreach ($videos as $vid) {
            $vid->days_since_creation = Carbon::parse($vid->created_at)->diffForHumans();
        }

        $is_own_channel = ($user && $detail->id === $user->id);

        return view('profile.channel', [
            'title' => 'Channel',
            'user' => $user,
            'users' => $users,
            'videos' => $videos,
            'total_video' => $total_video,
            'detail' => $detail,
            'is_own_channel' => $is_own_channel,
        ]);
    }

    public function subscribe($username)
    {
        $subs = User::where('username', $username)->first();

        if(!auth()->user()->subscribe->contains('subscribe_id', $subs->id)) {
            Subscriber::create([
                'subscriber_id' => auth()->id(),
                'subscribed_id' => $subs->id,
            ]);

            auth()->user()->subscribe()->create([
                'subscribe_id' => $subs->id,
            ]);
        }

        return redirect()->back();
    }

    public function unsubscribe($username)
    {
        $unsubs = User::where('username', $username)->first();

        Subscriber::where('subscriber_id', auth()->id())
        ->where('subscribed_id', $unsubs->id)
        ->delete();

        auth()->user()->subscribe()->where('subscribe_id', $unsubs->id)->delete();

        return redirect()->back();
    }
}
