<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex items-center justify-between">
                <p class="text-text_gray font-roboto">Complete your goals within the set deadline to maintain your offensive!</p>
                <x-profile-picture />
            </div>
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">My Collections</span>
                </div>
                <button class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-xl hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">Create personalized collection</button>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-2 gap-8">
                <!-- Daily Goals -->
                <div class="bg-bg_gray px-6 py-5 rounded-3xl shadow-xl relative hover:scale-105 transition-all duration-200 ease-in-out">
                    <span class="absolute top-6 right-6 bg-yellow-500 w-6 h-6 flex items-center justify-center rounded-full text-white text-xs font-bold">!</span>
                    <h3 class="text-xl mb-4 font-poppins font-medium">Dayly Goals</h3>
                    <p class="text-text_gray mb-4">Access your daily goals</p>
                    <a href="#" class="text-white hover:text-text_gray underline transition-all duration-200 ease-in-out">See All</a>
                </div>

                <!-- Monthly Goals -->
                <div class="bg-bg_gray px-6 py-5 rounded-3xl shadow-xl relative hover:scale-105 transition-all duration-200 ease-in-out">
                    <span class="absolute top-6 right-6 bg-yellow-500 w-6 h-6 flex items-center justify-center rounded-full text-white font-poppins text-xs font-bold">!</span>
                    <h3 class="text-xl mb-4 font-poppins font-medium">Monthly Goals</h3>
                    <p class="text-text_gray mb-4">Access your monthly goals</p>
                    <a href="#" class="text-white hover:text-text_gray underline transition-all duration-200 ease-in-out">See All</a>
                </div>

                <!-- Yearly Goals -->
                <div class="bg-bg_gray px-6 py-5 rounded-3xl shadow-xl relative hover:scale-105 transition-all duration-200 ease-in-out">
                    <span class="absolute top-6 right-6 bg-yellow-500 w-6 h-6 flex items-center justify-center rounded-full text-white font-poppins text-xs font-bold">!</span>
                    <h3 class="text-xl mb-4 font-poppins font-medium">Yearly Goals</h3>
                    <p class="text-text_gray mb-4">Access your yearly goals</p>
                    <a href="#" class="text-white hover:text-text_gray underline transition-all duration-200 ease-in-out">See All</a>
                </div>

                <!-- Personalized Goals -->

                @foreach($goals as $goal)
                <div class="bg-bg_gray px-6 py-5 rounded-3xl shadow-xl relative hover:scale-105 transition-all duration-200 ease-in-out">
                    <span class="absolute top-6 right-6 bg-yellow-500 w-6 h-6 flex items-center justify-center rounded-full text-white font-poppins text-xs font-bold">!</span>
                    <h3 class="text-xl mb-4 font-poppins font-medium">{{ $goal['title'] }}</h3>
                    <p class="text-text_gray mb-4">Access your {{ strtolower($goal['title']) }} goals</p>
                    <a href="#" class="text-white hover:text-text_gray underline transition-all duration-200 ease-in-out">See All</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.layout>