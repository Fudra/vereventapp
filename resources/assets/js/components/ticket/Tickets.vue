<template>
	<section class="section">
		<div class="container">
			<h2 class="title is-2 has-text-centered">Tickets</h2>

			<div class="columns" v-for="tickets in getChunkedTickets()">
				<div class="column is-one-fifth"
					 :class="{ 'is-offset-one-fifth': index === 0}"
					 v-for="(ticket, index) in tickets"
					 :key="index">
					<ticket-card :ticket="ticket"></ticket-card>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import TicketCard from '~/components/ticket/TicketCard';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	import { chunk } from 'lodash';

	export default {
		name: 'tickets',
		props: {
			chunkSize: {
				type: Number,
				default: 3,
			},
		},
		methods: {
			getChunkedTickets () {
				return chunk(this.currentEvent.tickets.data, this.chunkSize);
			},
		},
		computed: {
			...mapGetters(
				{
					currentEvent: 'events/currentEvent',
				},
			)
		},
		components: {
			TicketCard,
		}
	};
</script>