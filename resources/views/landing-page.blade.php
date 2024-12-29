<x-layouts.layout-lp>
    <header class="my-8 block md:flex items-center justify-between">
        <h1 class="text-3xl font-poppins font-bold cursor-default">
            <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span>
        </h1>
        <div class="flex gap-3 mt-8 md:mt-0">
            <a href="/login" class="bg-secondary block hover:bg-primary px-5 sm:px-10 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Login
            </a>
            <a href="/register" class="bg-primary block hover:bg-[#A772E8] px-5 sm:px-20 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Start Now!
            </a>
        </div>
    </header>

    <section id="hover-section" class="mt-8 sm:mt-20 flex flex-col gap-10 lg:flex-row items-center">
        <div class="lg:w-1/2">
            <h1 class="text-white lg:text-left text-3xl sm:text-6xl font-poppins font-semibold leading-tight">Level up <br>your <span class="underline-secondary">productivity</span /> <br><span class="underline-secondary">and discipline</span></h1>
            <p class="text-text_gray lg:text-left text-base sm:text-xl mt-3 sm:mt-8">DaylyQuest helps you organize and achieve your goals with ease. Create custom collections, set deadlines, and track your progress. Make each day a quest toward your best self.</p>
        </div>
        <div class="lg:w-1/2">
            <img src="<?= asset('images/lp-img.svg') ?>" alt="Level Up Image" class="w-full h-auto">
        </div>
    </section>

    <section class="mt-20 md:mt-40">
        <div class="flex flex-col">
            <h1 class="text-white text-center text-2xl sm:text-4xl font-poppins font-semibold leading-tight underline-secondary">Organize your most different goals<span class="text-secondary">!</span></h1>
            <p class="mt-4 sm:mt-6 text-text_gray text-base sm:text-lg text-center font-roboto">Create custom collections, set deadlines, and track your progress.</p>
            <a href="/register" class="self-center mt-5 sm:mt-10 text-center font-poppins font-bold bg-primary px-10 sm:px-20 py-2.5 shadow-xl rounded-lg hover:scale-95 transition-all duration-200 ease-in-out">
                Start Right Now!
            </a>
            <div class="relative mt-12">
                <img id="inside-img"
                    class="rounded-2xl border-2 border-detail transition-all duration-200 ease-in-out"
                    src="<?= asset('images/homepage-lp.png') ?>"
                    alt="DaylyQuest homepage image">
                <img id="logo-img"
                    style="z-index: -1;"
                    src="<?= asset('images/logotipo-test.svg') ?>"
                    alt="daylyquest logo"
                    class="hidden lg:block desapear hover-effect w-20 absolute top-[-64px] rotate-6 right-[-32px]">
            </div>
        </div>
    </section>

    <section class="mt-20 hidden lg:block">
        <div class="grid grid-cols-2 gap-10 items-center">
            <img class="mt-12 border-2 border-detail rounded-2xl shadow-xl transition-all duration-200 ease-in-out" src="<?= asset('images/collections-lp.png') ?>" alt="DaylyQuest collections interface">
            <div class="flex flex-col">
                <h1 class="text-white text-4xl font-poppins font-semibold leading-tight underline-secondary">
                    Take Control of Your Ambitions<span class="text-secondary">!</span>
                </h1>
                <p class="mt-2 text-text_gray text-lg font-roboto">
                    Create tailored collections, define deadlines, and monitor your journey to success.
                </p>
                <a href="/register" class="self-start mt-10 font-poppins font-bold bg-secondary px-20 py-2.5 shadow-xl rounded-lg hover:scale-95 transition-all duration-200 ease-in-out">
                    Join Us Today!
                </a>
            </div>
        </div>
    </section>

    <footer class="mt-10 sm:mt-20 text-white py-8">
        <div class="text-center mt-8 text-xs sm:text-sm">
            <p>&copy; 2024 DaylyQuest. All rights reserved.</p>
        </div>
    </footer>
</x-layouts.layout-lp>

<style>
    #logo-img {
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .hover-effect.down {
        transform: translate(-32px, 32px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const logo = document.querySelector('#logo-img');
        const proximityThreshold = 200;

        document.addEventListener('mousemove', (event) => {
            const rect = logo.getBoundingClientRect();
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            const distanceX = Math.abs(mouseX - (rect.left + rect.width / 2));
            const distanceY = Math.abs(mouseY - (rect.top + rect.height / 2));
            const distance = Math.sqrt(distanceX ** 2 + distanceY ** 2);

            if (distance < proximityThreshold) {
                logo.classList.add('down');
            } else {
                logo.classList.remove('down');
            }
        });
    });
</script>