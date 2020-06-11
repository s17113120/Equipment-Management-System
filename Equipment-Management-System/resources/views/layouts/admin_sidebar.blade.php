<div class="sidebar-container">
    <div class="sidebar-title">
        <div class="title">
            <div class="title-first">D</div>
            <div class="title-last">EVICE</div>
        </div>
    </div>
    <div class="sidebar-content">
        <ul class="hamburger">
            <li>
                <a href="{{ url('/') }}"><i class="fas fa-home"></i>首頁</a>
            </li>
            <li>
                <a href="{{ url('devices') }}"><i class="fas fa-search"></i>查看設備</a>
            </li>
            <li>
                <a href="{{ url('devices/create') }}"><i class="fas fa-plus"></i>新增設備</a>
            </li>
            <li>
                <a href="{{ url('records/create') }}"><i class="fas fa-plus"></i>設備借出</a>
            </li>
            <li>
                <a href="{{ url('records/searchLend') }}"><i class="fas fa-paste"></i>查看個人借出</a>
            </li>
            <li>
                <a href="{{ url('records/checkLend') }}"><i class="fas fa-paste"></i>審核借出</a>
            </li>

            <li>
                <a href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i>登出</a>
            </li>

        </ul>
        <div class="userData">
            <div class="user-div user-icon"><i class="far fa-user fa-2x"></i></div>
            <div class="user-div user-name">{{ session('userdata')->user_name }}</div>
            <div class="user-div user-button"><div class="btn"><i class="fas fa-chevron-right"></i></div></div>
        </div>
    </div>
</div>
