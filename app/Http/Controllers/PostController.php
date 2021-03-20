<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show single post Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Post $post){
        return view('blog-post', ['post' => $post]);
    }

    /**
     * Show all posts page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //  get posts related to logged user
        //  $posts = auth()->user()->posts;

        //  get all posts for all users
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show create post page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(){
        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    /**
     * Store new post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(){

        $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        session()->flash('created-post-message', 'Post was created');

        return redirect()->route('posts.index');
    }

    /**
     * Edit post page.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Post $post)
    {
        $this->authorize('view', $post);

        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update post.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Post $post)
    {

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);

        if(request('post_image')){
            $post->post_image = request('post_image')->store('images');
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->update();

        session()->flash('updated-post-message', 'Post was updated');

        return redirect()->route('posts.index');
    }

    /**
     * Delete post by id.
     *
     * @param Post $post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post, Request $request){
        // check if user authorized to delete this post
        $this->authorize('delete', $post);

        // delete this post
        $post->delete();

        // set flash message
        $request->session()->flash('message', 'Post was deleted');

        // return to the pervious route
        return back();
    }

}
