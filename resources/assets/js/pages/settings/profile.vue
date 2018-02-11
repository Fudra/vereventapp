<template>

	<div>
		<h1 class="title">{{$t('your_info')}}</h1>

		<form @submit.prevent="update" @keydown="form.onKeydown($event)" class="form">
			<alert-success :form="form" :message="$t('info_updated')"></alert-success>

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

			<!-- submit Button -->
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
	import { mapGetters } from 'vuex';

	export default {
		metaInfo () {
			return { title: this.$t('settings') };
		},

		data() {
			return {
				form: new Form(
					{
						name: '',
						email: '',
					},
				),
			}
		},

		computed: {
			...mapGetters(
				{
					user: 'auth/user',
				},
			),
		},

		created () {
			this.form.keys()
				.forEach(key => {
					this.form[key] = this.user[0][key];
				});
		},

		methods: {
			async update () {
				const { data } = await this.form.patch('/api/account/settings/profile');

				this.$store.dispatch('auth/updateUser', { user: data });
			},
		},
	};
</script>
