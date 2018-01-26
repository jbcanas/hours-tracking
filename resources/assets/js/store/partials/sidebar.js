const state = {
	menus: [
		{
			id: _.uniqueId('menu'),
		    name: 'Gang Sheet',
		    icon: 'fa-newspaper-o',
		    url: '/gangSheet',
		    active: false,
		    highlight: false,
		    items: []
		},
		{
			id: _.uniqueId('menu'),
		    name: 'Reports',
		    icon: 'fa-archive',
		    url: '/reports',
		    active: false,
		    highlight: false,
		    items: [
		        {
		            name: 'Company Jobs',
		            url: '/reports/companyJobs'
		        },
		        {
		            name: 'Employee Jobs',
		            url: '/reports/employeeJobs'
		        },
		        {
		            name: 'Port Hours',
		            url: '/reports/portHours'
		        },
		    ]
		}
	]
}

const actions = {
	toggleMenu({commit, state}, id) {
		commit('toggleActiveState', id);
	},
	hoverMenu({commit, state}, args) {
		commit('modifyActiveState', args);
	},
	activateHighlight({commit, state}, id) {
		commit('enableHighlightState', id);
	},
	enableMenu({commit, state}, path) {
		const findID = _.find(state.menus, {url: path});
		commit('enableHighlightState', findID.id);
	}
}

const mutations = {
	toggleActiveState(state, id) {
		const menu = _.find(state.menus, {id: id});
		menu.active = ! menu.active;
	},
	modifyActiveState(state, args) {
		const menu = _.find(state.menus, {id: args.id});
		menu.active = args.arg;
	},
	enableHighlightState(state, id) {
		// disable all hightlight first
		_.forEach(state.menus, (el, key) => {
			el.highlight = false;
			el.active = false;
		});

		const menu = _.find(state.menus, {id: id});
		menu.highlight = true;
		menu.active = true;
	}
}

export default {
	state,
	mutations,
	actions,
}
