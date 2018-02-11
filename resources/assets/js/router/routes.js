/* eslint-disable  */

export default [
	// Home
	{
		path: '/',
		name: 'welcome',
		component: require('~/pages/welcome'),
	},

	// Events
	{
		path: '/event/:event',
		name: 'event-detail',
		component: require('~/pages/event/event-detail'),
	},

	// User
	{
		path: '/users',
		name: 'users.index',
		component: require('~/pages/user/user-index'),
	},
	{
		path: '/users/:user',
		name: 'users.detail',
		component: require('~/pages/user/user-detail'),
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
			component: require('~/pages/account/events/layout'),
			children: [
				{
					path: 'overview',
					name: 'events.index',
					component: require('~/pages/account/events/index'),
				},
				{
					path: 'create',
					name: 'events.create',
					component: require('~/pages/account/events/create'),
				},
				{
					path: ':event/edit',
					name: 'events.edit',
					component: require('~/pages/account/events/edit'),
				},
				// tickets
				{
					path: ':event/tickets',
					name: 'events.tickets.index',
					component: require('~/pages/account/tickets/index')
				},
				{
					path: ':event/tickets/create',
					name: 'events.tickets.create',
					component: require('~/pages/account/tickets/create')
				},
				{
					path: ':event/tickets/:ticket/edit',
					name: 'events.tickets.edit',
					component: require('~/pages/account/tickets/edit')
				},

				// invitees
				{
					path: ':event/invitees',
					name: 'event.invitees.index',
					component: require('~/pages/account/invitees/index')
				},
				{
					path: ':event/invitees/invite',
					name: 'event.invitees.invite',
					component: require('~/pages/account/invitees/invite')
				},

				// attendee
				{
					path: ':event/attendee',
					name: 'event.attendee.index',
					component: require('~/pages/account/attendee/index')
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
