<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        private string $title,
        private ?string $add = null,
        private ?string $labelAdd = null,
        private $data = null,
        private $filter = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card', [
            'title' => $this->title,
            'add' => $this->add,
            'labelAdd' => $this->labelAdd,
            'data' => $this->data,
            'filter' => $this->filter,
        ]);
    }
}
