<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title "> Employee Job Hours </h3>
                </div>
            </div>
        </div>

        <div class="m-content pt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div 
                        id="gangSheetFormContainer" 
                        class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <a 
                                    href="javascript:void(0);"
                                    class="btn btn-sm btn-info" 
                                    @click="newGangSheetForm()">
                                    <i class="fa fa-plus"/> New
                                </a>
                                <a 
                                    v-b-modal.find 
                                    href="javascript:void(0);" 
                                    class="btn btn-sm btn-info">
                                    <i class="fa fa-search"/> Find
                                </a>
                                <a 
                                    href="javascript:void(0);" 
                                    class="btn btn-sm btn-danger" 
                                    @click="newGangSheetForm()">
                                    <i class="fa fa-minus"/> Cancel
                                </a>
                                <a 
                                    :class="{hidden: showEditButton}"
                                    href="javascript:void(0);"
                                    class="btn btn-sm btn-info" 
                                    @click="editGangSheet()">
                                    <i class="fa fa-pencil"/> Edit
                                </a>
                                <a 
                                    v-b-modal.deleteGangSheet
                                    :class="{hidden: hideDeleteButton}"
                                    href="javascript:void(0);"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-remove"/> Delete
                                </a>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a 
                                    :class="{disabled: disableInputs}"
                                    class="btn btn-sm btn-info" 
                                    href="javascript:void(0);"
                                    @click="saveGangSheet()">
                                    <i class="fa fa-external-link"/> Save
                                </a>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form 
                                action="#" 
                                class="form-horizontal gangSheetForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div 
                                            :class="{'has-error': errors.has('accountDescription'), hidden: showAccountDescription}" 
                                            class="form-group row">
                                            <label class="control-label col-md-3">Account Description</label>
                                            <div class="col-md-7">
                                                <account-description 
                                                    v-validate:accountDescriptionValidate="'required'" 
                                                    :mechanics-template="mechanicsTemplate"
                                                    :disable-inputs="disableInputs" 
                                                    type="accountDescription"
                                                    data-vv-name="accountDescription"/>
                                                <span class="invalid-feedback"> Please select an account desc.</span>
                                            </div>
                                        </div>
                                        <div 
                                            :class="{'has-error': errors.has('jobName')}" 
                                            class="form-group row">
                                            <label class="control-label col-md-3">{{ jobNameLabel }}</label>
                                            <div class="col-md-7">
                                                <job-name 
                                                    v-validate:jobNameValidate="'required'" 
                                                    :mechanics-template="mechanicsTemplate"
                                                    :find-mode="find.mode"
                                                    type="jobName" 
                                                    data-vv-name="jobName"/>
                                                <span class="invalid-feedback"> Please select a job name.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Job Location</label>
                                            <div class="col-md-5">
                                                <input 
                                                    :value="gangSheet.jobInfo.jobLocation" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'jobLocation')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Arbitration Award</label>
                                            <div class="col-md-9">
                                                <label class="custom-control custom-checkbox">
                                                    <input 
                                                        :checked="gangSheet.jobInfo.arbitrationAward"  
                                                        :disabled="disableInputs"
                                                        type="checkbox" 
                                                        class="custom-control-input"
                                                        @change="updateJobInfo($event, 'arbitrationAward')">
                                                    <span 
                                                        aria-hidden="true" 
                                                        class="custom-control-indicator"/>
                                                    <span class="custom-control-description"/>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Vessel/Barge</label>
                                            <div class="col-md-5">
                                                <input 
                                                    :value="gangSheet.jobInfo.vesselBarge" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'vesselBarge')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Voyage</label>
                                            <div class="col-md-5">
                                                <input 
                                                    :value="gangSheet.jobInfo.voyage" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'voyage')">
                                            </div>
                                        </div>
                                        <div 
                                            :class="gangSheet.jobInfo.id < 1 ? 'hidden' : ''" 
                                            class="form-group row">
                                            <label class="control-label col-md-3">Job Sheet Number</label>
                                            <div class="col-md-3">
                                                <input 
                                                    :value="gangSheet.jobInfo.jobSheetNumber" 
                                                    type="text" 
                                                    class="form-control" 
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">ILWU Job Number</label>
                                            <div class="col-md-3">
                                                <input 
                                                    v-validate="'required|min:5'" 
                                                    :class="errors.has('ilwuJobNumber') ? 'is-invalid' : ''" 
                                                    :value="gangSheet.jobInfo.ilwuJobNumber"
                                                    :disabled="disableInputs"
                                                    type="text"
                                                    class="form-control" 
                                                    name="ilwuJobNumber"
                                                    @input="updateJobInfo($event, 'ilwuJobNumber')">
                                                <span class="invalid-feedback"> Please input a value</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Notes</label>
                                            <div class="col-md-9">
                                                <textarea 
                                                    :value="gangSheet.jobInfo.notes" 
                                                    :disabled="disableInputs"
                                                    class="form-control" 
                                                    cols="30" 
                                                    rows="3" 
                                                    @input="updateJobInfo($event, 'notes')"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Requested by</label>
                                            <div class="col-md-4">
                                                <input 
                                                    :value="gangSheet.jobInfo.requestedBy" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'requestedBy')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Request Date</label>
                                            <div class="col-md-2">
                                                <datepicker 
                                                    :value="gangSheet.jobInfo.requestDate" 
                                                    :disabled="disableInputs" 
                                                    :bootstrap-styling="true" 
                                                    :format="'MM/dd/yyyy'" 
                                                    @input="updateJobInfo($event, 'requestDate')"/> 
                                            </div>
                                        </div>
                                        <div 
                                            :class="{'has-error': errors.has('workDate')}" 
                                            class="form-group row">
                                            <label class="control-label col-md-3">Work Date</label>
                                            <div class="col-md-2">
                                                <datepicker 
                                                    v-validate="'required|min:5'" 
                                                    :value="gangSheet.jobInfo.workDate"
                                                    :bootstrap-styling="true" 
                                                    :input-class="errors.has('workDate') ? 'is-invalid' : ''"
                                                    :format="'MM/dd/yyyy'"
                                                    :disabled="disableInputs" 
                                                    name="workDate"
                                                    @input="updateJobInfo($event, 'workDate')"/> 
                                            </div>
                                            <span class="invalid-feedback"> Please select a date</span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Start Time</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.startTime" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'startTime')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Stop Time</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.stopTime" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'stopTime')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Meal Break</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.mealBreak" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'mealBreak')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Coffee Break</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.coffeeBreak" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'coffeeBreak')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Early Start</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.earlyStart" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'earlyStart')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Moves</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.moves" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'moves')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Gang Shift</label>
                                            <div class="col-md-2">
                                                <input 
                                                    :value="gangSheet.jobInfo.gang" 
                                                    :disabled="disableInputs"
                                                    type="text" 
                                                    class="form-control" 
                                                    @input="updateJobInfo($event, 'gang')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr >
                                        <gangsheet-employees 
                                            v-validate:employeesValidate="'required|min_value:2'" 
                                            :error-bag="errorBag" 
                                            :disable-inputs="disableInputs"
                                            data-vv-name="employees"/>
                                    </div>
                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <b-modal 
            id="find" 
            size="md" 
            title="Find Gang Sheet"
            ok-title="Search"
            ok-variant="info"
            @show="findModalShow"
            @ok="searchGangSheet">
            <v-switch 
                v-model="find.ilwu" 
                on="" 
                off="ILWU Job #"/>
            
            <div 
                id="findContainer" 
                class="form-group row">
                <label class="control-label col-md-2">{{ gangSheet.find.ilwu ? 'ILWU#' : 'JSN#' }}</label>
                <div class="col-md-9">
                    <input 
                        v-model="find.value" 
                        type="text" 
                        class="form-control"
                        @keyup.enter="searchGangSheet">
                </div>
            </div>
        </b-modal>

        <b-modal 
            id="deleteGangSheet" 
            size="sm" 
            title="Delete Gang Sheet"
            ok-title="Proceed"
            ok-variant="info"
            @ok="deleteGangSheet">
            <div 
                id="deleteGangSheetContainer" 
                class="form-group row">
                <p>Are you sure you want to delete this gang sheet?</p>
            </div>
        </b-modal>
        
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import AccountDescription from './components/AccountDescription.vue';
import JobName from './components/JobName.vue';
import GangsheetEmployees from './components/GangsheetEmployees.vue';
import Materials from 'vue-materials';
import swal from 'sweetalert2';

