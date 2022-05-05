<div class="px-5 bg-white py-5 flex flex-col xs:flex-row items-center xs:justify-between">
    <div class="flex items-center">
        <a class="page-link" href="{{ $users->url(1) }}">
            <button type="button" class="w-full p-4 border text-base rounded-l-xl text-gray-600 bg-white hover:bg-gray-100">
                <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
                    </path>
                </svg>
            </button>
        </a>
        @if ($users->lastPage() > 1)
            @for ($i = 1; $i <= $users->lastPage(); $i++)
                @if ($i === $users->currentPage())
                    <button type="button" class="w-full px-4 py-2 border-t border-b text-base text-indigo-500 hover:bg-pink-400 bg-pink-200">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </button>
                @else
                    <button type="button" class="w-full px-4 py-2 border-t border-b text-base text-indigo-500 bg-white hover:bg-pink-200">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </button>
                @endif
            @endfor
        @else
            <button type="button" class="w-full px-4 py-2 border-t border-b text-base text-indigo-500 bg-white hover:bg-gray-100">
                <a class="page-link" href="{{ $users->url(1) }}">{{ 1 }}</a>
            </button>
        @endif
        <a class="page-link" href="{{ $users->url($users->lastPage()) }}">
            <button type="button" class="w-full p-4 border-t border-b border-r border-l text-base  rounded-r-xl text-gray-600 bg-white hover:bg-gray-100">
                <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                    </path>
                </svg>
            </button>
        </a>
    </div>
</div>
