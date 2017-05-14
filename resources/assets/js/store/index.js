import Vue from 'vue'
import Vuex from 'vuex'
import sidebar from './partials/sidebar'
import topBar from './partials/topBar'
import companyJobs from './companyJobs'

export default new Vuex.Store({
	modules: {
		sidebar,
		topBar,
		companyJobs
	}
})