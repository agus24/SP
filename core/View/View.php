<?php

namespace Core\View;

class View
{
    private $base;
    private $view;
    private $variables = [];

    public static function instance()
    {
        return new self;
    }

    public function extend($base)
    {
        $this->base = $base;
        return $this;
    }

    public function make($name,$view)
    {
        $this->view[$name] = $view;
        return $this;
    }

    public function share($key,$variable)
    {
        $this->variables[$key] = $variable;
        return $this;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function render()
    {
        extract($this->view);
        return require "app/views/{$this->base}.view.php";
    }
}
