<template>
	<section class="section">
		<div class="container is-fluid">
			<div class="columns">
				<div class="column is-half is-offset-one-quarter">
					<h1 class="title">{{$t('register')}}</h1>
					<form @submit.prevent="register" @keydown="form.onKeydown($event)" class="form">

						<!-- Name -->
						<div class="field">
							<label class="label" for="name">{{ $t('name') }}</label>
							<p class="control">
								<input v-model="form.name" type="text" name="name" class="input" id="name"
									   :class="{ 'is-danger': form.errors.has('email') }">
								<has-error :form="form" field="name"></has-error>
							</p>
						</div>

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

						<!-- Password confirmed-->
						<div class="field">
							<label class="label" for="password_confirmation">{{ $t('password_confirmation') }}</label>
							<p class="control">
								<input v-model="form.password_confirmation" type="password" name="password_confirmation"
									   class="input"
									   id="password_confirmation"
									   :class="{ 'is-danger': form.errors.has('password_confirmation') }">
								<has-error :form="form" field="password"></has-error>
							</p>
						</div>


						<div class="field is-grouped">
							<p class="control">
								<button class="button is-primary" :class="{'is-loading': form.busy }">
									{{ $t('register') }}
								</button>
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
	import * as api from '~/services/routes';

	export default {
		layout: 'plain',

		metaInfo () {
			return { title: this.$t('register') };
		},

		data: () => ({
			form: new Form(
				{
					name: '',
					email: '',
					password: '',
					password_confirmation: '',
				},
			),
		}),

		methods: {
			async register () {
				// Register the user.
				const { data } = await this.form.post(api.REGISTER);

				//Log in the user.
				//const { data: { token }} = await this.form.post('/api/login')

				// Save the token.
				//this.$store.dispatch('saveToken', { token })

				// Update the user.
				//await this.$store.dispatch('auth/updateUser', { user: data })

				// Redirect home.
				this.$router.push({ name: 'home' });
			},
		},

		computed: {},
	};
</script>
