<template>
    <v-select 
        v-model="infoModel" 
        :options="list" 
        :disabled="disableInputs"
        label="value" 
        placeholder="Select an account description"/>
</template>

<script>
import vSelect from 'vue-select';

export default {
    name: 'AccountDescription',
    components: {
        vSelect
    },
    computed: {
        list() {
            return this.$store.state.gangSheet.accountDescriptions;
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

                if(value === null)
                    return true;

                const jobNames = Array.isArray(value.jobNames) ? value.jobNames : [value.jobNames];

                this.$store.commit('setJobNames', jobNames.sort());

                this.$store.commit('updateJobInfo', {
                    type: 'jobName',
                    value: jobNames.length > 1 ? '' : value.jobNames
                });
            }
        },
        disableInputs() {
            return this.$store.state.gangSheet.disableInputs;
        }
    },
    mounted() {
        this.$store.state.gangSheet[this.type];
    }
};
</script>
