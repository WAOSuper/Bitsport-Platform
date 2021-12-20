<?php

namespace App\HTTP\ViewComposers;

use Illuminate\View\View;
use Auth;
use Sentinel;
use App\Models\Category;

class Sidebar
{
	public function compose(View $view){

		$data=Category::where('status',0)->orderBy('orders', 'asc')->get();

		$view->with('category',$data);
	}
}
