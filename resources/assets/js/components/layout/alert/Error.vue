<template>
	<div class="notification is-danger" v-if="form.errors.any()" >
		<button class="delete" v-if="dismissible" @click="dismiss" type="button"></button>
		<div v-if="form.errors.has('error')" v-html="form.errors.get('error')"></div>
		<div v-else v-html="message"></div>
	</div>
</template>

<script>
	import Alert from './Alert';

	export default {
		extends: Alert,
		name: 'alert-error',
		props: {
			message: {
				type: String,
				default: 'There were some problems with your input.',
			},
		},
	};
</script>