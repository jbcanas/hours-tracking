<template>
    <div>
        <h1 class="page-title"> Company Jobs</h1>
        <datepicker v:model="" :format="'MM/dd/yyyy'"></datepicker>

    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker
        }
    }
</script>
