<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 pb-0 pt-0 overflow-y-auto">
            <!-- Header -->
            <div class="sticky top-0 z-10 py-4 bg-bg_black">
                <div class="mb-5 flex items-center justify-between sticky top-0 p-5 pl-0 z-10">
                    <div class="text-3xl font-semibold flex items-center gap-[16px]">
                        <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                        <span class="font-poppins font-bold text-4xl">Community</span>
                    </div>
                    <a href="/collection/create" class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">New Post!</a>
                </div>

                <!-- Header Menu -->
                <nav>
                    <ul class="flex gap-8 items-center pb-2 text-xl font-poppins font-semibold">
                        <li>
                            <a href="/community/filter">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-text_gray hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 18h4a1 1 0 100-2h-4a1 1 0 100 2zM4 6h16a1 1 0 100-2H4a1 1 0 100 2zm2 7h12a1 1 0 100-2H6a1 1 0 100 2z" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="/community/foryou" class="text-white underline">For You</a>
                        </li>
                        <li>
                            <a href="/community/followers" class="text-text_gray hover:underline">Followers</a>
                        </li>
                        <li>
                            <a href="/community/search" class="text-text_gray hover:underline">Search</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content Area -->
            <div class="mt-5">
                <!-- Posts Section -->
                <div class="w-full max-w-[860px] mb-8 px-6 py-5 rounded-3xl shadow-md bg-bg_gray hover:translate-y-[-8px] transition-all duration-200 ease-in-out">
                    <!-- Sample Post -->
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}" class="w-16 h-16 object-cover rounded-full border-4 border-detail bg-bg_black">
                            <h3 class="font-semibold font-poppins text-xl">Cirilo_123</h3>
                        </div>
                        <span class="text-text_gray italic font-roboto">01/11/2024</span>
                    </div>
                    <p class="mt-5 text-base text-text_gray font-roboto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis numquam quas, mollitia laboriosam deleniti incidunt eius repudiandae soluta reprehenderit iure commodi provident tempora cumque, nostrum, dolor placeat earum dolores accusantium. 🚀🚀🚀</p>
                    <div class="mt-5 flex gap-8">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="fas fa-heart text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Like</span>
                        </div>
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="far fa-comment text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Comments</span>
                        </div>
                    </div>
                </div>
                <!-- Additional posts can be added here similarly -->
                <div class="w-full max-w-[860px] mb-8 px-6 py-5 rounded-3xl shadow-md bg-bg_gray hover:translate-y-[-8px] transition-all duration-200 ease-in-out">
                    <!-- Sample Post -->
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}" class="w-16 h-16 object-cover rounded-full border-4 border-detail bg-bg_black">
                            <h3 class="font-semibold font-poppins text-xl">Cirilo_123</h3>
                        </div>
                        <span class="text-text_gray italic font-roboto">01/11/2024</span>
                    </div>
                    <p class="mt-5 text-base text-text_gray font-roboto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 😁</p>
                    <div class="mt-5 flex gap-8">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="far fa-heart text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Like</span>
                        </div>
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="far fa-comment text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Comments</span>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-[860px] mb-8 px-6 py-5 rounded-3xl shadow-md bg-bg_gray hover:translate-y-[-8px] transition-all duration-200 ease-in-out">
                    <!-- Sample Post -->
                    <div class="flex items-center justify-between">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}" class="w-16 h-16 object-cover rounded-full border-4 border-detail bg-bg_black">
                            <h3 class="font-semibold font-poppins text-xl">Cirilo_123</h3>
                        </div>
                        <span class="text-text_gray italic font-roboto">01/11/2024</span>
                    </div>
                    <p class="mt-5 text-base text-text_gray font-roboto">Lorem ipsum dolor sit amet consectetur, adipisicing elit. 😁</p>
                    <div class="mt-5 flex gap-8">
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="far fa-heart text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Like</span>
                        </div>
                        <div class="flex gap-3 items-center cursor-pointer">
                            <i class="far fa-comment text-2xl text-text_gray"></i>
                            <span class="text-lg text-text_gray font-roboto">Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>