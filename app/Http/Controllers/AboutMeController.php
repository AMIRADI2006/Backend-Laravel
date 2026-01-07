<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AboutMeController extends Controller
{
    public function show(Request $request)
    {
        return AboutMe::where('user_id', $request->user()->id)->first();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $aboutMe = AboutMe::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['content' => $data['content']]
        );

        return response()->json($aboutMe);
    }

    public function destroy(Request $request)
    {
        AboutMe::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'About me deleted']);
    }
}
