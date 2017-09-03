<template>
	<div>
		<div class="row jobPositionContainer">
			<div class="col-md-4">
				<jobpos :setJobPositionMethod="setJobPosition"></jobpos>
			</div>
			<div class="col-md-3">
				<a href="javascript:;" class="btn blue-steel"
					v-bind:class="jobPositionEmpty"
					@click="addEmployee"> <i class="fa fa-plus"></i></a>
			</div>
		</div>
		<div class="row" v-show="jobInfo.employees.length > 0">
			<table class="table table-condensed table-hover table-bordered">
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
		                <th>ST-Other</th>
		                <th>OT-Other</th>
		                <th>POT-Other</th>
		                <th>DT</th>
		                <th>PL</th>
		                <th>Adjust Pay</th>
		                <th>Total Hrs</th>
		                <th></th>
		            </tr>
		        </thead>
		        <tbody>
		        	<tr v-for="(employee, key) in jobInfo.employees">
		        		<td>{{ employee.employee_number }}</td>
		        		<td>{{ employee.company_number }}</td>
		        		<td>{{ employee.first_name }}</td>
		        		<td>{{ employee.last_name }}</td>
		        		<td>{{ employee.office_use }}</td>
		        		<td>{{ employee.job_position }}</td>
		        		<td>{{ employee.labor_code }}</td>
		        		<td>{{ employee.st }}</td>
		        		<td>{{ employee.ot }}</td>
		        		<td>{{ employee.pot }}</td>
		        		<td>{{ employee.st_other }}</td>
		        		<td>{{ employee.ot_other }}</td>
		        		<td>{{ employee.pot_other }}</td>
		        		<td>{{ employee.dt }}</td>
		        		<td>{{ employee.pl }}</td>
		        		<td>{{ employee.adjust_pay }}</td>
		        		<td>{{ totalHrs(employee) }}</td>
		        		<td>
		        			<a href="javascript:;" class="btn btn-xs red"
								@click="removeEmployee(key)"> <i class="fa fa-times"></i>
							</a>
		        		</td>
		        	</tr>
		        </tbody>
		    </table>
	    </div>
   </div>
</template>

<script>
	import JobPositionDropDown from './JobPositionDropDown.vue';

	export default {
		name: 'gangSheetEmployees',
		data() {
			return {
				jobPosition: ''
			}
		},
		components: {
			jobpos: JobPositionDropDown
		},
		computed: {
			jobInfo() {
                return this.$store.state.gangSheet.jobInfo;
            },
            jobPositionEmpty() {
            	return this.jobPosition == '' ? 'hidden' : '';
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
					job_position: this.jobPosition
				});
            },
            removeEmployee(key) {
            	this.$store.commit('removeEmployee', {
					key: key
				});
            }
		}
	}
</script>