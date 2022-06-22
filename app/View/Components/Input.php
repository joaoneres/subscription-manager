<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $col, $field, $label, $default, $mb, $readonly, $type, $step, $required;

    public function __construct($col, $field, $default = null, $label, $readonly = false, $mb = '0', $type = 'text', $step = 0, $required = true)
    {
        $this->mb = $mb;
        $this->col = $col;
        $this->field = $field;
        $this->label = $label;
        $this->default = $default;
        $this->readonly = $readonly;
        $this->type = $type;
        $this->step = $step;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.input');
    }
}
