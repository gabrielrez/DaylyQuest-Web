<x-layouts.layout>
    <style>
        .icon-width {
            width: 24px;
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
                    <span class="font-poppins font-bold text-4xl">Information</span>
                </div>
            </div>

            <!-- Content -->
            <div class="flex flex-col gap-4 mt-8">

                <ul class="flex flex-col gap-y-3 mt-5 underline text-text_gray">
                    <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 transition-all duration-200 ease-in-out"><a href="#">contact@daylyquest.com</a></li>
                    <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 transition-all duration-200 ease-in-out"><a href="#">facebook.com/daylyquest</a></li>
                    <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 transition-all duration-200 ease-in-out"><a href="#">instagram.com/daylyquest</a></li>
                    <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 transition-all duration-200 ease-in-out"><a href="#">youtube.com/daylyquest</a></li>
                    <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 transition-all duration-200 ease-in-out"><a href="#">linkedin.com/company/daylyquest</a></li>
                </ul>
                <p class="text-base text-text_gray mt-5">
                    <span class="font-bold text-white italic">Tax ID:</span> 11.111.111/1111-11
                    <br>
                    <span class="font-bold text-white italic">Address:</span> Rua Nome Rua, 111, 11th floor, Suite 1111 - Bairro - City - State - ZIP Code: 11111-111
                    <br>
                    <br>
                    <span class="font-bold italic">DaylyQuest © 2025. Some Rights Reserved.</span>
                </p>
            </div>
        </div>
    </div>
</x-layouts.layout>