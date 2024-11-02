<style>
    .input-field,
    .submit-btn {
        border-radius: 16px;
        padding-top: 16px;
        padding-bottom: 16px;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.5);
        opacity: 1;
    }
</style>

<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">Edit Profile</span>
                </div>
            </div>

            <!-- Form -->
            <div class="w-full max-w-[680px] mt-8 flex gap-10">
                <form action="/user/{{ Auth::user()->id }}" method="POST" class="flex flex-col items-center gap-5 w-full">
                    @csrf
                    @method('PATCH')
                    <div class="flex gap-3 items-center self-start">
                        <img src="<?= asset('images/profile-picture-default.jpg') ?>" class="w-60 h-60 rounded-full border-4 border-detail bg-bg_black">
                        <input type="file" name="profile-picture">
                    </div>
                    <input type="text" placeholder="Name" name="name"
                        class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" value="{{ Auth::user()->name }}" required>
                    <input type="text" name="nickname" placeholder="Nickname" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" value="{{ Auth::user()->nickname }}" required />
                    <button type="submit"
                        class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary px-6 w-full hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
                        Save Changes
                    </button>
                    <a href="/profile" class="text-text_gray underline">Cancel</a>

                    @if($errors->any())
                    <ul class="self-start">
                        @foreach($errors->all() as $error)
                        <li class="text-sm text-error font-semibold mt-1">
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layouts.layout>