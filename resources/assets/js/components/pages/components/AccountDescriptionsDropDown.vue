<template>
	<v-select v-model="selected" :options="['foo','bar']"></v-select>
</template>

<script>
	import vSelect from 'vue-select'
	export default {
		name: 'accountDescriptions',
		components: {
			vSelect
		}
	}
</script>