<!-- Sidebar -->
          <div id="sidebar" class="sidebar col-md-3">


            <ul class="cd-accordion-menu animated" style="list-style: none; padding: 0;">
            <?php $i=1; ?>
            @foreach($category as $cat)
                <li class="@if(count($cat->subcat)) has-children @else no-children @endif">
                  <input type="checkbox" {{{ (Request::is('events/'.$cat->slug.'/*') ? 'checked' : '') }}} name="group-{{ $i }}" id="group-{{ $i }}"> <!-- comment checked -->
                 
                  <label for="group-{{ $i }}"> <a href="{{ url('events/'.$cat->slug) }}">{{$cat->name}} <img src="{{ $cat->icon }}" style="float: right;margin-right: 30px;"></a></label>

                    <ul><?php $j=1; ?>
                    @foreach($cat->subcat as $subcat)
                      <li class="@if(count($subcat->subsubcat)) has-children @else no-children @endif">
                        <input type="checkbox" {{{ (Request::is('events/'.$cat->slug.'/'.$subcat->slug.'/*') ? 'checked' : '') }}} name ="sub-group-{{ $j }}" id="sub-group-{{ $j }}">
                        <label for="sub-group-{{ $j }}" style="    box-shadow: inset 0 -1px #41444a;" >
                        <a href="{{ url('events/'.$cat->slug.'/'.$subcat->slug) }}">{{ $subcat->name }}</a></label>
                        @foreach($subcat->subsubcat as $subsub)
                        <ul class="sub-sub-menu">
                          <li class="sub-sub-menu-li"><a class="sub-sub-menu-a" href="{{ url('events/'.$cat->slug.'/'.$subcat->slug.'/'.$subsub->slug) }}">{{ $subsub->name }}</a></li>
                        </ul>
                        @endforeach
                      </li><?php $j++; ?>
                      @endforeach
                    </ul>
                </li><?php $i++; ?>
                @endforeach

            </ul> <!-- cd-accordion-menu -->
          </div>
