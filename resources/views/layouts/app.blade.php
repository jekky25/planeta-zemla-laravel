<!DOCTYPE html>
<html lang="ru">
<head>
	<title>@yield('title')</title>
	<base href="{{route('home')}}" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="{{ asset("favicon.ico") }}" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" href="{{ asset("css/jcomments/style.css?v=12") }}" type="text/css" />
	<script type="text/javascript" src="{{ asset("js/system/mootools.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/system/caption.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/jcomments/jcomments-v2.1.js?t=5") }}"></script>
	<script type="text/javascript" src="{{ asset("js/jcomments/ajax.js?v=1") }}"></script>
	@stack('scripts')
	<link rel="stylesheet" href="{{ asset("css/style.css?t=4") }}" type="text/css" />
	{!!$MetaTags!!}
</head>
<body>
<div id="overhtm">
	<div id="overhtm1">
		<div id="overhtm2">
			<div id="header">
					 <h1><a href="{{route('home')}}" title="На главную"><img alt="На главную" src="{{ asset("images/logo.png") }}" /></a></h1>
			</div>
			@if (!empty ($menuH))
			<div id="hmenu">
				<div class="moduletable_menu">
					<ul class="menu">
					@foreach ($menuH as $item)
						@if ($item->home == true)
							<li class="item{{ $item->id}}" {!! (request()->is('*')) ? ' id="current"' : '' !!}><a href="{{route('home')}}"><span>{{ $item->name}}</span></a></li>
						@else
							<li class="item{{ $item->id}}" {!! (request()->is($item->alias)) ? ' id="current"' : '' !!}><a href="{{route('category_name', $item->alias)}}"><span>{{ $item->name}}</span></a></li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			@endif
			<div class="main">
				<div class="main1 clearfix">
					<div id="main_content" class="clearfix">
						<div id="main_content1">
<!--centr_begin-->
@yield('main_body')
<!--centr_end-->
						</div>
					</div>
					<div id="left_col">
					@if (!empty ($menuLeft))
					<div class="moduletable">
					<ul id="mainlevel-nav">
					@foreach ($menuLeft as $item)
					<li><a class="mainlevel-nav" href="{{route('category_name', $item->alias)}}">{{ $item->name}}</a></li>
					@endforeach
					</ul>
					</div>
					@endif
					</div>
				</div>
			</div>
			<div id="footer">
				<div id="rights">
					<p>копирование материалов разрешено только с установкой обратной ссылки на наш сайт</p>
					<p>&copy; 2010 все права защищены</p>
				</div>
				<div id="feedback">
					<div class="moduletable">
						<ul class="menu">
							<li class="item3"><a href="{{route('feedback')}}"><span>Обратная связь</span></a></li>
						</ul>
					</div>
	
				</div>
	<div id="counters">
<!--Rating@Mail.ru counter-->
<script language="javascript"><!--
d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
<script language="javascript1.1"><!--
a+=';j='+navigator.javaEnabled();js=11;//--></script>
<script language="javascript1.2"><!--
s=screen;a+=';s='+s.width+'*'+s.height;
a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>
<script language="javascript1.3"><!--
js=13;//--></script><script language="javascript" type="text/javascript"><!--
d.write('<a href="http://top.mail.ru/jump?from=1957157" target="_top">'+
'<img src="http://dd.cd.bd.a1.top.mail.ru/counter?id=1957157;t=130;js='+js+
a+';rand='+Math.random()+'" alt="�������@Mail.ru" border="0" '+
'height="40" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>
<noscript><a target="_top" href="http://top.mail.ru/jump?from=1957157">
<img src="http://dd.cd.bd.a1.top.mail.ru/counter?js=na;id=1957157;t=130"
height="40" width="88" border="0" alt="�������@Mail.ru"></a></noscript>
<script language="javascript" type="text/javascript"><!--
if(11<js)d.write('--'+'>');//--></script>
<!--// Rating@Mail.ru counter-->
</div>
			</div>
		</div>
	</div>
</div>
<?
//echo iconv("WINDOWS-1251","UTF-8",$sape->return_links(1));
//echo $sape->return_links(1);
//echo '<pre>';
//print_r ($CODE_INPUT['code_sape']);
//echo '</pre>';

?>
</body>
</html>