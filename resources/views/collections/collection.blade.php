<x-layouts.layout>

    @if(session('expired'))
    <div id="modal" class="fixed inset-0 z-50 bg-black bg-opacity-75 flex items-center justify-center">
        <div class="bg-bg_gray rounded-3xl shadow-md w-5/12 px-9 py-8">
            <h2 class="text-3xl font-poppins font-semibold mb-4">Oops! ⌛</h2>
            <p class="text-base text-text_gray">{{ session('expired') }}</p>
            <div class="flex gap-x-5 mt-10 justify-end">
                <button onclick="closeModal()" class="border-2 border-text_gray font-bold font-poppins text-text_gray text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Ok, continue</button>
            </div>
        </div>
    </div>
    @endif

    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex items-center justify-between">
                <p class="text-text_gray font-roboto">You have until <span class="font-bold text-white">{{ $deadline }}</span> to complete this collection.</p>
                <x-app.profile-picture />
            </div>
            <div class="flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-4xl">{{ $collection['title'] }}</span>
                </div>
                <a href="/goal/create/{{ $collection['id'] }}" class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">Create Goal</a>
            </div>
            <!-- Description -->
            <p class="text-text_gray font-roboto">{{ $collection['description'] }}</p>

            <!-- Goals -->
            <ul class="flex flex-col gap-4 mt-8">
                @foreach($goals as $goal)
                <li class="bg-bg_gray flex gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out {{ $goal->status === 1 ? 'opacity-50' : 'opacity-100' }}">
                    <img src="{{ asset('images/grabme.svg') }}" class="max-w-5 hover:cursor-grab">
                    <div class="w-full flex items-center justify-between">
                        <div>
                            <h3 class="text-xl mb-1 font-poppins font-medium">{{ $goal->title }}</h3>
                            <p class="text-text_gray mb-1">{{ $goal->description }}</p>
                        </div>
                        <div>
                            <button onclick="openModal(this)" data-id="{{ $goal->id }}" data-status="{{ $goal->status }}" class="border-2 font-poppins font-semibold px-6 py-3 rounded-3xl transition-all duration-200 ease-in-out {{ $goal->status === 0 ? 'border-detail text-white hover:scale-105 hover:bg-secondary hover:border-secondary hover:text-bg_black' : 'bg-secondary border-secondary text-bg_black hover:scale-105' }}">
                                {{ $goal->status === 0 ? 'Complete' : 'Completed' }}
                            </button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
</x-layouts.layout>

<!-- Modal complete goal -->
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

<!-- Modal completed -->
@if($completed)
<div id="modal_completed" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
    <div class="bg-bg_gray rounded-3xl shadow-md w-5/12 px-9 py-8">
        <h2 class="text-3xl font-poppins font-semibold mb-4">Congrats! 🎉</h2>
        <p class="text-base text-text_gray">You've completed this collection!</p>
        <div class="flex gap-x-5 mt-10 justify-end">
            <button onclick="document.getElementById('modal_completed').classList.add('hidden')" class="bg-secondary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md cursor-pointer hover:scale-105 transition-all duration-200 ease-in-out">Continue</button>
        </div>
    </div>
</div>
@endif

<script>
    let goal_id = null;

    function openModal(button) {
        goal_id = button.getAttribute('data-id');
        const status = button.getAttribute('data-status');

        if (status == 0) {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
        } else {
            completeGoal();
        }
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        goal_id = null;
    }

    async function completeGoal() {
        if (!goal_id) return;

        try {
            const response = await fetch(`/goal/complete/${goal_id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    _method: 'PUT'
                })
            });
            closeModal();
            location.reload();
        } catch (error) {
            alert('Ops, something went wrong while trying complete goal, please contact suport.');
            closeModal();
            location.reload();
        }
    }
</script>