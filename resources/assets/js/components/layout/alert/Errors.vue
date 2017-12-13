<template>
	<div class="notification is-danger" v-if="form.errors.any()" >
		<button class="delete" v-if="dismissible" @click="dismiss" type="button"></button>

		<div v-if="message" v-html="message"></div>
		<ul>
			<li v-for="error in form.errors.flatten()" v-html="error"></li>
		</ul>
	</div>
</template>

<script>
	import Alert from './Alert';

	export default {
		extends: Alert,
		name: 'alert-errors',
		props: {
			message: {
				type: String,
				default: 'There were some problems with your input.',
			},
		},
	};
</script>