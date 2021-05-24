<?php

namespace Helper;

class FormBuilder
{

    private $form;

    public function __construct($method, $action)
    {
        $this->form = '<form method="' . $method . '" ';
        $this->form .= 'action="' . $action . '">';
    }

    public function get()
    {
        $this->form .= '</form>';
        return $this->form;
    }

    public function input($name, $type, $value = '', $placeholder = '', $id = '', $class = '', $label = '')
    {
        if ($id != '' && $label != '') {
            $this->form .= "<label for='$id'>$label</label>";
        }
        $this->form .= "<input id='$id' class='$class' name='$name' type='$type' ";
        $this->form .= "value='$value' placeholder='$placeholder' ><br>";
        return $this;
    }

    public function select()
    {

    }

    public function texarea($name)
    {
        $this->form .= "<textarea name='$name'></textarea>";
        return $this;
    }
}