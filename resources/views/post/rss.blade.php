<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n" ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
@if (!empty ($post))
	<channel>
		<title>{!! $post->title !!}</title>
		<description>Обсуждение {!! $post->title !!}</description>
		<link>{{route('item.name',[$post->category['alias'], $post->id,$post->alias])}}</link>
		<lastBuildDate>{{ $refreshTime }}</lastBuildDate>
		<generator>JComments</generator>
		<atom:link href="{{route('comment.rss',[$post->category['alias'], $post->id,$post->alias])}}" rel="self" type="application/rss+xml" />
		@if (!empty ($post->comments))
		@foreach ($post->comments as $item)
		<item>
			<title>{{ $item->username }} написал:</title>
			<link>{{route('item.name',[$post->category['alias'], $post->id,$post->alias])}}#comment-{{ $item->id }}</link>
			<description><![CDATA[{{ $item->comment }}]]></description>
			<dc:creator>{{ $item->username }}</dc:creator>
			<pubDate>{{ $item->dateStr }}</pubDate>
			<guid>{{route('item.name',[$post->category['alias'], $post->id,$post->alias])}}#comment-{{ $item->id }}</guid>
		</item>
		@endforeach
		@endif
	</channel>
@endif
</rss>
