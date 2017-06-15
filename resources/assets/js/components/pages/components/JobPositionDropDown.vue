<template>
	<div v-bind:class="classContainerProp">
		<v-select v-model="jobPositionModel" label="name" :options="list"></v-select>
	</div>
</template>

<script>
	import vSelect from 'vue-select';

	export default {
		name: 'jobpos',
		components: {
			vSelect
		},
		props: ['classContainer'],
		computed: {
			list() {
				return this.$store.state.gangSheet.jobPositions;
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
			},
			classContainerProp() {
				return this.$props.classContainer;
			}
		},
		mounted() {
		    this.$store.dispatch('loadData', {
		    	type: this.type == 'accountDescription' ? 'setAccountDescriptions' : 'setJobNames'
		    });
		}
	}
</script>