/* eslint-disable  */

export default [
	{
		path: '/',
		name: 'welcome',
		component: require('~/pages/welcome'),
	},
	{
		path: '/event/:identifier',
		name: 'event-detail',
		component: require('~/pages/event/event-detail')
	},

	// Authenticated routes.
	...middleware('auth', [
		{
			path: '/home',
			name: 'home',
			component: require('~/pages/profile/home'),
		},
		{
			path: '/events',
			component: require('~/pages/account/events/index'),
			children: [
				{
					path: 'overview',
					name: 'events.overview',
					component: require('~/pages/account/events/overview'),
				},
				{
					path: 'create',
					name: 'events.create',
					component: require('~/pages/account/events/create'),
				},
			]
		},
		{
			path: '/settings',
			component: require('~/pages/settings/index'),
			children: [
				{
					path: '',
					name: 'settings',
					redirect: { name: 'settings.profile' },
				},
				{
					path: 'profile',
					name: 'settings.profile',
					component: require('~/pages/settings/profile'),
				},
				{
					path: 'password',
					name: 'settings.password',
					component: require('~/pages/settings/password'),
				},
			],
		},

		// ...middleware('admin', [
		//   { path: '/admin', name: 'admin', component: require('~/pages/admin') }
		// ])
		// { path: '/example', name: 'example', component: require('~/pages/example'), middleware: ['admin'] },
	]),

	// Guest routes.
	...middleware('guest', [
		{
			path: '/login',
			name: 'login',
			component: require('~/pages/auth/login'),
		},
		{
			path: '/register',
			name: 'register',
			component: require('~/pages/auth/register'),
		},
		{
			path: '/password/reset',
			name: 'password.request',
			component: require('~/pages/auth/password/email'),
		},
		{
			path: '/password/reset/:token',
			name: 'password.reset',
			component: require('~/pages/auth/password/reset'),
		},
	]),

	{
		path: '*',
		component: require('~/pages/errors/404.vue'),
	},
];

/**
 * @param  {String|Function} middleware
 * @param  {Array} routes
 * @return {Array}
 */
function middleware (middleware, routes) {
	routes.forEach(route =>
					   (route.middleware || (route.middleware = [])).unshift(middleware),
	);

	return routes;
}
