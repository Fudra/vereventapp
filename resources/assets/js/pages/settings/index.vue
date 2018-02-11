<template>
	<div class="">
		<!-- tabs -->
		<div class="tabs is-boxed">
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
					{
						icon: 'trash',
						name: this.$t('danger'),
						route: 'settings.danger',
					},
				],
			};
		},
	};
</script>
