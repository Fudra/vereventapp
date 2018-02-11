<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						Checkout
					</h1>
					<h2 class="subtitle">
						{{currentEvent.title}}
					</h2>
				</div>
			</div>
		</section>

		<pre>{{currentEvent.tickets.data}}</pre>
	</div>
</template>

<script>
	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: 'Checkout' };
		},

		computed: {
			...mapGetters(
				{
					currentEvent: 'events/currentEvent',
				},
			)
		},
	}
</script>