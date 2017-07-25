const state = {
	menus: [
		{
			id: _.uniqueId('menu'),
		    name: 'Gang Sheet',
		    icon: 'fa-newspaper-o',
		    url: '/gangSheet',
		    active: false,
		    items: []
		},
		{
			id: _.uniqueId('menu'),
		    name: 'Reports',
		    icon: 'fa-archive',
		    url: '',
		    active: false,
		    items: [
		        {
		            name: 'Company Jobs',
		            url: '/companyJobs',
		            active: false,
		        },
		        {
		            name: 'Employee Jobs',
		            url: '/weekly',
		            active: false,
		        },
		        {
		            name: 'Port Hours',
		            url: '/weekly',
		            active: false,
		        },
		    ]
		}
	]
}

const mutations = {
	toggleMenuActiveProp(state, id) {
		const menu = _.find(state.menus, {id: id});
		menu.active = ! menu.active;
	}
}

export default {
	state,
	mutations,
}