<template>
	<div>
		<h1 class="title">{{$t('ticket.create')}}</h1>
		<form @submit.prevent="create" @keydown="form.onKeydown($event)" class="form">
			<alert-success :form="form" :message="$t('ticket.created')"></alert-success>

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
				<label class="label" for="quantity">{{ $t('ticket.quantity') }}</label>
				<p class="control">
					<input v-model="form.quantity" type="text" name="quantity" class="input"
						   id="quantity"
						   :class="{ 'is-danger': form.errors.has('quantity') }">
					<has-error :form="form" field="quantity"></has-error>
				</p>

				<label class="label" for="price">{{ $t('ticket.price') }}</label>
				<p class="control">
					<input v-model="form.price" type="text" name="price" class="input"
						   id="price"
						   :class="{ 'is-danger': form.errors.has('price') }">
					<has-error :form="form" field="price"></has-error>
				</p>
			</div>

			<!-- Datetime -->
			<div class="field is-grouped">
				<p class="control">
					<vue-datepicker-local v-model="time" type="normal" />
					<has-error :form="form" field="available_from"></has-error>
					<has-error :form="form" field="available_to"></has-error>
				</p>
			</div>


			<div class="field">
				<p class="control">
					<button class="button is-primary" :class="{'is-loading': form.busy }">
						{{ $t('general.save') }}
					</button>
				</p>
			</div>
		</form>
	</div>
</template>

<script>
	import Form from 'vform';
	import * as moment from 'moment';
	import axios from 'axios';
	import * as api from '~/services/routes';
	import VueDatepickerLocal from 'vue-datepicker-local'

	export default {
		name: 'tickets-create',

		metaInfo () {
			return { title: this.$t('ticket.create') };
		},

		data() {
			return {
				identifier: null,
				time: [],
				form: new Form(
					{
						name: '',
						quantity: 0,
						available_from: null,
						available_to: null,
						price: 0,
						visible: false,
					},
				),
			}
		},
		methods: {
			async create () {
				console.log('create new Ticket');

				this.form.available_from = this.parseDate(this.time[0]);
				this.form.available_to = this.parseDate(this.time[1]);

				console.log(this.form);
				await this.form.post(`/api/account/events/${this.identifier}/ticket`);
				this.form.reset();
				//this.identifier = null;
			},
			getIdentifer() {
				this.identifier = this.$route.params.event;
			},
			parseDate(dateString) {
				return moment(dateString).format('YYYY-MM-DD HH:mm:ss');
			}
		},
		components: {
			VueDatepickerLocal,
		},

		mounted() {
			this.getIdentifer();
		}
	}
</script>