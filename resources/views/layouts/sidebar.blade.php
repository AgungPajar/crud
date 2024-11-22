<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-camera"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT. XYZ</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link dashboard" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item departemen">
        <a class="nav-link" href="{{ route('departemen.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Data Departemen</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link karyawan" href="{{ route('karyawan.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Karyawan</span></a>
    </li>

    <li class="nav-item mt-auto">
        <a class="nav-link logout btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>


</ul>


{{-- Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/sesi/logout">Logout</a>
            </div>
        </div>
    </div>
</div>


{{-- CSS TAMBAHANNA --}}
<style>
    .sidebar {
        background: #343a40;
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        transition: background-color 0.3s, color 0.3s;
    }

    .sidebar .nav-link:hover {
        color: white;
    }

    .dashboard {
        background-color: #4b5764;
    }

    .departemen {
        background-color: #4b5764;
    }

    .karyawan {
        background-color: #4b5764;
    }

    .logout {
        background-color: #4b5764;
    }

    .dashboard:hover {
        background-color: #be5b5b;
    }

    .departemen:hover {
        background-color: #5bafbe;
    }

    .karyawan:hover {
        background-color: #5d5bbe;
    }

    .logout:hover {
        background-color: #884d4d;
    }

    .sidebar .nav-item.active .nav-link {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .sidebar-brand {
        font-size: 1.5rem;
        font-weight: 600;
    }
</style>
