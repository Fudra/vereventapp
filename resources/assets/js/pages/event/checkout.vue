<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						Checkout
					</h1>
					<h2 class="subtitle">
						{{currentEvent.title}}
					</h2>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<form @submit.prevent="checkout" @keydown="form.onKeydown($event)" class="form">
					<alert-success
							:form="form"
							message="Checkout Successfully! We Send yor an Email with your order.">
					</alert-success>
					<!-- title -->

					<div class="columns" style="margin-top: 30px">
						<div class="column">
							<div class="field">
								<label class="label" for="name">Name</label>
								<p class="control">
									<input v-model="form.name" type="text" name="name" class="input"
										   id="name"
										   required
										   :class="{ 'is-danger': form.errors.has('name') }">
									<has-error :form="form" field="name"></has-error>
								</p>
							</div>
						</div>
						<div class="column">
							<div class="field">
								<label class="label" for="email">E-Mail</label>
								<p class="control">
									<input v-model="form.email" type="text" name="email" class="input"
										   id="email" required
										   :class="{ 'is-danger': form.errors.has('email') }">
									<has-error :form="form" field="email"></has-error>
								</p>
							</div>
						</div>
					</div>
					<hr>

					<b-field horizontal
							 :label="ticket.name"
							 v-for="(ticket, index) in form.tickets"
							 :key="index">
						<p class="control">
							<b-input type="number"
									 placeholder="0"
									 min="0"
									 v-model="form.tickets[index].amount"
									 :max="ticket.max">
							</b-input>
						</p>
					</b-field>

					<div class="field">
						<p class="control">
							<button class="button is-primary" :class="{'is-loading': form.busy }">
								Checkout
							</button>
						</p>
					</div>
				</form>
			</div>
		</section>

	</div>
</template>

<script>
	import Form from 'vform';
	import Navbar from '~/components/layout/Navbar';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	export default {
		layout: 'default',

		data () {
			return {
				form: new Form(
					{
						name: '',
						email: '',
						tickets: [],
					},
				),
			};
		},
		components: {
			Navbar,
		},

		metaInfo () {
			return { title: 'Checkout' };
		},

		computed: {
			...mapGetters(
				{
					currentEvent: 'events/currentEvent',
				},
			)
		},
		methods: {
			async checkout () {
				await this.form.post(`/api/events/${this.currentEvent.identifier}/checkout`);
				this.form.reset();
			},
			addTickets () {
				console.log(this.currentEvent);
				if (Object.keys(this.currentEvent).length === 0) {
					return;
				}
				this.currentEvent.tickets.data.forEach(t => {
					this.form.tickets.push(
						{
							ticketId: t.identifier,
							name: t.name,
							amount: 0,
							min: 0,
							max: t.quantity,
						},
					);
				});
			},
		},
		watch: {
			currentEvent: {
				handler (v) {
					console.log(v);
					this.addTickets();
				},
			},
		},
		created() {
			this.addTickets();

		}
	};
</script>