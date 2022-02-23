<div>
    <!-- Sidebar outter -->
    <div class="main-sidebar sidebar-style-2">
        <!-- sidebar wrapper -->
        <aside id="sidebar-wrapper">
            <!-- sidebar brand -->
            <div class="sidebar-brand">
                <a href="{{ route('welcome') }}">{{ config('app.name', 'Ez trans オンライン翻訳＋会話＋通訳サービス提供') }}</a>
            </div>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <!-- menu header -->
                <li class="menu-header">General</li>
                <!-- menu item -->
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-fire"></i>
                        <span>ダッシュボード</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <li class="menu-header">Profile</li>
                <li class="{{ Route::is('profile.basic') ? 'active' : '' }}">
                    <a href="{{ route('profile.basic') }}">
                        <i class="fas fa-user"></i>
                        <span>基本情報</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile.career') ? 'active' : '' }}">
                    <a href="{{ route('profile.career') }}">
                        <i class="fas fa-user"></i>
                        <span>キャリア情報</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile.payment') ? 'active' : '' }}">
                    <a href="{{ route('profile.payment') }}">
                        <i class="fas fa-user"></i>
                        <span>支払情報</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile.account') ? 'active' : '' }}">
                    <a href="{{ route('profile.account') }}">
                        <i class="fas fa-user"></i>
                        <span>口座情報</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile.password') ? 'active' : '' }}">
                    <a href="{{ route('profile.password') }}">
                        <i class="fas fa-user"></i>
                        <span>パスワードのリセット</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <li class="menu-header">
                    Service
                </li>
                <li class="{{ Route::is('express_service') ? 'active' : ''}}">
                    <a href="{{ route('express_service') }}">
                        <i class="fas fa-user"></i>
                        <span>エクスプレス</span>
                    </a>
                </li>
                <li class="{{ Route::is('sharing_service') ? 'active' : ''}}">
                    <a href="{{ route('sharing_service') }}">
                        <i class="fas fa-user"></i>
                        <span>共有</span>
                    </a>
                </li>
                <li class="{{ Route::is('translate_service') ? 'active' : ''}}">
                    <a href="{{ route('translate_service') }}">
                        <i class="fas fa-user"></i>
                        <span>翻訳する</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <li class="menu-header">
                    category
                </li>
                <li class="{{ Route::is('ec_site') ? 'active' : ''}}">
                    <a href="{{ route('ec_site') }}">
                        <i class="fas fa-user"></i>
                        <span>ECサイト</span>
                    </a>
                </li>
                <li class="{{ Route::is('travel') ? 'active' : ''}}">
                    <a href="{{ route('travel') }}">
                        <i class="fas fa-user"></i>
                        <span>旅行</span>
                    </a>
                </li>
                <li class="{{ Route::is('business_documents_emails') ? 'active' : ''}}">
                    <a href="{{ route('business_documents_emails') }}">
                        <i class="fas fa-user"></i>
                        <span>ビジネス文書・メール</span>
                    </a>
                </li>
                <li class="{{ Route::is('web_it') ? 'active' : ''}}">
                    <a href="{{ route('web_it') }}">
                        <i class="fas fa-user"></i>
                        <span>WEB、IT</span>
                    </a>
                </li>
                <li class="{{ Route::is('other') ? 'active' : ''}}">
                    <a href="{{ route('other') }}">
                        <i class="fas fa-user"></i>
                        <span>そのほか</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <li class="menu-header">Payment</li>
                <li class="{{ Route::is('payment.index') ? 'active' : '' }}">
                    <a href="{{ route('payment.index') }}">
                        <i class="fas fa-user"></i>
                        <span>支払い</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
</div>
