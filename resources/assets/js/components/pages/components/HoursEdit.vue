<template>
    <div>
        <span 
            v-show="! hour.edit" 
            @click="toggleEdit">{{ hour.value }}</span>
                
        <input 
            v-show="hour.edit"
            :value="hour.value" 
            :ref="'hourInput'+ refkey"
            type="text"
            class="form-control"
            style="width: 100px"
            @keydown.enter="updateHours($event)"
            @keydown.esc="cancelEdit"
            @blur="updateHours($event)">   
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: Object,
            default: null
        },
        objReference: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            _beforeEditingCache: 0
        };
    },
    computed: {
        hour() {
            return this.type;
        },
        refkey() {
            return _.uniqueId();
        }
    },
    methods: {
        toggleEdit() {
            if(this.$store.state.gangSheet.disableInputs) return;
            
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
        closeEdit() {
            this.hour.edit = false;
        },
        cancelEdit() {
            this.hour.edit = false;

            this.hour.value = this._beforeEditingCache;
        },
        updateHours(event) {
            this.$store.commit('updateHours', {
                key: this.objReference.key,
                hourType: this.objReference.hourType,
                value: event.target.value
            });

            this.closeEdit();
        }
    }
};
</script>
