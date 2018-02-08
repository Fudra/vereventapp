<template>
	<div class="card">
		<div class="card-content">
			<nav class="level">
				<div class="level-item"></div>
				<div class="level-item has-text-centered">
					<div>
						<figure class="image is-64x64">
							<img class="is-rounded" :src="user.photo_url" alt="">
						</figure>
						<p class="heading">{{user.name}}</p>
					</div>
				</div>
				<div class="level-item"></div>
			</nav>
		</div>
		<footer class="card-footer">
			<router-link :to="{name: 'users.detail', params: { user: user.identifier}}" class="card-footer-item">
				Anzeigen
			</router-link>
		</footer>
	</div>
</template>

<script>
	export default {
		name: 'user-card',
		props: {
			user: {
				type: Object,
				required: true,
			},
		},
	};
</script>

<style>
	a.card-footer-item:hover {
		color: white;
		background: #167DF0;
	}

	.content .title,
	.content .heading {
		margin-bottom: 0.4em!important;
	}
	.image {
		margin: 0 auto;
	}
</style>