<div class="w-1/6 bg-bg_gray p-6 m-8 rounded-3xl shadow-md sticky top-0">
    <div class="text-2xl text-center font-bold border-b-2 border-detail pb-8 font-poppins cursor-default">
        <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span>
    </div>
    <nav class="mt-8 flex flex-col gap-y-8 text-xl items-center font-poppins">
        <a href="/homepage" class="{{ request()->is('homepage*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            Home Page
        </a>
        <!-- <a href="/collection/create" class="{{ request()->is('collection/create*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            New Collection
        </a> -->
        <a href="/profile" class="{{ request()->is('profile*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            My Profile
        </a>
        <a href="/homepage" class="{{ request()->is('comunity*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            Comunity
        </a>
        <a href="/settings" class="{{ request()->is('settings*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            Settings
        </a>
        <form action="/logout" method="POST">
            @csrf
            <button class="block py-2 text-lg font-poppins hover:text-text_gray cursor-pointer transition-all duration-200 ease-in-out">
                Logout
            </button>
        </form>
    </nav>
</div>