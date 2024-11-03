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
                    <span class="font-poppins font-bold text-4xl">Support</span>
                </div>
            </div>

            <!-- Content -->
            <div class="flex flex-col gap-4 mt-8">
                <a href="/settings" class="underline text-text_gray">Go Back</a>
                <p class="font-poppins text-lg text-text_gray mt-5">Contact our support via e-mail:</p>
                <div class="flex gap-5 items-center">
                    <i class="fas fa-envelope fa-2xl text-white icon-width"></i>
                    <a href="mailto:contact@daylyquest.com" class="text-2xl text-white underline">contact@daylyquest.com</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>