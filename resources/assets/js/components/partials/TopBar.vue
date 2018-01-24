<template>
	<header class="m-grid__item m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
	    <div class="m-container m-container--fluid m-container--full-height">
	        <div class="m-stack m-stack--ver m-stack--desktop">
	            <!-- BEGIN: Brand -->
	            <div class="m-stack__item m-brand  m-brand--skin-dark ">
	                <div class="m-stack m-stack--ver m-stack--general">
	                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
	                        <a href="index.html" class="m-brand__logo-wrapper">
	                            <img alt="" src="assets/demo/default/media/img/logo/logo_default_dark.png" />
	                        </a>
	                    </div>
	                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
	                        <!-- BEGIN: Left Aside Minimize Toggle -->
	                        <a href="javascript:;" @click="toggleSidebar" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
	                            <span></span>
	                        </a>
	                        <!-- END -->
	                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
	                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
	                            <span></span>
	                        </a>
	                        <!-- END -->
	                        <!-- BEGIN: Topbar Toggler -->
	                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
	                            <i class="flaticon-more"></i>
	                        </a>
	                        <!-- BEGIN: Topbar Toggler -->
	                    </div>
	                </div>
	            </div>
	            <!-- END: Brand -->
	            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
	                <!-- BEGIN: Topbar -->
	                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
	                    <div class="m-stack__item m-topbar__nav-wrapper">
	                        <ul class="m-topbar__nav m-nav m-nav--inline">
	                            <li class="
	m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-dark m-list-search m-list-search--skin-dark" data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch" data-search-type="dropdown">
	                                <a href="#" class="m-nav__link m-dropdown__toggle">
	                                    <span class="m-nav__link-icon">
	                                            <i class="flaticon-search-1"></i>
	                                        </span>
	                                </a>
	                                <div class="m-dropdown__wrapper">
	                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
	                                    <div class="m-dropdown__inner ">
	                                        <div class="m-dropdown__header">
	                                            <form class="m-list-search__form">
	                                                <div class="m-list-search__form-wrapper">
	                                                    <span class="m-list-search__form-input-wrapper">
	                                                            <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
	                                                        </span>
	                                                    <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
	                                                            <i class="la la-remove"></i>
	                                                        </span>
	                                                </div>
	                                            </form>
	                                        </div>
	                                        <div class="m-dropdown__body">
	                                            <div class="m-dropdown__scrollable m-scrollable" data-max-height="300" data-mobile-max-height="200">
	                                                <div class="m-dropdown__content"></div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </li>
	                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
	                                <a href="#" class="m-nav__link m-dropdown__toggle">
	                                    <span class="m-nav__link-icon">
	                                            <i class="flaticon-grid-menu"></i>
	                                        </span>
	                                </a>
	                            </li>
	                        </ul>
	                    </div>
	                </div>
	                <!-- END: Topbar -->
	            </div>
	        </div>
	    </div>
	</header>
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
