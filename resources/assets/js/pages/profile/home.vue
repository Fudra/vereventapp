<template>
	<div>
		<h1 class="title">{{$t('home')}}</h1>
		<p>{{ $t('you_are_logged_in') }}</p>
	</div>
</template>

<script>
	export default {
		metaInfo () {
			return { title: this.$t('home') };
		},
		components: {
		},
	};
</script>
