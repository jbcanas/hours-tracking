<template>
	<div class="page-header navbar navbar-fixed-top">
	    <div class="page-header-inner ">
	        <div class="page-logo">
	            <a href="/">
	                <img src="/assets/img/logo.png" alt="logo" class="logo-default" /> </a>
		            <div class="menu-toggler sidebar-toggler" 
		            	@click="toggleSidebar()">
		                <span></span>
		            </div>
	        </div>
	        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
	            <span></span>
	        </a>
	        <div class="top-menu">
	            <ul class="nav navbar-nav pull-right">
	                <li class="dropdown dropdown-quick-sidebar-toggler">
	                    <a href="javascript:;" class="dropdown-toggle">
	                        <i class="icon-logout"></i>
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>
</template>

<script>
	export default {
		name: 'top-bar',
		methods: {
			toggleSidebar() {
				this.$store.commit('toggleSidebar');
			}
		}
	}
</script>