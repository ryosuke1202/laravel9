<div class=" w-full z-20 flex place-content-between px-9 fixed items-center shadow" style="height: 68.8px;background-color: #333131;">
    <h2 class="text-3xl container w-80 text-gray-300" style="font-family: 'ヒラギノ角ゴ StdN'">管理者用サイト</h2>
    <div class="relative ">
        @csrf
            <carts-order-number-input
            :autocomplete-items='@json($orderNumbers ?? [])'
            >
            </carts-order-number-input>
    </div>
    <div class="flex">
        <p class="text-gray-300 text-1xl mr-5"><i class="far fa-user"></i>&nbsp;株式会社オータムさん</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="text-gray-300">
                <i class="fas fa-sign-out-alt"></i><input type="submit" value="ログアウト">
            </div>
        </form>
    </div>
</div>
