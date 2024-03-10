<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <img src="{{ asset('template/dist/assets/compiled/svg/circles.svg') }}" alt="circles">
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                        role="img" class="iconify iconify--system-uicons" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ $active === 'Dashboard' ? 'active' : '' }}">
                    <a href="/dashboard" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title">Data User</li>

                {{-- Admin Sidebar --}}
                @if (Auth::user() && Auth::user()->role === 'admin')
                    <li class="sidebar-item {{ $active === 'Pengguna' ? 'active' : '' }}">
                        <a href="{{ url('pengguna') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $active === 'verifikasi' ? 'active' : '' }}">
                        <a href="{{ route('verifikasi.index') }}" class='sidebar-link'>
                            <i class="bi bi-check-square"></i>
                            <span>Verifikasi</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Data Master</li>

                    <li class="sidebar-item {{ $active == 'Jabatan' ? 'active' : '' }}">
                        <a href="{{ url('jabatan') }}" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Data Jabatan</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-item has-sub {{ $active == 'BP' || $active == 'BPP' || $active == 'PPK' || $active == 'PPTK' || $active == 'KPA' || $active == 'PA' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Pegawai</span>
                        </a>

                        <ul
                            class="submenu {{ $active == 'BP' || $active == 'BPP' || $active == 'PPK' || $active == 'PPTK' || $active == 'KPA' || $active == 'PA' ? 'active' : '' }}">

                            <li class="submenu-item {{ $active == 'BP' ? 'active' : '' }} ">
                                <a href="{{ route('data-bp') }}" class="submenu-link"> <i
                                        class="bi bi-file-earmark-text-fill"></i>
                                    Biodata BP</a>
                            </li>
                            <li class="submenu-item {{ $active == 'BPP' ? 'active' : '' }}">
                                <a href="{{ route('data-bpp') }}" class="submenu-link"><i
                                        class="bi bi-file-earmark-fill"></i> Biodata
                                    BPP</a>
                            </li>

                            <li class="submenu-item {{ $active == 'KPA' ? 'active' : '' }}">
                                <a href="{{ route('data-kpa') }}" class="submenu-link"><i
                                        class="bi bi-file-diff-fill"></i> Biodata
                                    KPA</a>
                            </li>
                            <li class="submenu-item {{ $active == 'PA' ? 'active' : '' }}">
                                <a href="{{ route('data-pa') }}" class="submenu-link"> <i
                                        class="bi bi-file-earmark-plus-fill"></i>
                                    Biodata PA</a>
                            </li>
                            <li class="submenu-item {{ $active == 'PPTK' ? 'active' : '' }}">
                                <a href="{{ route('data-pptk') }}" class="submenu-link"><i
                                        class="bi bi-file-earmark-text-fill"></i>
                                    Biodata PPTK</a>
                            </li>
                            <li class="submenu-item {{ $active == 'PPK' ? 'active' : '' }}">
                                <a href="{{ route('data-ppk') }}" class="submenu-link"><i
                                        class="bi bi-file-earmark-text-fill"></i>
                                    Biodata PPK</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-earmark-medical-fill"></i>
                            <span>Document</span>
                        </a>

                        <ul class="submenu">

                            <li class="submenu-item {{ $title === 'Bp' ? 'active' : '' }} ">
                                <a href="{{ route('doc.bp.index') }}" class="submenu-link"> <i
                                        class="bi bi-file-earmark-text-fill"></i>
                                    Document BP</a>

                            </li>

                            <li class="submenu-item {{ $title === 'Bpp' ? 'active' : '' }}">
                                <a href="{{ route('acc.bpp.index') }}" class="submenu-link"><i
                                        class="bi bi-file-earmark-fill"></i>
                                    Document
                                    BPP</a>

                            </li>

                            <li class="submenu-item {{ $title === 'acc_kpa' ? 'active' : '' }}">
                                <a href="{{ route('acc.kpa.index') }}" class="submenu-link"><i
                                        class="bi bi-file-diff-fill"></i> Document
                                    KPA</a>

                            </li>

                            <li class="submenu-item {{ $title === 'Pa' ? 'active' : '' }}">
                                <a href="{{ route('acc.pa.index') }}" class="submenu-link"> <i
                                        class="bi bi-file-earmark-plus-fill"></i>
                                    Document PA</a>

                            </li>

                            <li class="submenu-item {{ $title === 'Ppk' ? 'active' : '' }}">
                                <a href="/ppk" class="submenu-link"><i class="bi bi-file-earmark-text-fill"></i>
                                    Document
                                    PPK</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ $active === 'Pengajuan' ? 'active' : '' }}">
                        <a href="/pengajuan" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Pengajuan</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Bukti-pengeluaran' ? 'active' : '' }}">
                        <a href="{{ route('bukti.pengeluaran') }}" class='sidebar-link'>
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Bukti Pengeluaran</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Spj' ? 'active' : '' }}">
                        <a href="/spj" class='sidebar-link'>
                            <i class="bi bi-journal-text"></i>
                            <span>SPJ</span>
                        </a>
                    </li>

                    {{-- BP Sidebar --}}
                @elseif (Auth::user() && Auth::user()->role === 'bp')
                    <li class="sidebar-item {{ $title === 'Profile' ? 'active' : '' }}">
                        <a href="/profile" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $title === 'Document-Bp' ? 'active' : '' }}">
                        <a href="/doc-bp" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Document</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'SPJ' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>SPJ</span>
                        </a>
                    </li>

                    {{-- BPP Sidebar --}}
                @elseif (Auth::user() && Auth::user()->role === 'bpp')
                    <li class="sidebar-item {{ $title === 'Profile' ? 'active' : '' }}">
                        <a href="/profile" class='sidebar-link'>
                            <i class='fas fa fa-user'></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Pengajuan' ? 'active' : '' }}">
                        <a href="/pengajuan-index" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Pengajuan (mengajukan)</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Tanda Bukti' ? 'active' : '' }}">
                        <a href="/bukti-bpp" class='sidebar-link'>
                            <i class="fas fa fa-check-circle"></i>
                            <span>Tanda Bukti</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'SPJ' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>SPJ</span>
                        </a>
                    </li>

                    {{-- Kpa Sidebar --}}
                @elseif (Auth::user() && Auth::user()->role === 'kpa')
                    <li class="sidebar-item {{ $title === 'Profile' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class='fas fa fa-user'></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Pengajuan' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Pengajuan (mengajukan)</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'Tanda Bukti' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="fas fa fa-check-circle"></i>
                            <span>Tanda Bukti</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'SPJ' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>SPJ</span>
                        </a>
                    </li>
                @elseif (Auth::user() && Auth::user()->role === 'pa')
                    <li class="sidebar-item {{ $title === 'Profile' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class='fas fa fa-user'></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'SPJ' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>SPJ (On Progress)</span>
                        </a>
                    </li>
                @elseif (Auth::user() && Auth::user()->role === 'pptk')
                    <li class="sidebar-item {{ $title === 'Profile' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class='fas fa fa-user'></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ $title === 'SPJ' ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>SPJ (CUMA BISA LIHAT)</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a href="/logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-door-closed-fill"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
