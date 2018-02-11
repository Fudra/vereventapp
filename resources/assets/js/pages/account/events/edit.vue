<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('event.edit')}}</h1>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'events.index' }" class="button is-primary">
					<span class="icon"><fa icon="arrow-left" fixed-width/></span>
					<span>Back to Overview</span>
				</router-link>
			</div>
		</div>

		<form @submit.prevent="updated" @keydown="form.onKeydown($event)" class="form">
			<!--<alert-success :form="form" :message="$t('event.updated')"></alert-success>-->

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
					<checkbox v-model="form.private" name="private">{{ $t('event.private') }}</checkbox>
				</p>
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

	export default {
		metaInfo () {
			return { title: this.$t('event.edit') };
		},

		data () {
			return {
				form: new Form(
					{
						title: '',
						description: '',
						description_short: '',
						price: 0,
						live: false,
						private: true,
					},
				),
				identifier: null,
			};
		},

		methods: {
			async updated () {
				await this.form.post(`/api/account/events/${this.identifier}`);
				//this.form.reset();
				//this.identifier = null;
			},

			async fetch () {
				this.identifier = this.$route.params.event;
				const { data } = await this.form.get(`/api/events/${this.identifier}`);

				this.fillEventData(data.data);
			},
			fillEventData (data) {
				this.form.keys()
					.forEach(key => {
						this.form[key] = data[key];
					});

				this.form.live = data.meta.live;
				this.form.private = data.meta.private;
			},
		},

		mounted () {
			this.fetch();
		},
	};
</script>
