<?php

namespace App\HTTP\ViewComposers;

use Illuminate\View\View;
use Auth;
use Sentinel;
use App\Models\Banner;

class Footer
{
	public function compose(View $view){

		$data = Banner::find(1);

		$view->with('banner', $data);
	}
}
