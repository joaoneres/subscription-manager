<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    public $col, $field, $label, $default, $mb, $readonly;

    public function __construct($mb = '0', $col, $field, $default = null, $label, $readonly = false)
    {
        $this->mb = $mb;
        $this->col = $col;
        $this->field = $field;
        $this->label = $label;
        $this->default = $default;
        $this->readonly = $readonly;
    }

    public function render()
    {
        return view('components.text-input');
    }
}
