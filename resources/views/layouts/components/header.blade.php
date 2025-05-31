<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                    <i class="ti ti-menu-2"></i>
                </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                    <i class="ti ti-menu-2"></i>
                </a>
                </li>
                <li class="dropdown pc-h-item d-inline-flex d-md-none">
                <a
                    class="pc-head-link dropdown-toggle arrow-none m-0"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                >
                    <i class="ti ti-search"></i>
                </a>
                <div class="dropdown-menu pc-h-dropdown drp-search">
                    <form class="px-3">
                    <div class="form-group mb-0 d-flex align-items-center">
                        <i data-feather="search"></i>
                        <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                    </div>
                    </form>
                </div>
                </li>
                <li class="pc-h-item d-none d-md-inline-flex">
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown pc-h-item">
                <a
                    class="pc-head-link dropdown-toggle arrow-none me-0"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    aria-expanded="false"
                >
                    <i class="ti ti-mail"></i>
                </a>
                <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                    <h5 class="m-0">Message</h5>
                    <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                    <div class="list-group list-group-flush w-100">
                        <a class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                            <img src="{{ asset('/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
                            </div>
                            <div class="flex-grow-1 ms-1">
                            <span class="float-end text-muted">3:00 AM</span>
                            <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.</p>
                            <span class="text-muted">2 min ago</span>
                            </div>
                        </div>
                        </a>
                        <a class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                            <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar">
                            </div>
                            <div class="flex-grow-1 ms-1">
                            <span class="float-end text-muted">6:00 PM</span>
                            <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                            <span class="text-muted">5 August</span>
                            </div>
                        </div>
                        </a>
                        <a class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                            <img src="../assets/images/user/avatar-3.jpg" alt="user-image" class="user-avtar">
                            </div>
                            <div class="flex-grow-1 ms-1">
                            <span class="float-end text-muted">2:45 PM</span>
                            <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                            <span class="text-muted">7 hours ago</span>
                            </div>
                        </div>
                        </a>
                        <a class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                            <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="user-avtar">
                            </div>
                            <div class="flex-grow-1 ms-1">
                            <span class="float-end text-muted">9:10 PM</span>
                            <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b> Meeting.</b></p>
                            <span class="text-muted">Daily scrum meeting time</span>
                            </div>
                        </div>
                        </a>
                    </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="text-center py-2">
                    <a href="#!" class="link-primary">View all</a>
                    </div>
                </div>
                </li>
                <li class="dropdown pc-h-item header-user-profile">
                <a
                    class="pc-head-link dropdown-toggle arrow-none me-0"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-haspopup="false"
                    data-bs-auto-close="outside"
                    aria-expanded="false"
                >
                    <img src="{{ asset('/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
                    <span>{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                    <div class="dropdown-header">
                    <div class="d-flex mb-1">
                        <div class="flex-shrink-0">
                        <img src="{{ asset('/assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar wid-35">
                        </div>
                        <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">{{ auth()->user()->name }}</h6>
                        <span>{{ ucwords(auth()->user()->roles->pluck('name')[0]) }}</span>
                        </div>
                    </div>
                    </div>
                    <div class="tab-content" id="mysrpTabContent">
                    <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                    </div>
                </div>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->