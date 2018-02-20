<template>
	<v-select v-model="infoModel" label="name" :options="list" placeholder="Select a job name"></v-select>
</template>

<script>
	import vSelect from 'vue-select'

	export default {
		name: 'jobName',
		components: {
			vSelect
		},
		computed: {
			list() {
				return this.$store.state.gangSheet.jobNames;
			},
			infoModel: {
				get() {
					return this.$store.state.gangSheet.jobInfo.jobName;
				},
				set(value) {
					this.$store.commit('updateJobInfo', {
						type: 'jobName',
						value: value
					});
				}
			}
		},
		mounted() {
		    this.$store.state.gangSheet[this.type];
		}
	}
</script>
