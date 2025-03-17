<template>
	<Link id="addcomments" href="#addcomments"></Link>
		<form id="comments-form" name="comments-form" action="javascript:void(null);">
			<input type="hidden" name="_token" autocomplete="off" :value="$attrs.csrf_field" />
			<div class="success-text" v-html="success" v-if="success"></div>
			<div class="error-text" v-html="errors" v-if="errors"></div>
			<GoogleCaptcha ref="googleCaptcha"></GoogleCaptcha>
			<p>
				<input v-model="name" id="comments-form-name" type="text" name="name" value="" maxlength="20" size="22" tabindex="1" class="">
				<label for="comments-form-name">Имя (обязательное)</label>
			</p>
			<p>
				<input v-model="email" id="comments-form-email" type="text" name="email" value="" size="22" tabindex="2">
				<label for="comments-form-email">E-Mail (обязательное)</label>
			</p>
			<p><textarea v-model="message" id="comments-form-comment" :name="message" cols="65" rows="8" tabindex="5"></textarea></p>
			<div id="comments-form-buttons">
				<div class="btn" id="comments-form-send"><div><a href="#" tabindex="7" v-on:click.prevent="saveComment();" title="Отправить (Ctrl+Enter)">Отправить</a></div></div>
				<div class="btn" id="comments-form-cancel" style="display:none;"><div><Link href="#" tabindex="8" onclick="return false;" title="Отменить">Отменить</Link></div></div>
				<div style="clear:both;"></div>
			</div>
			<input type="hidden" name="object_id" :value="post.id">
			<input type="hidden" name="object_group" value="com_content">
		</form>
</template>
<script>
import {Link, router} from '@inertiajs/vue3';
import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
export default {
	name: "FormAddComment",
	props: [
		'post',
	],
	components: {
			GoogleCaptcha
		},
	data() {
		return {
			errors: '',
			success: '',
			regexpEmail:/^(?:[a-z0-9._]+(?:[-_.]?[a-z0-9._]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i,
			id: 0,
			name:'',
			email:'',
			message:'',
			post_id: 0,
			recaptcha_response: '',
			data: Object
		};
	},
	methods: {
		JCommentsInitializeForm(jcomments)
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
					jcEditor.initSmiles('/images/smiles');
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
		},
		clearParams()
		{
			this.$data.errors = '';
			this.$data.success = '';
		},
		reloadCaptcha()
		{
			this.$refs.googleCaptcha.initReCaptcha();
		},
		saveComment()
			{
				this.clearParams();
				this.checkName();
				this.checkEMail();
				this.checkMessage();

				if (this.isError()) return false;
				this.getData();
				this.sendAjax();
				return false;
				
			},
			checkName()
			{
				if (this.name.length < 2) {
					this.$data.errors += '<p>Имя не введено</p>';
				}
			},
			checkEMail() 
			{
				if (!this.email.match(this.$data.regexpEmail)) {
					this.$data.errors += '<p>Некорректно введен е-майл</p>';
				}
			},
			checkMessage()
			{
				if (this.message.length < 2) {
					this.$data.errors += '<p>Не введено сообщение</p>';
				}
			},
			isError()
			{
				return this.$data.errors != '' ? true : false;
			},
			getData()
			{
				this.$data.name		= this.name;
				this.$data.email	= this.email;
				this.$data.message	= document.getElementById('comments-form-comment').value;
				this.$data._token	= this.csrf_field;
				this.$data.post_id	= this.post.id;
				this.recaptcha_response	= document.getElementById('recaptchaResponse').value;
			},
			sendAjax()
			{
				axios.post(route('comment.store', this.$data))
				.then(res => {
					let success = res.data.success;
					router.reload();
					if (success == 1)
					{
						this.success = '<p>Спасибо! Сообщение успешно добавлено!</p>';
						this.reloadCaptcha();
					}
				})
				.catch(res => {
					this.$data.errors += '<p>' + res.response.data.message + '</p>';
					this.reloadCaptcha();
				});
				return false;
			}
	},
	mounted()
	{
		var jcomments=new JComments( this.post.id , 'com_content',route('comment.ajax'));
		jcomments.setList('comments-list');
		this.JCommentsInitializeForm(jcomments);
	}
}
</script>