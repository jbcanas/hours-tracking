<template>
    <v-select 
        :on-change="setJobPosition" 
        :disabled="disableInputs"
        :options="list" 
        label="name" 
        placeholder="Job Position"/>
</template>

<script>
import vSelect from 'vue-select';

export default {
    name: 'Jobpos',
    components: {
        vSelect
    },
    computed: {
        list() {
            return this.$store.state.gangSheet.jobPositions;
        },
        disableInputs() {
            return this.$store.state.gangSheet.disableInputs;
        }
    },
    methods: {
        setJobPosition(value) {
            this.$store.commit('setJobPosition', value.name);
        }
    }
};
</script>
