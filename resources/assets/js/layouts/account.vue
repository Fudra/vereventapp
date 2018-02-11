<template>
	<div class="app-plain-layout main-bg">
		<navbar></navbar>
		<!--<account-stats></account-stats>-->

		<section class="section">
			<div class="container">
				<div class="columns">
					<div class="column is-one-quarter">
						<account-navigation></account-navigation>
					</div>
					<div class="column main-colum z-depth-1" >
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

<style>
	.main-bg {
		background: #f5f5f5;
		min-height: 100vh;
	}

	.main-colum {
		background: white;
	}
</style>
