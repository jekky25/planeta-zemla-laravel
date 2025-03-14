<template>
	<div class="componentheading"></div>
	<div id="component-contact">
		<div class="componentheading"></div>
		<h2 class="contentheading"><Link :href="route('feedback')" class="contentpagetitle">Обратная связь</Link></h2>
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen">
			<tr>
				<td colspan="2">
					<form action="javascript:void(null);" method="post" name="emailForm" id="emailForm" class="form-validate">
						<input type="hidden" name="_token" autocomplete="off" :value="$attrs.csrf_field" />
						<div class="success-text" v-html="success" v-if="success"></div>
						<div class="error-text" v-html="errors" v-if="errors"></div>
						<GoogleCaptcha ref="googleCaptcha"></GoogleCaptcha>
						<div v-show="visible" class="contact_email">
							<div class="mb-4">
								<label for="contact_name">&nbsp;Введите ваше имя:</label>
								<br />
								<input v-model="name" type="text" name="name" id="contact_name" size="30" class="shadow appearance-none border inputbox rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="" />
							</div>
							<div class="mb-4">
								<label id="contact_emailmsg" for="contact_email">&nbsp;E-mail адрес:</label>
								<br />
								<input v-model="email" type="text" id="contact_email" name="email" size="30" value="" class="inputbox required validate-email rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="100" />
							</div>
							<div class="mb-4">
								<label for="contact_subject">&nbsp;Тема сообщения:</label>
								<br />
								<input v-model="subject" type="text" name="subject" id="contact_subject" size="30" class="inputbox rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="" />
							</div>
							<div class="mb-4">
								<label id="contact_textmsg" for="contact_text">&nbsp;Введите текст вашего сообщения:</label>
								<br />
								<textarea v-model="message" cols="50" rows="10" :name="message" id="contact_message" class="inputbox required rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline border-transparent focus:border-transparent"></textarea>
							</div>
							<div class="mb-4">
								<input v-model="copy" class="mr-2 border inputbox rounded focus:text-blue-600 ring-offset-0" type="checkbox" name="copy" id="contact_email_copy" value="1" />
								<label for="contact_email_copy">Отправить копию этого сообщения на ваш адрес</label>
							</div>
							<div><button class="button validate bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" v-on:click.prevent="send();" type="submit">Отправить</button></div>
						</div>
					</form>
				</td>
			</tr>
		</table>
	</div>
</template>
<script setup>
import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
</script>
<script>
	import MainLayout from '@/Layouts/MainLayout.vue';
	import {Link} from '@inertiajs/vue3';

	export default {
		name: "Page",
		components: {
			Link
		},
		layout: MainLayout,
		props: [
		],
		data() {
		return {
			errors: '',
			success: '',
			regexpEmail:/^(?:[a-z0-9._]+(?:[-_.]?[a-z0-9._]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i,
			name:'',
			subject:'',
			email:'',
			message:'',
			recaptcha_response: '',
			visible: true,
			data: Object
			}
		},
		methods: {
			clearParams()
			{
				this.$data.errors = '';
				this.$data.success = '';
			},
			reloadCaptcha()
			{
				this.$refs.googleCaptcha.initReCaptcha();
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
			checkSubject() 
			{
				if (this.subject.length < 2) {
					this.$data.errors += '<p>Тема не введена</p>';
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
				this.$data.message	= document.getElementById('contact_message').value;
				this.$data._token	= this.csrf_field;
				this.recaptcha_response	= document.getElementById('recaptchaResponse').value;
			},
			send()
			{
				this.clearParams();
				this.checkName();
				this.checkSubject();
				this.checkEMail();
				this.checkMessage();
				if (this.isError()) return false;
				this.getData();
				this.ajax();

				return false;
			},
			ajax()
			{
				axios.post(route('feedback', this.$data))
				.then(res => {
					let success = res.data.success;
					if (success == 1)
					{
						this.success = '<p>Ваше сообщение было успешно отправлено!</p>';
						this.reloadCaptcha();
						this.$data.visible = false;
					}
				})
				.catch(res => {
					this.$data.errors += '<p>' + res.response.data.message + '</p>';
					this.reloadCaptcha();
				});
				return false;
			}
		}
	}
</script>