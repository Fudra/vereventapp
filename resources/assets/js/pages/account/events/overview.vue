<template>
	<div>
		<h1 class="title">{{$t('event.overview')}}</h1>
		<event-media-object v-for="(event, index) in events"
							:event="event"
							:key="index">
		</event-media-object>
	</div>
</template>

<script>
	import EventMediaObject from '~/components/events/partials/EventMediaObject';
	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	export default {
		name: 'overview',

		metaInfo () {
			return { title: this.$t('event.overview') };
		},

		components: {
			EventMediaObject,
		},
		created () {
			this.fetchEvents();
		},
		methods: {
			...mapActions(
				{
					fetchEvents: 'events/fetchAccountEvents',
				},
			),
		},
		computed: {
			...mapGetters(
				{
					events: 'events/events',
				},
			)
		},
	}
</script>