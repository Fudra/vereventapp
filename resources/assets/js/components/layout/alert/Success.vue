<template>
	<div class="notification is-success" v-if="form.successful" >
		<button class="delete" v-if="dismissible" @click="dismiss" type="button"></button>

		<div v-if="message" v-html="message"></div>

	</div>
</template>

<script>
	import Alert from './Alert';

	export default {
		extends: Alert,
		name: 'alert-success',
		props: {
			message: {
				type: String,
				required: true,
			},
		},
	};
</script>