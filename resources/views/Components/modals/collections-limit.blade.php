<div id="modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-11/12 md:w-8/12 lg:w-5/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">Oops... 🫢</h2>
        <p class="text-lg text-text_gray">It seems you've reached the maximum limit for your collections.</p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="closeModal()" class="border-2 border-text_gray font-bold font-poppins text-text_gray text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Return </button>
            <!-- <button onclick="alert('This is a beta version. Account upgrades are not available at this time.')" class="bg-secondary font-bold font-poppins text-bg_black text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Upgrade Account!</button> -->
        </div>
    </div>
</div>

<?= "Hello World" ?>

<script>
    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }
</script>