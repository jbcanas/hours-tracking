<template>
	<v-select v-model="jobPositionModel" label="name" :options="list"></v-select>
</template>

<script>
	import vSelect from 'vue-select';

	export default {
		name: 'jobPositionDropDown',
		components: {
			vSelect
		},
		computed: {
			list() {
				return this.$store.state.jobPositions;
			},
			jobPositionModel: {
				get() {
					return this.$store.state.gangSheet.jobInfo[this.type];
				},
				set(value) {
					this.$store.commit('updateJobInfo', {
						type: this.type,
						value: value
					});
				}
			}
		},
		mounted() {
		    this.$store.dispatch('loadData', {
		    	type: this.type == 'accountDescription' ? 'setAccountDescriptions' : 'setJobNames'
		    });
		}
	}
</script>