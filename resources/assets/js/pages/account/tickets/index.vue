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

		<pre>{{event.tickets.data}}</pre>

		<b-table :data="event.tickets.data"
				 :hoverable="true"
				 :mobile-cards="true">
			<template slot-scope="props">
				<!--<b-table-column  v-for="(item, index) in props.row" :key="index" sortable>-->
					<!--&lt;!&ndash;{{ props.row.id }}&ndash;&gt;-->
					<!--{{item}}-->
				<!--</b-table-column>-->


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