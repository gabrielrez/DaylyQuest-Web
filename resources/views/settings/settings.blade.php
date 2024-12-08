<x-layouts.layout>
    <style>
        .icon-width {
            width: 24px;
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
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-2xl sm:text-4xl">Settings</span>
                </div>
            </div>

            <!-- Settings Options -->
            <ul class="flex flex-col gap-4 mt-8">
                <!-- <li>
                    <a href="/settings/account/preferences" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-user fa-xl text-text_gray icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Account preferences</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="/settings/language" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-language fa-xl text-text_gray icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Language</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="settings/timezone" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-clock fa-xl text-text_gray icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Timezone</p>
                    </a>
                </li> -->
                <li>
                    <a href="/settings/support" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-headset fa-xl text-text_gray icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Support</p>
                    </a>
                </li>
                <!-- <li>
                    <a href="settings/information" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-info-circle fa-xl text-text_gray icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Information</p>
                    </a>
                </li> -->
                <li>
                    <a href="#" id="delete_btn" onclick="openModal(this)" data-id="{{ Auth::user()->id }}" class="bg-bg_gray flex items-center gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out">
                        <i class="fas fa-trash fa-xl text-error opacity-50 icon-width"></i>
                        <span class="w-0.5 h-8 bg-detail"></span>
                        <p class="text-text_gray mb-1">Delete Account</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <x-app.sidebar-mobile />
</x-layouts.layout>

<!-- Modal complete goal -->
<x-modals.account-delete>
</x-modals.account-delete>

<script>
    let user_id = document.getElementById('delete_btn').getAttribute('data-id');

    function openModal(button) {
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
    }

    async function deleteAccount() {
        try {
            const response = await fetch(`/user/${user_id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            closeModal();
            location.reload();
        } catch (error) {
            closeModal();
            location.reload();
        }
    }
</script>