<template>
	<div>
		<div class="row jobPositionContainer">
            <div class="col-md-4">
                <jobpos :setJobPositionMethod="setJobPosition"></jobpos>
            </div>
			<div class="col-md-2">
                <b-form-checkbox id="checkbox1"
                     v-model="replacement">
                     Replacement
                </b-form-checkbox>
			</div>
			<div class="col-md-3">
				<a href="javascript:;" class="btn blue-steel"
					v-bind:class="jobPositionEmpty"
					@click="addEmployee"> <i class="fa fa-plus"></i></a>
			</div>
		</div>

		<div id="gangSheetEmployeesTableContainer" class="row" :class="{'has-error': errors.has('employees')}">
			<span class="invalid-feedback">Please insert at least 1 employee(excluding the dispatcher) before saving the gang sheet.</span>

			<table id="gangSheetEmployeesTable" class="table table-condensed table-hover table-bordered m-table m-table--head-bg-brand">
		        <thead>
		            <tr>
		                <th>ILWU #</th>
		                <th>{{ companyName }} #</th>
		                <th>First Name</th>
		                <th>Last Name</th>
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
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		        	<tr :class="employee.replacement ? 'replacementEmployeeRow' : ''" v-for="(employee, key) in jobInfo.employees">
		        		<td class="handPointer" @click="showPopover(employee, 'ilwuType' + key, key)" :ref="'ilwuType' + key">{{ employee.employee_number }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'companyType' + key, key)" :ref="'companyType' + key">{{ employee.company_number }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'fname' + key, key)" :ref="'fname' + key">{{ employee.first_name }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'lname' + key, key)" :ref="'lname' + key">{{ employee.last_name }}</td>
		        		<td :class="{hidden: hideMatsonColumns}">{{ employee.office_use }}</td>
		        		<td>{{ employee.job_position }}</td>
		        		<td :class="{hidden: hideMatsonColumns}">{{ employee.labor_code }}</td>
		        		<td>
                            <hours-edit :type="employee.st"></hours-edit>   
                        </td>
		        		<td>
                            <hours-edit :type="employee.ot"></hours-edit>
                        </td>
		        		<td>
                            <hours-edit :type="employee.pot"></hours-edit>            
                        </td>
		        		<td :class="{hidden: otherHrs}">
                            <hours-edit :type="employee.st_other"></hours-edit>            
                        </td>
                        <td :class="{hidden: otherHrs}">
                            <hours-edit :type="employee.ot_other"></hours-edit>            
                        </td>
                        <td :class="{hidden: otherHrs}">
                            <hours-edit :type="employee.pot_other"></hours-edit>            
                        </td>
                        <td>
                            <hours-edit :type="employee.dt"></hours-edit>            
                        </td>
                        <td :class="{hidden: hideMatsonColumns}">
                            <hours-edit :type="employee.pl"></hours-edit>            
                        </td>
                        <td :class="{hidden: hideMatsonColumns}">
                            <hours-edit :type="employee.adjust_pay"></hours-edit>            
                        </td>
		        		<td>{{ totalHrs(employee) }}</td>
		        		<td>
		        			<a href="javascript:;" 
                                title="Delete" 
                                class="btn btn-sm red"
								@click="removeEmployee(key)"> <i class="fa fa-times"></i>
							</a>
		        		</td>
		        	</tr>
		        </tbody>
		    </table>

		    <div id="employeePopover" class="popover fade bs-popover-right hidden" role="tooltip">
		        <div class="arrow" style="top: 44px;"></div>
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
                        ref="employeeSearchElement">
                    </v-select>
		        </div>
		    </div>
	    </div>
   </div>
</template>

<script>
	import JobPositionDropDown from './JobPositionDropDown.vue';
    import Typeahead from './Typeahead.vue';
    import vSelect from 'vue-select';
    import { mapGetters } from 'vuex';
	import HoursEdit from './HoursEdit.vue';

	export default {
		name: 'gangSheetEmployees',
        inject: ['$validator'],
		data() {
			return {
				jobPosition: '',
                replacement: false,
                searchResults: [],
                rowToInsert: '',
                selectedEmployee: '',
                otherHrs: true,
                value: 'value'
			}
		},
		components: {
            jobpos: JobPositionDropDown,
			"hours-edit": HoursEdit,
			vSelect
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
                return 'Search by Name, ILWU# or '+ companyNumber;
            },
            companyName() {
                return companyName.toUpperCase();
            },
            ...mapGetters({
                jobNameState: 'getJobName'
            })
		},
		methods: {
			totalHrs(item) {
            	return (item.st === undefined ? 0 : Number(item.st.value)) +
					(item.ot === undefined ? 0 : Number(item.ot.value)) +
					(item.pot === undefined ? 0 : Number(item.pot.value)) +
					(item.st_other === undefined ? 0 : Number(item.st_other.value)) +
					(item.ot_other === undefined ? 0 : Number(item.ot_other.value)) +
					(item.pot_other === undefined ? 0 : Number(item.pot_other.value)) +
					(item.dt === undefined ? 0 : Number(item.dt.value));
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
                    },
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
				const offset = $(this.$refs[refElement]).offset(),
					posY = (offset.top - $('#gangSheetEmployeesTable').parent().offset().top) + 122,
					posX = (offset.left - $('#gangSheetEmployeesTable').parent().offset().left) + 86; 

                jQuery('#employeePopover').removeClass('show hidden').css({
                    left: posX,
                    top: posY
                });

                this.selectedEmployee = null;
                this.rowToInsertKey = key;

                setTimeout(() => {
                    // show popover
                    jQuery('#employeePopover').removeClass('show hidden').addClass('show');

                    // focus on employee search's input
					this.$refs.employeeSearchElement.$refs.search.focus();
                }, 1);
            },
            getOptions(search, loading, vm) {
            	loading(true);

                this.runSearch(search, loading, this);
            },
            runSearch: _.debounce((search, loading, vm) => {
                loading(true);

                axios.post('/api/masterList/search', {
                    value: search
                }).then(response => {
                    loading(false);

                    vm.searchResults = response.data;
                }).catch(response => {
                    loading(false);
                    console.log(response);
                });
            }, 500)
		},
        watch: {
            selectedEmployee(employee) {
                if(! _.isEmpty(employee)) {
                    const rowToUpdate = this.jobInfo.employees[this.rowToInsertKey];

                    rowToUpdate.employee_number = employee.employee_number;
                    rowToUpdate.company_number = this.hideMatsonColumns ? employee.apl_number : employee.hl_number;
                    rowToUpdate.first_name = employee.first_name;
                    rowToUpdate.last_name = employee.last_name;

                    // hide popover
                    jQuery('body').click();
                }
            },
            jobNameState(value) {
                if(value == 'YARD WORK/OTHER' && companyName == 'apl') {
                    this.otherHrs = false;
                } else {
                    this.otherHrs = true;
                }
            }
        }
	}

	//hide popover when clicked outside the element
	jQuery('html').on('click', function(e) {
        if (! jQuery(e.target).is('#employeePopover') && jQuery(e.target).closest('.popover').length == 0 && jQuery('#employeePopover').hasClass('show')) {
            jQuery('#employeePopover').removeClass('show').addClass('hidden');
        }
    });
</script>
