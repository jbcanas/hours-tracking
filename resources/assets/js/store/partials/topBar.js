const state = {
	hiddenSidebar: false
}

const mutations = {
	toggleSidebar(state) {
		state.hiddenSidebar = !state.hiddenSidebar
	}
}

export default {
	state,
	mutations,
}