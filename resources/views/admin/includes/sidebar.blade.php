<nav class="navbar-default navbar-static-side sidebar_background_color" role="navigation"
     style="">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li>
                <a class="d-flex p-2" href="{{ route('home') }}" target="_blank">
                    <h2 class="text-white mt-1 full-width site_title_hover">
                        <strong>
                            {{ config('app.name')  }}
                        </strong>
                    </h2>
                </a>
            </li>

            <li class="nav-header py-2 sidebar_background_color">
                <div class="dropdown profile-element">
                    <img width="48" alt="image" class="rounded-circle"
                         src="{{ isset(Auth::user()->image) ? Auth::user()->image->url : '' }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">
                            @auth
                                {{ auth()->user()->name }}
                            @endauth
                        </span>
                        <span class="text-muted text-xs block"><strong
                                class="nav-label text-white">
                                @auth
                                    {{ auth()->user()->roles()->count() ? auth()->user()->roles()->first()->name : '' }}
                                @else
                                    Administrator
                                @endauth
                            </strong><b
                                class="caret nav-label text-white"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"
                               onclick="document.getElementById('logout-form').submit()">Logout</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li class="{{ getActiveClassByRoute('admin.dashboard') }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>

            @php(@$active_class = getActiveClassByController('PermissionManageController') ||
                 getActiveClassByController('RoleManageController') ||
                 getActiveClassByController('AdminController') )
            @role('admin')


            <li class="{{ $active_class ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-users"></i>
                    <span class="nav-label">Administration</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse sidebar_background_color">
                    {{--                    <li class="{{ getActiveClassByController('PermissionManageController') }}">--}}
                    {{--                        <a href="{{ route('admin.permissions.index') }}">Manage Permission</a>--}}
                    {{--                    </li>--}}

                    <li class="{{ getActiveClassByController('RoleManageController') }}">
                        <a href="{{ route('admin.roles.index') }}">Manage Role</a>
                    </li>

                    <li class="{{ getActiveClassByRoute('admin.admins.create') }}">
                        <a href="{{ route('admin.admins.create') }}">
                            <span class="nav-label">Admin Create</span>
                        </a>
                    </li>

                    <li class="{{ getActiveClassByRoute('admin.admins.index') . getActiveClassByRoute('admin.admins.edit')}}">
                        <a href="{{ route('admin.admins.index') }}">
                            <span class="nav-label">Admin List</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endrole

            @canany(['user edit', 'user delete'])
                <li class="{{ getActiveClassByController('UserController') }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fa fa-user"></i>
                        <span class="nav-label">Users</span>
                    </a>
                </li>
            @endcanany

            @canany(['background_image create', 'background_image edit', 'background_image delete'])
                <li class="{{ getActiveClassByController('SliderBgController') }}">
                    <a href="{{ route('admin.slider-bg.index') }}">
                        <i class="fa fa-photo"></i>
                        <span class="nav-label">Background Images</span>
                    </a>
                </li>
            @endcanany

            @canany(['slider create', 'slider edit', 'slider delete', 'slider status'])
                <li class="{{ getActiveClassByController('SlidersController') }}">
                    <a href="{{ route('admin.sliders.index') }}"><i class="fa fa-photo"></i>
                        <span class="nav-label">Sliders</span>
                    </a>
                </li>
            @endcanany

            @canany(['welcome create', 'welcome edit', 'welcome delete'])
                <li class="{{ getActiveClassByController('PortfolioController') }}">
                    <a href="{{ route('admin.portfolios.index') }}"><i class="fa fa-home"></i>
                        <span class="nav-label">Welcome</span>
                    </a>
                </li>
            @endcanany

            @canany(['what_we_do create', 'what_we_do edit', 'what_we_do delete'])
                <li class="{{ getActiveClassByController('WhatWeDoController') }}">
                    <a href="{{ route('admin.what-we-do.index') }}"><i class="fa fa-briefcase"></i>
                        <span class="nav-label">What We Do</span>
                    </a>
                </li>
            @endcanany

            @canany(['featured_collaborative_brand create', 'featured_collaborative_brand edit', 'featured_collaborative_brand delete'])
                <li class="{{ getActiveClassByController('FeaturedBrandsController') }}">
                    <a href="{{ route('admin.featured-brands.index') }}" class="d-flex">
                        <div>
                            <i class="fa fa-braille"></i>
                        </div>
                        <div>
                            <span class="nav-label">Featured Collaborative Branders</span>
                        </div>
                    </a>
                </li>
            @endcanany

            @canany(['mission_and_value create', 'mission_and_value edit'])
                <li class="{{ getActiveClassByController('MissionAndValueController') }}">
                    <a href="{{ route('admin.mission_and_values.index') }}"><i class="fa fa-dashcube"></i>
                        <span class="nav-label">Mission & Values</span>
                    </a>
                </li>
            @endcanany

            @php(@$active_class = getActiveClassByController('TalentDescriptionController') || getActiveClassByController('TalentController'))
            @canany(['talent show', 'talent send message', 'talent_description create', 'talent_description edit'])
                <li class="{{ @$active_class ? 'active' : '' }}">
                    <a href="javascript:void(0)"><i class="fa fa-users"></i>
                        <span class="nav-label">Manage Talents</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse sidebar_background_color">
                        @canany(['talent show', 'talent delete', 'talent reply', 'talent reply show', 'talent reply delete'])
                            <li class="{{ getActiveClassByController('TalentController') }}">
                                <a href="{{ route('admin.talents.index') }}">Talents</a>
                            </li>
                        @endcanany
                        @canany(['talent_description create', 'talent_description edit'])
                            <li class="{{ getActiveClassByController('TalentDescriptionController') }}">
                                <a href="{{ route('admin.talent_descriptions.index') }}">Talent Description</a>
                            </li>
                        @endcanany
                    </ul>
                </li>
            @endcanany

            @canany(['message show', 'message delete', 'message reply', 'message reply show', 'message reply delete'])
                <li class="{{ getActiveClassByController('MessageController') }} {{ getActiveClassByController('ReplyController') }}">
                    <a href="{{ route('admin.messages.index') }}">
                        <i class="fa fa-envelope-o"></i>
                        <span class="nav-label">Messages</span>
                    </a>
                </li>
            @endcanany

            @canany(['social create', 'social edit', 'social delete', 'social status'])
                <li class="{{ getActiveClassByController('SocialController') }}">
                    <a href="{{ route('admin.socials.index') }}"><i class="fa fa-codepen"></i>
                        <span class="nav-label">Socials</span>
                    </a>
                </li>
            @endcanany

            @php(@$active_class = getActiveClassByController('SettingController') || getActiveClassByController('ContactController'))

            @canany(['contact create', 'contact edit', 'site_setting create', 'site_setting edit'])
                <li class="{{ $active_class ? 'active' : '' }}">
                    <a href="javascript:void(0)"><i class="fa fa-bar-chart-o"></i>
                        <span class="nav-label">Manage Settings</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse sidebar_background_color">
                        @canany(['site_setting create', 'site_setting edit'])
                            <li class="{{ getActiveClassByController('SettingController') }}">
                                <a href="{{ route('admin.settings.index') }}">Site Setting</a>
                            </li>
                        @endcanany
                        @canany(['contact create', 'contact edit'])
                            <li class="{{ getActiveClassByController('ContactController') }}">
                                <a href="{{ route('admin.contacts.index') }}">Contact</a>
                            </li>
                        @endcanany
                    </ul>
                </li>
            @endcanany
        </ul>
    </div>
</nav>
