/* eslint-disable */
import * as types from './mutation-types';
import Cookies from 'js-cookie';


export default {
	[types.FETCH_USERS_SUCCESS] (state, { users }) {
		state.users = users;
	},
	[types.FETCH_USER_SUCCESS] (state, { user }) {
		state.user = user;
	},
};
