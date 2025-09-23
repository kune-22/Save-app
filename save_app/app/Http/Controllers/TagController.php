<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    function index(Request $request){
        $user = $request->user();
        $tags = Tag::all();
        return view('home.create', compact('tags'));
    }

    function store(Request $request){
        $request->validate([
            'name' => 'string|max:20|unique:tags,name',
        ]);
        
        $name = $request['name'];
        Tag::create([
            'name' => $name,
        ]);

        return redirect()->route('tag');
    }
}
