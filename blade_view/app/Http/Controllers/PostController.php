<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = 'Post page';
//        $allPost = Post::all();
//        if ($allPost->count() > 0) {
//            foreach ($allPost as $post) {
//                echo $post->title.'<br>';
//            }
//        }

//        $allPost = Post::find(2);

        $allPost = Post::where('status', 1)->get();


        $allPost = Post::all();
        $allPost = $allPost->reject(function ($post) {
            return $post->status == 0;
        });

//        Post::chunk(2, function ($posts) {
//            foreach ($posts as $post) {
//                echo $post->title.'<br>';
//            }
//            echo 'End', '<br>';
//        });

        $allPost = Post::where('status', 1)->cursor();
//        $allPost = Post::cursor();
        foreach ($allPost as $post) {
            echo $post->title . '<br>';
        }
        dd($allPost);

    }

    public function add()
    {
        $daInsert = [
            'title' => 'Bai viet 5',
            'content' => 'Content 5',
            'status' => 1
        ];

        Post::create($daInsert);
//        Post::insert($daInsert);
//        $post = Post::create($daInsert);
//        echo 'Id vua insert'.$post->id;
//        dd($post);

        $post = Post::firstOrCreate([
            'id' => 14
        ], $daInsert);
        $check = true;
        $post = new Post();
        $post->title = "Bai viet 4";
        $post->content = "Content 4";
        if ($check) {
            $post->status = 1;
        }

//        $post->save();
    }

    public function update() {
        $post = Post::find(10);

//        $post->title;
//        $post->title = 'Title 14';
////        $original = $post->getOriginal('title');
//        $post->save();

        $post->content = 'Content 15';
        $post->title = 'Title 15';

        $check = $post->isDirty(); // ->true
        $check = $post->isDirty('status'); //->false
        $check = $post->isDirty('title'); //->true
        $check = $post->isDirty(['title', 'status']); //->true
        $check = $post->isClean(); //->false
        $check = $post->isClean('status'); //->true
        $check = $post->isClean(['title', 'status']); //->true

//        $post->save();

        $check = $post->wasChanged(); //->true
        $check = $post->wasChanged('status'); //->false
//        $check = $post->wasChanged(['status', 'title']); //->true

//        dd($original);
        $post = [
            'title' => 'Title 7',
            'content' => 'Content 7'
        ];
//        Post::where('id', 4)
//            ->update($post);
//        Post::updateOrCreate(['id' => 18], $post);
        Post::upsert([
            ['id' => 23, 'title' => 'Title 7', 'content' => 'Content 7', 'status' => 0 ],
        ], ['id']);
    }

    public function delete() {
//        $delete = Post::find(25)->delete();
//        $delete = Post::find(13)->forceDelete();
//        $delete = new Post();
//        $delete->restore();
//        Post::withTrashed()
//            ->where('id', 13)
//            ->restore();
        $delete = Post::withTrashed()
            ->where('id', 15)
            ->get();
        $delete = Post::onlyTrashed()
            ->where('id', 15)
            ->get();
//        $delete = Post::destroy(22);
//        $delete = Post::destroy(2,12);
//        $delete = Post::destroy(3, 26);
//        $delete = Post::destroy([5,14,18]);
//        $delete = Post::destroy(collect([1,4]));
        dd($delete);
    }
}
