<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag; 
use App\Models\User;

class SavesController extends Controller
{
    function index(Request $request){
        $links = Link::with('tags')->get();
        $tags = Tag::all();
        return view('home.top', compact('links', 'tags'));
    }

    function store(Request $request){
        $request->validate([
            'url' => 'required|url',
        ]);

        $link = Link::create([
            'user_id' => auth()->id(),
            'url' => $request['url'],
            'title' => $request['title'] ?? null,
            'is_favorite' => $request['is_favorite'] ?? false,
        ]);
        
        if (!empty($request['new_tag'])){
            $tag = Tag::firstOrCreate(['name' => trim($request['new_tag'])]);
            $link->tags()->attach($tag->id);
        } else if (!empty($request['tag_id'])){
            $link->tags()->attach($request['tag_id']);
        }
        return redirect()->route('saves');
    }

    function tag_store(Request $request){
        
    }

    function list(){
        return view('home.create');
    }
}
