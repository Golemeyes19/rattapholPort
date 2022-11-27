<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar">
	<ul class="side-menu toggle-menu">
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.websetting.websetting.edit') }}"><i class="side-menu__icon ion-gear-b"></i><span class="side-menu__label active"> {{ __('menu_admin.websetting') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.user.user.index') }}"><i class="side-menu__icon ion-person-stalker"></i><span class="side-menu__label active"> {{ __('menu_admin.admin') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.dashboard.dashboard.index') }}"><i class="side-menu__icon ion-gear-b"></i><span class="side-menu__label active"> {{ __('menu_admin.dashboard') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.menu.menu.index') }}"><i class="side-menu__icon ion-navicon-round"></i><span class="side-menu__label active"> {{ __('menu_admin.menu') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.about.about.index') }}"><i class="side-menu__icon ion-information-circled"></i><span class="side-menu__label active"> {{ __('menu_admin.about_us') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.banner.banner.index') }}"><i class="side-menu__icon ion-images"></i><span class="side-menu__label active"> {{ __('menu_admin.banner') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.page.page.index') }}"><i class="side-menu__icon ion-clipboard"></i><span class="side-menu__label active"> {{ __('menu_admin.pages') }}</span></a>
		</li> 
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon ion-speakerphone"></i><span class="side-menu__label active">{{ __('menu_admin.news') }}</span><i class="angle fa  fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item"  href="{{ route('admin.news.news.index_news_category') }}"><span> {{ __('menu_admin.news_categories') }}</span></a></li>
				<li><a class="slide-item" href="{{ route('admin.news.news.index') }}"><span> {{ __('menu_admin.news') }}</span></a></li>
			</ul>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="{{ route('admin.filemanager.filemanager.index') }}"><i class="side-menu__icon ion-folder"></i><span class="side-menu__label active">{{ __('menu_admin.manage_files') }}</span></a>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon ion-alert"></i><span class="side-menu__label active">{{ __('menu_admin.privacy_policy') }}</span><i class="angle fa  fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item"  href="{{ route('admin.pdpa.pdpa.index') }}"><span> {{ __('menu_admin.pdpa') }}</span></a></li>
				<li><a class="slide-item" href="{{ route('admin.pdpa.pdpa.pdpa_detail') }}"><span> {{ __('menu_admin.pdpa_detail') }}</span></a></li>
			</ul>
		</li>
		<li class="slide">
			<a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon ion-email"></i><span class="side-menu__label active">{{ __('menu_admin.contact_us') }}</span><i class="angle fa  fa-angle-right"></i></a>
			<ul class="slide-menu">
				<li><a class="slide-item"  href="{{ route('admin.contactus.contactus.edit_contact_page') }}"><span> {{ __('menu_admin.contact_us_info') }}</span></a></li>
				<li><a class="slide-item" href="{{ route('admin.contactus.contactus.index') }}"><span> {{ __('menu_admin.contact_list') }}</span></a></li>
				<li><a class="slide-item" href="{{ route('admin.contactus.contactus.subject_index') }}"><span> {{ __('menu_admin.contact_subject_list') }}</span></a></li>
			</ul>
		</li>
	</ul>
	<!-- .Zcom menu -->

</aside>
<!--sidemenu end-->
