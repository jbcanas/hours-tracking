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
				
	            <menu-single menu-name="Gang Sheet" menu-url="/gangSheet" menu-icon="fa-newspaper-o"></menu-single>

	            <li 
				 class="nav-item"
				 :class="activateMenu('reports', 'active')">
	                <a class="nav-link">
	                    <i class="fa fa-archive"></i>
	                    <span class="title">Reports</span>
						<span class="arrow" :class="activateMenu('reports', 'open')"></span>
	                </a>
					<ul 
					 class="sub-menu"
					 :class="activateMenu('reports', 'displayBlock')">
					 	<menu-single menu-name="Company Jobs" menu-url="/companyJobs" menu-icon=""></menu-single>
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
		components: {
			'menu-single': {
				props: ['menuName', 'menuUrl', 'menuIcon'],
				template: `<router-link
	             tag="li"
	             :to="menuUrl" 
	             class="nav-item">
	                <a class="nav-link">
	                    <i v-if="menuIcon != ''" class="fa" :class="menuIcon"></i>
	                    <span class="title">{{ menuName }}</span>
	                </a>
	            </router-link>`
			}
		},
		computed: {
			menus() {
				return this.$store.state.sidebar.menus;
			},
			arrowOpen() {

			} 
		},
		methods: {
			activateMenu(url, activeClass) {
				return (this.$route.path.indexOf(url) > -1) ? activeClass : '';
			},
			toggleMenu() {

			}
		}
	}
</script>