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

        i{
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
                    <span class="font-poppins font-bold text-4xl">Support</span>
                </div>
            </div>

            <!-- Content -->
            <div class="flex flex-col gap-4 mt-8 w-full">
                <div class="w-full flex gap-10">
                    <div class="w-full max-w-[600px]">
                    <h3 class="text-2xl font-poppins font-semibold mt-1.5">How Can We Help You <span class="text-secondary">?</span></h3>
                        <form action="" class="flex flex-col items-center gap-3 w-full mt-5">
                            <div class="w-full">
                                <label for="name" class="self-start font-roboto text-text_gray">Name:</label>
                                <input
                                    type="text"
                                    name="name"
                                    class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-4 w-full text-white" required />
                            </div>
                            <div class="w-full">
                                <label for="email" class="self-start font-roboto text-text_gray">E-mail:</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-4 w-full text-white" required />
                            </div>
                            <div class="w-full">
                                <label for="email" class="self-start font-roboto text-text_gray">Message:</label>
                                <textarea 
                                name="message"
                                id="message" 
                                class="input-field font-roboto bg-bg_gray border border-2 border-detail mt-2 px-4 w-full text-white"></textarea>
                            </div>
                            <button type="submit"
                                class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
                                Send Message
                            </button>
                        </form>
                    </div>
                    <div class="w-full max-w-[600px]">
                        <h3 class="text-2xl font-poppins font-semibold mt-1.5">Contact</h3>
                        <ul class="flex flex-col gap-y-3 mt-8 underline text-text_gray">
                            <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-envelope fa-lg mr-3 icon-width"></i><a href="#">contact@daylyquest.com</a></li>
                            <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-facebook fa-lg mr-3 icon-width"></i><a href="#">facebook.com/daylyquest</a></li>
                            <li class="pl-3 border-l-4 border-detail rounded hover:border-l-8 hover:text-white transition-all duration-200 ease-in-out"><i class="fas fa-instagram fa-lg mr-3 icon-width"></i><a href="#">instagram.com/daylyquest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>