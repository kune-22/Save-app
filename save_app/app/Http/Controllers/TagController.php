<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    function index(Request $request){
        $user = $request->user();
        $tags = Tag::all();
        return view('saves.tag_mana', compact('tags'));
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

    function edit($id){
        $tags = Tag::all();
        $tagToEdit = Tag::findOrFail($id); // 編集するタグを取得
        
        return view('saves.tag_mana', compact('tags', 'tagToEdit'));
    }

    function update(Request $request, $id){
        $request->validate([
            'name' => 'string|max:20|unique:tags,name,'.$id,
        ]);

        $tag = Tag::find($id);
        $tag->name = $request['name'];
        $tag->save();

        return redirect()->route('tag')->with('success', 'タグを更新しました。');
    }
    function destroy($id){
        $tag = Tag::findOrFail($id);
        $tag->links()->detach();
        $tag->delete();

        return redirect()->route('tag')->with('success', 'タグを削除しました。');
    }
}
