<template>
	<!-- BEGIN: Left Aside -->
    <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
        <!-- BEGIN: Aside Menu -->
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                <template v-for="(menu, key) in menus">
                    <template v-if="menu.items.length < 1">
                        <router-link
                        :key="key"
                        tag="li"
                        :to="menu.url" 
                        @click.native="activateHighlight(menu.id)"
                        class="m-menu__item"
                        :class="{'m-menu__item--active': menu.highlight}">
                            <a class="m-menu__link">
                                <i class="m-menu__link-icon fa" :class="menu.icon"></i>
                                <span class="m-menu__link-text">{{ menu.name }}</span>
                                <span v-show="menu.active" class="selected"></span>
                            </a>
                        </router-link>
                    </template>
                    <template v-else>
                        <li
                        :key="key"
                        :to="menu.url" 
                        :class="{'m-menu__item--open': menu.active, 'm-menu__item--active': menu.highlight}"
                        class="m-menu__item m-menu__item--submenu">
                            <a class="m-menu__link m-menu__toggle"
                             @click="toggleNav(menu.id)">
                                <i class="m-menu__link-icon fa" :class="menu.icon"></i>
                                <span class="m-menu__link-text">{{ menu.name }}</span>
                                <span v-show="menu.active" class="selected"></span>
                                <i v-show="menu.items.length > 0"
                                    class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu"
                            :class="menu.active ? 'd-block' : 'd-none'">
                                <span class="m-menu__arrow"></span>
                                <ul v-if="menu.items.length > 0" 
                                 class="m-menu__subnav"
                                 :class="menu.active ? 'd-block' : 'd-none'">
                                    <router-link 
                                    tag="li"
                                    v-for="(item, key) in menu.items"
                                    :key="key"
                                    :to="item.url"
                                    @click.native="activateHighlight(menu.id)"
                                    class="m-menu__item">
                                        <a class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                {{ item.name }}
                                            </span>
                                        </a>
                                    </router-link>
                                </ul>
                            </div>
                        </li>
                        
                    </template>
                    
                </template>
            </ul>
        </div>
        <!-- END: Aside Menu -->
    </div>
    <!-- END: Left Aside -->
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
				this.$store.dispatch('toggleMenu', id);
			},
			activateHighlight(id) {
				this.$store.dispatch('activateHighlight', id);
			}
		},
		mounted() {
			const urlPath = this.$route.path;

			if((urlPath.match(/\//g) || []).length > 1)
				this.$store.dispatch('enableMenu', '/'+ urlPath.substring(1).match(/^([\w\-]+)/g)[0]);
		}
	}
</script>
