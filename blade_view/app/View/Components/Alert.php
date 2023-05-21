<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $content;
    public $dataIcon;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $content, $dataIcon='check')
    {
        $this->type = $type;
        $this->content = $content;
        $this->dataIcon = $dataIcon;

        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
