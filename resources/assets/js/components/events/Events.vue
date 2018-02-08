<template>
	<section class="section">
		<div class="container">
			<h2 class="title has-text-centered">Events</h2>

			<div class="columns" v-for="events in getChunkedEvents()">
				<div class="column is-one-third"
					 v-for="(event, index) in events"
					 :key="index">
					<event-card :event="event"></event-card>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import EventCard from '~/components/events/partials/EventCard';

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
				default: 3,
			},
			fetchAll: {
				type: Boolean,
				default: true,
			}
		},
		created () {
			if(this.fetchAll)
			{
				this.fetchEvents();
			}
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