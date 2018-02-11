<template>
	<section class="section">
		<div class="container">
			<h2 class="title is-2">Tickets</h2>

			<div class="columns" v-for="tickets in getChunkedTickets()">
				<div class="column is-one-fifth"
					 :class="{ 'is-offset-one-fifth': index === 0}"
					 v-for="(ticket, index) in tickets"
					 :key="index">
					<ticket-card :ticket="ticket"></ticket-card>
				</div>
			</div>

			<div class="columns">
				<div class="column is-four-fifths">
					<router-link :to="{name: 'event.checkout' }" class="button is-pulled-right is-info">
						Go To Checkout
					</router-link>
				</div>
			</div>


		</div>
	</section>
</template>

<script>
	import TicketCard from '~/components/ticket/partials/TicketCard';

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
				return chunk(Object.keys(this.currentEvent).length === 0 ? [] : this.currentEvent.tickets.data, this.chunkSize);
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
		},
	};
</script>