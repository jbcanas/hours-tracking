<template>
	<v-select :on-change="setJobPosition" label="name" :options="list" placeholder="Job Position"></v-select>
</template>

<script>
	import vSelect from 'vue-select';

	export default {
		name: 'jobpos',
		props: ['setJobPositionMethod'],
		components: {
			vSelect
		},
		computed: {
			list() {
				return this.$store.state.gangSheet.jobPositions;
			}
		},
		methods: {
			setJobPosition(value) {
				return this.setJobPositionMethod(value.name);
			}
		}
	}
</script>
