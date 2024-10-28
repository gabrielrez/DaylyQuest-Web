<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex items-center justify-between">
                <p class="text-text_gray font-roboto">You have <span class="font-bold text-white">07:43:26</span> left to complete your goals!</p>
                <x-profile-picture />
            </div>
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">{{ $collection['title'] }}</span>
                </div>
                <a href="/goal/create/{{ $collection['id'] }}" class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">Create Goal</a>
            </div>
            <!-- Description -->
            <p class="text-text_gray font-roboto">{{ $collection['description'] }}</p>

            <!-- Goals -->
            <div class="flex flex-col gap-4 mt-8">
                @foreach($goals as $goal)
                <div class="bg-bg_gray flex gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                    <img src="{{ asset('images/grabme.svg') }}" class="max-w-5 hover:cursor-grab">
                    <div>
                        <h3 class="text-xl mb-1 font-poppins font-medium">{{ $goal->title }}</h3>
                        <p class="text-text_gray mb-1">{{ $goal->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
</x-layouts.layout>