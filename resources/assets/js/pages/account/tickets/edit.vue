<template>
	<div>
		<h1 class="title">{{$t('ticket.edit')}}</h1>
		<form @submit.prevent="create" @keydown="form.onKeydown($event)" class="form">
			<alert-success :form="form" :message="$t('event.created')"></alert-success>

			<!-- title -->
			<div class="field">
				<label class="label" for="title">{{ $t('event.title') }}</label>
				<p class="control">
					<input v-model="form.title" type="text" name="title" class="input"
						   id="title"
						   :class="{ 'is-danger': form.errors.has('title') }">
					<has-error :form="form" field="title"></has-error>
				</p>
			</div>

			<!-- description short -->
			<div class="field">
				<label class="label" for="description_short">{{ $t('event.description_short') }}</label>
				<p class="control">
					<textarea name="description_short" id="description_short"
							  cols="30" rows="5"
							  class="textarea"
							  v-model="form.description_short"
							  :class="{ 'is-danger': form.errors.has('description_short') }"></textarea>
					<has-error :form="form" field="description_short"></has-error>
				</p>
			</div>

			<!-- description -->
			<div class="field">
				<label class="label" for="description">{{ $t('event.description') }}</label>
				<p class="control">
					<textarea name="description" id="description"
							  cols="30" rows="5"
							  class="textarea"
							  v-model="form.description"
							  :class="{ 'is-danger': form.errors.has('description') }"></textarea>
					<has-error :form="form" field="description"></has-error>
				</p>
			</div>

			<!-- -->
			<div class="field is-grouped">
				<p class="control">
					<checkbox v-model="form.live" name="live">{{ $t('event.live') }}</checkbox>
				</p>
				<p class="control">
					<checkbox v-model="form.public" name="public">{{ $t('event.public') }}</checkbox>
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
	import axios from 'axios';
	import * as api from '~/services/routes';

	export default {
		name: 'tickets-create',

		metaInfo () {
			return { title: this.$t('ticket.create') };
		},

		data() {
			return {
				identifier: null,
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
		mounted:{
			async create () {
				console.log('create new Ticket');

				//await this.form.post(`/api/account/events/${this.identifier}`);
				this.form.reset();
				this.identifier = null;
			},
			getIdentifer() {
				this.identifier = this.$route.params.event;
			},
		},

		create() {
			this.getIdentifer();
		}

	}
</script>