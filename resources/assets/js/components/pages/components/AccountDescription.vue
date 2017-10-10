<template>
	<v-select v-model="infoModel" label="name" :options="list" placeholder="Select an account description"></v-select>
</template>

<script>
	import vSelect from 'vue-select'

	export default {
		name: 'accountDescription',
		components: {
			vSelect
		},
		computed: {
			list() {
				return this.$store.state.gangSheet.accountDescriptions;
				// return [];
			},
			infoModel: {
				get() {
					return this.$store.state.gangSheet.jobInfo.accountDescription;
				},
				set(value) {
					this.$store.commit('updateJobInfo', {
						type: 'accountDescription',
						value: value
					});
				}
			}
		},
		mounted() {
		    /*this.$store.dispatch('loadData', {
		    	type: 'setAccountDescriptions'
		    });*/

		    this.$store.state.gangSheet[this.type];
		}
	}
</script>
