<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $title, $content, $postId;
    public $isEditing = false;


    public function render()
    {
        $this->posts = Post::latest()->get();
        return view('livewire.posts');
    }

    public function store()
    {
        $this->validate([
            'title'=> 'string|required',
            'content'=>'nullable'
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        session()->flash('message', 'Post Created Successfully');
        $this->resetInputs();
    }

    public function edit($id)
    {
        $post = Post::findorfail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'nullable'
        ]);

        $post = Post::find($this->postId);
        $post->update([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->resetInputs();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
    }

    public function resetInputs()
    {
        $this->title = '';
        $this->content = '';
        $this->isEditing = '';
        $this->postId = null;
    }
}
