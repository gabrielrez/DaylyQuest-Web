<x-layouts.layout-lp>
    <header class="my-8 flex items-center justify-between">
        <h1 class="text-3xl font-poppins font-bold cursor-default">
            <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span>
        </h1>
        <div class="flex gap-3">
            <a href="/login" class="bg-secondary block hover:bg-primary px-10 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Login
            </a>
            <a href="/register" class="bg-primary block hover:bg-[#A772E8] px-20 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Start Now!
            </a>
        </div>
    </header>

    <section id="hover-section" class="mt-20 flex flex-col gap-10 md:flex-row items-center">
        <div class="md:w-1/2">
            <h1 class="text-white text-6xl font-poppins font-semibold leading-tight">Level up <br>your <span class="underline-secondary">productivity</span /> <br><span class="underline-secondary">and discipline</span></h1>
            <p class="text-text_gray text-xl mt-8">DaylyQuest helps you organize and achieve your goals with ease. Create custom collections, set deadlines, and track your progress. Make each day a quest toward your best self.</p>
        </div>
        <div class="md:w-1/2">
            <img src="<?= asset('images/lp-img.svg') ?>" alt="Level Up Image" class="w-full h-auto">
        </div>
    </section>

    <section id="inside-section" class="mt-40">
        <div class="flex flex-col">
            <h1 class="text-white text-center text-4xl font-poppins font-semibold leading-tight underline-secondary">Organize your most different goals<span class="text-secondary">!</span></h1>
            <p class="mt-6 text-white text-lg text-center font-roboto">Create custom collections, set deadlines, and track your progress.</p>
            <img class="mt-12 border-2 border-detail rounded-2xl hover:translate-y-[-8px] hover:shadow-xl hover:shadow-[rgba(41,41,41,0.1)] transition-all duration-200 ease-in-out" src="<?= asset('images/homepage-lp.png') ?>" alt="DaylyQuest homepage image">
            <a href="/register" class="self-center mt-10 text-white text-center font-poppins font-bold px-20 py-2.5 bg-detail rounded-lg hover:bg-primary hover:text-black transition-all duration-200 ease-in-out">Start Right Now!</a>
        </div>
    </section>

    <footer class="mt-20 text-white py-8">
        <div class="text-center mt-8 text-sm">
            <p>&copy; 2024 DaylyQuest. All rights reserved.</p>
        </div>
    </footer>
</x-layouts.layout-lp>