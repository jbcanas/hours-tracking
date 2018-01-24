<template>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title "> Gang Sheet </h3>
                </div>
                <div>
                    <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                            <span class="m-subheader__daterange-label">
                                <span class="m-subheader__daterange-title"></span>
                    <span class="m-subheader__daterange-date m--font-brand"></span>
                    </span>
                    <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                        <i class="la la-angle-down"></i>
                    </a>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="gangSheetFormContainer" class="portlet light">
                    <div class="portlet-title">
                        <div class="actions pull-left">
                            <b-button class="blue" href="javascript:;" @click="newGangSheetForm()">
                                <i class="fa fa-plus"></i> New
                            </b-button>
                            <b-button class="blue" href="javascript:;" v-b-modal.find>
                                <i class="fa fa-search"></i> Find
                            </b-button>
                            <b-button class="btn-danger" href="javascript:;" @click="newGangSheetForm()">
                                <i class="fa fa-minus"></i> Cancel
                            </b-button>
                        </div>
                        <div class="actions">
                            <a class="btn blue-steel" href="javascript:;" @click="saveGangSheet()">
                                <i class="fa fa-external-link"></i> Save
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="#" class="form-horizontal gangSheetForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row" :class="{'has-error': errors.has('accountDescription'), hidden: showAccountDescription}">
                                        <label class="control-label col-md-3">Account Description</label>
                                        <div class="col-md-7">
                                            <account-description type="accountDescription" v-validate:accountDescriptionValidate="'required'" data-vv-name="accountDescription"></account-description>
                                            <span class="invalid-feedback"> Please select an account desc.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row" :class="{'has-error': errors.has('jobName')}">
                                        <label class="control-label col-md-3">{{ jobNameLabel }}</label>
                                        <div class="col-md-7">
                                            <job-name type="jobName" v-validate:jobNameValidate="'required'" data-vv-name="jobName"></job-name>
                                            <span class="invalid-feedback"> Please select a job name.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Arbitration Award</label>
                                        <div class="col-md-9">
                                            <b-form-checkbox v-model="gangSheet.jobInfo.arbitrationAward">
                                            </b-form-checkbox>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Vessel/Barge</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.vesselBarge">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Voyage</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.voyage">
                                        </div>
                                    </div>
                                    <div class="form-group row" :class="gangSheet.jobInfo.jobSheetNumber == '' ? 'hidden' : ''">
                                        <label class="control-label col-md-3">Job Sheet Number</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.jobSheetNumber" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">ILWU Job Number</label>
                                        <div class="col-md-3">
                                            <input type="text" 
                                                class="form-control" 
                                                :class="errors.has('ilwuJobNumber') ? 'is-invalid' : ''"
                                                v-validate="'required|min:5'"
                                                name="ilwuJobNumber">
                                            <span class="invalid-feedback"> Please input a value</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Notes</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" cols="30" rows="3" v-model="gangSheet.jobInfo.notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Requested by</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Request Date</label>
                                        <div class="col-md-2">
                                            <datepicker v-model="gangSheet.jobInfo.requestDate" :bootstrapStyling="true" :format="'MM/dd/yyyy'"></datepicker> 
                                        </div>
                                    </div>
                                    <div class="form-group row" :class="{'has-error': errors.has('workDate')}">
                                        <label class="control-label col-md-3">Work Date</label>
                                        <div class="col-md-2">
                                            <datepicker 
                                                v-model="gangSheet.jobInfo.workDate"
                                                :bootstrapStyling="true"
                                                :input-class="errors.has('workDate') ? 'is-invalid' : ''"
                                                :format="'MM/dd/yyyy'" 
                                                v-validate="'required|min:5'"
                                                name="workDate"></datepicker> 
                                        </div>
                                        <span class="invalid-feedback"> Please select a date</span>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Start Time</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.startTime">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Stop Time</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.stopTime">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Meal Break</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.mealBreak">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Cofee Break</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.coffeeBreak">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Early Start</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.earlyStart">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Moves</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.moves">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Gang Shift</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="gangSheet.jobInfo.gang">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr />
                                    <gangsheet-employees 
                                        v-validate:employeesValidate="'required|min_value:2'" 
                                        data-vv-name="employees" 
                                        :error-bag="errorBag"></gangsheet-employees>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <b-modal id="find" size="sm" title="Find Gang Sheet">
            <v-switch v-model="gangSheet.find.ilwu" on="" off="ILWU Job #"></v-switch>
            
            <div id="findContainer" class="form-group row">
                <label class="control-label col-md-2">{{ gangSheet.find.ilwu ? 'ILWU#' : 'JSN#' }}</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" v-model="gangSheet.find.value">
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
    import BootstrapVue from 'bootstrap-vue';
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
            newGangSheetForm() {
                this.$store.dispatch('resetJobInfo');
            },
            saveGangSheet() {
                // handleOtherValidation(this.$store.state.gangSheet.jobInfo, this.$validator.errors);
console.log(this.$validator.errors);
                this.$validator.validateAll().then((result) => {
                    console.log(result);
                    if(result) {
                        axios.post('/api/gangSheet/store', this.$store.state.gangSheet.jobInfo)
                            .then((response) => {
                                swal('Success', 'Gang sheet successfully saved!', 'success');
                            })
                            .catch((error) => {
                                showError('Something went wrong! Please try again.');
                            });
                    }
                });
            }
        }
    }

    function handleOtherValidation(jobInfo, errorBag) {

        if(jobInfo.accountDescription === null) {
            errorBag.add('accountDescription', 'missing account description', 'required');
        } else {
            errorBag.remove('accountDescription');
        }

        if(jobInfo.jobName === null) {
            errorBag.add('jobName', 'missing job name', 'required');
        } else {
            errorBag.remove('jobName');
        }

        if(jobInfo.employees.length < 2) {
            errorBag.add('employees', 'missing employees', 'required');
        } else {
            errorBag.remove('employees');
        }
    }

    function showError(message = '') {
        const gangSheet = jQuery('#gangSheetFormContainer');

        gangSheet.addClass('shake-horizontal');

        setTimeout(function() {
            gangSheet.removeClass('shake-horizontal');
            if(message != '') swal('Oops..', message, 'error');
        }, 500);
    }

</script>
