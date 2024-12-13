<div id="side-menu" class="fixed left-0 top-0 z-40 w-72 bg-bg_black h-full border-r-2 border-bg_gray shadow-lg transform-translate-x-full transition-transform duration-300 ease-in-out">
    <div class="p-5">
        <div class="flex gap-5 items-center">
            <button id="close-menu" class="text-3xl font-bold text-right">&times;</button>
            <div class="text-xl font-poppins font-bold cursor-default text-center">
                <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span>
            </div>
        </div>
        <ul class="mt-10 flex flex-col gap-8">
            <li><a href="/homepage" class="{{ request()->is('homepage*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block text-lg font-poppins py-2"><i class="fas fa-home mr-3"></i>Home Page</a></li>
            <li><a href="/profile/{{ Auth::user()->id }}" class="{{ request()->is('profile*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block text-lg font-poppins py-2"><i class="fas fa-user mr-3"></i>My Profile</a></li>
            <li><a href="/settings" class="{{ request()->is('settings*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block text-lg font-poppins py-2"><i class="fas fa-cog mr-3"></i>Settings</a></li>
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="block py-2 text-lg font-poppins hover:text-text_gray cursor-pointer transition-all duration-200 ease-in-out">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
    #side-menu {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    #menu-toggle.active {
        z-index: -1;
    }
</style>

<script>
    const menu_toggle = document.getElementById('menu-toggle');
    const side_menu = document.getElementById('side-menu');
    const close_menu = document.getElementById('close-menu');

    menu_toggle.addEventListener('click', () => {
        side_menu.style.transform = 'translateX(0)';
        menu_toggle.classList.add('active');
    });

    close_menu.addEventListener('click', () => {
        side_menu.style.transform = 'translateX(-100%)';
        menu_toggle.classList.remove('active');
    });

    document.addEventListener('click', (event) => {
        if (!side_menu.contains(event.target) && !menu_toggle.contains(event.target)) {
            side_menu.style.transform = 'translateX(-100%)';
            menu_toggle.classList.remove('active');
        }
    });
</script>