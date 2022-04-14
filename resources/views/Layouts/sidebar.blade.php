<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dash.view') }}"> <img alt="image" style="border-radius: 50%;"
                    src="{{ asset('assets/img/selfie.jpeg') }}" class="header-logo" /> <span
                    class="logo-name">Selfie Art</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="{{ route('dash.view') }}" class="nav-link "><i
                        class="fas fa-tv"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('qr.show') }}" class="nav-link "><i
                        class="fas fa-qrcode"></i><span>QR</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('session.show') }}" class="nav-link "><i
                        class="fas fa-clock"></i><span>Session</span></a>
            </li>
            <li class="dropdown">
                <a  href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-ticket-alt"></i><span>Tickets</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('ticket.add') }}">Add Ticket</a></li>
                    <li><a class="nav-link" href="{{ route('ticket.record') }}">Ticket Records</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-cash-register"></i><span>Booking</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('booking.index') }}">Add Booking</a></li>
                    <li><a class="nav-link" href="{{ route('booking.view') }}">view Booking</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-dungeon"></i><span>Entry</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('entry.index') }}">Entry</a></li>
                    <li><a class="nav-link" href="{{ route('entry_record.index') }}">Entry Records</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-door-closed"></i><span>Lockers</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('lockers.index') }}">Lockers</a></li>
                    <li><a class="nav-link" href="{{ route('lockers.assign.view') }}">Assign Lockers</a></li>
                    <li><a class="nav-link" href="{{ route('lockers_free.view') }}">Free Lockers</a></li>
                    <li><a class="nav-link" href="{{ route('locker_records.index') }}">Lockers Records</a></li>
                </ul>
            </li>
            {{-- <li class="dropdown">
                <a  href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-door-closed"></i><span>Lockers</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('socks') }}">Lockers</a></li>
                    <li><a class="nav-link" href="{{ route('sock_transection.index') }}">Lockers Transaction</a>
                    </li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-dungeon"></i><span>Exit</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('checkout') }}">Exit</a></li>
                    <li><a class="nav-link" href="{{ route('exit_records.index') }}">Exit Records</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="{{ route('customer.record') }}" class="nav-link "><i
                        class="fas fa-table"></i><span>Customer Records</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i class="fas fa-truck-moving"></i><span>Inventory</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('products') }}">Products</a></li>
                    <li><a class="nav-link" href="{{ route('purchase') }}">Purchase</a></li>
                    <li><a class="nav-link" href="{{ route('stock') }}">Stock</a></li>
                    <li><a class="nav-link" href="{{ route('vendor') }}">Vendor</a></li>
                </ul>
            </li>
    </aside>
</div>
