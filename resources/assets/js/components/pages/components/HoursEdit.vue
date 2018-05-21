<template>
    <div>
        <span 
            @click="toggleEdit" 
            v-show="! hour.edit">{{ hour.value }}</span>
                
        <input 
            type="text"
            class="form-control" 
            style="width: 100px"
            :value="hour.value"
            v-show="hour.edit"
            :ref="'hourInput'+ refkey"
            @keydown.enter="updateHours($event)"
            @keydown.esc="cancelEdit"
            @blur="updateHours($event)">   
    </div>
</template>

<script>
export default {
    props: ['type', 'objReference'],
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
