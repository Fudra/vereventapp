/* eslint-disable */

import axios from 'axios/index';
import * as types from './mutation-types';
import * as api from '~/services/routes'

export const saveToken = ({ commit }, payload) => commit(types.SAVE_TOKEN, payload);

export const fetchUser = async ({ commit }) => {
	try {
		const { data } = await axios.get(api.USER);

		console.log('USER DATA', data.data);

		commit(types.FETCH_USER_SUCCESS, { user: data.data });
	} catch (e) {
		commit(types.FETCH_USER_FAILURE);
	}
};

export const updateUser = ({ commit }, payload) => {
	commit(types.UPDATE_USER, payload);
};

export const logout = async ({ commit }) => {
	try {
		await axios.post(api.LOGOUT);
	} catch (e) {
	}

	commit(types.LOGOUT);
};

