<template>
	<div>
		<h1 class="title">{{$t('your_password')}}</h1>
		<form @submit.prevent="update" @keydown="form.onKeydown($event)" class="form">
			<alert-success :form="form" :message="$t('password_updated')"></alert-success>

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

			<!-- Password Confirmation -->
			<div class="field">
				<label class="label" for="password_confirmation">{{ $t('confirm_password') }}</label>
				<p class="control">
					<input v-model="form.password_confirmation" type="password" name="password_confirmation"
						   class="input"
						   id="password_confirmation"
						   :class="{ 'is-danger': form.errors.has('password_confirmation') }">
					<has-error :form="form" field="password"></has-error>
				</p>
			</div>

			<div class="field">
				<p class="control">
					<button class="button is-primary" :class="{'is-loading': form.busy }">
						{{ $t('update') }}
					</button>
				</p>
			</div>
		</form>
	</div>
</template>

<script>
	import Form from 'vform';

	export default {
		metaInfo () {
			return { title: this.$t('settings') };
		},

		data: () => ({
			form: new Form({
							   password: '',
							   password_confirmation: '',
						   }),
		}),

		methods: {
			async update () {
				await this.form.patch('/api/settings/password');

				this.form.reset();
			},
		},
	};
</script>
