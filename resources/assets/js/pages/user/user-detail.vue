<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						{{selectedUser.name}}
					</h1>
					<p class="subtitle is-4">{{selectedUser.email}}</p>
				</div>
			</div>
		</section>
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



	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import EventCard from '~/components/events/partials/EventCard';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	import { chunk } from 'lodash';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: this.selectedUser.name };
		},
		methods: {
			...mapActions(
				{
					fetchUser: 'user/fetchUser',
				},
			),
			getChunkedEvents () {
				return chunk(this.selectedUser.events.data, 3);
			},
		},
		computed: {
			...mapGetters(
				{
					selectedUser: 'user/selectedUser',
				},
			)
		},

		components: {
			Navbar,
			EventCard,
		},

		mounted () {
			this.fetchUser(this.$route.params.user);
		},

	};

</script>