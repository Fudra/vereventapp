<template>
	<div>
		<div class="columns">
			<div class="column is-vcentered">
				<h1 class="title">{{$t('invitee.invite')}}</h1>
			</div>
			<div class="column is-narrow">
				<router-link :to="{name: 'event.invitees.index', params: { event: identifier}}"
							 class="button is-primary">
					<span>Back</span>
				</router-link>
			</div>
		</div>
		<form @submit.prevent="invite" @keydown="form.onKeydown($event)" class="form">
			<alert-success :form="form" :message="$t('invitation.send')"></alert-success>

			<div class="columns" v-for="(invitation, index) in form.invitations" :key="index">
				<div class="column">
					<div class="field">
						<label class="label" for="name">{{ $t('invitee.name') }}</label>
						<p class="control">
							<input v-model="form.invitations[index].name"
								   type="text"
								   name="name"
								   class="input"
								   required
								   id="name"
								   :class="{ 'is-danger': form.errors.has('name') }">
						</p>
					</div>
				</div>
				<div class="column">
					<div class="field">
						<label class="label" for="email">{{ $t('invitee.email') }}</label>
						<p class="control">
							<input v-model="form.invitations[index].email"
								   type="text"
								   name="name"
								   class="input"
								   required
								   id="email"
								   :class="{ 'is-danger': form.errors.has('email') }">
						</p>
					</div>
				</div>
			</div>

			<div class="field">
				<p class="control">
					<button class="button is-primary" :class="{'is-loading': form.busy }">
						{{$t('general.invite')}}
					</button>
				</p>
			</div>
		</form>

		<hr>
		<a class="button" @click.prevent="addInviteField">
			<span class="icon">
			<fa icon="plus" fixed-width/>
		</span>
		</a>
		<a class="button" @click.prevent="removeInviteField">
			<span class="icon">
				<fa icon="minus" fixed-width/>
			</span>
		</a>
	</div>
</template>

<script>
	import Form from 'vform';

	export default {
		name: 'invitees-invite',

		metaInfo () {
			return { title: this.$t('event.invite') };
		},

		data () {
			return {
				form: new Form(
					{
						invitations: [
							{
								name: '',
								email: '',
							},

						],
					},
				),
				identifier: null,
			};
		},

		methods: {
			async fetch () {
				this.identifier = this.$route.params.event;
			},
			addInviteField () {
				this.form.invitations.push(
					{
						name: '',
						email: '',
					},
				);
			},
			removeInviteField () {
				this.form.invitations.pop();
			},
			async invite () {
				await this.form.post(`/api/account/events/${this.identifier}/invite`);
				this.form.reset();
			},
		},
		mounted () {
			this.fetch();
		},
	};
</script>