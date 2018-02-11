<template>
	<article class="media">
		<div class="media-content">
			<div class="content">
				<p>
					<strong>
						<router-link :to="{name: 'events.edit', params: { event: event.identifier}}">
							{{event.title}}
						</router-link>
					</strong>
					<br>
					{{ event.description_short }}
				</p>
			</div>
			<nav class="level is-mobile">
				<router-link :to="{name: 'events.tickets.index', params: { event: event.identifier }}"
							 class="level-item">
					<span class="icon"><fa icon="ticket-alt" fixed-width/></span>
					<span>{{event.tickets.data.length}}</span>
				</router-link>

				<router-link :to="{name: 'event.attendee.index', params: { event: event.identifier }}"
							 class="level-item">
					<span class="icon"><fa icon="users" fixed-width/></span>
					<span>{{event.meta.attendee}}</span>
				</router-link>

				<router-link :to="{name: 'event.invitees.index', params: { event: event.identifier }}"
							 class="level-item">
					<span class="icon"><fa icon="envelope" fixed-width/></span>
					<span>{{event.meta.invitees}}</span>
				</router-link>

				<a class="level-item">
					<span class="icon">
						<fa icon="eye-slash" v-if="event.meta.private" fixed-width/>
						<fa icon="eye" v-else fixed-width/>
					</span>
				</a>

				<a class="level-item">
					<span class="icon">
						<fa icon="check-square" v-if="event.meta.live" fixed-width/>
						<fa icon="stop" v-else fixed-width/>
					</span>
				</a>

				<router-link :to="{name: 'event.stats.index', params: { event: event.identifier }}"
							 class="level-item">
					<span class="icon"><fa icon="chart-bar" fixed-width/></span>
				</router-link>
			</nav>
		</div>
	</article>
</template>

<script>
	export default {
		name: 'event-media-object',
		props: {
			event: {
				type: Object,
				required: true,
			},
		},
	};
</script>

