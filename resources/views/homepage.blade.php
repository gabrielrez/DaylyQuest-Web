<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-5 sm:p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex items-center justify-between">
                <button id="menu-toggle" class="z-50 block xl:hidden font-poppins font-bold text-xl"><i class="fas fa-bars mr-2"></i>Menu</button>
                <p class="hidden lg:block text-text_gray italic text-sm sm:text-base font-roboto">Complete your goals within the set deadline!</p>
                <x-app.profile-picture />
            </div>
            <div class="block sm:flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-3xl md:text-4xl">My Collections</span>
                </div>
                <button onclick="openModal()"
                    class="mt-10 sm:mt-0 bg-primary text-bg_black font-bold font-poppins text-base px-5 sm:px-10 py-3 rounded-full shadow-md cursor-pointer hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
                    Create personalized collection
                </button>
            </div>

            <ul class="hidden sm:flex mb-10 mt-5 gap-3 font-roboto text-base">
                <li>
                    <a href="/homepage/all" class="{{ $filter === 'all' ? 'text-white opacity-100 bg-bg_gray border-2 border-detail' : 'opacity-50 text-text_gray bg-bg_gray border-2 border-detail hover:opacity-75 transition-all duration-200 ease-in-out' }} px-5 py-1.5 rounded-full"><i class="fa-solid fa-list-ul mr-2 text-sm"></i>All</a>
                </li>
                <li>
                    <a href="/homepage/completed" class=" {{ $filter === 'completed' ? 'text-white opacity-100 bg-bg_gray border-2 border-detail' : 'opacity-50 text-text_gray bg-bg_gray border-2 border-detail hover:opacity-75 transition-all duration-200 ease-in-out' }} px-5 py-1.5 rounded-full"><i class="fa-regular fa-circle-check mr-2 text-sm"></i>Completed</a>
                </li>
                <li>
                    <a href="/homepage/in-progress" class="{{ $filter === 'in-progress' ? 'text-white opacity-100 bg-bg_gray border-2 border-detail' : 'opacity-50 text-text_gray bg-bg_gray border-2 border-detail hover:opacity-75 transition-all duration-200 ease-in-out' }} px-5 py-1.5 rounded-full"><i class="fa-solid fa-spinner mr-2 text-sm"></i>In Progress</a>
                </li>
                <li>
                    <a href="/homepage/expired" class="{{ $filter === 'expired' ? 'text-white opacity-100 bg-bg_gray border-2 border-detail' : 'opacity-50 text-text_gray bg-bg_gray border-2 border-detail hover:opacity-75 transition-all duration-200 ease-in-out' }} px-5 py-1.5 rounded-full"><i class="fa-solid fa-hourglass-end mr-2 text-sm"></i>Expired</a>
                </li>
            </ul>

            <div class="flex flex-wrap md:grid md:grid-cols-2 gap-5 sm:gap-8">
                <!-- Collections -->
                @if ($collections->isEmpty())
                <div class="flex gap-8">
                    <img src="<?= asset('images/empty-collections.svg') ?>" alt="No collections" class="w-48 h-auto">
                    <p class="text-text_gray text-xl italic">No collections here...</p>
                </div>
                @endif
                @foreach ($collections as $collection)
                <a href="/collection/{{ $collection['id'] }}"
                    class="flex-1 min-w-full bg-bg_gray px-6 py-5 rounded-3xl shadow-md {{ $collection->hasExpired() ? 'opacity-50' : 'opacity-100' }} relative hover:scale-105 transition-all duration-200 ease-in-out">
                    @if ($collection->status == 'completed')
                    <i class="fas text-2xl fa-check-circle absolute top-6 right-6 text-secondary"></i>
                    @elseif($collection->hasExpired())
                    <i class="fas text-2xl fa-times-circle absolute top-6 right-6 text-error"></i>
                    @else
                    <span
                        class="absolute top-6 right-6 border-2 border-detail w-max h-6 p-3 flex items-center justify-center rounded-full text-text_gray font-poppins text-xs italic font-bold">{{ $collection['deadline'] }}</span>
                    @endif
                    @if ($collection->cyclic === 1)
                    <h3 class="text-xl mb-3 font-poppins font-medium">{{ $collection['title'] }} <i
                            class="fas text-xl fa-sync opacity-20 ml-2 cyclic-icon"></i></h3>
                    @else
                    <h3 class="text-xl mb-3 font-poppins font-medium">{{ $collection['title'] }}</h3>
                    @endif
                    <p class="text-text_gray mb-5">{{ strlen($collection['description']) > 36 ? substr($collection['description'], 0, 36) . '...' : $collection['description'] }}</p>
                    <span
                        class="text-white hover:text-text_gray underline transition-all duration-200 ease-in-out">See
                        All</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <x-app.sidebar-mobile />

    <x-modals.collection-new>
    </x-modals.collection-new>

    @if (session('show_limit_modal'))
    <x-modals.collections-limit>
    </x-modals.collections-limit>
    @endif

    @if ($show_notice_modal)
    <x-modals.notice>
    </x-modals.notice>
    @endif

</x-layouts.layout>

<style>
    .tooltip {
        position: absolute;
        background-color: #333;
        color: #fff;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        display: block;
        opacity: 0;
        transform: translate(-50%, -120%);
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        pointer-events: none;
    }

    .tooltip.show {
        opacity: 1;
        transform: translate(-50%, -100%);
    }
</style>

<script>
    let cyclic_icons = document.querySelectorAll('.cyclic-icon');

    cyclic_icons.forEach(icon => {
        const tooltip = document.createElement('div');
        tooltip.textContent = "Cyclic collection";
        tooltip.className = 'tooltip';
        document.body.appendChild(tooltip);

        icon.addEventListener('mouseover', function() {
            const rect = icon.getBoundingClientRect();
            tooltip.style.left = `${rect.left + window.scrollX + rect.width / 2}px`;
            tooltip.style.top = `${rect.top + window.scrollY - 10}px`;
            tooltip.classList.add('show');
        });

        icon.addEventListener('mouseout', function() {
            tooltip.classList.remove('show');
        });
    });
</script>