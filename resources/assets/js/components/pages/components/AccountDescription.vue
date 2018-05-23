<template>
    <v-select 
        v-model="infoModel" 
        :options="list" 
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

                if(value.value == 'SHOP-DUT') {
                    axios.post('/api/gangSheet/mechTemplate')
                        .then((response) => {
                            this.$store.dispatch('resetEmployees');

                            _.map(response.data, (item) => {
                                this.$store.commit('addEmployee', {
                                    id: 0,
                                    employee_id: item.employee_id,
                                    job_position: item.job_position,
                                    replacement: item.replacement,
                                    employee_number: item.employee_number,
                                    company_number: item.company_number,
                                    first_name: item.first_name,
                                    last_name: item.last_name,
                                    reg_status: item.reg_status,
                                    st: {
                                        value: 0,
                                        edit: false
                                    },
                                    ot: {
                                        value: 0,
                                        edit: false
                                    },
                                    pot: {
                                        value: 0,
                                        edit: false
                                    },
                                    st_other: {
                                        value: 0,
                                        edit: false
                                    },
                                    ot_other: {
                                        value: 0,
                                        edit: false
                                    },
                                    pot_other: {
                                        value: 0,
                                        edit: false
                                    },
                                    dt: {
                                        value: 0,
                                        edit: false
                                    },
                                    pl: {
                                        value: 0,
                                        edit: false
                                    },
                                    adjust_pay: {
                                        value: 0,
                                        edit: false
                                    }
                                });
                            });
                        })
                        .catch(() => {
                            // showError('Something went wrong! Please try again.');
                        });
                }
            }
        }
    },
    mounted() {
        this.$store.state.gangSheet[this.type];
    }
};
</script>
