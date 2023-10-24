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
<div class="gog_baner2">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6379140164632940";
/* Планета земля верх */
google_ad_slot = "6724939469";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script async type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
</div></div>
<script type="text/javascript">
<!--
var jcomments=new JComments({{ $post->id }}, 'com_content','{{route('comment_refresh')}}');
jcomments.setList('comments-list');
//-->
</script>
@if (!empty($post->comments))
<div id="jc">
	<div id="comments">
		<h4>Комментарии
			<a class="rss" href="{{route('comment_rss',[$post->category['alias'], $post->id,$post->alias])}}" title="RSS лента комментариев этой записи" target="_blank">&nbsp;</a>
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage({{ $post->id }},'com_content',0);return false;">&nbsp;</a>
		</h4>
		<div id="comments-list" class="comments-list">
		@foreach ($post->comments as $item)
		<div class="even" id="comment-item-{{ $item->id }}">
			<div class="rbox">
				<div class="rbox_tr">
					<div class="rbox_tl">
						<div class="rbox_t">&nbsp;</div>
					</div>
				</div>
				<div class="rbox_m">
					<div class="comment-box usertype-guest">
						<span class="comments-vote">
							<span id="comment-vote-holder-{{ $item->id }}">
								<a href="#" class="vote-good" title="Хороший комментарий!" onclick="jcomments.voteComment({{ $item->id }}, 1);return false;"></a>
								<a href="#" class="vote-poor" title="Плохой комментарий!" onclick="jcomments.voteComment({{ $item->id }}, -1);return false;"></a>
								<span class="{{ $item->voteClass }}">{{ $item->voteCount }}</span>
							</span>
						</span>
						<a class="comment-anchor" href="{{route('item_name',[$post->category['alias'], $post->id,$post->alias])}}#comment-{{ $item->id }}" id="comment-{{ $item->id }}">#{{ $loop->iteration }}</a>
						<span class="comment-author">{{ $item->name }}</span>
						<span class="comment-date">{{ $item->date }}</span>
						<div class="comment-body" id="comment-body-{{ $item->id }}">{!! $item->comment !!}</div>
						<span class="comments-buttons">
							<a href="#" onclick="jcomments.quoteComment({{ $item->id }}); return false;">Цитировать</a>
						</span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="rbox_br">
					<div class="rbox_bl">
						<div class="rbox_b">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		</div>
		<div id="comments-list-footer">
			<a class="refresh" href="#" title="Обновить список комментариев" onclick="jcomments.showPage({{ $item->id }},'com_content',0);return false;">Обновить список комментариев</a>
			<br />
			<a class="rss" href="{{route('comment_rss',[$post->category['alias'], $post->id,$post->alias])}}" target="_blank">RSS лента комментариев этой записи</a>
		</div>
	</div>
	<h4>Добавить комментарий</h4>
	<a id="addcomments" href="#addcomments"></a>
	<form id="comments-form" name="comments-form" action="javascript:void(null);">
	<p>
		<input id="comments-form-name" type="text" name="name" value="" maxlength="20" size="22" tabindex="1" class="">
		<label for="comments-form-name">Имя (обязательное)</label>
	</p>
	<p>
		<input id="comments-form-email" type="text" name="email" value="" size="22" tabindex="2">
		<label for="comments-form-email">E-Mail (обязательное)</label>
	</p>
	<p>
	<textarea id="comments-form-comment" name="comment" cols="65" rows="8" tabindex="5"></textarea>
	</p>
	<p>
		<input class="checkbox" id="comments-form-subscribe" type="checkbox" name="subscribe" value="1" tabindex="5">
		<label for="comments-form-subscribe">Подписаться на уведомления о новых комментариях</label><br>
	</p>
	<p>
		<img class="captcha" onclick="jcomments.clear('captcha');" id="comments-form-captcha-image" name="captcha-image" src="http://www.planeta-zemla.ru/index.php?option=com_jcomments&amp;task=captcha&amp;tmpl=component&amp;ac=34400" width="121" height="60" alt="Защитный код"><br>
		<span class="captcha" onclick="jcomments.clear('captcha');">Обновить</span><br>
		<input class="captcha" id="comments-form-captcha" type="text" name="captcha-refid" value="" size="5" tabindex="6"><br>
		<input type="hidden" name="recaptcha_response" id="recaptchaResponse" value="03AFcWeA7URZfklRu8QXsUy222hO7FVyyTQ3QcNRloxxoqaKThwjqw-GyRIbSye0Q6X2ABvvCip1p607N2cmcAvcEXFL9dPBJpMzWYvKQOJoUV3_eorggLPnUT0zWtqOrLFsFXtW3p0Ng2ElFglJVV7ZLcSTtLRvNp0qYjtbGZWfi8LMsoBLNR0uQHz5JuDjjOr_QMZdINVwpdVqETu7tNQn_KTgmlezl4o60foHvlYHJXQ4FWBcDvQadnzYzHUSs_WftPb2c5d-dBT-2aNEzogWSUqYQoKqGVRpMJs6UiAnftmjT8KJjdzJCU1jSoZ7ie4B-8TgQHGOaHL7uqZewrxh5r4cWaJn8jwN4XmfjQILBHiggliouB5pN1UgDM7urkU5P-TkwszPVTZ548sIRuHj5agP2mInd0OIzGUGYOUdVNxKtFjNxgoK9Kg6-APPX5nRXjtTzZNK3DQa7NvZRE5ubuU57QbBfoB-fuNTFM1_LPP3gGm_jm8u7Fl5ro8XlmyE3ZtzoRng7PgrD2VDqQrYWmrlI_LwOqLVD-xUTWELvcGLullWKdbsw">
	</p>
	<div id="comments-form-buttons">
		<div class="btn" id="comments-form-send"><div><a href="#" tabindex="7" onclick="jcomments.saveComment();return false;" title="Отправить (Ctrl+Enter)">Отправить</a></div></div>
		<div class="btn" id="comments-form-cancel" style="display:none;"><div><a href="#" tabindex="8" onclick="return false;" title="Отменить">Отменить</a></div></div>
		<div style="clear:both;"></div>
	</div>
		<input type="hidden" name="object_id" value="113">
		<input type="hidden" name="object_group" value="com_content">
	</form>
	<script type="text/javascript">
