<div id="collectionModal" class="fixed hidden inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
    <div class="w-full max-w-[600px] bg-bg_gray px-6 py-5 rounded-3xl shadow-md flex gap-10">
        <div class="flex-1 p-3 overflow-y-auto">
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">New Collection</span>
                </div>
            </div>
            <form action="/collection" method="POST" class="flex flex-col items-center gap-3 w-full">
                @csrf
                <div class="w-full">
                    <label for="title" class="self-start font-roboto text-text_gray">Title:</label>
                    <input
                        type="text"
                        name="title"
                        class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white" required>
                </div>
                <div class="w-full">
                    <label for="description" class="self-start font-roboto text-text_gray">Description:</label>
                    <textarea
                        name="description"
                        class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white"
                        required></textarea>
                </div>
                <div class="w-full">
                    <label for="deadline" class="self-start font-roboto text-text_gray">Deadline:</label>
                    <input
                        type="date"
                        name="deadline"
                        class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white" required>
                </div>
                <input type="hidden" name="status" value="inProgress">
                <input type="hidden" name="points" value="1">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="cyclic" value="0">
                <button type="submit"
                    class="submit-btn font-poppins text-lg text-bg_black font-semibold bg-primary mt-5 px-6 w-full hover:bg-[#A772E8] hover:translate-y-[-4px] transition-all duration-200 ease-in-out">
                    Create Collection
                </button>
                <button onclick="closeModal()" class="text-text_gray underline">Cancel</button>

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

<script>
    function openModal() {
        document.getElementById('collectionModal').classList.remove('hidden');
    }

    function closeModal(event) {
        document.getElementById('collectionModal').classList.add('hidden');
    }
</script>