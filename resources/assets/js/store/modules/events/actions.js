/* eslint-disable */

import axios from 'axios/index';
import * as types from './mutation-types';
import * as api from '~/services/routes';

export const fetchEvents = async ({ commit }) => {
	try {
		const { data } = await axios.get(api.EVENTS);

		commit(types.FETCH_EVENTS_SUCCESS, { events: data.data });
	} catch (e) {
		commit(types.FETCH_EVENTS_FAILURE);
	}
};

export const fetchEvent = async ({ commit }, payload) => {
	try {
		const { data } = await axios.get(api.EVENTS + '/'+ payload);

		commit(types.FETCH_EVENT_SUCCESS, { event: data.data });
	} catch (e) {
		commit(types.FETCH_EVENT_FAILURE);
	}
};
