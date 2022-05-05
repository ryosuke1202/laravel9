<header class="flex justify-between items-center p-5 bg-white">
    <a href="{{ route('pulchryell.index') }}"><img src="assets/images/pulchryel.png" alt="pulchryellのロゴ" class="w-24 h-10"></a>
    <nav>
        <ul class="flex">
            @can('admin')
                <li><a href="{{ route('carts.index') }}" class="mr-5 hover:text-gray-500">管理者サイトへ</a></li>
            @endcan
            @guest
                <li><a href="{{ route('register') }}" class="mr-5 hover:text-gray-500">新規会員登録</a></li>
                <li><a href="{{ route('login') }}" class="mr-5 hover:text-gray-500">ログイン</a></li>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="mr-5">
                        <i class="fas fa-sign-out-alt"></i><input type="submit" value="ログアウト" class="bg-white cursor-pointer">
                    </div>
                </form>
            @endguest
            <li><a href="#" class="w-3"><i class="fas fa-heart fa-lg text-gray-600"></i></a></li>
            <li><a href="#" class="w-3"><i class="fas fa-user-circle fa-lg text-gray-600 ml-3"></i></a></li>
            <li><a href="#" class="w-3"><i class="fas fa-shopping-cart fa-lg text-gray-600 ml-3"></i></a></li>
            <li class="block relative right-0 top-1/2 w-6 h-4 ml-3">
                <span class="block absolute w-6 h-1 bg-gray-600"></span>
                <span class="block absolute w-6 h-1 top-2 bg-gray-600"></span>
                <span class="block absolute w-6 h-1 top-4 bg-gray-600"></span>
            </li>
        </ul>
    </nav>
</header>
<!-- headerの下線 -->
<span class="h-px bg-gray-300 absolute inset-x-0"></span>
