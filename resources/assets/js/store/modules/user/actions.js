/* eslint-disable */

import axios from 'axios/index';
import * as types from './mutation-types';
import * as api from '~/services/routes';

export const fetchUsers = async ({ commit }) => {
	try {
		const { data } = await axios.get(api.USER);
		console.log(data);

		commit(types.FETCH_USERS_SUCCESS, { users: data.data });
	} catch (e) {
		commit(types.FETCH_USERS_FAILURE);
	}
};

export const fetchUser = async ({ commit, dispatch }, payload) => {
	try {
		const { data } = await axios.get(api.USER + '/'+ payload);

		dispatch('events/storeEvents', { events: data.data.events }, {root: true});
		commit(types.FETCH_USER_SUCCESS, { user: data.data });
	} catch (e) {
		commit(types.FETCH_USER_FAILURE);
	}
};
