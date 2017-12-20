<template>
	<article class="media">
		<div class="media-content">
			<div class="content">
				<p>
					<strong>
						<router-link :to="{name: 'events.edit', params: { identifier: event.identifier}}">
							{{event.title}}
						</router-link>
					</strong>
					<br>
					{{ event.description_short }}
				</p>
			</div>
			<nav class="level is-mobile">
				<a class="level-item">
					<span class="icon"><fa icon="ticket-alt" fixed-width/></span>
					<span>{{event.tickets.data.length}}</span>
				</a>
				<a class="level-item">
					<span class="icon"><fa icon="users" fixed-width/></span>
					<span>0</span>
				</a>
				<a class="level-item">
					<span class="icon"><fa icon="calendar-alt" fixed-width/></span>
					<span><time datetime="2016-1-1">1 Jan 2016</time> - <time
							datetime="2016-1-1">1 Jan 2016</time></span>
				</a>
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

