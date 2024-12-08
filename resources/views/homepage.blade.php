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

            <div class="flex flex-wrap md:grid md:grid-cols-2 gap-5 sm:gap-8">
                <!-- Collections -->
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
                    <h3 class="text-xl mb-4 font-poppins font-medium">{{ $collection['title'] }} <i
                            class="fas text-xl fa-sync opacity-20 ml-2"></i></h3>
                    @else
                    <h3 class="text-xl mb-4 font-poppins font-medium">{{ $collection['title'] }}</h3>
                    @endif
                    <p class="text-text_gray mb-4">Access your {{ strtolower($collection['title']) }} goals</p>
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