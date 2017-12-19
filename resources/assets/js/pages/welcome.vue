<template>
	<div>
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

		<events></events>
	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import Events from '~/components/events/Events';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: this.$t('home') };
		},

		data () {
			return {
				title: window.config.appName,
				subtitle: 'Your place to manage your events..',
			};
		},

		components: {
			Navbar,
			Events,
		},
	};
</script>

