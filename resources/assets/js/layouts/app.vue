<template>
	<div class="app-layout">
		<navbar></navbar>
		<account-stats></account-stats>
		<section class="section">
			<div class="container">
				<div class="columns">
					<div class="column is-one-quarter">
						<!--@todo side-nav-->
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

	export default {
		name: 'app-layout',

		components: {
			Navbar,
			AccountStats,
		},
	};
</script>
