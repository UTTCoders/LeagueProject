@extends('user.userhome')

@section('title','RESULTS')

@section('css2')
<style type="text/css">
	body{
		background-color: white;
	}
	.comment{
		font-size: 13px;
		color: #666;
	}
	#commentSection{
		max-height: 500px;
		width: 100%;
		overflow-y: auto;
		padding: 10px;
		border-top: 1px solid #D9EDF7;
	}
	.commentCard{
		border-radius: 0;
		box-shadow: 1px 1px #eee;
	}
	textarea{
		resize: none;
	}
	.content{
		margin-top: 100px;
	}
	#goalSection{
		color:#111;
	}
</style>
@endsection

@section('body2')
<div class="container content">
	<h2 style="color:#111;"><strong>@if($teams["local"]["goals"] > $teams["visitor"]["goals"])Victorious: {{$teams["local"]->name}}@elseif($teams["local"]["goals"] < $teams["visitor"]["goals"])Victorious: {{$teams["visitor"]->name}}@else Equals!@endif</strong></h2>
	<hr style="border-color: #111;">
	<div class="row" style="color:#444;">
		<div class="col-md-6 col-xs-12">
			<div id="goalSection">
			<h3 align="center">Marker:</h3>
				@include('user.goals')
			</div>
		</div>
		<h3>History:</h3>
		<div class="col-md-5 col-xs-12 thumbnail">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
	</div>
	<div class="row">
	<br>
		<div class="col-sm-9 col-xs-11">
			<h4 id="commentsIndicator" style="color:#444;">Comments - {{$match->comments()->count()}}</h4>
			<div id="commentSection">
				@include('user.comments')
			</div>
			<input type="hidden" name="thematchid" value="{{$match->id}}">
			<br>
			@if(($match->state==1 || $match->state==3) && $allowComment)
				<div class="col-xs-12">
					<div class="form-group">
						<label>Leave a comment:</label><span class="pull-right" id="charIN">(140 left)</span>
						<textarea id="textareaC" style="border-radius: 0;" rows="3" maxlength="140" class="form-control"></textarea>
					</div>
					<button style="border-radius: 0; border:1px solid #ccc;" id="btnSendComment" class="btn btn-default pull-right">Send</button>
				</div>
			@endif
		</div>
	</div>
</div>
<br><br>
@endsection