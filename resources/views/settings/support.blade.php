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
        <div class="flex-1 p-5 sm:p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex xl:hidden items-center justify-between">
                <button id="menu-toggle" class="block xl:hidden font-poppins font-bold text-xl"><i class="fas fa-bars mr-2"></i>Menu</button>
            </div>
            <div class="flex justify-between items-center mb-5 sm:mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-2xl sm:text-4xl">Support</span>
                </div>
            </div>

            <!-- Content -->
            <div class="flex flex-col gap-4 mt-8 w-full">
                <div class="w-full block flex-col-reverse sm:flex-row flex gap-10">
                    <div class="w-full max-w-[600px]">
                        <a href="/settings" class="font-roboto text-base text-text_gray hover:underline"><i class="fa-solid fa-arrow-left"></i>Back</a>
                        <h3 class="text-2xl font-poppins font-semibold mt-1.5">How Can We Help You <span class="text-secondary">?</span></h3>
                        <p class="text-base text-text_gray font-roboto mt-1">Suggestions and feedback are always welcome!</p>
                        <form action="/support-message" id="support-form" class="flex flex-col items-center gap-3 w-full mt-5" method="POST">
                            @csrf
                            <div class="w-full">
                                <label for="name" class="self-start font-roboto text-text_gray">Your name:</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white" required />
                            </div>
                            <div class="w-full">
                                <label for="email" class="self-start font-roboto text-text_gray">Your e-mail:</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white" required />
                            </div>
                            <div class="w-full">
                                <label for="email" class="self-start font-roboto text-text_gray">Message:</label>
                                <textarea
                                    name="message"
                                    id="message"
                                    class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-4 w-full text-white"></textarea>
                            </div>
                            <button type="submit"
                                class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                                Send Message
                            </button>
                        </form>
                    </div>
                    <div class="mt-2 sm:mt-0 w-full max-w-[600px]">
                        <h3 class="text-xl sm:text-2xl font-poppins font-semibold mt-1.5">Contact</h3>
                        <ul class="flex flex-col gap-y-3 mt-3 sm:mt-8 underline text-text_gray">
                            <li class="pl-3 border-l-4 border-secondary rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-envelope fa-lg mr-3 icon-width"></i><a href="mailto:garezp.dev@gmail.com">garezp.dev@gmail.com</a></li>
                            <!-- <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-facebook fa-lg mr-3 icon-width"></i><a href="#">facebook.com/daylyquest</a></li>
                            <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-instagram fa-lg mr-3 icon-width"></i><a href="#">instagram.com/daylyquest</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-app.sidebar-mobile />
</x-layouts.layout>