<template>
	<section class="section">
		<div class="container">
			<div class="columns">
				<div class="column is-one-quarter">
					<aside class="menu">
						<p class="menu-label">{{ $t('settings') }}</p>
						<ul class="menu-list">
							<li v-for="tab in tabs">
								<router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
									<fa :icon="tab.icon" fixed-width/>
									{{ tab.name }}
								</router-link>
							</li>
						</ul>
						<p class="menu-label">General</p>
						<ul class="menu-list">
							<router-link to="home" class="nav-link">
								<fa icon="home" fixed-width/>
								Home
							</router-link>
						</ul>
					</aside>
				</div>
				<div class="column is-half">
					<transition name="fade" mode="out-in">
						<router-view></router-view>
					</transition>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		loading: false,
		layout: 'app-plain',

		data () {
			return {
				tabs: [
					{
						icon: 'user',
						name: this.$t('profile'),
						route: 'settings.profile',
					},
					{
						icon: 'lock',
						name: this.$t('password'),
						route: 'settings.password',
					},
				],
			};
		},
	};
</script>
