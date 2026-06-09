<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = $request->user()
            ->bookmarks()
            ->with(['news.category'])
            ->latest()
            ->get();

        return response()->json($bookmarks);
    }

    public function toggle(Request $request, News $news)
    {
        $bookmark = $request->user()->bookmarks()->where('news_id', $news->id)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['message' => 'تم الحذف من المفضلة', 'bookmarked' => false]);
        }

        $request->user()->bookmarks()->create(['news_id' => $news->id]);
        return response()->json(['message' => 'تم الإضافة للمفضلة', 'bookmarked' => true]);
    }
}
