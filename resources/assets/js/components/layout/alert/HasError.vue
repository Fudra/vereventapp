<template>
	<p class="help is-danger" v-if="form.errors.has(field)" v-html="form.errors.get(field)"></p>
</template>

<script>
	export default {
		name: 'has-error',
		props: {
			form: {
				type: Object,
				required: true
			},
			field: {
				type: String,
				required: true
			}
		}
	}
</script>