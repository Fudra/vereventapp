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
						<router-link :to="{name: 'event-detail', params: { event: event.identifier}}">
							{{event.title}}
						</router-link>
					</p>
				</div>
			</div>

			<div class="content">
				{{event.description_short}}
				<!--<a href="#">#css</a> <a href="#">#responsive</a>-->
				<br>
				<br>
				<!--<div class="tags">-->
					<!--<span class="tag">One</span>-->
					<!--<span class="tag">Two</span>-->
					<!--<span class="tag">Three</span>-->
				<!--</div>-->
				<!--<p class="subtitle is-6"><a href="#">{{event.user.data.name}}</a></p>-->
				<nav class="level">
					<div class="level-item"></div>
					<div class="level-item has-text-centered">
						<div>
							<figure class="image is-64x64">
								<img class="is-rounded" :src="event.user.data.photo_url" alt="">
								<p class="heading">{{event.user.data.name}}</p>
							</figure>
						</div>
					</div>
					<div class="level-item"></div>
				</nav>
				<hr>
				<div class="has-text-right">
					<time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
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
