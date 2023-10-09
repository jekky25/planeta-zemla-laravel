@extends('layouts.app')
@section('title', $title)
@section('main_body')
@if (!empty ($post))
<div class="componentheading"></div>
<h2 class="contentheading"><a href="{{route('item_name',[$post->category['alias'], $post->id,$post->alias])}}" class="contentpagetitle">{!! $post->title !!}</a></h2>
<div class="gog_baner1">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6379140164632940";
/* Планета земля верх */
google_ad_slot = "6724939469";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
<div class="article-content">{!! $post->introtext !!}{!! $post->fulltext !!}
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6379140164632940";
/* Планета земля верх */
google_ad_slot = "6724939469";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div>
@endif
@overwrite