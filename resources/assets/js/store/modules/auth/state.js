/* eslint-disable */

import Cookies from 'js-cookie';

export default {
	user: null,
	token: Cookies.get('token'),
};