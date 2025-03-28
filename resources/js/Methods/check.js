export default
	{
		data() {
			return {
				errors: '',
				success: '',
				regexpEmail: /^(?:[a-z0-9._]+(?:[-_.]?[a-z0-9._]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i
			}
		},
		methods: {
			clearParams() {
				this.$data.errors = '';
				this.$data.success = '';
			},
			checkName(e) {
				if (e.length < 2) {
					this.$data.errors += '<p>Имя не введено</p>';
				}
			},
			checkEMail(e) {
				if (!e.match(this.$data.regexpEmail)) {
					this.$data.errors += '<p>Некорректно введен е-майл</p>';
				}
			},
			checkMessage(e) {
				if (e.length < 2) {
					this.$data.errors += '<p>Не введено сообщение</p>';
				}
			},
			checkSubject(e) {
				if (e.length < 2) {
					this.$data.errors += '<p>Тема не введена</p>';
				}
			},
			isError() {
				return this.$data.errors != '' ? true : false;
			},
		}
	}