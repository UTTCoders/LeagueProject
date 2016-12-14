@if($match->comments()->count()>0)
	@foreach($match->comments()->orderBy('date','desc')->get() as $comment)
		<div class="thumbnail col-xs-12 commentCard">
			<div class="col-xs-12">
				<h4>{{$comment->name}} <small style="text-align: right;" class="pull-right"><span class="hidden-xs">{{date_format(date_create($comment->pivot->date),"Y/F/d")}}</span><span class="hidden-sm hidden-md hidden-lg">{{date_format(date_create($comment->pivot->date),"Y/m/d")}}</span> <br>{{date_format(date_create($comment->pivot->date),"g:i a")}}</small></h4>
				<br>
				<p class="comment">{{$comment->pivot->content}}</p>
			</div>
		</div>
	@endforeach
@else
	<h5 style="color:#444;"><i>There are no comments to show...</i></h5>
@endif
<input type="hidden" name="commentsCount" value="{{$match->comments()->count()}}">