<template>
	<Link id="addcomments" href="#addcomments">
	</Link>
	<form id="comments-form" name="comments-form" action="javascript:void(null);">
		<input type="hidden" name="_token" autocomplete="off" :value="$attrs.csrf_field" />
		<div class="success-text" v-html="success" v-if="success"></div>
		<div class="error-text" v-html="errors" v-if="errors"></div>
		<GoogleCaptcha ref="googleCaptcha"></GoogleCaptcha>
		<LabelInput ref="name" v-model="name" type="text" name="name" id="comments-form-name">&nbsp;Введите ваше имя:</LabelInput>
		<LabelInput ref="email" v-model="email" type="text" name="email" id="comments-form-email">&nbsp;E-mail адрес:</LabelInput>
		<LabelTextarea ref="message" v-model="message" name="message" id="comments-form-comment" rows="10">&nbsp;Введите текст вашего сообщения:</LabelTextarea>
		<div id="comments-form-buttons">
			<div class="btn" id="comments-form-send">
				<SubmitButton v-on:click.prevent="saveComment();">Отправить</SubmitButton>
			</div>
			<div class="btn" id="comments-form-cancel" style="display:none;">
				<div>
					<Link href="#" tabindex="8" onclick="return false;" title="Отменить">Отменить</Link>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		<input type="hidden" name="object_id" :value="post.id">
		<input type="hidden" name="object_group" value="com_content">
	</form>
</template>
<script>
import { Link, router } from '@inertiajs/vue3';
import SubmitButton from '@/Components/Forms/SubmitButton.vue';
import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
import LabelInput from '@/Components/Blocks/LabelInput.vue';
import LabelTextarea from '@/Components/Blocks/LabelTextarea.vue';
import check from "@/Methods/check.js";
import captcha from "@/Methods/captcha.js";
import ajax from "@/Methods/ajax.js";

export default {
	name: "FormAddComment",
	props: [
		'post',
	],
	components: {
		GoogleCaptcha,
		SubmitButton,
		LabelInput,
		LabelTextarea
	},
	data() {
		return {
			id: 0,
			name: '',
			email: '',
			message: '',
			post_id: 0,
			recaptcha_response: '',
			data: Object
		};
	},
	mixins: [check, captcha, ajax],
	methods: {
		JCommentsInitializeForm(jcomments) {
			var jcEditor = new JCommentsEditor('comments-form-comment', true);
			jcEditor.addButton('b', 'Жирный', 'Введите текст для форматирования');
			jcEditor.addButton('i', 'Курсив', 'Введите текст для форматирования');
			jcEditor.addButton('u', 'Подчеркнутый', 'Введите текст для форматирования');
			jcEditor.addButton('s', 'Зачеркнутый', 'Введите текст для форматирования');
			jcEditor.addButton('quote', 'Цитата', 'Введите текст цитаты');
			jcEditor.addButton('custombbcode1', 'YouTube Video', 'Введите текст для форматирования', '[youtube]', '[/youtube]', 'bbcode-youtube', '');
			jcEditor.addButton('custombbcode4', 'Google Video', 'Введите текст для форматирования', '[google]', '[/google]', 'bbcode-google', '');
			jcEditor.addButton('custombbcode8', 'Facebook Video', 'Введите текст для форматирования', '[fv]', '[/fv]', 'bbcode-facebook', '');
			jcEditor.addButton('custombbcode10', 'Wikipedia', 'Введите текст для форматирования', '[wiki]', '[/wiki]', 'bbcode-wiki', '');
			jcEditor.initSmiles('/images/smiles');
			jcEditor.addSmile(':D', 'laugh.gif');
			jcEditor.addSmile(':lol:', 'lol.gif');
			jcEditor.addSmile(':-)', 'smile.gif');
			jcEditor.addSmile(';-)', 'wink.gif');
			jcEditor.addSmile('8)', 'cool.gif');
			jcEditor.addSmile(':-|', 'normal.gif');
			jcEditor.addSmile(':-*', 'whistling.gif');
			jcEditor.addSmile(':oops:', 'redface.gif');
			jcEditor.addSmile(':sad:', 'sad.gif');
			jcEditor.addSmile(':cry:', 'cry.gif');
			jcEditor.addSmile(':o', 'surprised.gif');
			jcEditor.addSmile(':-?', 'confused.gif');
			jcEditor.addSmile(':-x', 'sick.gif');
			jcEditor.addSmile(':eek:', 'shocked.gif');
			jcEditor.addSmile(':zzz', 'sleeping.gif');
			jcEditor.addSmile(':P', 'tongue.gif');
			jcEditor.addSmile(':roll:', 'rolleyes.gif');
			jcEditor.addSmile(':sigh:', 'unsure.gif');
			jcEditor.addCounter(1000, 'Осталось:', ' символов', 'counter');
			jcomments.setForm(new JCommentsForm('comments-form', jcEditor));
		},
		saveComment() {
			this.clearParams();
			this.checkName(this.$refs.name.get());
			this.checkEMail(this.$refs.email.get());
			this.checkMessage(this.$refs.message.get());

			if (this.isError()) return false;
			this.getData();
			this.ajax(route('comment.store', this.$data));
			return false;

		},
		getData() {
			this.$data.name = this.$refs.name.get();
			this.$data.email = this.$refs.email.get();
			this.$data.message = document.getElementById('comments-form-comment').value;
			this.$data._token = this.csrf_field;
			this.$data.post_id = this.post.id;
			this.recaptcha_response = document.getElementById('recaptchaResponse').value;
		},
		ajaxError(res) {
			this.$data.errors += '<p>' + res.response.data.message + '</p>';
			this.reloadCaptcha();
		},
		ajaxSuccess(res) {
			let success = res.data.success;
			router.reload();
			if (success == 1) {
				this.success = '<p>Спасибо! Сообщение успешно добавлено!</p>';
				this.reloadCaptcha();
			}
		}
	},
	mounted() {
		var jcomments = new JComments(this.post.id, 'com_content', route('comment.ajax'));
		jcomments.setList('comments-list');
		this.JCommentsInitializeForm(jcomments);
	}
}
</script>