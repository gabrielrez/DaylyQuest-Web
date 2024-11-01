<div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-5/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">Did you <span class="text-secondary font-extrabold">really</span> complete it? 👀</h2>
        <p class="text-base text-text_gray">Remember, your future just depends on you!</p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="closeModal()" class="border-2 border-text_gray font-bold font-poppins text-text_gray text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Go Back</button>
            <button onclick="completeGoal()" class="bg-secondary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Yes, I did!</button>
        </div>
    </div>
</div>