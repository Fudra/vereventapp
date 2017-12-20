<template>
	<aside class="menu">
		<template v-for="item in nav">
			<p class="menu-label"> {{ item.label }}</p>
			<ul class="menu-list">
				<li v-for="link in item.links">
					<router-link :to="{ name: link.route }" class="nav-link" active-class="is-active">
						<!--<fa :icon="tab.icon" fixed-width/>-->
						{{ link.name }}
					</router-link>
				</li>
			</ul>
		</template>
	</aside>
</template>

<script>
	export default {
		name: 'account-navigation',
		data() {
			return {
				nav: [
					{
						label: 'Veranstalungen',
						links:  [
							{
								name: 'Übersicht',
								route: 'events.overview'
							}
						]
					},
					{
						label: 'Allgemeines',
						links: [
							{
								name: 'Einstellungen',
								route: 'settings',
							}
						]
					}
				]
			}
		}

	};
</script>