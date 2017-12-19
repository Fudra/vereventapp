/* eslint-disable */
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import auth from './modules/auth';
import events from './modules/events';

export default new Vuex.Store(
	{
		modules: {
			auth,
			events,
		},
	},
);
