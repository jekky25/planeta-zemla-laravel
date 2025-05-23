@extends('layouts.app')
@section('title', $title)
@section('main_body')

<div class="componentheading">
			</div>
<div id="component-contact">
	<div class="componentheading"></div>
	<h2 class="contentheading">
		<a href="{{ route('feedback') }}" class="contentpagetitle">
		Обратная связь</a>
	</h2>
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen">
		<tr>
			<td colspan="2">
			@if(session()->has('success'))<div class="success">{{ session()->get('success') }}</div>@endif 
				@if (!empty ($errors->all()))
				<div class="error">
				@foreach ($errors->all() as $message)
				<p>{{ $message }}</p>
				@endforeach
				</div>
				@endif
				<form action="{{route('feedback')}}" method="post" name="emailForm" id="emailForm" class="form-validate">
					{{ csrf_field() }}
					<x-google-captcha />
					<div class="contact_email">
						<label for="contact_name">&nbsp;Введите ваше имя:</label>
						<br />
						<input type="text" name="name" id="contact_name" size="30" class="inputbox" value="{{ old('name') }}" />
						<br />
						<label id="contact_emailmsg" for="contact_email">&nbsp;E-mail адрес:</label>
						<br />
						<input type="text" id="contact_email" name="email" size="30" value="{{ old('email') }}" class="inputbox required validate-email" maxlength="100" />
						<br />
						<label for="contact_subject">&nbsp;Тема сообщения:</label>
						<br />
						<input type="text" name="subject" id="contact_subject" size="30" class="inputbox" value="{{ old('subject') }}" />
						<br /><br />
						<label id="contact_textmsg" for="contact_text">&nbsp;Введите текст вашего сообщения:</label>
						<br />
						<textarea cols="50" rows="10" name="text" id="contact_text" class="inputbox required">{{ old('text') }}</textarea>
						<br />
						<input type="checkbox" name="email_copy" id="contact_email_copy" value="1"@if (!empty( old ('email_copy'))) checked="checked"@endif />
						<label for="contact_email_copy">Отправить копию этого сообщения на ваш адрес</label>
						<br />
						<br />
						<button class="button validate" type="submit">Отправить</button>
					</div>
					<input type="hidden" name="option" value="com_contact" />
					<input type="hidden" name="view" value="contact" />
					<input type="hidden" name="id" value="1" />
					<input type="hidden" name="task" value="submit" />
				</form>
				<br />
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
<!--
var _acic={dataProvider:10};(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src="https://www.acint.net/aci.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})()
//-->
</script>
@overwrite