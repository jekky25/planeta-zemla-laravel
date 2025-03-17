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
							<LabelInput LabelId="contact_name" v-model="name" type="text" name="name" id="contact_name">&nbsp;Введите ваше имя:</LabelInput>
							<div class="mb-4">
								<label id="contact_emailmsg" for="contact_email">&nbsp;E-mail адрес:</label>
								<br />
								<TextInput v-model="email" type="text" name="email" id="contact_email"></TextInput>
							</div>
							<div class="mb-4">
								<label for="contact_subject">&nbsp;Тема сообщения:</label>
								<br />
								<TextInput v-model="subject" type="text" name="subject" id="contact_subject"></TextInput>
							</div>
							<div class="mb-4">
								<label id="contact_textmsg" for="contact_text">&nbsp;Введите текст вашего сообщения:</label>
								<br />
								<Textarea v-model="message" cols="50" rows="10" :name="message" id="contact_message"></Textarea>
							</div>
							<div class="mb-4">
								<Checkbox name="copy" v-model="copy" id="contact_email_copy" value="1" />
								<label for="contact_email_copy">Отправить копию этого сообщения на ваш адрес</label>
							</div>
							<div><SubmitButton v-on:click.prevent="send();">Отправить</SubmitButton></div>
						</div>
					</form>
				</td>
			</tr>
		</table>
		<TestChild ref="Testic" v-model="proba"></TestChild>
<br/>
<!--button @click="updateLocation">Click  Top</button-->>

	</div>
</template>
<script>
	import MainLayout from '@/Layouts/MainLayout.vue';
	import {Link} from '@inertiajs/vue3';
	import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
	import SubmitButton from '@/Components/Forms/SubmitButton.vue';
	import TextInput from '@/Components/Forms/TextInput.vue';
	import Textarea from '@/Components/Forms/Textarea.vue';
	import Checkbox from '@/Components/Forms/Checkbox.vue';
	import LabelInput from '@/Components/Blocks/LabelInput.vue';

	import TestChild from '@/Components/Blocks/TestChild.vue';

	export default {
		name: "Page",
		components: {
			Link,
			GoogleCaptcha,
			SubmitButton,
			TextInput,
			Textarea,
			Checkbox,
			LabelInput,
			TestChild
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
			proba:'',
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
				alert(this.name);
				alert(this.email);

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
			},
/*
			updateLocation()
            {
                alert('kkk');
                //alert(this.proba);
				//console.log(this.$refs);
				console.log(this.$refs.Testic);
                alert(this.$refs);
				//alert(this.$refs.googleCaptcha);
				//alert(this.$refs.Testic);
            }
*/
		}
	}
</script>