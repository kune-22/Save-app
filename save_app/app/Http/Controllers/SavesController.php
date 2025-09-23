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

    return view('saves.top', compact('links', 'tags'));
    }

    function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'title' => 'nullable|string|max:255',
            'new_tag' => 'nullable|string|max:20|unique:tags,name',
            'tag_id' => 'nullable|array',
            'tag_id.*' => 'exists:tags,id',
        ]);

        $user = $request->user();
        $link = $user->links()->create([
            "url" => $request->url,
            "title" => $request->title,
            "is_favorite" => $request->has('is_favorite'),
        ]);

        $tagIds = [];
        if ($request->filled('new_tag')) {
            $newTag = Tag::firstOrCreate(["name" => trim($request->new_tag)]);
            $tagIds[] = $newTag->id;
        }

        if ($request->filled('tag_id')) {
            $tagIds = array_merge($tagIds, $request->input('tag_id'));
        }

        $link->tags()->sync($tagIds);

        return redirect()->route("saves")->with('success', 'リンクを保存しました。');
    }
    
    function show($id){
        $user = auth()->user();

        $link = $user->links()->with('tags')->find($id);
        return view('saves.show', compact('link'));
    }

    function edit($id){
        $user = auth()->user();

        $link = $user->links()->with('tags')->find($id);
        $tags = Tag::all();
        return view('saves.edit', compact('link', 'tags'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|url',
            'title' => 'nullable|string|max:255',
            'new_tag' => 'nullable|string|max:20|unique:tags,name',
            'tag_id' => 'nullable|array',
            'tag_id.*' => 'exists:tags,id',
        ]);

        $link = auth()->user()->links()->findOrFail($id);
        $link->update([
            "url" => $request->url,
            "title" => $request->title,
            "is_favorite" => $request->has('is_favorite'),
        ]);
        $tagIds = $request->input('tag_id', []);
        
        // 新しいタグが入力された場合
        if ($request->filled('new_tag')) {
            $newTag = Tag::firstOrCreate(["name" => trim($request->new_tag)]);
            $tagIds[] = $newTag->id;
        }
        
        // 最終的なタグIDのリストで完全に同期
        $link->tags()->sync($tagIds);

        return redirect()->route("saves")->with('success', 'リンクを更新しました。');
    }

    function destroy($id){
        $link = auth()->user()->links()->findOrFail($id);
        $link->tags()->detach(); // 中間テーブルのレコードを削除
        $link->delete();

        return redirect()->route("saves");
    }
}
