<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('attendee.overview')}}</h1>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'events.index' }" class="button is-primary">
					<span class="icon"><fa icon="arrow-left" fixed-width/></span>
					<span>Back to Overview</span>
				</router-link>
			</div>
		</div>

		<b-table :data="this.attendee"
				 :striped="true"
				 :loading="loading">

			<template slot-scope="props">
				<b-table-column field="name" label="Name">
					{{ props.row.name }}
				</b-table-column>
				<b-table-column field="email" label="E-Mail">
					{{ props.row.email }}
				</b-table-column>
			</template>

			<template slot="empty">
				<section class="section">
					<div class="content has-text-grey has-text-centered">
						<p>
							<span class="icon"><fa icon="frown" fixed-width size="6x"/></span>
						</p>
						<p>No Attendees.</p>
					</div>
				</section>
			</template>
		</b-table>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {
		name: 'attendee-index',

		metaInfo () {
			return { title: this.$t('attendee.index') };
		},

		data () {
			return {
				identifier: null,
				attendee: [],
				loading: true,
			};
		},

		methods: {
			async fetch () {
				this.identifier = this.$route.params.event;
				const { data } = await axios.get(`/api/account/events/${this.identifier}/attendee`);
				this.attendee = data.data;
				this.loading = false;
			},
		},

		mounted () {
			this.fetch();
		},
	};
</script>