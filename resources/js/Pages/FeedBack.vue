<template>
	<Head title="Обратная связь, Земля как планета" />
	<div class="componentheading"></div>
	<div id="component-contact">
		<div class="componentheading"></div>
		<h2 class="contentheading">
			<Link :href="route('feedback')" class="contentpagetitle">Обратная связь</Link>
		</h2>
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen">
			<tr>
				<td colspan="2">
					<form action="javascript:void(null);" method="post" name="emailForm" id="emailForm"
						class="form-validate">
						<input type="hidden" name="_token" autocomplete="off" :value="$attrs.csrf_field" />
						<div class="success-text" v-html="success" v-if="success"></div>
						<div class="error-text" v-html="errors" v-if="errors"></div>
						<GoogleCaptcha ref="googleCaptcha"></GoogleCaptcha>
						<div v-show="visible" class="contact_email">
							<LabelInput ref="name" v-model="name" type="text" name="name" id="contact_name">&nbsp;Введите ваше имя:</LabelInput>
							<LabelInput ref="email" v-model="email" type="text" name="name" id="contact_email">&nbsp;E-mail адрес:</LabelInput>
							<LabelInput ref="subject" v-model="subject" type="text" name="subject" id="contact_subject">&nbsp;Тема сообщения:</LabelInput>
							<LabelTextarea ref="message" v-model="message" name="message" id="contact_message">&nbsp;Введите текст вашего сообщения:</LabelTextarea>
							<div class="mb-4">
								<Checkbox name="copy" v-model="copy" id="contact_email_copy" value="1" />
								<label for="contact_email_copy">Отправить копию этого сообщения на ваш адрес</label>
							</div>
							<div>
								<SubmitButton v-on:click.prevent="send();">Отправить</SubmitButton>
							</div>
						</div>
					</form>
				</td>
			</tr>
		</table>
	</div>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
import GoogleCaptcha from '@/Components/GoogleCaptcha.vue';
import SubmitButton from '@/Components/Forms/SubmitButton.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import Textarea from '@/Components/Forms/Textarea.vue';
import Checkbox from '@/Components/Forms/Checkbox.vue';
import LabelInput from '@/Components/Blocks/LabelInput.vue';
import LabelTextarea from '@/Components/Blocks/LabelTextarea.vue';
import check from "@/Methods/check.js";
import captcha from "@/Methods/captcha.js";
import ajax from "@/Methods/ajax.js";

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
		LabelTextarea
	},
	layout: MainLayout,
	props: [
	],
	data() {
		return {
			name: '',
			subject: '',
			email: '',
			message: '',
			proba: '',
			recaptcha_response: '',
			copy: 0,
			visible: true,
			data: Object
		}
	},
	mixins: [check, captcha, ajax],
	methods: {
		getData() {
			this.$data.name = this.$refs.name.get();
			this.$data.email = this.$refs.email.get();
			this.$data.subject = this.$refs.subject.get();
			this.$data.message = this.$refs.message.get();
			this.$data._token = this.csrf_field;
			this.recaptcha_response = document.getElementById('recaptchaResponse').value;
			this.$data.copy = this.copy;
		},
		send() {
			this.clearParams();
			this.checkName(this.$refs.name.get());
			this.checkSubject(this.$refs.subject.get());
			this.checkEMail(this.$refs.email.get());
			this.checkMessage(this.$refs.message.get());
			if (this.isError()) return false;
			this.getData();
			this.ajax(route('feedback', this.$data));

			return false;
		},
		ajaxError(res)
		{
			this.$data.errors += '<p>' + res.response.data.message + '</p>';
			this.reloadCaptcha();
		},
		ajaxSuccess(res)
		{
			let success = res.data.success;
			if (success == 1) {
				this.success = '<p>Ваше сообщение было успешно отправлено!</p>';
				this.reloadCaptcha();
				this.$data.visible = false;
			}
		}
	}
}
</script>