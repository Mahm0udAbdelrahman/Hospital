<!-- Start::main-sidebar-header -->
<div class="main-sidebar-header">
    <a href="index.html" class="header-logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-white.png')}}" class="desktop-white" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-white.png')}}" class="toggle-white" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-logo.png')}}" class="desktop-logo" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-dark.png')}}" class="toggle-dark" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-logo.png')}}" class="toggle-logo" alt="logo">
        <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-dark.png')}}" class="desktop-dark" alt="logo">
    </a>
</div>
<!-- End::main-sidebar-header -->
<!-- Start::main-sidebar -->
<div class="main-sidebar" id="sidebar-scroll">
    <!-- Start::nav -->
    <nav class="main-menu-container nav nav-pills flex-column sub-open">
        <div class="slide-left" id="slide-left">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
            </svg>
        </div>
        <ul class="main-menu">
            <!-- Start::slide__category -->
            <li class="slide__category"><span class="category-name">{{ __('Dashboard') }}</span></li>
            <!-- End::slide__category -->

            <!-- Start::slide -->
            <li class="slide {{ request()->segment(2) == 'admin' ? 'active' : '' }}">
                <a href="{{ route('admin') }}" class="side-menu__item">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-home side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <!-- End::slide -->

            <!-- Start::slide -->
            <li class="slide has-sub {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                <a href="javascript:void(0);" class="side-menu__item">
                    <span class="shape1"></span>
                    <span class="shape2"></span>
                    <i class="ti-wallet side-menu__icon"></i>
                    <span class="side-menu__label">{{ __('Administration') }}</span>
                    <i class="fe fe-chevron-right side-menu__angle"></i>
                </a>
                <ul class="slide-menu child1">
                    <li class="slide side-menu__label1">
                        <a href="javascript:void(0)">Crypto Currencies</a>
                    </li>
                    {{-- @can('permissions')  --}}

                    <li class="slide {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                        <a href="{{ route('permissions.index') }}" class="side-menu__item">{{ __('Permissions') }}</a>
                    </li>

                    {{-- @can('roles')  --}}
                    <li class="slide">
                        <a href="{{ route('roles.index') }}" class="side-menu__item">{{ __('Roles') }}</a>
                    </li>
                    {{-- @endcan  --}}

                    {{-- @can('admins')  --}}
                    <li class="slide">
                        <a href="{{ route('admins.index') }}" class="side-menu__item">{{ __('Admins') }}</a>
                    </li>
                    {{-- @endcan  --}}

                    {{-- @can('admins')  --}}
                    {{-- <li class="slide">
                                    <a href="{{ route('members.index') }}" class="side-menu__item">{{ __('Members') }}</a>
            </li> --}}
            {{-- @endcan  --}}

        </ul>
        </li>
        <!-- End::slide -->
        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'countries' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Countries and cities') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">
                {{-- @can('countries')  --}}
                <li class="slide">
                    <a href="{{ route('countries.index') }}" class="side-menu__item">{{ __('Countries') }}</a>
                </li>
                {{-- @endcan  --}}
                {{-- @can('cities')  --}}
                <li class="slide">
                    <a href="{{ route('cities.index') }}" class="side-menu__item">{{ __('Cities') }}</a>
                </li>
                {{-- @endcan  --}}
            </ul>
        </li>
        <!-- End::slide -->
        <!-- Start::slide -->

        <!-- End::slide -->
        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'InsuranceSections' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Insurance Sections') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">




                <li class="slide">
                    <a href="{{ route('InsuranceSections.index') }}" class="side-menu__item">{{ __('Insurance Sections') }}</a>
                </li>

            </ul>
        </li>
        <!-- End::slide -->
        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'insurances' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Insurance') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">




                <li class="slide">
                    <a href="{{ route('insurances.index') }}" class="side-menu__item">{{ __('Insurance') }}</a>
                </li>

            </ul>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'specialties' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Specialty') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">




                <li class="slide">
                    <a href="{{ route('specialties.index') }}" class="side-menu__item">{{ __('Specialty') }}</a>
                </li>






            </ul>
        </li>
        <!-- End::slide -->
        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'packages' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Packages') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">


                <li class="slide">
                    <a href="{{ route('packages.index') }}" class="side-menu__item">{{ __('Packages') }}</a>
                </li>


            </ul>
        </li>
        <!-- End::slide -->
        <!-- Start::slide -->






        <li class="slide has-sub {{ request()->segment(2) == 'categories'  ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Blog') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">


                {{-- @can('categories')  --}}
                <li class="slide">
                    <a href="{{ route('categories.index') }}" class="side-menu__item">{{ __('Categories') }}</a>
                </li>
                {{-- @endcan  --}}

                {{-- @can('posts')  --}}

                <li class="slide">
                    <a href="{{ route('posts.index') }}" class="side-menu__item">{{ __('Posts') }}</a>
                </li>
                {{-- @endcan  --}}

                {{-- <li class="slide">
                                    <a href="{{ route('asks.index') }}" class="side-menu__item">{{ __('Comments') }}</a>
        </li> --}}
        </ul>
        </li>
        <!-- End::slide -->

        <!-- Start::slide -->
        <li class="slide has-sub {{ request()->segment(2) == 'languages' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('General Settings') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('languages')  --}}

                <li class="slide">
                    <a href="{{ route('languages.index') }}" class="side-menu__item">{{ __('Languages') }}</a>
                </li>
                {{-- @endcan  --}}

                {{-- @can('settings')  --}}

                <li class="slide">
                    <a href="{{ route('settings.edit',$setting->id) }}" class="side-menu__item">{{ __('Settings') }}</a>
                </li>
                {{-- @endcan  --}}

                <li class="slide">
                    <a href="{{ route('currencies.index') }}" class="side-menu__item">{{ __('Currencies') }}</a>
                </li>

                {{-- <li class="slide">
                                    <a href="{{ route('payment-methods.index') }}" class="side-menu__item">{{ __('Payment Methods') }}</a>
        </li> --}}


        </ul>
        </li>



        <li class="slide has-sub {{ request()->segment(2) == 'hospitals' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Hospitals') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('hospitals')  --}}

                <li class="slide">
                    <a href="{{ route('hospitals.index') }}" class="side-menu__item">{{ __('Hospitals') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'doctors' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Doctor') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('doctors')  --}}

                <li class="slide">
                    <a href="{{ route('doctors.index') }}" class="side-menu__item">{{ __('Doctor') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'medical_technologies' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Medical Technologies') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('medical_technologies')  --}}

                <li class="slide">
                    <a href="{{ route('medical_technologies.index') }}" class="side-menu__item">{{ __('Medical Technology') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>



        <li class="slide has-sub {{ request()->segment(2) == 'medical_tourisms' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Medical Tourisms') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('medical_tourisms')  --}}

                <li class="slide">
                    <a href="{{ route('medical_tourisms.index') }}" class="side-menu__item">{{ __('Medical Tourisms') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>

        <li class="slide has-sub {{ request()->segment(2) == 'info_healths' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Health Info') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('medical_services')  --}}

                <li class="slide">
                    <a href="{{ route('info_healths.index') }}" class="side-menu__item">{{ __('Health Info') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'patients_rights' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Patients Rights') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('patients_rights')  --}}

                <li class="slide">
                    <a href="{{ route('patients_rights.index') }}" class="side-menu__item">{{ __('Patients Rights') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>

        <li class="slide has-sub {{ request()->segment(2) == 'patients_respons' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Patients Responsibilities') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('patients_respons')  --}}

                <li class="slide">
                    <a href="{{ route('patients_respons.index') }}" class="side-menu__item">{{ __('Patients Responsibilities') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'patients' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Patients') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('patients')  --}}

                <li class="slide">
                    <a href="{{ route('patients.index') }}" class="side-menu__item">{{ __('Patients') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>



        <li class="slide has-sub {{ request()->segment(2) == 'bookings' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Bookings') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('bookings')  --}}

                <li class="slide">
                    <a href="{{ route('bookings.index') }}" class="side-menu__item">{{ __('Bookings') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'centers' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Centers') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('centers')  --}}

                <li class="slide">
                    <a href="{{ route('centers.index') }}" class="side-menu__item">{{ __('Centers') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'sliders' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('sliders') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('sliders')  --}}

                <li class="slide">
                    <a href="{{ route('sliders.index') }}" class="side-menu__item">{{ __('sliders') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>

        <li class="slide has-sub {{ request()->segment(2) == 'manager_hospitals' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Manager Hospital') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('manager_hospitals.index')  --}}

                <li class="slide">
                    <a href="{{ route('manager_hospitals.index') }}" class="side-menu__item">{{ __('Manager Hospital') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>



        <li class="slide has-sub {{ request()->segment(2) == 'competencies' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('competencies') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('competencies.index')  --}}

                <li class="slide">
                    <a href="{{ route('competencies.index') }}" class="side-menu__item">{{ __('competencies') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'days' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('days') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('days.index')  --}}

                <li class="slide">
                    <a href="{{ route('days.index') }}" class="side-menu__item">{{ __('days') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'who_are_we' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Who Are We') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('who_are_we.index')  --}}

                <li class="slide">
                    <a href="{{ route('who_are_we.index') }}" class="side-menu__item">{{ __('Who Are We') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'goal_and_mission' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Goal And Mission') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('goal_and_mission.index')  --}}

                <li class="slide">
                    <a href="{{ route('goal_and_mission.index') }}" class="side-menu__item">{{ __('Goal And Mission') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'clinics' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Clinics') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('clinics.index')  --}}

                <li class="slide">
                    <a href="{{ route('clinics.index') }}" class="side-menu__item">{{ __('Clinics') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>


        <li class="slide has-sub {{ request()->segment(2) == 'pharmacy' ? 'active' : '' }}">
            <a href="javascript:void(0);" class="side-menu__item">
                <span class="shape1"></span>
                <span class="shape2"></span>
                <i class="ti-wallet side-menu__icon"></i>
                <span class="side-menu__label">{{ __('Pharmacies') }}</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">

                {{-- @can('pharmacy.index')  --}}

                <li class="slide">
                    <a href="{{ route('pharmacies.index') }}" class="side-menu__item">{{ __('Pharmacies') }}</a>
                </li>
                {{-- @endcan  --}}


            </ul>
        </li>





        <!-- End::slide -->
        </ul>
        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
            </svg></div>
    </nav>
    <!-- End::nav -->

</div>
<!-- End::main-sidebar -->
