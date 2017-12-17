<template>
	<div class="app-plain-layout">
		<navbar></navbar>
		<account-stats></account-stats>

		<section class="section">
			<div class="container">
				<div class="columns">
					<div class="column is-one-quarter">
						<account-navigation></account-navigation>
					</div>
					<div class="column">
						<child/>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import AccountStats from '~/components/account/Stats';
	import AccountNavigation from '~/components/account/Navigation';


	export default {
		name: 'account-layout',

		components: {
			AccountNavigation,
			Navbar,
			AccountStats,
		},
	};
</script>
