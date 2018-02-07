<template>
	<div>
		<h1 class="title">{{$t('ticket.update')}}</h1>
		<form @submit.prevent="updated" @keydown="form.onKeydown($event)" class="form">
			<!--<alert-success :form="form" :message="$t('ticket.created')"></alert-success>-->

			<!-- title -->
			<div class="field">
				<label class="label" for="name">{{ $t('ticket.name') }}</label>
				<p class="control">
					<input v-model="form.name" type="text" name="name" class="input"
						   id="name"
						   :class="{ 'is-danger': form.errors.has('name') }">
					<has-error :form="form" field="name"></has-error>
				</p>
			</div>

			<!-- quantitiy / price -->
			<div class="field is-grouped">

				<p class="control">
					<label class="label" for="quantity">{{ $t('ticket.quantity') }}</label>
					<input v-model="form.quantity" type="text" name="quantity" class="input"
						   id="quantity"
						   :class="{ 'is-danger': form.errors.has('quantity') }">
					<has-error :form="form" field="quantity"></has-error>
				</p>
				<div class="field has-addons">
					<p class="control">
						<label class="label" for="price">{{ $t('ticket.price') }}</label>
						<input v-model="form.price" type="text" name="price" class="input"
							   id="price"
							   :class="{ 'is-danger': form.errors.has('price') }">
						<has-error :form="form" field="price"></has-error>
					</p>
					<p class="control">
						<label class="label">&nbsp;</label>
						<a class="button is-static">
							€
						</a>
					</p>
				</div>

			</div>

			<!-- Datetime -->
			<div class="field is-grouped">
				<p class="control">
					<b-field :label="$t('ticket.date.from')"></b-field>

					<b-datepicker
							placeholder="Click to select..."
							v-model="form.available_from">
					</b-datepicker>
					<has-error :form="form" field="available_from"></has-error>
				</p>
				<p class="control">
					<b-field :label="$t('ticket.date.to')"></b-field>

					<b-datepicker
							placeholder="Click to select..."
							v-model="form.available_to">
					</b-datepicker>
					<has-error :form="form" field="available_to"></has-error>
				</p>

				<!--<vue-datepicker-local v-model="time" type="normal" :local="local" />-->

			</div>


			<div class="field">
				<p class="control">
					<button class="button is-primary" :class="{'is-loading': form.busy }">
						{{ $t('general.update') }}
					</button>
				</p>
			</div>
		</form>
	</div>
</template>

<script>
	import Form from 'vform';
	import axios from 'axios';
	import * as api from '~/services/routes';
	import * as moment from 'moment';


	export default {
		name: 'tickets-create',

		metaInfo () {
			return { title: this.$t('ticket.create') };
		},

		data () {
			return {
				eventId: null,
				ticketId: null,
				form: new Form(
					{
						name: '',
						quantity: 0,
						available_from: new Date(),
						available_to: new Date(),
						price: 0,
						visible: false,
					},
				),
				sendForm: null,
			};
		},
		methods: {
			async updated () {
				this.sendFrom = new Form(this.form);
				this.sendFrom.available_from = this.parseDate(this.form.available_from);
				this.sendFrom.available_to = this.parseDate(this.form.available_to);
				await this.sendFrom.patch(`/api/account/events/${this.eventId}/ticket/${this.ticketId}`);

			},
			async fetch () {
				console.log('tickets fetch', this.$route.params);
				this.eventId = this.$route.params.event;
				this.ticketId = this.$route.params.ticket;
				const { data } = await this.form.get(`/api/events/${this.eventId}/ticket/${this.ticketId}`);

				console.log(data.data);

				this.fillTicketData(data.data);
			},
			fillTicketData (data) {
				this.form.keys()
					.forEach(key => {
						if(key === 'available_from' || key === 'available_to') {
							this.form[key] = new Date(data[key]);
						} else {
							this.form[key] = data[key];
						}
					});

			},
			getIdentifer () {
				this.identifier = this.$route.params.event;
			},
			parseDate(dateString) {
				return moment(dateString).format('YYYY-MM-DD HH:mm:ss');
			},
		},
		created () {
			this.fetch();
		},

	};
</script>