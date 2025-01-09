<x-layouts.layout>
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

        i {
            width: 18px;
        }
    </style>

    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">Timezone</span>
                </div>
            </div>

            <!-- Content -->
            <form action="/timezone/{{Auth::user()->id}}" method="POST" class="flex flex-col gap-4 mt-8 max-w-[600px]">
                @csrf
                @method('PATCH')
                <a href="/settings" class="font-roboto text-base text-text_gray hover:underline"><i class="fa-solid fa-arrow-left"></i>Back</a>
                <label for="timezone" class="font-roboto text-text_gray">Select your timezone:</label>
                <select name="timezone" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
                    <option value="" disabled selected>Select Your Timezone</option>
                    @foreach (\DateTimeZone::listIdentifiers() as $timezone)
                    <option value="{{ $timezone }}" {{ $timezone === Auth::user()->timezone ? 'selected' : '' }}>
                        {{ $timezone }}
                    </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</x-layouts.layout>