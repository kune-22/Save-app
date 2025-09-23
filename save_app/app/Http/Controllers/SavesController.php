<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag; 
use App\Models\User;

class SavesController extends Controller
{
    function index(Request $request){
    $userId = auth()->id();
    $links = Link::with('tags')->where('user_id', $userId)->get();
    $tags = Tag::all();

    return view('home.top', compact('links', 'tags'));
    }

    function store(Request $request){
        $request->validate([
            'url' => 'required|url',
        ]);
        
        $url = $request["url"];
        $title = $request["title"] ?? null;
        $is_favorite = $request["is_favorite"] ?? false;
        
        $user = $request->user();
        $link = $user->links()->create([
            "url" => $url,
            "title" => $title,
            "is_favorite" => $is_favorite,
        ]);
        
        if (!empty($request["new_tag"])) {
            // 新しいタグが入力された場合
            $tag = Tag::firstOrCreate(["name" => trim($request["new_tag"])]);
            $link->tags()->attach($tag->id);
        } else if (!empty($request["tag_id"])) {
            // 既存のタグが選択された場合
            $link->tags()->attach($request["tag_id"]);
        }
        return redirect()->route("saves");
    }
    
    function edit($id){
        $user = auth()->user();

        $link = $user->links()->find($id);
        return view('saves.edit', compact('link'));
    }
}
