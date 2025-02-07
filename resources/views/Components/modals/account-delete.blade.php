<div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-11/12 md:w-8/12 lg:w-5/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">Be Careful! ⚠️</h2>
        <p class="text-lg text-text_gray">This action is permanent. Do you really want to delete your account?</p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="closeModal()" class="border-2 border-text_gray font-bold font-poppins text-text_gray text-base px-3 w-full sm:w-max sm:px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Cancel</button>
            <button onclick="deleteAccount()" class="bg-error text-bg_black font-bold font-poppins text-base px-3 w-full sm:w-max sm:px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Delete permanently</button>
        </div>
    </div>
</div>