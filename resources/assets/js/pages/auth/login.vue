<template>
	<section class="section">
		<div class="container is-fluid">
			<div class="columns">
				<div class="column is-half is-offset-one-quarter">
					<h1 class="title">{{$t('login')}}</h1>
					<form @submit.prevent="login" @keydown="form.onKeydown($event)" class="form">
						<!-- Email -->
						<div class="field">
							<label class="label" for="email">{{ $t('email') }}</label>
							<p class="control">
								<input v-model="form.email" type="email" name="email" class="input" id="email"
									   :class="{ 'is-danger': form.errors.has('email') }">
								<has-error :form="form" field="email"></has-error>
							</p>
						</div>

						<!-- Password -->
						<div class="field">
							<label class="label" for="password">{{ $t('password') }}</label>
							<p class="control">
								<input v-model="form.password" type="password" name="password" class="input"
									   id="password"
									   :class="{ 'is-danger': form.errors.has('password') }">
								<has-error :form="form" field="password"></has-error>
							</p>
						</div>

						<!-- Remember me -->
						<div class="field">
							<p class="control">
								<checkbox v-model="remember" name="remember">{{ $t('remember_me') }}</checkbox>
							</p>
						</div>

						<div class="field is-grouped">
							<p class="control">
								<button class="button is-primary" :class="{'is-loading': form.busy }">
									{{ $t('login') }}
								</button>
							</p>
							<p>
								<router-link :to="{ name: 'password.request' }">
									{{ $t('forgot_password') }}
								</router-link>
							</p>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import Form from 'vform';

	export default {
		metaInfo () {
			return { title: this.$t('login') };
		},

		data: () => ({
			form: new Form(
				{
					email: '',
					password: '',
				},
			),
			remember: false,
		}),

		methods: {
			async login () {
				// Submit the form.
				const { data } = await this.form.post('/api/login');

				// Save the token.
				this.$store.dispatch('auth/saveToken', {
					token: data.meta.token,
					remember: this.remember,
				});

				// Fetch the user.
				await this.$store.dispatch('auth/fetchUser');

				// Redirect home.
				this.$router.push({ name: 'home' });
			},
		},

		computed: {

		},
	};
</script>
