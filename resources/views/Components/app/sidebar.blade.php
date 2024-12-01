<div class="w-1/6 p-6 m-8 rounded-3xl sticky top-0">
    <a href="/homepage" class="text-2xl font-bold pb-8 font-poppins">
        <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span><span class="text-xs italic ml-1.5 font-normal">Beta</span>
    </a>
    <nav class="mt-12 flex flex-col gap-y-6 text-xl font-poppins">
        <a href="/homepage" class="{{ request()->is('homepage*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            <i class="fas fa-home mr-3"></i> Home Page
        </a>
        <!-- <a href="/collection/create" class="{{ request()->is('collection/create*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            New Collection
        </a> -->
        <a href="/profile/{{ Auth::user()->id }}" class="{{ request()->is('profile*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            <i class="fas fa-user mr-3"></i> My Profile
        </a>
        <!-- <a href="/community" class="{{ request()->is('community*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            <i class="fas fa-users mr-3"></i> Community
        </a> -->
        <a href="/settings" class="{{ request()->is('settings*') ? 'text-secondary' : 'text-white hover:text-text_gray'}} block py-2 text-lg font-poppins transition-all duration-200 ease-in-out">
            <i class="fas fa-cog mr-3"></i> Settings
        </a>
        <form action="/logout" method="POST">
            @csrf
            <button class="block py-2 text-lg font-poppins hover:text-text_gray cursor-pointer transition-all duration-200 ease-in-out">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </button>
        </form>
    </nav>
</div>