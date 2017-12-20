<template>
	<div class="card">
		<header class="card-header">
			<p class="card-header-title">
				{{ticket.name}}
			</p>
		</header>
		<div class="card-content">

			<div class="content">
				<p class="heading">Preis</p>
				<p class="title" v-if="ticket.price !== '0.00'">{{ticket.price}} €</p>
				<p class="title" v-else><span class="tag is-success">Frei</span></p>
				<p class="heading">Verfügbar</p>
				<p class="title">{{ticket.quantity}}</p>
				<br>
				<time :datetime="ticket.available_from">{{ticket.available_from}}</time>
				-
				<time :datetime="ticket.available_to">{{ticket.available_to}}</time>
			</div>
		</div>
		<footer class="card-footer">
			<a href="#" class="card-footer-item">Kaufen</a>
			<a href="#" class="card-footer-item">Interessiert</a>
		</footer>
	</div>
</template>

<script>
	export default {
		name: 'ticket-card',
		props: {
			ticket: {
				type: Object,
				required: true,
			},
		},
		computed: {},
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
</style>