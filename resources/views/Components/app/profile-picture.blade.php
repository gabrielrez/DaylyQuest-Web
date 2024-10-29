<a href="/profile" class="flex gap-3 items-center hover:bg-bg_gray rounded-full pl-5 transition-all duration-200 ease-in-out">
    <h3 class="font-bold font-poppins text-xl">{{ Auth::user()->name }}</h3>
    <img src="<?= asset('images/profile-picture-default.jpg') ?>" class="w-14 h-14 rounded-full border-2 border-detail bg-bg_black">
</a>