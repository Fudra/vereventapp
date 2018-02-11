<template>
	<section class="section">
		<div class="container">
			<h2 class="title is-2">Organizer</h2>


			<div class="columns">
				<div class="column is-one-quarter">
					<img :src="userData.photo_url" alt="">
				</div>
				<div class="column">
					<p class="title is-2">{{userData.name}}</p>
					<p class="subtitle is-4">{{userData.email}}</p>
				</div>
			</div>


		</div>
	</section>
</template>

<script>
	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	export default {
		name: 'organizer',

		data() {
			return {}
		},
		methods: {

		},
		computed: {
			...mapGetters(
				{
					currentEvent: 'events/currentEvent',
				},
			),
			userData() {
				return Object.keys(this.currentEvent).length === 0 ? {} : this.currentEvent.user.data;
			}
		},
	};
</script>