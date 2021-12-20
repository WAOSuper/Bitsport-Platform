<div class="sidebar" style="margin: 0;">
     @foreach($menus as $menu)
          <a href="{{url('content/'.$menu->slug)}}"><h3>{{$menu->title}}</h3></a>
     @endforeach
 </div>