<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						{{selectedUser.name}}
					</h1>
				</div>
			</div>
		</section>

		<section class="container" style="margin-top: 30px;">
			<pre>{{selectedUser}}</pre>
		</section>

		<events :fetchAll="false"></events>


	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import Events from '~/components/events/Events'

	import {
		mapActions,
		mapGetters,
	} from 'vuex';


	export default {
		layout: 'default',

		metaInfo () {
			return { title: this.selectedUser.name };
		},
		methods: {
			...mapActions(
				{
					fetchUser: 'user/fetchUser',
				},
			),
		},
		computed: {
			...mapGetters(
				{
					selectedUser: 'user/selectedUser',
				},
			)
		},

		components: {
			Navbar,
			Events,
		},
		mounted() {
			this.fetchUser(this.$route.params.user)
		}
	}

</script>