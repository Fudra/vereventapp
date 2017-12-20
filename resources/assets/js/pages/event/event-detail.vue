<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						{{currentEvent.title}}
					</h1>
					<h2 class="subtitle">
						{{currentEvent.description_short}}
					</h2>
				</div>
			</div>
		</section>

		<section class="section is-lightgray" >
			<div class="container">
				<div class="columns" >
					<div class="column">
						<h2 class="title is-2 has-text-centered">Über die Veranstaltung</h2>
						<p>
							{{currentEvent.description}}
						</p>
					</div>
				</div>
			</div>
		</section>

		<!--<section class="section">-->
			<!--<div class="container">-->
				<!--<div class="columns">-->
					<!--<div class="column is-half is-offset-one-quarter">-->
						<!--<article class="media">-->
							<!--<figure class="media-left">-->
								<!--<p class="image is-64x64">-->
									<!--<img :src="currentEvent.user.data.photo_url">-->
								<!--</p>-->
							<!--</figure>-->
							<!--<div class="media-content">-->
								<!--<div class="content">-->
									<!--<p class="title is-4 is-spaced">{{currentEvent.user.data.name}}</p>-->
									<!--<p class="subtitle is-6">{{currentEvent.user.data.email}}</p>-->
								<!--</div>-->
							<!--</div>-->
						<!--</article>-->
					<!--</div>-->
				<!--</div>-->
				<!--<hr>-->
			<!--</div>-->
		<!--</section>-->

		<tickets></tickets>


	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import Tickets from '~/components/ticket/Tickets';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	import { chunk } from 'lodash';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: this.currentEvent.title };
		},
		components: {
			Navbar,
			Tickets,
		},
		methods: {
			...mapActions(
				{
					fetchEvent: 'events/fetchEvent',
				},
			),
		},
		computed: {
			...mapGetters(
				{
					currentEvent: 'events/currentEvent',
				},
			)
		},
		mounted () {
			this.fetchEvent(this.$route.params.identifier);
		},
	};
</script>