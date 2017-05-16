export default {
	state: {
		jobInfo: {
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
		loadData({commit}, payload) {
			axios.post('/api/gangSheet', {
				type: payload.type
			})
			.then(function(response) {
				commit(payload.type, response.data);
			});
		}
	},
	mutations: {
		setAccountDescriptions(state, payload) {
			state.accountDescriptions = payload;
		},
		setJobNames(state, payload) {
			state.jobNames = payload;
		},
		updateJobInfo(state, payload) {
			state.jobInfo[payload.type] = payload.value;
		}
	}

}