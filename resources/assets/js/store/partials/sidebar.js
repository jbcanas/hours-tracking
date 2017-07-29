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
		    url: '',
		    active: false,
		    highlight: false,
		    items: [
		        {
		            name: 'Company Jobs',
		            url: '/companyJobs'
		        },
		        {
		            name: 'Employee Jobs',
		            url: '/weekly'
		        },
		        {
		            name: 'Port Hours',
		            url: '/weekly'
		        },
		    ]
		}
	]
}

const actions = {
	toggleMenu({commit, state}, id) {
		commit('toggleActiveState', id);
	},
	activateHighlight({commit, state}, id) {
		commit('enableHighlightState', id);
	}
}

const mutations = {
	toggleActiveState(state, id) {
		const menu = _.find(state.menus, {id: id});
		menu.active = ! menu.active;
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