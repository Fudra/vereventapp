/* eslint-disable */
import * as types from './mutation-types';
import Cookies from 'js-cookie';

export default {
	[types.SAVE_TOKEN] (state, { token, remember }) {
		state.token = token;
		Cookies.set('token', token, { expires: remember ? 365 : null });
	},

	[types.FETCH_USER_SUCCESS] (state, { user }) {
		state.user = user;
	},

	[types.FETCH_USER_FAILURE] (state) {
		state.token = null;

		Cookies.remove('token');
	},

	[types.LOGOUT] (state) {
		state.user = null;
		state.token = null;

		Cookies.remove('token');
	},

	[types.UPDATE_USER] (state, { user }) {
		state.user = user;
	},
};
