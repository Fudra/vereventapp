<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('invitees.overview')}}</h1>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'event.invitees.invite', params: { event: identifier}}" class="button is-primary">
					<span class="icon"><fa icon="plus" fixed-width/></span>
					<span>Invite</span>
				</router-link>
			</div>
		</div>

		<b-table :data="this.invitees"
				 :striped="true"
				:loading="loading">

			<template slot-scope="props">
				<b-table-column field="name" label="Name" >
					{{ props.row.name }}
				</b-table-column>
				<b-table-column field="email" label="E-Mail" >
					{{ props.row.email }}
				</b-table-column>
			</template>
		</b-table>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		name: 'invitees-index',

		metaInfo () {
			return { title: this.$t('event.invite') };
		},

		data () {
			return {
				identifier: null,
				invitees: [],
				loading: true,
			}
		},

		methods: {
			async fetch () {
				this.identifier = this.$route.params.event;
				const { data } = await axios.get(`/api/account/events/${this.identifier}/invite`);
				this.invitees = data.data;
				this.loading = false;
			},
		},

		mounted () {
			this.fetch();
		},
	}
</script>