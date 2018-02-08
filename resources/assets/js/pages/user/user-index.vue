<template>
	<div>
		<section class="hero is-info is-bold">
			<navbar></navbar>

			<div class="hero-body">
				<div class="container">
					<h1 class="title">
						Die Benutzer der Plattform.
					</h1>
				</div>
			</div>
		</section>

		<section class="container" style="margin-top: 30px;">
			<div class="columns" v-for="users in getChunkedUsers()">
				<div class="column is-one-third"
					 v-for="(user, index) in users"
					 :key="index">
					<user-card :user="user"></user-card>
				</div>
			</div>
		</section>


	</div>
</template>

<script>
	import Navbar from '~/components/layout/Navbar';
	import UserCard from '~/components/user/UserCard';
	import { chunk } from 'lodash';

	import {
		mapActions,
		mapGetters,
	} from 'vuex';

	export default {
		layout: 'default',

		metaInfo () {
			return { title: 'user.plattform' };
		},

		data () {
			return {};
		},

		components: {
			Navbar,
			UserCard,
		},

		methods: {
			...mapActions(
				{
					fetchUsers: 'user/fetchUsers',
				},
			),
			getChunkedUsers () {
				return chunk(this.users, 3);
			},
		},
		computed: {
			...mapGetters(
				{
					users: 'user/users',
				},
			)
		},

		created () {
			this.fetchUsers();
		},
	};
</script>