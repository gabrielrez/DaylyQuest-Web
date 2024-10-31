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
                    <span class="font-poppins font-bold text-4xl">New Collection</span>
                </div>
            </div>

            <!-- Form -->
            <div class="w-full mt-8 flex gap-10">
                <form action="/collection" method="POST" class="flex flex-col items-center gap-5 w-full">
                    @csrf
                    <input type="text" placeholder="Collection title" name="title"
                        class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
                    <input
                        type="text"
                        name="description"
                        id="collection-description"
                        placeholder="Collection description"
                        class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required />
                    <input type="date" name="deadline"
                        class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="points" value="1">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="cyclic" value="0">
                    <button type="submit"
                        class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary px-6 w-full hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
                        Create Collection
                    </button>

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
                <div class="text-text_gray font-roboto max-w-md">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem totam aliquid porro consequuntur minus atque commodi dolore voluptas dolorum est eius, hic fugit provident quaerat, perferendis qui fugiat corporis deserunt!
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout>