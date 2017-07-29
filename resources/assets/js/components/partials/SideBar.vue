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
				<template v-for="(menu, key) in menus">
					<template v-if="menu.items.length < 1">
						<router-link
						:key="key"
						tag="li"
						:to="menu.url" 
						class="nav-item">
							<a class="nav-link">
								<i class="fa" :class="menu.icon"></i>
								<span class="title">{{ menu.name }}</span>
								<span v-show="menu.active" 
									class="selected"></span>
								<span v-show="menu.items.length > 0" 
									class="arrow" 
									:class="menu.active ? 'open' : 'closed'"></span>
							</a>
							<ul v-if="menu.items.length > 0" class="sub-menu">
								<router-link 
								tag="li"
								v-for="(item, key) in menu.items"
								:key="key"
								:to="item.url"
								class="nav-item">
									<a class="nav-link">{{ item.name }}</a>
								</router-link>
							</ul>
						</router-link>
					</template>
					<template v-else>
						<li
						:key="key"
						:to="menu.url" 
						@click="toggleNav(menu.id)"
						:class="{open: menu.active}"
						class="nav-item">
							<a class="nav-link">
								<i class="fa" :class="menu.icon"></i>
								<span class="title">{{ menu.name }}</span>
								<span v-show="menu.active" 
									class="selected"></span>
								<span v-show="menu.items.length > 0" 
									class="arrow" 
									:class="{open: menu.active}"></span>
							</a>
							<ul v-if="menu.items.length > 0" 
							 class="sub-menu"
							 :class="{show: menu.active}">
								<router-link 
								tag="li"
								v-for="(item, key) in menu.items"
								:key="key"
								:to="item.url"
								class="nav-item">
									<a class="nav-link">{{ item.name }}</a>
								</router-link>
							</ul>
						</li>
						
					</template>
					
				</template>
	            
	        </ul>
	    </div>
	</div>
</template>

<script>
	import { mapGetters } from 'vuex'

	export default {
		name: 'side-bar',
		components: {
			'with-router': {
				template: `<router-link
				:key="key"
				tag="li"
				:to="{path: menu.items.length > 0 ? 'javascript:;' : menu.url}" 
				class="nav-item"></router-link>`
			}
		},
		computed: {
			menus() {
				return this.$store.state.sidebar.menus;
			}
		},
		methods: {
			toggleNav(id) {
				this.$store.dispatch('toggleMenuActiveProp', id);
				// console.log(id, this.$refs[id].className);
			}
		}
	}
</script>