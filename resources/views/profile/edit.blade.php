<style>
    .input-field,
    .submit-btn {
        border-radius: 16px;
        padding-top: 16px;
        padding-bottom: 16px;
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
            <div class="w-full max-w-[600px] mt-8 flex gap-10">
                <form action="/user/{{ Auth::user()->id }}" method="POST" class="flex flex-col items-center gap-3 w-full" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="flex gap-3 items-center self-start mb-5">
                        <img id="preview" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}" class="w-36 h-36 object-cover rounded-full border-4 border-detail bg-bg_black">
                        <input type="file" name="profile-picture" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                    </div>
                    <div class="w-full">
                        <label for="name" class="self-start font-poppins text-text_gray">Your Name:</label>
                        <input type="text" name="name"
                            class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-6 w-full text-white" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="w-full">
                        <label for="nickname" class="self-start font-poppins text-text_gray">Your Nickname:</label>
                        <input type="text" name="nickname" class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-6 w-full text-white" value="{{ Auth::user()->nickname }}" required />
                    </div>
                    <button type="submit"
                        class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
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

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    </script>

</x-layouts.layout>