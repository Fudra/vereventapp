<template>
	<section class="section">
		<div class="container">
			<div class="columns">

				<div class="column is-half">
					<!-- tabs -->
					<div class="tabs is-centered">
						<ul>
							<router-link :to="{ name: tab.route }" class="nav-link" active-class="is-active"
										 v-for="(tab, index) in tabs" tag="li" :key="index">
								<a href="#">
									<fa :icon="tab.icon" fixed-width/>
									{{ tab.name }}
								</a>
							</router-link>
						</ul>
					</div>
					<!-- // End -->

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
		layout: 'account',

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
