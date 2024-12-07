<a href="/profile/{{ Auth::user()->id }}" class="flex gap-3 items-center hover:bg-bg_gray rounded-full pl-5 transition-all duration-200 ease-in-out">
    <h3 class="hidden sm:block font-bold font-poppins text-xl">{{ Auth::user()->name }}</h3>
    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}" class="w-14 h-14 object-cover rounded-full border-2 border-detail bg-bg_black">
</a>