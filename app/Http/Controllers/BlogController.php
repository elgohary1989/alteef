<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)
            ->latest('published_at')
            ->paginate(6);

        $latestPosts = Post::where('published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('blog.index', [
            'settings' => SiteSetting::instance(),
            'posts' => $posts,
            'latestPosts' => $latestPosts,
        ]);
    }

    public function show($locale, $post)
    {
        $post = Post::where('slug', $post)->firstOrFail();

        $post->increment('views');

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('blog.show', compact(
            'post',
            'relatedPosts'
        ));
    }
}
