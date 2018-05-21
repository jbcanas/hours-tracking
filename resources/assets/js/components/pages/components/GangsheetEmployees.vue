<template>
    <div>
        <div class="row jobPositionContainer">
            <div class="col-md-3 hoursHelper">
                <input 
                    v-model="hoursHelper.st"
                    type="text" 
                    placeholder="st">
                <input 
                    v-model="hoursHelper.ot"
                    type="text" 
                    placeholder="ot">
                <input 
                    v-model="hoursHelper.pot"
                    type="text" 
                    placeholder="pot">
                <input 
                    v-model="hoursHelper.dt"
                    type="text" 
                    placeholder="dt">
                <button 
                    type="button" 
                    class="btn btn-info btn-sm ml-2"
                    @click="populateHoursHelper">Ok</button>
            </div>
            <div class="col-md-4">
                <jobpos :set-job-position-method="setJobPosition"/>
            </div>
            <div class="col-md-2">
                <b-form-checkbox 
                    id="checkbox1"
                    v-model="replacement">
                    Replacement
                </b-form-checkbox>
            </div>
            <div class="col-md-3">
                <a 
                    href="javascript:;" 
                    class="btn blue-steel"
                    :class="jobPositionEmpty"
                    @click="addEmployee"> <i class="fa fa-plus"/></a>
            </div>
        </div>

        <div 
            id="gangSheetEmployeesTableContainer" 
            class="row" 
            :class="{'has-error': errors.has('employees') || errors.has('grandTotalHrs')}">
            <div 
                class="alert alert-danger" 
                role="alert" 
                v-show="errors.has('employees')">Please insert at least 1 employee(excluding the dispatcher) before saving the gang sheet.</div>
            <div 
                class="alert alert-danger" 
                role="alert" 
                v-show="errors.has('grandTotalHrs')">{{ errors.first('grandTotalHrs') }}</div>

            <table 
                id="gangSheetEmployeesTable" 
                class="table table-condensed table-hover table-bordered m-table m-table--head-bg-brand">
                <thead>
                    <tr>
                        <th>ILWU #</th>
                        <th>{{ companyName }} #</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Reg Status</th>
                        <th :class="{hidden: hideMatsonColumns}">Office use</th>
                        <th>Job Position</th>
                        <th :class="{hidden: hideMatsonColumns}">Labor Code</th>
                        <th>ST</th>
                        <th>OT</th>
                        <th>POT</th>
                        <th :class="{hidden: otherHrs}">ST-Other</th>
                        <th :class="{hidden: otherHrs}">OT-Other</th>
                        <th :class="{hidden: otherHrs}">POT-Other</th>
                        <th>DT</th>
                        <th :class="{hidden: hideMatsonColumns}">PL</th>
                        <th :class="{hidden: hideMatsonColumns}">Adjust Pay</th>
                        <th>Total Hrs</th>
                        <th/>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        :class="employee.replacement ? 'replacementEmployeeRow' : ''" 
                        v-for="(employee, key) in jobInfo.employees"
                        :key="key">
                        <td 
                            class="handPointer" 
                            @click="showPopover(employee, 'ilwuType' + key, key)" 
                            :ref="'ilwuType' + key">{{ employee.employee_number }}</td>
                        <td 
                            class="handPointer" 
                            @click="showPopover(employee, 'companyType' + key, key)" 
                            :ref="'companyType' + key">{{ employee.company_number }}</td>
                        <td 
                            class="handPointer" 
                            @click="showPopover(employee, 'fname' + key, key)" 
                            :ref="'fname' + key">{{ employee.first_name }}</td>
                        <td 
                            class="handPointer" 
                            @click="showPopover(employee, 'lname' + key, key)" 
                            :ref="'lname' + key">{{ employee.last_name }}</td>
                        <td>{{ employee.status }}</td>
                        <td :class="{hidden: hideMatsonColumns}">{{ employee.office_use }}</td>
                        <td>{{ employee.job_position }}</td>
                        <td :class="{hidden: hideMatsonColumns}">{{ employee.labor_code }}</td>
                        <td>
                            <hours-edit 
                                :type="employee.st" 
                                :obj-reference="{key: key, hourType: 'st'}"/>
                        </td>
                        <td>
                            <hours-edit 
                                :type="employee.ot" 
                                :obj-reference="{key: key, hourType: 'ot'}"/>
                        </td>
                        <td>
                            <hours-edit 
                                :type="employee.pot" 
                                :obj-reference="{key: key, hourType: 'pot'}"/>
                        </td>
                        <td :class="{hidden: otherHrs}">
                            <hours-edit 
                                :type="employee.st_other" 
                                :obj-reference="{key: key, hourType: 'st_other'}"/>
                        </td>
                        <td :class="{hidden: otherHrs}">
                            <hours-edit 
                                :type="employee.ot_other" 
                                :obj-reference="{key: key, hourType: 'ot_other'}"/>
                        </td>
                        <td :class="{hidden: otherHrs}">
                            <hours-edit 
                                :type="employee.pot_other" 
                                :obj-reference="{key: key, hourType: 'pot_other'}"/>
                        </td>
                        <td>
                            <hours-edit 
                                :type="employee.dt" 
                                :obj-reference="{key: key, hourType: 'dt'}"/>
                        </td>
                        <td :class="{hidden: hideMatsonColumns}">
                            <hours-edit :type="employee.pl"/>
                        </td>
                        <td :class="{hidden: hideMatsonColumns}">
                            <hours-edit :type="employee.adjust_pay"/>
                        </td>
                        <td>{{ totalHrs(employee) }}</td>
                        <td>
                            <a 
                                href="javascript:;" 
                                title="Delete" 
                                class="btn btn-sm red"
                                @click="removeEmployee(key)"> <i class="fa fa-times"/>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div 
                id="employeePopover" 
                class="popover fade bs-popover-right hidden" 
                role="tooltip">
                <div 
                    class="arrow" 
                    style="top: 44px;"/>
                <h3 class="popover-header">
                    <div>
                        Search an employee
                    </div>
                </h3>
                <div class="popover-body">
                    <v-select 
                        label="resultLabel" 
                        v-model="selectedEmployee"
                        @search="getOptions" 
                        :options="searchResults" 
                        :filterable="false"
                        :placeholder="employeePopoverPlaceholder"
                        ref="employeeSearchElement"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JobPositionDropDown from './JobPositionDropDown.vue';
