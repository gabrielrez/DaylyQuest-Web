<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-5 sm:p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex xl:hidden items-center justify-between">
                <button id="menu-toggle" class="block xl:hidden font-poppins font-bold text-xl"><i class="fas fa-bars mr-2"></i>Menu</button>
            </div>
            <div class="flex justify-between items-center mb-6 sm:mb-12">
                <div class="text-3xl">
                    <div class="sm:flex sm:items-center gap-5 sm:gap-8">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}"
                            class="w-28 h-28 sm:w-60 sm:h-60 object-cover rounded-full border-4 border-detail bg-bg_black">
                        <div class="flex flex-col font-poppins">
                            <div class="mt-2 sm:mt-0 flex gap-5 items-baseline">
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
            <div class="sm:hidden w-full h-px bg-detail"></div>
            <div class="flex flex-col-reverse md:flex-row gap-10 md:gap-20">
                <div class="mt-0 sm:mt-10 max-w-full md:max-w-96">
                    <h3 class="font-poppins font-bold text-xl sm:text-4xl flex items-center gap-3">Achievements <a href="/achievements"><i class="fa-solid fa-circle-info text-base sm:text-lg text-text_gray hover:text-white transition-all duration-200 ease-in-out"></i></a></h3>
                    <div class="mt-5 sm:mt-8 flex justify-center sm:justify-normal gap-3 flex-wrap">
                        @if(empty($achievements))
                        <p class="font-roboto text-lg text-text_gray italic">No achievements yet...</p>
                        @else
                        @foreach($achievements as $achievement)
                        <p data-tooltip="{{ $achievement['title'] }}" class="achievement w-12 h-12 flex items-center justify-center cursor-default {{ $achievement['type'] == 'beginner' ? 'text-primary' : '' }} text-3xl hover:scale-125 transition-all duration-200 ease-in-out">
                            <i class="fa-solid {{ $achievement['icon'] }}"></i>
                        </p>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="hidden sm:block w-px h-80 bg-detail"></div>
                <div class="mt-5 sm:mt-10">
                    <h3 class="font-poppins font-bold text-xl sm:text-4xl">Current Statistics</h3>
                    <div class="mt-5 sm:mt-8 flex gap-5 sm:gap-10 flex-wrap">
                        <div class="flex gap-3 items-end">
                            @if($collections > 9)
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">{{ $collections }}</h3>
                            @else
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">0{{ $collections }}</h3>
                            @endif
                            <p class="text-text_gray italic font-poppins font-semibold text-lg">Collections</p>
                        </div>
                        <div class="flex gap-3 items-end">
                            @if($goals > 9)
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">{{ $goals }}</h3>
                            @else
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">0{{ $goals }}</h3>
                            @endif
                            <p class="text-text_gray italic font-poppins font-semibold text-lg">Goals</p>
                        </div>
                    </div>
                </div>
            </div>

            <x-app.sidebar-mobile />
</x-layouts.layout>

<style>
    .achievement {
        position: relative;
    }

    .achievement:hover::after {
        content: attr(data-tooltip);
        font-family: 'Poppins', sans-serif;
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 0 8px;
        border-radius: 8px;
        font-size: 0.75rem;
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        opacity: 1;
        visibility: visible;
        z-index: 10;
        transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
    }

    .achievement::after {
        content: '';
        position: absolute;
        opacity: 0;
        visibility: hidden;
    }
</style>