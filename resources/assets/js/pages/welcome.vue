<template>
	<section class="hero is-primary is-medium is-bold">
		<navbar></navbar>

		<div class="hero-body">
			<div class="container has-text-centered">
				<h1 class="title">
					{{ title }}
				</h1>
				<h2 class="subtitle">
					{{ subtitle }}
				</h2>
			</div>
		</div>

	</section>
</template>

<script>

	import Navbar from '~/components/layout/Navbar';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: this.$t('home') };
		},

		data: () => ({
			title: window.config.appName,
			subtitle: "Your place to manage your events.."
		}),

		components: {
			Navbar,
		},
	};
</script>

