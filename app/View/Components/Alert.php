<?php
namespace App\View\Components;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;

class Alert extends Component
{
    public $type;
    public $dismissible;
    protected $classes = ['alert'];
//    public $id;
    protected $types = [
        "success",
        "warning",
        "danger",
        "info",
    ];
    public function validType($type){
        return in_array($type, $this->types) ? $type : $this->types[3];
    }
    /**
     * Create a new component instance.
     */
    public function __construct($type = "info" /* ,$id*/, $dismissible = false){
        $this->type = $this->validType($type);
        $this->classes[] = "alert-{$this->type}";
        if($dismissible){
            $this->classes[] = "alert-dismissible fade show";
        }
        $this->dismissible = $dismissible;
//        $this->id = $id;
    }
    public function link($text,$target = '#'){
        return new HtmlString("<a href=\"{$target}\" class=\"alert-link\">{$text}</a>");
    }
    public function icon($url = null){
        $this->classes[] = "d-flex align-items-center";
        $icon = $url ?? asset("icons/icon-{$this->type}.svg");
        return new HtmlString("<img class='me-2' src='{$icon}'>");
    }
    public function getClasses(){
        return join(" ", $this->classes);
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.alert');
    }
}
