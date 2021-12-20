<?php 
namespace App\Http\ViewComposers;

use App\Nav;

class NavComposer
{
    public function compose($view)
    {
        $view->with('menu', Nav::all());
    }
}

?>