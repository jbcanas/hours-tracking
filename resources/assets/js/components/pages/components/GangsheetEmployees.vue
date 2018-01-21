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

		<div class="row" :class="{'has-error': errors.has('employees')}">
			<span class="invalid-feedback">Please insert at least 1 employee(excluding the dispatcher) before saving the gang sheet.</span>

			<table id="gangSheetEmployeesTable" class="table table-condensed table-hover table-bordered">
		        <thead>
		            <tr>
		                <th>ILWU #</th>
		                <th>Company #</th>
		                <th>First Name</th>
		                <th>Last Name</th>
		                <th>Office use</th>
		                <th>Job Position</th>
		                <th>Labor Code</th>
		                <th>ST</th>
		                <th>OT</th>
		                <th>POT</th>
		                <th :class="{hidden: otherHrs}">ST-Other</th>
		                <th :class="{hidden: otherHrs}">OT-Other</th>
		                <th :class="{hidden: otherHrs}">POT-Other</th>
		                <th>DT</th>
		                <th>PL</th>
		                <th>Adjust Pay</th>
		                <th>Total Hrs</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		        	<tr :class="employee.replacement ? 'replacementEmployeeRow' : ''" v-for="(employee, key) in jobInfo.employees">
		        		<td class="handPointer" @click="showPopover(employee, 'ilwuType' + key)" :ref="'ilwuType' + key">{{ employee.employee_number }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'companyType' + key)" :ref="'companyType' + key">{{ employee.company_number }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'fname' + key)" :ref="'fname' + key">{{ employee.first_name }}</td>
		        		<td class="handPointer" @click="showPopover(employee, 'lname' + key)" :ref="'lname' + key">{{ employee.last_name }}</td>
		        		<td>{{ employee.office_use }}</td>
		        		<td>{{ employee.job_position }}</td>
		        		<td>{{ employee.labor_code }}</td>
		        		<td>{{ employee.st }}</td>
		        		<td>{{ employee.ot }}</td>
		        		<td>{{ employee.pot }}</td>
		        		<td :class="{hidden: otherHrs}">{{ employee.st_other }}</td>
		        		<td :class="{hidden: otherHrs}">{{ employee.ot_other }}</td>
		        		<td :class="{hidden: otherHrs}">{{ employee.pot_other }}</td>
		        		<td>{{ employee.dt }}</td>
		        		<td>{{ employee.pl }}</td>
		        		<td>{{ employee.adjust_pay }}</td>
		        		<td>{{ totalHrs(employee) }}</td>
		        		<td>
		        			<a href="javascript:;" class="btn btn-sm red"
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
                        @search="getOptions" 
                        :options="searchResults" 
                        :filterable="false"
                        :placeholder="employeePopoverPlaceholder"
                        ref="employeePopover">
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

	export default {
		name: 'gangSheetEmployees',
        inject: ['$validator'],
		data() {
			return {
				jobPosition: '',
                replacement: false,
                searchResults: []
			}
		},
		components: {
			jobpos: JobPositionDropDown,
			vSelect
		},
		computed: {
            gangSheetState() {
                return this.$store.state.gangSheet;
            },
			jobInfo() {
                return this.$store.state.gangSheet.jobInfo;
            },
            jobPositionEmpty() {
            	return this.jobPosition == '' ? 'hidden' : '';
            },
            employeePopoverPlaceholder() {
                const companyNumber = companyName == 'apl' ? 'APL#' : 'Matson#';
                return 'Search by Name, ILWU# or '+ companyNumber;
            },
            otherHrs() {
                return (this.jobInfo.account_description == 'YARD WORK/SORT' && this.jobInfo.job_name == 'YARD WORK/OTHER') ? false : true;
            }
		},
		methods: {
			totalHrs(item) {
            	return (item.st === undefined ? 0 : item.st) +
					(item.ot === undefined ? 0 : item.ot) +
					(item.pot === undefined ? 0 : item.pot) +
					(item.st_other === undefined ? 0 : item.st_other) +
					(item.ot_other === undefined ? 0 : item.ot_other) +
					(item.pot_other === undefined ? 0 : item.pot_other) +
					(item.dt === undefined ? 0 : item.dt);
            },
            setJobPosition(value) {
                this.jobPosition = value;
            },
            addEmployee() {
                this.$store.commit('addEmployee', {
                    job_position: this.jobPosition,
                    replacement: this.replacement
                });

                // resets replacement checkbox to un-checked state
                this.replacement = false;
            },
            removeEmployee(key) {
            	this.$store.commit('removeEmployee', {
					key: key
				});
            },
            showPopover(employee, refElement) {
				const offset = $(this.$refs[refElement]).offset(),
					posY = (offset.top - $('#gangSheetEmployeesTable').parent().offset().top) + 122,
					posX = (offset.left - $('#gangSheetEmployeesTable').parent().offset().left) + 86; 


                jQuery('#employeePopover').removeClass('show hidden').css({
                    left: posX,
                    top: posY
                });

                setTimeout(function() {
					jQuery('#employeePopover').removeClass('show hidden').addClass('show');
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
            }, 750),
		}
	}

	//hide popover when clicked outside the element
	jQuery('html').on('click', function(e) {
        if (! jQuery(e.target).is('#employeePopover') && jQuery(e.target).closest('.popover').length == 0 && jQuery('#employeePopover').hasClass('show')) {
            jQuery('#employeePopover').removeClass('show').addClass('hidden');
        }
    });
</script>
