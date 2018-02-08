/* eslint-disable */
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import auth from './modules/auth';
import events from './modules/events';
import user from './modules/user';

export default new Vuex.Store(
	{
		modules: {
			auth,
			events,
			user,
		},
	},
);
