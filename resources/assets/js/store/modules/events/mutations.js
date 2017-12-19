/* eslint-disable */
import * as types from './mutation-types';
import Cookies from 'js-cookie';


export default {
	[types.FETCH_EVENTS_SUCCESS] (state, { events }) {
		state.events = events;
	},

	[types.FETCH_EVENTS_FAILURE] (state) {
		state.events = null;
	},
};