<!--
function JCommentsInitializeForm()
{
	var jcEditor = new JCommentsEditor('comments-form-comment', true);
	jcEditor.addButton('b','Жирный','Введите текст для форматирования');
	jcEditor.addButton('i','Курсив','Введите текст для форматирования');
	jcEditor.addButton('u','Подчеркнутый','Введите текст для форматирования');
	jcEditor.addButton('s','Зачеркнутый','Введите текст для форматирования');
	jcEditor.addButton('quote','Цитата','Введите текст цитаты');
	jcEditor.addButton('custombbcode1','YouTube Video','Введите текст для форматирования','[youtube]','[/youtube]','bbcode-youtube','');
	jcEditor.addButton('custombbcode4','Google Video','Введите текст для форматирования','[google]','[/google]','bbcode-google','');
	jcEditor.addButton('custombbcode8','Facebook Video','Введите текст для форматирования','[fv]','[/fv]','bbcode-facebook','');
	jcEditor.addButton('custombbcode10','Wikipedia','Введите текст для форматирования','[wiki]','[/wiki]','bbcode-wiki','');
	jcEditor.initSmiles('/images/smilies');
	jcEditor.addSmile(':D','laugh.gif');
	jcEditor.addSmile(':lol:','lol.gif');
	jcEditor.addSmile(':-)','smile.gif');
	jcEditor.addSmile(';-)','wink.gif');
	jcEditor.addSmile('8)','cool.gif');
	jcEditor.addSmile(':-|','normal.gif');
	jcEditor.addSmile(':-*','whistling.gif');
	jcEditor.addSmile(':oops:','redface.gif');
	jcEditor.addSmile(':sad:','sad.gif');
	jcEditor.addSmile(':cry:','cry.gif');
	jcEditor.addSmile(':o','surprised.gif');
	jcEditor.addSmile(':-?','confused.gif');
	jcEditor.addSmile(':-x','sick.gif');
	jcEditor.addSmile(':eek:','shocked.gif');
	jcEditor.addSmile(':zzz','sleeping.gif');
	jcEditor.addSmile(':P','tongue.gif');
	jcEditor.addSmile(':roll:','rolleyes.gif');
	jcEditor.addSmile(':sigh:','unsure.gif');
	jcEditor.addCounter(1000, 'Осталось:', ' символов', 'counter');
	jcomments.setForm(new JCommentsForm('comments-form', jcEditor));
}

if (window.addEventListener) {
	JCommentsInitializeForm();
	//window.addEventListener('load',JCommentsInitializeForm,false);
	//passive: если true
}
else if (document.addEventListener){
	document.addEventListener('load',JCommentsInitializeForm,false);
}
else if (window.attachEvent){
	window.attachEvent('onload',JCommentsInitializeForm);
}
else {if (typeof window.onload=='function'){
	var oldload=window.onload;
	window.onload=function(){
		oldload();
		JCommentsInitializeForm();
	}
} else window.onload=JCommentsInitializeForm;} 
//-->
</script>
<div id="comments-footer" align="center"><a href="http://www.joomlatune.com" title="JComments" target="_blank">JComments</a></div>
<script type="text/javascript">
<!--
jcomments.setAntiCache(1,0,0);
//-->
</script>
</div>
@endif
@endif
@overwrite