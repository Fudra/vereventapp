<template>
	<div class="plain-layout">
		<navbar></navbar>

		<child/>
	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import AccountStats from '~/components/account/Stats';

	export default {
		name: 'plain-layout',

		components: {
			Navbar,
			AccountStats,
		},
	};
</script>