export default {
    components: {
        Datepicker,
        AccountDescription,
        JobName,
        GangsheetEmployees,
        Materials,
        swal
    },
    data() {
        return {
            find: {
                searchById: true,
                ilwu: false,
                value: null,
                mode: false
            }
        };
    },
    computed: {
        gangSheet() {
            return this.$store.state.gangSheet;
        },
        jobNameLabel() {
            return this.$store.state.gangSheet.jobInfo.accountDescription != 'TRAINING' ? 'Job Name' : 'Training Type';
        },
        showAccountDescription() {
            return companyName != 'apl' ? true : false;
        },
        accountDescriptionValidate() {
            return this.$store.state.gangSheet.jobInfo.accountDescription;
        },
        jobNameValidate() {
            return this.$store.state.gangSheet.jobInfo.jobName;
        },
        employeesValidate() {
            return this.$store.state.gangSheet.jobInfo.employees.length;
        },
        errorBag() {
            return this.$validator.errors;
        },
        showEditButton() {
            return this.$store.state.gangSheet.jobInfo.id > 0 ? false : true;
        },
        disableInputs() {
            return this.$store.state.gangSheet.disableInputs;
        },
        hideDeleteButton() {
            return this.$store.state.gangSheet.jobInfo.id < 1 && this.$store.state.gangSheet.disableInputs;
        }
    },
    created() {
        if(this.$route.query.id !== undefined) {
            this.find.value = this.$route.query.id;
            this.searchGangSheet();
        }

        if(this.$route.query.userid !== undefined) {
            this.$store.commit('updateJobInfo', {
                type: 'userId',
                value: this.$route.query.userid
            });

            this.$store.commit('updateJobInfo', {
                type: 'requestedBy',
                value: this.$route.query.requestedby
            });
        }
    },
    methods: {
        updateJobInfo(event, type, findMode = false) { 
            let value = '';

            if(findMode) {
                value = event;
            } else if(type == 'arbitrationAward') {
                value = event.target.checked;
            } else if(type.includes('Date')) {
                value = event;
            } else {
                value = event.target.value;
            }

            this.$store.commit('updateJobInfo', {
                type: type,
                value: value
            });
        },
        newGangSheetForm() {
            this.$store.dispatch('resetJobInfo');
            this.find.mode = false;
        },
        saveGangSheet() {
            let jobInfo = this.$store.state.gangSheet.jobInfo;
            jobInfo.accountDescription = jobInfo.accountDescription.value;

            this.$validator.validateAll().then((result) => {
                if(result) {
                    axios.post('/api/gangSheet/store', jobInfo)
                        .then((response) => {
                            swal('Success', 'Gang sheet successfully saved!', 'success');

                            this.$store.commit('updateJobInfo', {
                                type: 'id',
                                value: response.data.id
                            });
                            _.map(response.data.employees, (item) => {
                                item.id = item.id;
                            });
                        })
                        .catch(() => {
                            showError('Something went wrong! Please try again.');
                        });
                }
            });
        },
        searchGangSheet() {
            let type = this.find.ilwu ? 'ilwu_job_number' : 'job_sheet_number';
            if(this.find.searchById) type = 'id';

            axios.post('/api/gangSheet/find', {
                type: type,
                value: this.find.value
            })
                .then((response) => {
                    this.$store.dispatch('resetJobInfoAndEmployees');

                    this.updateJobInfo(response.data.id, 'id', true);
                    this.updateJobInfo(response.data.arbitrary_award, 'arbitrationAward', true);
                    this.updateJobInfo(response.data.vessel_barge, 'vesselBarge', true);
                    this.updateJobInfo(response.data.voyage, 'voyage', true);
                    this.updateJobInfo(response.data.job_sheet_number, 'jobSheetNumber', true);
                    this.updateJobInfo(response.data.ilwu_job_number, 'ilwuJobNumber', true);
                    this.updateJobInfo(response.data.notes, 'notes', true);
                    this.updateJobInfo(response.data.requested_by, 'requestedBy', true);
                    this.updateJobInfo(response.data.dispatch_date, 'requestDate', true);
                    this.updateJobInfo(response.data.work_date, 'workDate', true);
                    this.updateJobInfo(response.data.start_time, 'startTime', true);
                    this.updateJobInfo(response.data.stop_time, 'stopTime', true);
                    this.updateJobInfo(response.data.meal_break, 'mealBreak', true);
                    this.updateJobInfo(response.data.coffee_break, 'coffeeBreak', true);
                    this.updateJobInfo(response.data.early_start, 'earlyStart', true);
                    this.updateJobInfo(response.data.moves, 'moves', true);
                    this.updateJobInfo(response.data.gang, 'gang', true);

                    let accountDescription = _.find(this.gangSheet.accountDescriptions, {value: response.data.account_description});
                    this.$store.commit('updateJobInfo', {
                        type: 'accountDescription',
                        value: accountDescription
                    });
                    setTimeout(() => {
                        this.$store.commit('updateJobInfo', {
                            type: 'jobName',
                            value: response.data.job_name
                        });
                    }, 5);

                    _.map(response.data.employees, (item) => {
                        this.$store.commit('addEmployee', {
                            id: item.id,
                            employee_id: item.employee_id,
                            job_position: item.job_position,
                            replacement: item.replacement,
                            employee_number: item.employee_number,
                            company_number: item.company_number,
                            first_name: item.first_name,
                            last_name: item.last_name,
                            reg_status: item.reg_status,
                            st: {
                                value: item.st,
                                edit: false
                            },
                            ot: {
                                value: item.ot,
                                edit: false
                            },
                            pot: {
                                value: item.pot,
                                edit: false
                            },
                            st_other: {
                                value: item.st_other,
                                edit: false
                            },
                            ot_other: {
                                value: item.ot_other,
                                edit: false
                            },
                            pot_other: {
                                value: item.pot_other,
                                edit: false
                            },
                            dt: {
                                value: item.dt,
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
                        });
                    });

                    this.find.mode = true;
                    this.$store.commit('setDisableInputs', true);
                })
                .catch(() => {
                    showError('Something went wrong! Please try again.');
                });
        },
        findModalShow() {
            this.find.searchById = false;
        },
        mechanicsTemplate(jobName) {
            let toolAllowance = jobName == 'TOOL ALLOWANCE' ? 1 : 0;

            if(this.gangSheet.jobInfo.accountDescription.value != 'SHOP-DUT') toolAllowance = 0;

            axios.post('/api/gangSheet/mechTemplate', {
                kodiak: this.gangSheet.jobInfo.accountDescription.value == 'SHOP-KOD' ? 1 : 0,
                toolAllowance: toolAllowance,
            })
                .then((response) => {
                    this.$store.dispatch('resetEmployees');

                    _.map(response.data, (item) => {
                        const st = item.weeks !== null ? item.weeks : null;

                        this.$store.commit('addEmployee', {
                            id: 0,
                            employee_id: item.employee_id,
                            job_position: item.job_position,
                            replacement: item.replacement,
                            employee_number: item.employee_number,
                            company_number: item.company_number,
                            first_name: item.first_name,
                            last_name: item.last_name,
                            reg_status: item.reg_status,
                            st: {
                                value: st,
                                edit: false
                            },
                            ot: {
                                value: null,
                                edit: false
                            },
                            pot: {
                                value: null,
                                edit: false
                            },
                            st_other: {
                                value: null,
                                edit: false
                            },
                            ot_other: {
                                value: null,
                                edit: false
                            },
                            pot_other: {
                                value: null,
                                edit: false
                            },
                            dt: {
                                value: null,
                                edit: false
                            },
                            pl: {
                                value: null,
                                edit: false
                            },
                            adjust_pay: {
                                value: null,
                                edit: false
                            }
                        });
                    });
                })
                .catch(() => {
                    // showError('Something went wrong! Please try again.');
                });
        },
        editGangSheet() {
            this.$store.commit('setDisableInputs', false);
        },
        deleteGangSheet() {
            axios.post('/api/gangSheet/delete', {
                id: this.gangSheet.jobInfo.id
            }).then(() => {
                swal('Success', 'Gang sheet successfully deleted!', 'success');
                this.newGangSheetForm();
            });
        }
    }
};

function showError(message = '') {
    const gangSheet = jQuery('#gangSheetFormContainer');

    gangSheet.addClass('shake-horizontal');

    setTimeout(function() {
        gangSheet.removeClass('shake-horizontal');
        if(message != '') swal('Oops..', message, 'error');
    }, 500);
}

</script>
