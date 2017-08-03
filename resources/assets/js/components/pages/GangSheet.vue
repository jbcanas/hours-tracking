<template>
    <div>
        <h1 class="page-title"> Gang Sheet</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
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
                            <b-button class="btn-steel" href="javascript:;" @click="saveGangSheet()">
                                <i class="fa fa-external-link"></i> Save
                            </b-button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="#" class="form-horizontal gangSheetForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Account Description</label>
                                        <div class="col-md-7">
                                            <job-type type="accountDescription"></job-type>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">{{ jobNameLabel }}</label>
                                        <div class="col-md-7">
                                            <job-type type="jobName"></job-type>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Arbitration Award</label>
                                        <div class="col-md-9">
                                            <v-switch v-model="jobInfo.arbitrationAward" on="" off=""></v-switch>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Vessel/Barge</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" v-model="jobInfo.vesselBarge">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Voyage</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" v-model="jobInfo.voyage">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Job Sheet Number</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" v-model="jobInfo.jobSheetNumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">ILWU Job Number</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" v-model="jobInfo.ilwuJobNumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Notes</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" cols="30" rows="3" v-model="jobInfo.notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Requested by</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Request Date</label>
                                        <div class="col-md-2">
                                            <datepicker v-model="jobInfo.requestDate" input-class="form-control" :format="'MM/dd/yyyy'"></datepicker> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Work Date</label>
                                        <div class="col-md-2">
                                            <datepicker v-model="jobInfo.workDate" input-class="form-control" :format="'MM/dd/yyyy'"></datepicker> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Start Time</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="jobInfo.startTime">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Stop Time</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="jobInfo.stopTime">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Meal Break</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="jobInfo.mealBreak">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Cofee Break</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="jobInfo.coffeeBreak">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Early Start</label>
                                        <div class="col-md-1">
                                            <input type="text" class="form-control" v-model="jobInfo.earlyStart">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Moves</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="jobInfo.moves">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">Gang Shift</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" v-model="jobInfo.gangShift">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr />
                                    <gangsheet-employees></gangsheet-employees>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import jobType from './components/JobTypeDropDown.vue';
    import GangsheetEmployees from './components/GangsheetEmployees.vue';
    import Materials from 'vue-materials';
    import BootstrapVue from 'bootstrap-vue';

    export default {
        components: {
            Datepicker,
            jobType,
            GangsheetEmployees,
            Materials,
            BootstrapVue
        },
        computed: {
            jobInfo() {
                return this.$store.state.gangSheet.jobInfo;
            },
            jobNameLabel() {
                return this.$store.state.gangSheet.jobInfo.accountDescription.name != 'TRAINING' ? 'Job Name' : 'Training Type';
            }
        }
    }
</script>
