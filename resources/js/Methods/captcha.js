export default
	{
		methods: {
			reloadCaptcha() {
				this.$refs.googleCaptcha.initReCaptcha();
			}
		}
	}