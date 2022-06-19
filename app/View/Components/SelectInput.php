<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $col, $options, $selected, $field, $label, $mb, $required, $disabled;

    public function __construct($options, $field, $col, $label = null, $mb = '0', $selected = null, $required = false, $disabled = false)
    {
        $this->options = $options;
        $this->selected = $selected;
        $this->field = $field;
        $this->label = $label;
        $this->col = $col;
        $this->mb = $mb;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-input');
    }
}
