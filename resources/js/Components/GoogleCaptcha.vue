<template>
<input type="hidden" name="recaptcha_response" :value="$page.props.config.google_recaptcha_key" id="recaptchaResponse">
</template>
<script>

export default {
	props: ['sitekey'],

	methods: {
		initReCaptcha(){
			var google_recaptcha_key = this.$page.props.config.google_recaptcha_key
			setTimeout(function() {
				if(typeof grecaptcha === 'undefined') {
					self.initReCaptcha();
				} else {
					grecaptcha.ready(function () {
						grecaptcha.execute(google_recaptcha_key, { action: 'contact' }).then(function (token) {
							var recaptchaResponse = document.getElementById('recaptchaResponse');
							recaptchaResponse.value = token;
						});
					});
				}
			}, 100);
		}
	},
	mounted(){
		if (document.contains(document.getElementById("recaptcha"))) {
			document.getElementById("recaptcha").remove();
		}

		let recaptchaScript = document.createElement('script');
		recaptchaScript.setAttribute('id', 'recaptcha');
		recaptchaScript.setAttribute('src', 'https://www.google.com/recaptcha/api.js?render=' + this.$page.props.config.google_recaptcha_key);
		document.head.appendChild(recaptchaScript);

		this.initReCaptcha();
	}
}
</script>