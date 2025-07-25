<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li class="menu-title">
                    <span>Main</span>
                </li>

                <!-- Dashboard -->
                <!-- <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            {{__('sidebar.dashboard')}}
                        </span>
                    </a>
                </li> -->
                <!-- /Dashboard -->



                @can('deal-list')
                <li class="{{ (request()->is('admin/deal/index')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('deal.index') }}" aria-expanded="false">
                        <i data-feather="credit-card"></i>
                        <span>
                            {{__('sidebar.deal')}}
                        </span>
                    </a>
                </li>
                            @endcan      
                            @can('deal-invested-list')    
                <li class="{{ (request()->is('admin/deal/*invested*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('deal.index_invested') }}" aria-expanded="false">
                        <i data-feather="credit-card"></i>
                        <span>
                            {{__('sidebar.deal_invested')}}
                        </span>
                    </a>
                </li>
                    @endcan      
                                       
                <!-- Users -->
                @if(auth()->user()->can('user-list') || auth()->user()->can('role-list') || auth()->user()->can('permission-list') || auth()->user()->can('user-activity'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i data-feather="users"></i>
                            <span class="hide-menu">{{__('sidebar.user')}} </span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('user-list')
                                <li>
                                    <a href="{{ route('users.index') }}" title="{{__('sidebar.user')}}" class="sidebar-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.user')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('anchor-list')
                                <li>
                                    <a href="{{ route('anchor.index') }}" title="{{__('sidebar.anchor')}}" class="sidebar-link {{ (request()->is('admin/anchor*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.anchor')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('customer-list')
                                <li>
                                    <a href="{{ route('customer.index') }}" title="{{__('sidebar.customer')}}" class="sidebar-link {{ (request()->is('admin/customer*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.customer')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('deal-list')
                                <li>
                                    <a href="{{ route('deal.index') }}" title="{{__('sidebar.deal')}}" class="sidebar-link {{ (request()->is('admin/deal*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.deal')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('deal-invested-list')
                                <li>
                                    <a href="{{ route('deal.index_invested') }}" title="{{__('sidebar.deal_invested')}}" class="sidebar-link {{ (request()->is('admin/deal/index_invested*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.deal_invested')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('role-list')
                                <li>
                                    <a href="{{ route('roles.index') }}" title="{{__('sidebar.roles')}}" class="sidebar-link {{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.roles')}}</span>
                                    </a>
                                </li>
                            @endcan

                            @can('permission-list')
                                <li>
                                    <a href="{{ route('permissions.index') }}" title="{{__('sidebar.permissions')}}" class="sidebar-link {{ (request()->is('admin/permissions*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.permission')}}</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- @can('user-activity')
                                <li>
                                    <a href="/admin/user-activity" title="{{__('sidebar.user-activity')}}" class="sidebar-link {{ (request()->is('admin/setting/useractivity*')) ? 'active' : '' }}">
                                        <span class="hide-menu">{{__('sidebar.user-activity')}}</span>
                                    </a>
                                </li>
                            @endcan -->
                        </ul>
                    </li>
                @endif
                <!-- /Users -->


                


            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->
