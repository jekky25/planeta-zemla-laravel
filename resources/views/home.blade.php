@extends('layouts.app')
@section('title', $title)
@section('main_body')
<h2>Главная</h2>
@if (!empty ($posts))
<table class="blog" cellpadding="0" cellspacing="0">
<tr valign="top"><td>
@foreach ($posts as $item)
<div>
	<div class="contentpaneopen">
		<h2 class="contentheading"><a href="{{route('item_name',[$item->category['alias'], $item->id,$item->alias])}}" class="contentpagetitle">{{ $item->title }}</a></h2>
		<div class="article-content">{!! $item->introtext !!}
			<div class="jcomments-links">
				<a class="readmore-link" href="{{route('item_name',[$item->category['alias'], $item->id,$item->alias])}}" title="{{ $item->title }}">Подробнее...</a>
				@if ($item->comments->count() > 0)
				<a href="{{route('item_name',[$item->category['alias'], $item->id,$item->alias])}}#comments" class="comments-link">Комментарии ({{ $item->comments->count() }})</a>
				@else
				<a href="{{route('item_name',[$item->category['alias'], $item->id,$item->alias])}}#addcomments" class="comments-link">Добавить комментарий</a>
				@endif
			</div>
	</div>
</div>

<span class="article_separator">&nbsp;</span>
		</div>
@endforeach
</td></tr></table>
@endif
@overwrite