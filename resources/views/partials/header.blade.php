<body class="font-[Rubik] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee] h-screen">
<header class="bg-white">
    <nav class="flex justify-between items-center w-[92%]  mx-auto">
        <div>
            <img class="w-16 cursor-pointer" src="https://cdn-icons-png.flaticon.com/512/5968/5968204.png" alt="...">
        </div>
        <div class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto  w-full flex items-center px-5">
            <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                <li>
                    <a href="{{ route('login') }}" class="hover:text-gray-500">Каталог</a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="#">Категории</a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="#">Оплата</a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="#">Доставка</a>
                </li>
                <li>
                    <a class="hover:text-gray-500" href="#">Отзывы</a>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-2">
            @guest
                <button onclick="window.location='{{ route('login') }}'"
                        class="bg-[#a6c1ee] text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Войти
                </button>
                <button onclick="window.location='{{ route('register') }}'"
                        class="bg-[#7FFF00] text-white px-5 py-2 rounded-full hover:bg-[#32CD32]">Регистрация
                </button>
            @endguest

            @auth
                <button onclick="window.location='{{ route('logout') }}'"
                        class="bg-[#DC143C] text-white px-5 py-2 rounded-full hover:bg-[#B22222]">Выйти
                </button>
            @endauth
            <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
        </div>
    </nav>
</header>


<script>
    const navLinks = document.querySelector('.nav-links')

    function onToggleMenu(e) {
        e.name = e.name === 'menu' ? 'close' : 'menu'
        navLinks.classList.toggle('top-[9%]')
    }
</script>
</body>