<template>
	<div class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white"
		:class="sidebarHidden ? 'page-sidebar-closed page-sidebar-closed-hide-logo' : ''">
        <div class="page-wrapper">
			<top-bar />

			<div class="page-container">
				<side-bar />
				<div class="page-content-wrapper">
				    <div class="page-content">
				        <router-view></router-view>
				    </div>
				</div>
			</div>
        </div>
   </div>
</template>

<script>
	import Vue from 'vue'

	import topBar from './components/partials/TopBar.vue'
	import sideBar from './components/partials/SideBar.vue'
	import footerSection from './components/partials/Footer.vue'

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
	}
</script>