import vSelect from 'vue-select';
import { mapGetters } from 'vuex';
import HoursEdit from './HoursEdit.vue';
import { Validator } from 'vee-validate';

export default {
    name: 'GangSheetEmployees',
    inject: ['$validator'],
    components: {
        jobpos: JobPositionDropDown,
        'hours-edit': HoursEdit,
        vSelect
    },
    data() {
        return {
            jobPosition: '',
            replacement: false,
            searchResults: [],
            rowToInsert: '',
            selectedEmployee: null,
            otherHrs: true,
            value: 'value',
            hoursHelper: {
                st: '',
                ot: '',
                pot: '',
                dt: '',
            }
        };
    },
    computed: {
        jobInfo() {
            return this.$store.state.gangSheet.jobInfo;
        },
        jobPositionEmpty() {
            return this.jobPosition == '' ? 'hidden' : '';
        },
        hideMatsonColumns() {
            return companyName == 'matson' ? false : true;
        },
        employeePopoverPlaceholder() {
            const companyNumber = companyName == 'apl' ? 'APL#' : 'Matson#';
            return 'Search by Name, ILWU# or ' + companyNumber;
        },
        companyName() {
            return companyName.toUpperCase();
        },
        ...mapGetters({
            jobNameState: 'getJobName',
            grandTotalHrs: 'calculateGrandTotalHrs'
        })
    },
    watch: {
        selectedEmployee(employee) {
            if (!_.isEmpty(employee)) {
                const rowToUpdate = this.jobInfo.employees[this.rowToInsertKey];

                rowToUpdate.employee_id = employee.id;
                rowToUpdate.employee_number = employee.employee_number;
                rowToUpdate.company_number = this.hideMatsonColumns
                    ? employee.apl_number
                    : employee.hl_number;
                rowToUpdate.first_name = employee.first_name;
                rowToUpdate.last_name = employee.last_name;
                rowToUpdate.status = employee.status;

                // hide popover
                jQuery('body').click();
            }
        },
        jobNameState(value) {
            if (value == 'YARD WORK/OTHER' && companyName == 'apl') {
                this.otherHrs = false;
            } else {
                this.otherHrs = true;
            }
        }
    },
    created() {
        Validator.extend('verify_hours', {
            getMessage: field => `The ${field} is not a valid coupon.`,
            validate: value =>
                new Promise(resolve => {
                    setTimeout(() => {
                        resolve({
                            valid: value && value > 0
                        });
                    }, 500);
                })
        });

        /* this.$validator.attach({
            name: 'grandTotalHrs',
            rules: 'required|verify_hours'
        }); */
    },
    methods: {
        totalHrs(item) {
            const total =
                (item.st === undefined ? 0 : Number(item.st.value)) +
                (item.ot === undefined ? 0 : Number(item.ot.value)) +
                (item.pot === undefined ? 0 : Number(item.pot.value)) +
                (item.st_other === undefined
                    ? 0
                    : Number(item.st_other.value)) +
                (item.ot_other === undefined
                    ? 0
                    : Number(item.ot_other.value)) +
                (item.pot_other === undefined
                    ? 0
                    : Number(item.pot_other.value)) +
                (item.dt === undefined ? 0 : Number(item.dt.value));

            // this.grandTotalHrs = this.$store.getters.calculateGrandTotalHrs;

            return total;
        },
        setJobPosition(value) {
            this.jobPosition = value;
        },
        addEmployee() {
            this.$store.commit('addEmployee', {
                job_position: this.jobPosition,
                replacement: this.replacement,
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
                dt: {
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
            });

            // resets replacement checkbox to un-checked state
            this.replacement = false;
        },
        removeEmployee(key) {
            this.$store.commit('removeEmployee', {
                key: key
            });
        },
        showPopover(employee, refElement, key) {
            const offset = jQuery(this.$refs[refElement]).offset(),
                posY =
                    offset.top -
                    jQuery('#gangSheetEmployeesTable')
                        .parent()
                        .offset().top +
                    122,
                posX =
                    offset.left -
                    jQuery('#gangSheetEmployeesTable')
                        .parent()
                        .offset().left +
                    86;

            jQuery('#employeePopover')
                .removeClass('show hidden')
                .css({
                    left: posX,
                    top: posY
                });

            this.selectedEmployee = null;
            this.rowToInsertKey = key;

            setTimeout(() => {
                // show popover
                jQuery('#employeePopover')
                    .removeClass('show hidden')
                    .addClass('show');

                // focus on employee search's input
                this.$refs.employeeSearchElement.$refs.search.focus();
            }, 1);
        },
        getOptions(search, loading) {
            loading(true);

            this.runSearch(search, loading, this);
        },
        populateHoursHelper() {
            this.$store.commit('populateHoursHelper', this.hoursHelper);
        },
        runSearch: _.debounce((search, loading, vm) => {
            loading(true);

            axios
                .post('/api/masterList/search', {
                    value: search
                })
                .then(response => {
                    loading(false);

                    vm.searchResults = response.data;
                })
                .catch(() => {
                    loading(false);
                });
        }, 500)
    }
};

//hide popover when clicked outside the element
jQuery('html').on('click', function(e) {
    if (
        !jQuery(e.target).is('#employeePopover') &&
        jQuery(e.target).closest('.popover').length == 0 &&
        jQuery('#employeePopover').hasClass('show')
    ) {
        jQuery('#employeePopover')
            .removeClass('show')
            .addClass('hidden');
    }
});
</script>
