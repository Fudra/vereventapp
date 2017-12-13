<template>
	<div class="app-plain-layout">
		<navbar></navbar>
		<account-stats></account-stats>

		<child/>
	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import AccountStats from '~/components/account/Stats';

	export default {
		name: 'app-plain-layout',

		components: {
			Navbar,
			AccountStats,
		},
	};
</script>
