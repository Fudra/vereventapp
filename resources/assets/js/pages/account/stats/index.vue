<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('stats.overview')}}</h1>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'events.index' }" class="button is-primary">
					<span class="icon"><fa icon="arrow-left" fixed-width/></span>
					<span>Back to Overview</span>
				</router-link>
			</div>
		</div>

		<b-loading :active.sync="isLoading" :canCancel="false"></b-loading>
		<b-field grouped group-multiline>
			<div class="control">
				<b-taglist attached>
					<b-tag size="is-large" type="is-dark">Invitations</b-tag>
					<b-tag size="is-large" type="is-info">{{stats.invited}}</b-tag>
				</b-taglist>
			</div>

			<div class="control">
				<b-taglist attached>
					<b-tag size="is-large" type="is-dark">Attendees</b-tag>
					<b-tag size="is-large" type="is-info">{{stats.attendees}}</b-tag>
				</b-taglist>
			</div>

			<div class="control">
				<b-taglist attached>
					<b-tag size="is-large" type="is-dark">Ticket Sales</b-tag>
					<b-tag size="is-large" type="is-info">{{stats.sales}}</b-tag>
				</b-taglist>
			</div>
		</b-field>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		name: 'stats-index',

		metaInfo () {
			return { title: this.$t('event.stats') };
		},

		data () {
			return {
				identifier: null,
				stats: [],
				isLoading: true,
			};
		},

		methods: {
			async fetch () {
				this.identifier = this.$route.params.event;
				const { data } = await axios.get(`/api/account/events/${this.identifier}/stats`);
				this.stats = data.data;
				this.isLoading = false;
			},
		},

		mounted () {
			this.fetch();
		},
	};
</script>