<x-layouts.layout-lp>
    <header class="my-8 flex items-center justify-between">
        <h1 class="text-3xl font-poppins font-bold cursor-default">
            <span class="text-primary">Dayly</span><span class="text-secondary">Quest</span>
        </h1>
        <div class="flex gap-3">
            <a href="/login" class="bg-secondary block hover:bg-primary px-10 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Login
            </a>
            <a href="/homepage" class="bg-primary block hover:bg-[#A772E8] px-20 py-2.5 font-poppins font-bold rounded-lg shadow-xl cursor-pointer hover:scale-95 transition-all duration-200 ease-in-out">
                Start Now!
            </a>
        </div>
    </header>

    <!-- Added an id for the section to track movement -->
    <section id="hover-section" class="mt-20 flex flex-col gap-10 md:flex-row items-center">
        <div class="md:w-1/2">
            <h1 class="text-white text-6xl font-poppins font-semibold leading-tight">Level up <br>your <span class="underline-secondary">productivity</span /> <br><span class="underline-secondary">and discipline</span></h1>
            <p class="text-text_gray text-xl mt-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Explicabo obcaecati molestiae ullam voluptatem, enim assumenda suscipit. Placeat esse expedita laudantium dicta.</p>
        </div>
        <div class="md:w-1/2">
            <img src="<?= asset('images/lp-img.svg') ?>" alt="Level Up Image" class="w-full h-auto">
        </div>
    </section>

    <script>
        const section = document.getElementById('hover-section');

        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth - e.pageX) / 250;
            const y = (window.innerHeight - e.pageY) / 250;

            section.style.transform = `translate(${x}px, ${y}px)`;
            section.style.transition = 'transform 0.1s ease-out';
        });
    </script>
</x-layouts.layout-lp>