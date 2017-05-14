<template>
	<div class="page-sidebar-wrapper">
	    <div class="page-sidebar navbar-collapse collapse">
	        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
	        	<li class="sidebar-toggler-wrapper hide">
	                <div class="sidebar-toggler">
	                    <span></span>
	                </div>
	            </li>
	            <li class="sidebar-search-wrapper hidden">
	                <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
	                    <a href="javascript:;" class="remove">
	                        <i class="icon-close"></i>
	                    </a>
	                    <div class="input-group">
	                        <input type="text" class="form-control" placeholder="Search...">
	                        <span class="input-group-btn">
	                            <a href="javascript:;" class="btn submit">
	                                <i class="icon-magnifier"></i>
	                            </a>
	                        </span>
	                    </div>
	                </form>
	            </li>
	            <li v-for="menu in menus" 
	            class="nav-item" 
	            :class="menu.active ? 'active open' : ''"
	            @click="toggleNav(menu.id)">
	                <a class="nav-link"
	                v-bind:href="menu.items.length > 0 ? 'javascript:;' : '/#'+ menu.url" >
	                    <i class="fa" :class="menu.icon"></i>
	                    <span class="title">{{ menu.name }}</span>
	                    <span v-show="menu.items.length > 0" 
	                    	class="arrow" 
	                    	:class="menu.active ? 'open' : 'closed'"></span>
	                    <span v-show="menu.active" 
	                    	class="selected"></span>
	                </a>
	                <ul v-if="menu.items.length > 0" class="sub-menu">
	                    <li class="nav-item" 
	                    v-for="item in menu.items">
	                        <a v-bind:href="item.url == '' ? 'javascript:;' : '/#'+ item.url" 
	                        class="nav-link">
	                            <span class="title">{{ item.name }}</span>
	                        </a>
	                    </li>
	                </ul>
	            </li>
	        </ul>
	    </div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'

	export default {
		name: 'side-bar',
		computed: {
			menus() {
				return this.$store.state.sidebar.menus;
			} 
		},
		methods: {
			toggleNav(id) {
				this.$store.commit('toggleMenuActiveProp', id);
			}
		}
	}
</script>