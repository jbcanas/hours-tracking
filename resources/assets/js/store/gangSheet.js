export default {
    state: {
        jobInfo: jobInfo(),
        accountDescriptions: [
            {
                value: 'BARGES',
                jobNames: [
                    'NORTHLAND',
                    'IMPALA',
                    'NL SUPPORT',
                    'HORIZON',
                    'HORIZON SUPPORT',
                    'SEA TRADER',
                    'SEA TRADER SUPPORT',
                    'SAMSON',
                    'SAMSON SUPPORT'
                ]
            },
            {
                value: 'CFS SURVEY',
                jobNames: [
                    'DELTA WESTERN - CAST OFF',
                    'DELTA WESTERN - TIE UP',
                    'DELTA WESTERN - SECURITY',
                    'DELTA WESTERN - GANG',
                    'SHELL - CAST OFF',
                    'SHELL - TIE UP',
                    'SHELL - SECURITY',
                    'SHELL - GANG',
                    'NORTHLAND',
                    'HORIZON',
                    'SEA TRADER',
                    'SAMSON',
                    'TRAINING',
                    'MISCELLANEOUS',
                    'WHIRLY CRANE',
                    'HORIZON TIE-UP',
                    'HORIZON CAST-OFF',
                    'HORIZON GANG',
                    'HORIZON SECURITY',
                    'HORIZON LINES SHIFT'
                ]
            },
            {
                value: 'CFS BARGES',
                jobNames: 'CFS BARGES'
            },
            {
                value: 'CRANE',
                jobNames: 'CRANE WORK'
            },
            {
                value: 'CONTAINER STUFFING',
                jobNames: 'CONTAINER STUFFING'
            },
            {
                value: 'TOOL ALLOWANCE',
                jobNames: 'TOOL ALLOWANCE'
            },
            {
                value: 'CY MAINTENANCE',
                jobNames: [
                    'CORD ROLLERS',
                    'CONTAINER YARD CLEAN-UP',
                    'CRANE MAINTENANCE',
                    'DOCK WASHING',
                    'REEFER WASHING',
                    'SNOW REMOVAL',
                    'MISCELLANEOUS',
                    'VEHICLE WASHING'
                ]
            },
            {
                value: 'DD YARD DAWG',
                jobNames: 'YARD DAWG'
            },
            {
                value: 'KODIAK',
                jobNames: 'LONGSHORE'
            },
            {
                value: 'SEWARD',
                jobNames: 'LONGSHORE'
            },
            {
                value: 'CORDOVA',
                jobNames: 'LONGSHORE'
            },
            {
                value: 'ROAD DRIVING',
                jobNames: ['ROAD DRIVING', 'TRANSLOADS']
            },
            {
                value: 'VESSEL',
                jobNames: 'SHIP GANG'
            },
            {
                value: 'VESSEL LINES',
                jobNames: ['SHIP TIE-UP', 'SHIP CAST-OFF']
            },
            {
                value: 'VESSEL LASHER',
                jobNames: 'SHIP LASHERS'
            },
            {
                value: 'VESSEL SECURITY',
                jobNames: 'SECURITY'
            },
            {
                value: 'SHOP DISPATCHER',
                jobNames: 'SHOP MECHANICS'
            },
            {
                value: 'SHOP-DUTCH',
                jobNames: 'SHOP-TEMP'
            },
            {
                value: 'STEADYMEN',
                jobNames: 'YARD DAWG'
            },
            {
                value: 'STEADYMEN DISPATCHER',
                jobNames: 'YARD DAWG'
            },
            {
                value: 'TRANSLOADS',
                jobNames: 'TRANSLOADS'
            },
            {
                value: 'YARD WORK/SORT',
                jobNames: [
                    'HORIZON SUPPORT',
                    'NL SUPORT',
                    'SAMSON SUPPORT',
                    'SEA TRADER SUPPORT',
                    'YARD SORT',
                    'YARD WORK',
                    'YARD WORK/OTHER'
                ]
            }
        ],
        jobNames: [
            'NORTHLAND',
            'BARGE',
            'NL SUPPORT',
            'DELIVERY',
            'HORIZON',
            'GH-DISPATCH',
            'HORIZON SUPPORT',
            'CAST-OFF',
            'SEA TRADER',
            'CLERICAL',
            'SEA TRADER SUPPORT',
            'CRANE WORK',
            'CRANE MAINTENANCE',
            'SAMSON',
            'TOOL ALLOWANCE',
            'DOCK WASHING',
            'SAMSON SUPPORT',
            'EDUC',
            'DELTA WESTERN - CAST OFF',
            'SHELL - CAST OFF',
            'TIE-UP',
            'DELTA WESTERN - TIE UP',
            'SHELL - TIE UP',
            'LONGSHORE',
            'DELTA WESTERN - SECURITY',
            'SHELL - SECURITY',
            'LTL',
            'DELTA WESTERN - GANG',
            'SHELL - GANG',
            'ROAD DRIVING',
            'SHOP DISPATCHER',
            'SECURITY',
            'IMPALA',
            'SHUFFLE',
            'SNOW REMOVAL',
            'STEADYMEN',
            'MISCELLANEOUS',
            'TRAINING',
            'DISPATCHER',
            'CORD ROLLERS',
            'TRANSLOADS',
            'CONTAINER YARD CLEAN-UP',
            'YARD DRIVING',
            'UNPIN CRANE',
            'REEFER WASHING',
            'VESSEL',
            'VESSEL SUPPORT',
            'YARD DAWG',
            'VEHICLE WASHING',
            'YARD WORK',
            'BOBCAT',
            'YARD SORT',
            'CRANE',
            'BASIC LONGSHORE',
            'DRIVER',
            'DISCRIMINATION',
            'FALL AREST',
            'TRAINING COMMITTEE',
            'FIRST AID',
            'FORKLIFT',
            'HAZMAT DRIVER',
            'HATCH/DOCK TENDER',
            'LOADER',
            'MAN OVERBOARD',
            'STRENGTH & AGILITY',
            'TOPPICK',
            'SHIP GANG',
            'SHIP TIE-UP',
            'SHIP CAST-OFF',
            'SHIP LASHERS',
            'REEFER MECHANICS',
            'SHOP-MECHANICS',
            'SHOP-TEMP',
            'NL SUPORT',
            'YARD WORK/OTHER',
            'HORIZON TIE-UP',
            'HORIZON CAST-OFF',
            'HORIZON GANG',
            'HORIZON SECURITY',
            'HORIZON LINES SHIFT',
            'ORIENTATION'
        ],
        find: {
            ilwu: false,
            value: ''
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
    getters: {
        getJobName: state => state.jobInfo.jobName,
        calculateGrandTotalHrs: state => {
            return _.sumBy(state.jobInfo.employees, item => {
                return (
                    Number(item.st.value) +
                    Number(item.ot.value) +
                    Number(item.pot.value) +
                    Number(item.dt.value) +
                    Number(item.st_other.value) +
                    Number(item.ot_other.value) +
                    Number(item.pot_other.value)
                );
            });
        }
    },
    actions: {
        loadData({ commit }, payload) {
            axios
                .post('/api/gangSheet', {
                    type: payload.type
                })
                .then(function(response) {
                    commit(payload.type, response.data);
                });
        },
        resetJobInfo({ commit }) {
            commit('resetJobInfo');
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
        updateHours(state, payload) {
            state.jobInfo.employees[payload.key][payload.hourType].value =
                payload.value;
            state.jobInfo.employees[payload.key][payload.hourType].edit = false;
        }
    }
};

function jobInfo() {
    return {
        id: 0,
        userId: 0,
        accountDescription: null,
        jobName: null,
        requestedBy: '',
        arbitrationAward: false,
        requestDate: new Date(),
        vesselBarge: '',
        workDate: '',
        voyage: '',
        startTime: '',
        jobSheetNumber: '',
        stopTime: '',
        ilwuJobNumber: '',
        mealBreak: 0,
        coffeeBreak: 0,
        earlyStart: 0,
        moves: 0,
        gang: 0,
        notes: '',
        employees: [
            {
                job_position: 'Dispatcher',
                st: {
                    value: 0,
                    edit: false
                },
                ot: {
                    value: 0,
                    edit: false
                },
                pot: {
                    value: 0,
                    edit: false
                },
                dt: {
                    value: 0,
                    edit: false
                },
                st_other: {
                    value: 0,
                    edit: false
                },
                ot_other: {
                    value: 0,
                    edit: false
                },
                pot_other: {
                    value: 0,
                    edit: false
                },
                pl: {
                    value: 0,
                    edit: false
                },
                adjust_pay: {
                    value: 0,
                    edit: false
                }
            }
        ]
    };
}
