<template>
    <div>
        <span @click="toggleEdit" v-show="! hour.edit">{{hour.value}}</span>
                
        <input type="text"
            class="form-control" 
            v-model="hour.value"
            v-show="hour.edit"
            :ref="'hourInput'+ refkey"
            @keydown.enter="closeEdit"
            @keydown.esc="cancelEdit"
            @blur="closeEdit">   
    </div>
</template>

<script>
    export default {
        props: ['employee'],
        data() {
            return {
                _beforeEditingCache: 0
            }
        },
        computed: {
            hour() {
                return this.employee;
            },
            refkey() {
                return _.uniqueId();
            }
        },
        methods: {
            toggleEdit() {
                this.hour.edit = ! this.hour.edit;
                this._beforeEditingCache = this.hour.value;

                // Focus input field
                if(this.hour.edit){
                    Vue.nextTick(() => {
                        // focus input and then select;
                        this.$refs['hourInput'+ this.refkey].select();
                    });
                }
            },
            closeEdit(ev) {
                this.hour.edit = false;
            },
            cancelEdit(ev) {
                this.hour.edit = false;

                this.hour.value = this._beforeEditingCache;
            }
        }
    }
</script>
