<div class="w-3/12 z-10 text-center">
    <nav class="fixed xl:ml-20 md:ml-10 xl:pt-6 h-full" style="background-color: #fdf6f6;">
        <ul class="leading-10 text-gray-500 md:w-44 xl:w-48" style="line-height: 4em;font-size: 1rem;">
            <li class="border-gray-300 border-solid border-b hover:text-gray-400"><i class="far fa-caret-square-down" style="font-size: 0.6cm;"></i>&emsp;<a href="{{ route('carts.index') }}">受注一覧</a></li>
            <li class="border-gray-300 border-solid border-b hover:text-gray-400"><i class="far fa-address-card" style="font-size: 0.6cm;"></i>&emsp;<a href="{{ route('users.manage.index') }}">顧客管理</a></li>
            <li class="border-gray-300 border-solid border-b hover:text-gray-400"><i class="fab fa-wordpress" style="font-size: 0.6cm;"></i><a href="{{ route('blogs.manageIndex') }}">&ensp;&ensp;ブログ</a></li>
            <li class="border-gray-300 border-solid border-b hover:text-gray-400"><i class="fas fa-dolly-flatbed" style="font-size: 0.6cm;"></i>&emsp;<a href="{{ route('products.manageIndex') }}">商品関連</a></li>
            <li class="border-gray-300 border-solid border-b hover:text-gray-400"><i class="fas fa-cart-plus" style="font-size: 0.6cm;"></i>&emsp;<a href="#">商品発注</a></li>
        </ul>
    </nav>
</div>
