<template>
	<section class="section">
		<div class="container">
			<h2 class="title is-2 has-text-centered">Events</h2>

			<div class="columns" v-for="events in getChunkedEvents()">
				<div class="column is-one-fifth"
					 :class="{ 'is-offset-one-fifth': index === 0}"
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
		},


		components: {
			EventCard,
		}
	};
</script>