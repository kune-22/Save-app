<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag;
use App\Models\User;

class ListController extends Controller
{
    /**
     * タグごとのリンク一覧、またはタグなしリンクの一覧を表示します。
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    function index(Request $request)
    {
        $userId = auth()->id();
        $links = Link::with('tags')->where('user_id', $userId);
        $tags = Tag::all();
        $selectedTag = null; // 選択されたタグを保持する変数

        // クエリパラメータからタグIDを取得
        $tagId = $request->query('tag_id');

        if ($tagId) {
            if ($tagId === 'none') {
                // タグなしのリンクを取得
                $links->doesntHave('tags');
            } else {
                // 指定されたタグが付いているリンクを取得
                $links->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('tag_id', $tagId);
                });
                $selectedTag = Tag::find($tagId);
            }
        }
        
        $links = $links->get();

        return view('list.save_list', compact('links', 'tags', 'selectedTag'));
    }
}
