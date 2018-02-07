<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('tickets.heading')}}</h1>
				<h2 class="subtitle">
					<router-link :to="{name: 'events.edit', params: { event: event.identifier}}">
						{{event.title}}
					</router-link>
				</h2>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'events.tickets.create', params: { event: event.identifier}}" class="button is-primary">
					<span class="icon"><fa icon="plus" fixed-width/></span>
					<span>Add new Ticket</span>
				</router-link>
			</div>
		</div>

		<b-table :data="event.tickets.data"
				 :hoverable="true"
				 :per-page="1"
				 :mobile-cards="true">
			<template slot-scope="props">
				<b-table-column  field="name" label="Name" sortable>
					{{ props.row.name }}
				</b-table-column>

				<b-table-column  field="quantity" label="Anzahl" sortable>
					{{ props.row.quantity }}
				</b-table-column>

				<b-table-column  field="available_from" label="Verfügbar ab" sortable>
					{{ new Date(props.row.available_from).toLocaleDateString() }}
				</b-table-column>

				<b-table-column  field="available_to" label="Verfügbar bis" sortable>
					{{ new Date(props.row.available_to).toLocaleDateString() }}
				</b-table-column>

				<b-table-column  field="price" label="Preis" sortable>
					{{ props.row.price }}
				</b-table-column>

				<b-table-column  label="Edit">
					<router-link :to="{name:'events.tickets.edit', params: { ticket: props.row.identifier, event: identifier}} " tag="button" class="button is-primary">Edit</router-link>
				</b-table-column>
			</template>

		</b-table>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		name: 'ticket-index',
		layout: 'account',

		metaInfo () {
			return { title: this.$t('tickets.heading') };
		},

		data () {
			return {
				event: {
					identifier: 0,
					tickets: {
						data: []
					}
				}
			};
		},
		methods: {
			async fetch () {
				this.identifier = this.$route.params.event;
				const { data } = await axios.get(`/api/events/${this.identifier}`);

				this.event = data.data;
			},
		},
		mounted() {
			this.fetch();
		}
	};
</script>