<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title "> Gang Sheet </h3>
                </div>
            </div>
        </div>

        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <div 
                        id="gangSheetFormContainer" 
                        class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <a 
                                    href="javascript:;"
                                    class="btn btn-sm m-btn m-btn--gradient-from-primary m-btn--gradient-to-info m-btn--icon" 
                                    @click="newGangSheetForm()">
                                    <i class="fa fa-plus"/> New
                                </a>
                                <a 
                                    href="javascript:;" 
                                    class="btn btn-sm m-btn m-btn--gradient-from-primary m-btn--gradient-to-info m-btn--icon" 
                                    v-b-modal.find>
                                    <i class="fa fa-search"/> Find
                                </a>
                                <a 
                                    href="javascript:;" 
                                    class="btn btn-sm m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning" 
                                    @click="newGangSheetForm()">
                                    <i class="fa fa-minus"/> Cancel
                                </a>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a 
                                    class="btn btn-sm m-btn--pill m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" 
                                    href="javascript:;" 
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
                                            class="form-group row" 
                                            :class="{'has-error': errors.has('accountDescription'), hidden: showAccountDescription}">
                                            <label class="control-label col-md-3">Account Description</label>
                                            <div class="col-md-7">
                                                <account-description 
                                                    type="accountDescription" 
                                                    v-validate:accountDescriptionValidate="'required'" 
                                                    data-vv-name="accountDescription"/>
                                                <span class="invalid-feedback"> Please select an account desc.</span>
                                            </div>
                                        </div>
                                        <div 
                                            class="form-group row" 
                                            :class="{'has-error': errors.has('jobName')}">
                                            <label class="control-label col-md-3">{{ jobNameLabel }}</label>
                                            <div class="col-md-7">
                                                <job-name 
                                                    type="jobName" 
                                                    v-validate:jobNameValidate="'required'" 
                                                    data-vv-name="jobName"/>
                                                <span class="invalid-feedback"> Please select a job name.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Arbitration Award</label>
                                            <div class="col-md-9">
                                                <label class="custom-control custom-checkbox">
                                                    <input 
                                                        type="checkbox" 
                                                        class="custom-control-input"
                                                        :checked="gangSheet.jobInfo.arbitrationAward"  
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
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.vesselBarge" 
                                                    @input="updateJobInfo($event, 'vesselBarge')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Voyage</label>
                                            <div class="col-md-5">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.voyage" 
                                                    @input="updateJobInfo($event, 'voyage')">
                                            </div>
                                        </div>
                                        <div 
                                            class="form-group row" 
                                            :class="gangSheet.jobInfo.jobSheetNumber == '' ? 'hidden' : ''">
                                            <label class="control-label col-md-3">Job Sheet Number</label>
                                            <div class="col-md-3">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.jobSheetNumber" 
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">ILWU Job Number</label>
                                            <div class="col-md-3">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :class="errors.has('ilwuJobNumber') ? 'is-invalid' : ''"
                                                    v-validate="'required|min:5'"
                                                    :value="gangSheet.jobInfo.ilwuJobNumber" 
                                                    @input="updateJobInfo($event, 'ilwuJobNumber')"
                                                    name="ilwuJobNumber">
                                                <span class="invalid-feedback"> Please input a value</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Notes</label>
                                            <div class="col-md-9">
                                                <textarea 
                                                    class="form-control" 
                                                    cols="30" 
                                                    rows="3" 
                                                    :value="gangSheet.jobInfo.notes" 
                                                    @input="updateJobInfo($event, 'notes')"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Requested by</label>
                                            <div class="col-md-4">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.requestedBy" 
                                                    @input="updateJobInfo($event, 'requestedBy')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Request Date</label>
                                            <div class="col-md-2">
                                                <datepicker 
                                                    :value="gangSheet.jobInfo.requestDate" 
                                                    @input="updateJobInfo($event, 'requestDate')" 
                                                    :bootstrap-styling="true" 
                                                    :format="'MM/dd/yyyy'"/> 
                                            </div>
                                        </div>
                                        <div 
                                            class="form-group row" 
                                            :class="{'has-error': errors.has('workDate')}">
                                            <label class="control-label col-md-3">Work Date</label>
                                            <div class="col-md-2">
                                                <datepicker 
                                                    :value="gangSheet.jobInfo.workDate" 
                                                    @input="updateJobInfo($event, 'workDate')"
                                                    :bootstrap-styling="true"
                                                    :input-class="errors.has('workDate') ? 'is-invalid' : ''"
                                                    :format="'MM/dd/yyyy'" 
                                                    v-validate="'required|min:5'"
                                                    name="workDate"/> 
                                            </div>
                                            <span class="invalid-feedback"> Please select a date</span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Start Time</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.startTime" 
                                                    @input="updateJobInfo($event, 'startTime')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Stop Time</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.stopTime" 
                                                    @input="updateJobInfo($event, 'stopTime')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Meal Break</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.mealBreak" 
                                                    @input="updateJobInfo($event, 'mealBreak')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Coffee Break</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.coffeeBreak" 
                                                    @input="updateJobInfo($event, 'coffeeBreak')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Early Start</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.earlyStart" 
                                                    @input="updateJobInfo($event, 'earlyStart')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Moves</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.moves" 
                                                    @input="updateJobInfo($event, 'moves')">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Gang Shift</label>
                                            <div class="col-md-2">
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    :value="gangSheet.jobInfo.gang" 
                                                    @input="updateJobInfo($event, 'gang')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr >
                                        <gangsheet-employees 
                                            v-validate:employeesValidate="'required|min_value:2'" 
                                            data-vv-name="employees" 
                                            :error-bag="errorBag"/>
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
            size="sm" 
            title="Find Gang Sheet">
            <v-switch 
                v-model="gangSheet.find.ilwu" 
                on="" 
                off="ILWU Job #"/>
            
            <div 
                id="findContainer" 
                class="form-group row">
                <label class="control-label col-md-2">{{ gangSheet.find.ilwu ? 'ILWU#' : 'JSN#' }}</label>
                <div class="col-md-9">
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="gangSheet.find.value">
                </div>
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
        }
    },
    methods: {
        updateJobInfo(event, type) {
            let value = '';

            if(type == 'arbitrationAward') {
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
        },
        saveGangSheet() {
            this.$validator.validateAll().then((result) => {
                if(result) {
                    axios.post('/api/gangSheet/store', this.$store.state.gangSheet.jobInfo)
                        .then(() => {
                            swal('Success', 'Gang sheet successfully saved!', 'success');
                        })
                        .catch(() => {
                            showError('Something went wrong! Please try again.');
                        });
                }
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
