<?php

namespace Fawad\LaravelComments\Http\Livewire;

use Livewire\Component;

class Comment extends Component
{
    public $model;

    public function mount($model)
    {
        $this->model = $model;
    }
    public function render()
    {
        return view('comments::livewire.comments');
    }
}
