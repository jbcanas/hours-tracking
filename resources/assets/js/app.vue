<template>
    <div 
        class="m-page--fluid m--skin- m-content--skin-light2 m-header--static m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"
        :class="sidebarHidden ? 'm-brand--minimize m-aside-left--minimize' : ''">
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <top-bar />

            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <side-bar />
				
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import topBar from './components/partials/TopBar.vue';
import sideBar from './components/partials/SideBar.vue';
import footerSection from './components/partials/Footer.vue';

export default {
    components: {
        topBar,
        sideBar,
        footerSection
    },
    computed: {
        sidebarHidden() {
            return this.$store.state.topBar.hiddenSidebar;
        }
    }
};
</script>
