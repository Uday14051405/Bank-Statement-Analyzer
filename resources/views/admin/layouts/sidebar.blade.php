<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span></span>
                </li>

                <!-- Dashboard -->
                @can('dashboard')
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            {{__('sidebar.dashboard')}}
                        </span>
                    </a>
                </li>
                @endcan   
                <!-- /Dashboard -->

                <!-- CMS -->
                <!-- @if(auth()->user()->can('cmspage-list') || auth()->user()->can('cmscategory-list'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="file-text"></i>
                            <span class="hide-menu">{{__('sidebar.cms')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('cmscategory-list')
                                <li>
                                    <a href="{{ route('cmscategories.index') }}" title="{{__('sidebar.category')}}" class="sidebar-link {{ (request()->is('admin/cmscategories*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.category')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('cmspage-list')
                                <li>
                                    <a href="{{ route('cmspages.index') }}" title="{{__('sidebar.cms-pages')}}" class="sidebar-link {{ (request()->is('admin/cmspage*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.cms-pages')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif -->
                <!-- /CMS -->

                <!-- Users -->
                @if(auth()->user()->can('customer-list') )
        @can('user-list')
            <li class="{{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" title="{{__('sidebar.user')}}" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span>{{__('sidebar.user')}}</span>
                </a>
            </li>
        @endcan

        @can('anchor-list')
            <li class="{{ (request()->is('admin/anchor*')) ? 'active' : '' }}">
                <a href="{{ route('anchor.index') }}" title="{{__('sidebar.anchor')}}" class="sidebar-link">
                    <i data-feather="anchor"></i>
                    <span>{{__('sidebar.anchor')}}</span>
                </a>
            </li>
        @endcan

        @can('customer-list')
            <li class="{{ (request()->is('admin/customer/index')) ? 'active' : '' }}">
                <a href="{{ route('customer.index') }}" title="{{__('sidebar.customer')}}" class="sidebar-link">
                    <i data-feather="user-check"></i>
                    <span>{{__('sidebar.customer')}}</span>
                </a>
            </li>
        @endcan

        @can('customer-event')
            <li class="{{ (request()->is('admin/customer/event_list')) ? 'active' : '' }}">
                <a href="{{ route('customer.event_list') }}" title="{{__('sidebar.customer')}}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Event List</span>
                </a>
            </li>
        @endcan

        @can('customer-contact-us')
            <li class="{{ (request()->is('admin/customer/contact_us')) ? 'active' : '' }}">
                <a href="{{ route('customer.contact_us') }}" title="{{__('sidebar.customer')}}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>Contact Us</span>
                </a>
            </li>
        @endcan

        @can('deal-list')
            <li class="{{ (request()->is('admin/deal*')) ? 'active' : '' }}">
                <a href="{{ route('deal.index') }}" title="{{__('sidebar.deal')}}" class="sidebar-link">
                    <i data-feather="file-text"></i>
                    <span>{{__('sidebar.deal')}}</span>
                </a>
            </li>
        @endcan

        @can('investor-list')
            <li class="{{ (request()->is('admin/investor*')) ? 'active' : '' }}">
                <a href="{{ route('investor.index') }}" title="{{__('sidebar.investor')}}" class="sidebar-link">
                    <i data-feather="users"></i>
                    <span>{{__('sidebar.investor')}}</span>
                </a>
            </li>
        @endcan

        @can('role-list')
            <li class="{{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" title="{{__('sidebar.roles')}}" class="sidebar-link">
                    <i data-feather="shield"></i>
                    <span>{{__('sidebar.roles')}}</span>
                </a>
            </li>
        @endcan

        @can('permission-list')
            <li class="{{ (request()->is('admin/permissions*')) ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}" title="{{__('sidebar.permissions')}}" class="sidebar-link">
                    <i data-feather="lock"></i>
                    <span>{{__('sidebar.permissions')}}</span>
                </a>
            </li>
        @endcan

        <!-- @can('user-activity')
            <li class="{{ (request()->is('admin/setting/useractivity*')) ? 'active' : '' }}">
                <a href="/admin/user-activity" title="{{__('sidebar.user-activity')}}" class="sidebar-link">
                    <i data-feather="activity"></i>
                    <span>{{__('sidebar.user-activity')}}</span>
                </a>
            </li>
        @endcan -->
    @endif

                <!-- /Users -->

   <!-- Settings -->
   @if(auth()->user()->can('reports-mis') || auth()->user()->can('reports-view_mis_details') )
                    <li class="submenu " >
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings"></i>
                            <span class="hide-menu">{{__('sidebar.reports')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('reports-mis')
                                <li>
                                    <a href="{{ route('reports.mis') }}" title="{{__('sidebar.mis')}}" class="sidebar-link {{ (request()->is('admin/mis*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.mis')}}</span>
                                    </a>
                                </li>
                            @endcan

                          

                         

                           
                        </ul>
                    </li>
                @endif
                <!-- /Settings -->
                

                <!-- Settings -->
                @if(auth()->user()->can('file-manager') || auth()->user()->can('currency-list') || auth()->user()->can('websetting-edit') || auth()->user()->can('log-view'))
                    <li class="submenu " >
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="settings"></i>
                            <span class="hide-menu">{{__('sidebar.settings')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('currency-list')
                                <li>
                                    <a href="{{ route('currencies.index') }}" title="{{__('sidebar.currencies')}}" class="sidebar-link {{ (request()->is('admin/currencies*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.currency')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('websetting-edit')
                                <li>
                                    <a href="{{route('website-setting.edit')}}" title="{{__('sidebar.website-setting')}}" class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.website-setting')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('file-manager')
                                <li>
                                    <a href="{{route('filemanager.index')}}" title="{{__('sidebar.file-manager')}}" class="sidebar-link {{ (request()->is('admin/setting/file-manager*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.file-manager')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('log-view')
                                <li>
                                    <a href="/admin/log-reader" title="{{__('sidebar.read-logs')}}" class="sidebar-link {{ (request()->is('admin/setting/log*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.read-logs')}}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!-- /Settings -->

            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
