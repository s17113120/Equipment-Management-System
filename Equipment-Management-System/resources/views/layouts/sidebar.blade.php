<div class="sidebar-container">
    <div class="sidebar-title">
        <div class="title">
            <div class="title-first">D</div>
            <div class="title-last">EVICE</div>
        </div>
    </div>
    <div class="sidebar-content">
        <ul class="hamburger">


            @if (session()->has('userdata'))
                <li>
                    <a href="{{ url('/') }}"><i class="fas fa-home"></i>首頁</a>
                </li>
                <li>
                    <a href="{{ url('devices') }}"><i class="fas fa-search"></i>查看設備</a>
                </li>
                <li>
                    <a href="{{ url('records/create') }}"><i class="fas fa-plus"></i>設備借出</a>
                </li>
                <li>
                    <a href="{{ url('records/searchLend') }}"><i class="fas fa-paste"></i>查看借出狀態</a>
                </li>
                <li>
                    <a href="{{ url('records/searchLendHistory') }}"><i class="fas fa-paste"></i>查看借出紀錄</a>
                </li>

                @if (session('userdata')->user_authority == "management")
                    <li>
                        <a href="{{ url('devices/create') }}"><i class="fas fa-plus"></i>新增設備</a>
                    </li>
                    <li>
                        <a href="{{ url('records/checkLend') }}"><i class="fas fa-paste"></i>審核借出</a>
                    </li>
                    <li>
                        <a href="{{ url('records/lendHistory') }}"><i class="fas fa-paste"></i>審核紀錄</a>
                    </li>
                    <li>
                        <a href="{{ url('records/checkLend') }}"><i class="fas fa-chart-bar"></i>統計圖表</a>
                    </li>
                    <li>
                        <a href="{{ url('records/deviceBack') }}"><i class="fas fa-paste"></i>歸還設備</a>
                    </li>
                @elseif (session('userdata')->user_authority == "admin")
                    <li>
                        <a href="{{ url('devices/create') }}"><i class="fas fa-plus"></i>新增設備</a>
                    </li>
                    <li>
                        <a href="{{ url('records/checkLend') }}"><i class="fas fa-paste"></i>審核借出</a>
                    </li>
                    <li>
                        <a href="{{ url('records/lendHistory') }}"><i class="fas fa-paste"></i>審核紀錄</a>
                    </li>
                    <li>
                        <a href="{{ url('records/deviceBack') }}"><i class="fas fa-paste"></i>歸還設備</a>
                    </li>
                @endif

                <li>
                    <a href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i>登出</a>
                </li>
            @else
                <li>
                    <a href="{{ url('login') }}"><i class="fas fa-sign-in-alt"></i>登入</a>
                </li>
                <li>
                    <a href="{{ url('addUser') }}"><i class="fas fa-plus"></i>註冊</a>
                </li>
            @endif
        </ul>

        @if (session()->has('userdata'))
            <div class="userData">
                <div class="user-div user-icon"><i class="far fa-user fa-2x"></i></div>
                <div class="user-div user-name">{{ session('userdata')->user_name }}</div>
                <div class="user-div user-button"><div class="btn"><i class="fas fa-chevron-right"></i></div></div>
            </div>
        @endif

    </div>
</div>
