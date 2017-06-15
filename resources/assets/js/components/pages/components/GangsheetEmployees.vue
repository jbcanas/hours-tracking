<template>
	<div class="row">
		<jobpos classContainer="jobPositionContainer"></jobpos>
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
	            </tr>
	        </thead>
	        <tbody>
	        	<tr v-for="employee in jobInfo.employees">
	        		<td>{{ employee.employee_ }}</td>
	        		<td>{{ employee.company_ }}</td>
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
	        	</tr>
	        </tbody>
	    </table>
   </div>
</template>

<script>
	import JobPositionDropDown from './JobPositionDropDown.vue';

	export default {
		name: 'gangSheetEmployees',
		components: {
			jobpos: JobPositionDropDown
		},
		computed: {
			jobInfo() {
                return this.$store.state.gangSheet.jobInfo;
            }
		},
		methods: {
			totalHrs(item) {
            	return (item.st) + (item.ot) + (item.pot) + (item.st_other) + (item.ot_other) + (item.pot_other) + (item.dt);
            }
		}
	}
</script>