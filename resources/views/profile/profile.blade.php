<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-5 sm:p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex sm:hidden items-center justify-between">
                <button id="menu-toggle" class="block xl:hidden font-poppins font-bold text-xl"><i class="fas fa-bars mr-2"></i>Menu</button>
            </div>
            <div class="flex justify-between items-center mb-6 sm:mb-12">
                <div class="text-3xl">
                    <div class="sm:flex sm:items-center gap-5 sm:gap-8">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}"
                            class="w-20 h-20 sm:w-60 sm:h-60 object-cover rounded-full border-4 border-detail bg-bg_black">
                        <div class="flex flex-col font-poppins">
                            <div class="mt-3 sm:mt-0 flex gap-5 items-baseline">
                                <h3 class="font-bold text-xl sm:text-3xl">{{ Auth::user()->name }}</h3>
                                <a href="/profile/edit" class="text-base text-text_gray font-roboto mt-3 underline">Edit
                                    Profile<i class="fa fa-edit ml-3"></i></a>
                            </div>
                            <span class="text-lg sm:text-xl font-bold text-text_gray">{{ Auth::user()->nickname }}</span>
                            <p class="text-base mt-2 sm:mt-4 max-w-[600px] text-text_gray font-roboto">{{ Auth::user()->bio }}
                            </p>
                            <span class="text-lg sm:text-xl font-roboto font-light mt-4">Joined at
                                {{ Auth::user()->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-px bg-detail"></div>
            <div class="flex gap-20">
                <div class="mt-5 sm:mt-10">
                    <h3 class="font-poppins font-bold text-2xl sm:text-4xl">Current Statistics</h3>
                    <div class="mt-5 sm:mt-8 flex gap-3 flex-wrap">
                        <div class="flex gap-3 items-end">
                            <div class="flex gap-3 items-baseline bg-primary px-3 sm:px-6 py-2.5 sm:py-5 rounded-2xl sm:rounded-3xl shadow-md cursor-default hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                                @if($collections > 9)
                                <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-bg_black">{{ $collections }}</h3>
                                @else
                                <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-bg_black">0{{ $collections }}</h3>
                                @endif
                                <p class="text-bg_black italic font-poppins font-semibold text-lg">Collections</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-end">
                            <div class="flex gap-3 items-baseline bg-secondary px-3 sm:px-6 py-2.5 sm:py-5 rounded-2xl sm:rounded-3xl shadow-md cursor-default hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                                @if($goals > 9)
                                <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-bg_black">{{ $goals }}</h3>
                                @else
                                <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-bg_black">0{{ $goals }}</h3>
                                @endif
                                <p class="text-bg_black italic font-poppins font-semibold text-lg">Goals</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="mt-10">
                    <h3 class="font-poppins font-bold text-4xl">Achievements</h3>
                    <div class="mt-8 flex gap-3 flex-wrap">
                        <p class="bg-white px-6 py-1.5 rounded-3xl shadow-md cursor-default text-bg_black italic font-poppins font-semibold text-lg">The Hero</p>
                        <p class="bg-error px-6 py-1.5 rounded-3xl shadow-md cursor-default text-bg_black italic font-poppins font-semibold text-lg">Disciplined</p>
                    </div>
                </div> -->
            </div>

            <x-app.sidebar-mobile />
</x-layouts.layout>