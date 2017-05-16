<template>
	<v-select label="name" :options="accountDescriptions"></v-select>
</template>

<script>
	import vSelect from 'vue-select'
	export default {
		name: 'accountDescriptions',
		components: {
			vSelect
		},
		computed: {
			accountDescriptions() {
				return this.$store.state.gangSheet.accountDescriptions
			}
		},
		mounted() {
		    this.$store.dispatch('loadAccountDescription');
		}
	}
</script>