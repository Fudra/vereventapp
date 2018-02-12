<template>
	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="container">
			<div class="navbar-brand">
				<router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-item">
					{{ appName }}
				</router-link>
				<button class="button navbar-burger">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
			<div class="navbar-menu">
				<div class="navbar-end">
					<!-- Authenticated -->
					<div class="navbar-item has-dropdown is-hoverable" v-if="user">
						<a href="#" class="navbar-link">
							<img :src="user.photo_url" class="image is-24x24 is-profile">
							{{ user.name }}
						</a>
						<div class="navbar-dropdown is-boxed">
							<router-link :to="{ name: 'settings.profile' }" class="navbar-item" style="color:black">
								<fa icon="cog" fixed-width/>
								{{ $t('settings') }}
							</router-link>

							<hr class="navbar-divider">
							<a @click.prevent="logout" class="navbar-item" href="#"  style="color:black">
								<fa icon="sign-out-alt" fixed-width/>
								{{ $t('logout') }}
							</a>
						</div>
					</div>

					<!-- Guest -->
					<template v-else>
						<router-link :to="{ name: 'login' }" class="navbar-item" active-class="active">
							{{ $t('login') }}
						</router-link>
						<router-link :to="{ name: 'register' }" class="navbar-item" active-class="active">
							{{ $t('register') }}
						</router-link>
					</template>
				</div>
			</div>
		</div>
	</nav>
</template>

<script>
	import { mapGetters } from 'vuex';

	export default {
		data: () => ({
			appName: window.config.appName,
		}),

		computed: mapGetters(
			{
				user: 'auth/user',
			},
		),

		methods: {
			async logout () {
				// Log out the user.
				await this.$store.dispatch('auth/logout');

				// Redirect to login.
				this.$router.push({ name: 'login' });
			},
		},
	};
</script>

<style scoped>
	.navbar {
		font-weight: 600;
		border-bottom: 1px solid #DEE9F2;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
	}

</style>
