export default {
	state: {
		jobInfo: jobInfo(),
		accountDescriptions: [],
		jobNames: [],
		find: {
			ilwu: false
		},
		jobPositions: [
			{
				name: 'Attendee',
				company: 'both'
			},
			{
				name: 'BobCat Operator',
				company: 'both'
			},
			{
				name: 'Bull',
				company: 'both'
			},
			{
				name: 'Crane Operator',
				company: 'both'
			},
			{
				name: 'Clerk',
				company: 'both'
			},
			{
				name: 'Dispatcher',
				company: 'both'
			},
			{
				name: 'Dock Checker',
				company: 'both'
			},
			{
				name: 'Dock Tender',
				company: 'both'
			},
			{
				name: 'Facility Maintenance',
				company: 'both'
			},
			{
				name: 'Forklift',
				company: 'both'
			},
			{
				name: 'Gang Boss',
				company: 'both'
			},
			{
				name: 'GH-Dispatcher-Daily',
				company: 'matson'
			},
			{
				name: 'GH-Dispatcher-Weekly',
				company: 'matson'
			},
			{
				name: 'Hatch Tender',
				company: 'both'
			},
			{
				name: 'Hoser',
				company: 'both'
			},
			{
				name: 'Kubota',
				company: 'both'
			},
			{
				name: 'Loader Operator',
				company: 'both'
			},
			{
				name: 'Longshoreman',
				company: 'both'
			},
			{
				name: 'LTL Driver',
				company: 'matson'
			},
			{
				name: 'Mail',
				company: 'both'
			},
			{
				name: 'Mechanic Foreman',
				company: 'both'
			},
			{
				name: 'Mechanic Helper I',
				company: 'both'
			},
			{
				name: 'Mechanic Helper II',
				company: 'both'
			},
			{
				name: 'Mechanic Helper III',
				company: 'both'
			},
			{
				name: 'Mechanic Leadman',
				company: 'both'
			},
			{
				name: 'Mechanic Partsman',
				company: 'both'
			},
			{
				name: 'Pilot',
				company: 'both'
			},
			{
				name: 'Mechanic Journeyman',
				company: 'both'
			},
			{
				name: 'Mechanic Foreman',
				company: 'both'
			},
			{
				name: 'Safety',
				company: 'both'
			},
			{
				name: 'Security Guard-Front',
				company: 'apl'
			},
			{
				name: 'Security Guard-Back',
				company: 'apl'
			},
			{
				name: 'Security Guard',
				company: 'both'
			},
			{
				name: 'Skilled Grader Operator',
				company: 'both'
			},
			{
				name: 'Slingmen',
				company: 'both'
			},
			{
				name: 'Stick C/O',
				company: 'both'
			},
			{
				name: 'Stickman',
				company: 'both'
			},
			{
				name: 'Toppick',
				company: 'both'
			},
			{
				name: 'Trac',
				company: 'both'
			},
			{
				name: 'Trainee',
				company: 'both'
			},
			{
				name: 'Trainor',
				company: 'both'
			},
			{
				name: 'Truck Driver (Haz Mat)',
				company: 'both'
			},
			{
				name: 'Truck Driver',
				company: 'both'
			},
			{
				name: 'Utility',
				company: 'both'
			},
			{
				name: 'Walking Boss',
				company: 'both'
			},
			{
				name: 'Warehouseman',
				company: 'matson'
			},
			{
				name: 'Warehouse Foreman',
				company: 'matson'
			},
			{
				name: 'Whirly Crane',
				company: 'both'
			},
			{
				name: 'Winch Operator',
				company: 'both'
			},
			{
				name: 'Unpin',
				company: 'both'
			},
			{
				name: 'Yard Dawg',
				company: 'both'
			},
			{
				name: 'Yard Dawg Skilled',
				company: 'both'
			},
			{
				name: 'Yard Dawg Skilled 5-yr',
				company: 'both'
			}
		]
	},
	actions: {
		loadData({commit}, payload) {
			axios.post('/api/gangSheet', {
				type: payload.type
			})
			.then(function(response) {
				commit(payload.type, response.data);
			});
		},
		resetJobInfo({commit}) {
			commit('resetJobInfo');
		},
		toggleIlwuJobNumber(state, payload) {
			commit('toggleBoolean', payload);
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
		},
		addEmployee(state, payload) {
			state.jobInfo.employees.push(payload);
		},
		removeEmployee(state, payload) {
			state.jobInfo.employees.splice(payload.key, 1);
		},
		resetJobInfo(state) {
			state.jobInfo = jobInfo();
		},
		toggleBoolean(state) {

		}
	}

}

function jobInfo() {
	return {
			userId: 0,
			accountDescription: '',
			jobName: '',
			requestedBy: '',
			arbitrationAward: false,
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
			coffeeBreak: 0,
			earlyStart: 0,
			moves: 0,
			gang: 0,
			employees: []
		}
}