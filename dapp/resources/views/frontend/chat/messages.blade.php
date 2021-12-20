@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<style type="text/css">
    .badge-danger {
        color: white;
        background-color: Red;
    }

    img .live {
        width: 14%;
        height: auto;
    }
</style>

<div class="content col-md-9">
    <!-- Posts Area 1 -->
    <!-- Latest News -->
    <?php echo $chat ?>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var config = {
		csrf: "{{csrf_token()}}"
	}
	var socketUrl = "{{\config('chat.socket.url')}}";
	var chat = new ChatController(<?= $user_id ?>, <?= $to_user_id ?>, "<?= $to_user_name ?>", socketUrl);
	$("#message").keydown(chat.sendMessage);
</script>
@endsection
