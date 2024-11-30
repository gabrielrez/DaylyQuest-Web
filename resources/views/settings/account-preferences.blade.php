<x-layouts.layout>
    <style>
        .icon-width {
            width: 24px;
        }

        .input-field,
        .submit-btn {
            border-radius: 16px;
            padding-top: 16px;
            padding-bottom: 16px;
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
                    <span class="font-poppins font-bold text-4xl">Account preferences</span>
                </div>
            </div>

            <!-- Content -->
            <div class="flex flex-col gap-8 mt-8 max-w-[600px]">
                <div class="flex flex-col gap-3 max-w-[600px]">
                    <label class="font-poppins text-lg text-white font-medium">Theme Color:</label>
                    <select name="toggle" class="text-text_gray font-medium bg-bg_gray px-3 py-5 rounded-2xl" id="toggle_tooltips">
                        <option value="enable">Dark Theme</option>
                    </select>
                </div>

                <button class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</x-layouts.layout>