<template>
	<div class="card">
		<div class="card-image">
			<figure class="image is-4by3">
				<img :src="imgUrl" :alt="event.title">
			</figure>
		</div>
		<div class="card-content">
			<div class="media">
				<!--<div class="media-left">-->
				<!--<figure class="image is-48x48">-->
				<!--<img :src="event.user.data.photo_url" :alt="event.user.data.name">-->
				<!--</figure>-->
				<!--</div>-->
				<div class="media-content">
					<p class="title is-4">
						<router-link :to="{name: 'event-detail', params: { identifier: event.identifier}}">
							{{event.title}}
						</router-link>
					</p>
					<p class="subtitle is-6"><a href="#">{{event.user.data.name}}</a></p>
				</div>
			</div>

			<div class="content">
				{{event.description_short}}
				<!--<a href="#">#css</a> <a href="#">#responsive</a>-->
				<br>
				<br>
				<time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
				<hr>
				<div class="tags">
					<span class="tag">One</span>
					<span class="tag">Two</span>
					<span class="tag">Three</span>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
	export default {
		name: 'event-card',
		props: {
			event: {
				type: Object,
				required: true,
			},
		},
		computed: {
			imgUrl () {
				return `https://via.placeholder.com/1280x960?text=${this.event.title}`;
			},
		},
	};
</script>
