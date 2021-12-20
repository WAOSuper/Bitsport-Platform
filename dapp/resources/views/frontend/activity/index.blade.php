@foreach($activities as $activity)
<li class="notification-box  {{!$activity->read_status ? 'unread' : ''}}">    
    <div class="row click-notification" data-id="{{$activity->id}}" data-url="{{$activity->url}}">
        <div class="ml-30">
            <div class="ml">
                {{$activity->message}}
            </div>
            <small class="text-warning">{{date('d-m-Y h:i a',strtotime($activity->created_at))}}</small>
        </div>
    </div>    
</li>
@endforeach
@if(!count($activities))
    <li class="notification-box">
        <div class="row ">
            <div class="ml-30">
                <div class="ml">
                    No activities
                </div>
        </div>
    </li>
@endif