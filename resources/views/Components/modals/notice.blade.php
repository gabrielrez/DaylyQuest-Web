<div id="modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-6/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">Welcome to <span class="text-primary font-bold">Dayly</span><span class="text-secondary font-bold">Quest</span> ! 🤩</h2>
        <p class="text-lg text-text_gray">You're currently using the beta version. We’d love to hear your thoughts — please share any feedback through the settings menu under "Support."<br><span class="italic block mt-2">Enjoy your experience!</span></p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="closeModal()" class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Get started!</button>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        goal_id = null;
    }
</script>