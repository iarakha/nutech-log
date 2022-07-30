<!--**********************************
            Sidebar start
        ***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            @if ($role === "it")
            <li><a href="dashboard" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{{route('open_task')}}" aria-expanded="false">
                    <i class="fas fa-table"></i>
                    <span class="nav-text">Open Task</span>
                </a>
            </li>
            @endif
            @if ($role === "cs")
            <li><a href="dashboard" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{{route('wo')}}" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Trouble ET</span>
                </a>
            </li>
            <li><a href="{{route('open_task')}}" aria-expanded="false">
                    <i class="fas fa-table"></i>
                    <span class="nav-text">Open Task</span>
                </a>
            </li>
            @endif
            @if ($role === "analis")
            <li><a href="dashboard" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{{route('report')}}" aria-expanded="false">
                    <i class="fas fa-file-alt"></i>
                    <span class="nav-text">Report</span>
                </a>
            </li>
            @endif
            @if ($role === "superadmin")
            <li>
                <a href="dashboard" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{{route('wo')}}" aria-expanded="false">
                    <i class="fas fa-info-circle"></i>
                    <span class="nav-text">Trouble ET</span>
                </a>
            </li>
            <li><a href="{{route('open_task')}}" aria-expanded="false">
                    <i class="fas fa-table"></i>
                    <span class="nav-text">Open Task</span>
                </a>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('user')}}">User</a></li>
                    <li><a href="{{route('lokasi')}}">Lokasi</a></li>
                    <li><a href="{{route('perangkat')}}">Perangkat</a></li>
                    <li><a href="{{route('part')}}">Part</a></li>
                    <li><a href="{{route('jenis_masalah')}}">Jenis Masalah</a></li>
                </ul>
            </li>
            <li><a href="{{route('report')}}" aria-expanded="false">
                    <i class="fas fa-file-alt"></i>
                    <span class="nav-text">Report</span>
                </a>
            </li>
            @endif
            @if($role === "teknisi")
            <li><a href="dashboard" class="" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @endif

        </ul>

    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->