<template>
	<div>
		<h1 class="title">{{$t('account.delete')}}</h1>

		<article class="message is-info">
			<div class="message-header">
				Danger Zone
			</div>
			<div class="message-body">
				Here can you delete your account. This action can not be reversed!
			</div>
		</article>

		<a class="button is-danger is-langer" @click.prevent="deleteAccount">Delete Account</a>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		metaInfo () {
			return { title: this.$t('settings') };
		},

		data () {
			return {

			};
		},

		methods: {
			async deleteAccount () {
				// Delete user Account
				axios.delete('/api/account/settings/delete');
				
				// Log out the user.
				await this.$store.dispatch('auth/logout');

				// Redirect to login.
				this.$router.push({ name: 'login' });
			},
		},
	};
</script>
