<?php

namespace Core\View;

use Core\View\ViewRender;

class View
{
    public $path;
    public $vars;

    public static function instance()
    {
        return new self;
    }

    public static function make($path)
    {
        $class = self::instance();
        $class->path = $path;
        return $class;
    }

    public function share($vars)
    {
        $this->vars = $vars;
        return $this;
    }

    public function render()
    {
        echo $this->filterView();
    }

    public function filterView()
    {
        $files = file_get_contents("app/views/{$this->path}.tpl");
        if(preg_match("(@section\(['\"][^\s]+)", $files,$section))
        {
            $section = ViewRender::filterSection($section);
        }

        if(preg_match("(@use\(['\"][^\s]+)", $files,$use))
        {
            $use_path = ViewRender::filterUse($use);
            $use_content = file_get_contents("app/views/{$use_path}");
            $files = preg_replace("({$use[0]})",$use_content,$files);
        }

        if(preg_match("(@ext\(['\"][^\s]+)", $files,$ext))
        {
            // dd(ViewRender::filterExt($ext));
            (new $this)->make(ViewRender::filterExt($ext))->render();
        }

        return $files;
    }
}
