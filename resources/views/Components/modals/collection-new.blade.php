<div id="collectionModal" class="fixed hidden inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
    <div class="w-11/12 sm:w-full max-w-[600px] bg-bg_gray px-6 py-5 rounded-3xl shadow-md flex gap-10">
        <div class="flex-1 p-3 overflow-y-auto">
            <div class="flex justify-between items-center mb-5 sm:mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-3xl sm:text-4xl">New Collection</span>
                </div>
            </div>
            <form action="/collection"
                method="POST"
                class="flex flex-col items-center gap-3 w-full"
                onsubmit="validateForm(event)">
                @csrf
                <div class="w-full">
                    <label for="title" class="self-start font-roboto text-text_gray">Title:</label>
                    <input
                        id="collection-title"
                        type="text"
                        name="title"
                        class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white" required>
                    <span id="title-error" class="text-sm text-error font-semibold mt-1"></span>
                </div>
                <div class="w-full">
                    <label for="description" class="self-start font-roboto text-text_gray">Description:</label>
                    <textarea
                        id="collection-description"
                        name="description"
                        class="input-field font-roboto bg-bg_gray border-2 border-detail mt-2 px-4 w-full text-white"
                        required></textarea>
                    <span id="description-error" class="text-sm text-error font-semibold mt-1"></span>
                </div>
                <div class="w-full">
                    <label for="deadline" class="self-start font-roboto text-text_gray">Deadline:</label>
                    <input
                        min="y-m-d"
                        type="date"
                        id="deadline"
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
                <button onclick="closeModal()" class="mt-3 text-text_gray underline">Cancel</button>

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
    const today = new Date().toISOString().split("T")[0];

    document.getElementById("deadline").setAttribute("min", today);
</script>

<script>
    function openModal() {
        document.getElementById('collectionModal').classList.remove('hidden');
    }

    function closeModal(event) {
        document.getElementById('collectionModal').classList.add('hidden');
    }

    function validateForm(event) {
        const title = document.getElementById('collection-title');
        const description = document.getElementById('collection-description');
        const error_title = document.getElementById('title-error');
        const error_description = document.getElementById('description-error');

        if (title.value.length > 36) {
            event.preventDefault();
            error_title.textContent = 'Title must not exceed 36 characters.';
        } else if (description.value.length > 100) {
            event.preventDefault();
            error_title.textContent = '';
            error_description.textContent = 'Description must not exceed 100 characters.';
        } else {
            error_title.textContent = '';
            error_description.textContent = '';
        }
    }
</script>