<div id="modal_completed" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-5/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">{{ $title }}</h2>
        <p class="text-base text-text_gray">{{ $message }}</p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="document.getElementById('modal_completed').classList.add('hidden')"
                class="{{ $status === 'success' ? 'bg-secondary text-bg_black' : 'border-2 border-detail text-text_gray' }}
                    font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">
                Continue
            </button>
        </div>
    </div>
</div>