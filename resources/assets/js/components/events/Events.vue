<template>
	<section class="section">
		<div class="container">
			<h2 class="subtitle is-2">Events</h2>

			<div class="columns" v-for="events in getChunkedEvents()">
				<div class="column is-3"
					 v-for="(event, index) in events"
					 :key="index">
					<event-card :event="event"></event-card>
				</div>
			</div>

		</div>
	</section>
</template>

<script>
	import EventCard from '~/components/events/EventCard';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	import { chunk } from 'lodash';

	export default {
		name: 'events',
		props: {
			chunkSize: {
				type: Number,
				default: 4,
			},
		},
		created () {
			this.fetchEvents();
		},
		methods: {
			...mapActions(
				{
					fetchEvents: 'events/fetchEvents',
				},
			),
			getChunkedEvents () {
				return chunk(this.events, this.chunkSize);
			},
		},
		computed: {
			...mapGetters(
				{
					events: 'events/events',
				},
			)
		},
		components: {
			EventCard,
		}
	};
</script>