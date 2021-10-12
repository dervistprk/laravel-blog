<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
            <div class="sidebar-brand-text mx-3">Admin Paneli</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item @if(Request::segment(2) == 'panel') active @endif">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Yönetici Paneli</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            İçerik Yönetimi
        </div>
        <li class="nav-item @if(Request::segment(2) == 'makaleler') active @endif">
            <a class="nav-link @if(Request::segment(2) == 'makaleler') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Makaleler</span>
            </a>
            <div id="collapseTwo" class="collapse @if(Request::segment(2) == 'makaleler') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Makale İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == 'makaleler' && !Request::segment(3)) active @endif" href="{{route('admin.makaleler.index')}}">Tüm Makaleler</a>
                    <a class="collapse-item @if(Request::segment(2) == 'makaleler' && Request::segment(3) == 'olustur') active @endif" href="{{route('admin.makaleler.create')}}">Makale Oluştur</a>
                </div>
            </div>
        </li>
        <li class="nav-item @if(Request::segment(2) == 'kategoriler') active @endif">
            <a class="nav-link" href="{{route('admin.category.index')}}">
                <i class="fas fa-fw fa-list"></i>
                <span>Kategoriler</span>
            </a>
        </li>
        <li class="nav-item @if(Request::segment(2) == 'sayfalar' || Request::segment(2) == 'sayfa') active @endif">
            <a class="nav-link @if(Request::segment(2) == 'sayfalar' || Request::segment(3) == 'olustur') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Sayfalar</span>
            </a>
            <div id="collapsePage" class="collapse @if(Request::segment(2) == 'sayfalar' || Request::segment(2) == 'sayfa') show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Sayfa İşlemleri</h6>
                    <a class="collapse-item @if(Request::segment(2) == 'sayfalar' && !Request::segment(3)) active @endif" href="{{route('admin.pages.index')}}">Tüm Sayfalar</a>
                    <a class="collapse-item @if(Request::segment(2) == 'sayfa' && Request::segment(3) == 'olustur') active @endif" href="{{route('admin.pages.create')}}">Sayfa Oluştur</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Site Ayarları
        </div>
        <li class="nav-item @if(Request::segment(2) == 'ayarlar') active @endif">
            <a class="nav-link" href="{{route('admin.config.index')}}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Ayarlar</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @php $admin = \App\Models\Admins::first() @endphp
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$admin->name}}</span>
                            <img class="img-profile rounded-circle" src="{{URL::asset('page_images/undraw_profile.svg')}}">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{route('admin.profile')}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.logout')}}" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Çıkış Yap
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    <a href="{{route('home')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-globe fa-sm text-white-50"></i> Siteyi Görüntüle</a>
                </div>
