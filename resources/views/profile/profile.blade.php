<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-12">
                <div class="text-3xl">
                    <div class="flex items-center gap-8">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}"
                            class="w-60 h-60 object-cover rounded-full border-4 border-detail bg-bg_black">
                        <div class="flex flex-col font-poppins">
                            <div class="flex gap-5 items-baseline">
                                <h3 class="font-bold">{{ Auth::user()->name }}</h3>
                                <a href="/profile/edit" class="text-base text-text_gray font-roboto mt-3 underline">Edit
                                    Profile<i class="fa fa-edit ml-3"></i></a>
                            </div>
                            <span class="text-xl font-bold text-text_gray">{{ Auth::user()->nickname }}</span>
                            <p class="text-base mt-4 max-w-[600px] text-text_gray font-roboto">{{ Auth::user()->bio }}
                            </p>
                            <span class="text-xl font-roboto font-light mt-4">Joined at
                                {{ Auth::user()->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-px bg-detail"></div>
            <div class="mt-10">
                <h3 class="font-poppins font-bold text-4xl">Current statistics</h3>
                <div class="mt-8 flex gap-10 flex-wrap">
                    <div class="flex gap-3 items-end">
                        <div class="flex gap-3 items-baseline bg-primary px-6 py-5 rounded-3xl shadow-md cursor-default hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                            @if($collections > 9)
                            <h3 class="text-6xl font-poppins font-bold text-bg_black">{{ $collections }}</h3>
                            @else
                            <h3 class="text-6xl font-poppins font-bold text-bg_black">0{{ $collections }}</h3>
                            @endif
                            <p class="text-bg_black italic font-poppins font-semibold text-lg">Collections</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-base italic text-primary opacity-70">{{ $collections_completed }} Completed</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-end">
                        <div class="flex gap-3 items-baseline bg-secondary px-6 py-5 rounded-3xl shadow-md cursor-default hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                            @if($goals > 9)
                            <h3 class="text-6xl font-poppins font-bold text-bg_black">{{ $goals }}</h3>
                            @else
                            <h3 class="text-6xl font-poppins font-bold text-bg_black">0{{ $goals }}</h3>
                            @endif
                            <p class="text-bg_black italic font-poppins font-semibold text-lg">Goals</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-base italic text-secondary opacity-70">{{ $goals_completed }} Completed</p>
                        </div>
                    </div>
                </div>
            </div>
</x-layouts.layout>