<template>
    <v-select 
        v-model="infoModel" 
        :options="list" 
        :disabled="disableInputs"
        label="name" 
        placeholder="Select a job name"/>
</template>

<script>
import vSelect from 'vue-select';

export default {
    name: 'JobName',
    components: {
        vSelect
    },
    props: {
        mechanicsTemplate: {
            type: Function,
            default: null
        },
        findMode: {
            type: Boolean,
            default: null
        }
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
				
                if(
                    ['SHOP-DUT', 'SHOP-KOD'].includes(this.$store.state.gangSheet.jobInfo.accountDescription.value) &&
                    ['SHOP-MECHANICS', 'TOOL ALLOWANCE'].includes(value) &&
                    !this.findMode
                ) {
                    this.mechanicsTemplate(value);
                }
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
