export default {
	state: {
		gangSheet: {
			userId: 0,
			accountDescription: '',
			jobName: '',
			requestedBy: '',
			arbitrationAward: 0,
			requestDate: '',
			vesselBarge: '',
			workDate: '',
			voyage: '',
			startTime: '',
			jobSheetNumber: '',
			stopTime: '',
			ilwuJobNumber: '',
			mealBreak: '',
			notes: '',
			coffeeBreak: '',
			earlyStart: '',
			moves: '',
			gang: '',
		},
		accountDescriptions: [],
		jobNames: []
	},
	actions: {
		loadData({commit}) {
			axios.post('/api/gangSheet')
				.then(function(response) {
					commit('setAccountDescriptions', response.data.accountDescriptions);
					commit('setJobNames', response.data.jobNames);
				});
		}
	},
	mutations: {
		setAccountDescriptions(state, payload) {
			state.accountDescriptions = payload;
		},
		setJobNames(state, payload) {
			state.jobNames = payload;
		}
	}

}