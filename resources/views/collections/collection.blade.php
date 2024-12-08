<x-layouts.layout>
    <div class="flex h-screen overflow-hidden">
        <x-app.sidebar />
        <!-- Main Content -->
        <div class="flex-1 p-5 sm:p-10 overflow-y-auto">
            <!-- Header -->
            <div class="mb-10 flex items-center justify-between">
                @if(!$collection->hasExpired() && !$collection->isCompleted())
                <p class="hidden sm:block text-text_gray italic font-roboto">You have until <span class="font-bold text-white">{{ $deadline }}</span> to complete this collection.</p>
                @endif
                @if($collection->hasExpired() && !$collection->isCompleted())
                <p class="hidden sm:block text-error italic font-roboto">This collection has expired on {{ $deadline }}.</p>
                @endif
                @if($collection->isCompleted())
                <p class="hidden sm:block text-secondary italic font-roboto">You've completed this collection.</p>
                @endif
                <button id="menu-toggle" class="block xl:hidden font-poppins font-bold text-xl"><i class="fas fa-bars mr-2"></i>Menu</button>
                <x-app.profile-picture />
            </div>
            <div class="block sm:flex justify-between items-center mb-10">
                <div class="text-3xl font-semibold flex items-center gap-[16px]">
                    <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
                    <span class="font-poppins font-bold text-3xl md:text-4xl">{{ $collection['title'] }}</span>
                    <div class="flex gap-1.5 items-center">
                        <svg class="w-10 h-10 ml-4" viewBox="0 0 36 36" class="circular-chart" xmlns="http://www.w3.org/2000/svg">
                            <path class="circle-bg" fill="none" stroke="#1E1E1E" stroke-width="4" d="M18 2 a16 16 0 1 1 0 32 a16 16 0 1 1 0 -32" />
                            <path class="circle" fill="none" stroke="#03DAC6" stroke-width="4" stroke-dasharray="{{ $completion_percentage }}, 100" d="M18 2 a16 16 0 1 1 0 32 a16 16 0 1 1 0 -32" />
                        </svg>
                        <span class="text-base text-poppins {{ $collection->isCompleted() ? 'text-secondary' : 'text-text_gray' }} font-semibold italic">{{ number_format($completion_percentage, 0) }}%</span>
                    </div>
                </div>
                <div class="mt-10 sm:mt-0">
                    @if($collection['cyclic'] != 1)
                    <a href="#" id="delete-collection-btn" data-id="{{ $collection['id'] }}" class=" mr-3 text-error underline font-roboto">Delete Collection</a>
                    @endif
                    <button onclick="openNewGoalModal()" class="bg-primary text-bg_black font-bold font-poppins text-base px-10 py-3 rounded-full shadow-md hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">Create Goal</button>
                </div>
            </div>
            <!-- Description -->
            <div class="flex items-center gap-5">
                <p class="text-text_gray text-lg font-roboto">{{ $collection['description'] }}</p>
                <i onclick="openEditCollectiomModal()" class="fas fa-edit text-text_gray cursor-pointer hover:text-white transition-all duration-200 ease-in-out" id="edit-icon" data-id="{{ $collection['id'] }}"></i>
            </div>

            <!-- Goals -->
            <ul id="goal-list" class="flex flex-col gap-4 mt-8">
                @foreach($goals as $goal)
                <li class="group bg-bg_gray flex gap-5 px-6 py-5 rounded-3xl shadow-md relative hover:translate-x-3 transition-all duration-200 ease-in-out {{ $goal->status === 'completed' || $goal->collection->hasExpired() ? 'opacity-50' : 'opacity-100' }}"
                    data-id="{{ $goal->id }}">
                    <img src="{{ asset('images/grabme.svg') }}" class="dont-open-steps max-w-6 hover:cursor-grab grab-handle">
                    <div class="w-full block sm:flex gap-3 items-center justify-between">
                        <div>
                            <h3 class="text-lg sm:text-xl mb-1 font-poppins font-medium">{{ $goal->title }}</h3>
                            <p class="text-text_gray text-sm sm:text-base mb-1">{{ $goal->description }}</p>
                        </div>
                        <div class="mt-3 sm:mt-0 flex items-center gap-3">
                            <button onclick="openModal(this)" data-id="{{ $goal->id }}" data-status="{{ $goal->status }}"
                                class="dont-open-steps w-full sm:w-max border-2 font-poppins font-semibold px-6 py-3 rounded-2xl sm:rounded-3xl transition-all duration-200 ease-in-out {{ $goal->status === 'inProgress' ? 'border-detail text-white hover:scale-105 hover:bg-secondary hover:border-secondary hover:text-bg_black' : 'bg-secondary border-secondary text-bg_black hover:scale-105' }}">
                                {{ $goal->status === 'inProgress' ? 'Complete' : 'Completed' }}
                            </button>
                            <form action="/goal/{{ $goal['id'] }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dont-open-steps text-text_gray underline hover:text-error font-roboto"><i class="fas fa-xmark text-xl"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
</x-layouts.layout>

<x-app.sidebar-mobile />

<!-- Modal complete goal -->
<x-modals.goal-complete>
</x-modals.goal-complete>

<!-- Modal new goal -->
<x-modals.goal-new :collection="$collection">
</x-modals.goal-new>

<!-- Modal edit collection -->
<x-modals.collection-description-edit :collection="$collection">
</x-modals.collection-description-edit>

<!-- Modal status -->
@if($status != null)
<x-modals.collection-status
    :title="$status['title']"
    :message="$status['message']"
    :status="$status['status']"
    :collection="$collection" />
@endif

<style>
    .drag-ghost {
        opacity: 0.5;
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .drag-chosen {
        border: 2px dashed #FFFFFF;
        background-color: #292929;
    }

    #goal-list>.sortable-ghost+* {
        margin-top: 16px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initDragAndDrop();
    });

    function initDragAndDrop() {
        const goalItems = document.querySelectorAll('#goal-list li');
        const goalList = document.querySelector('#goal-list');
        const goals = [...goalList.children];
        const collectionId = '{{ $collection->id }}';

        function loadGoalsFromLocalStorage() {
            const savedOrder = JSON.parse(localStorage.getItem(`goalOrder_${collectionId}`));
            if (savedOrder) {
                savedOrder.forEach(id => {
                    const goal = goals.find(item => item.getAttribute('data-id') == id);
                    if (goal) goalList.appendChild(goal);
                });
            }
        }

        function saveGoalsToLocalStorage() {
            const goalIds = [...goalList.children].map(item => item.getAttribute('data-id'));
            localStorage.setItem(`goalOrder_${collectionId}`, JSON.stringify(goalIds));
        }

        loadGoalsFromLocalStorage();

        Sortable.create(goalList, {
            animation: 200,
            ghostClass: 'drag-ghost',
            chosenClass: 'drag-chosen',
            handle: '.grab-handle',
            onEnd: function(evt) {
                saveGoalsToLocalStorage();
            }
        });
    }
</script>

<script>
    let goal_id = null;

    function openModal(button) {
        goal_id = button.getAttribute('data-id');
        const status = button.getAttribute('data-status');

        if (status == 'inProgress') {
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
            closeModal();
            location.reload();
        }
    }

    const delete_collection_btn = document.getElementById('delete-collection-btn');

    delete_collection_btn.addEventListener('click', async function() {
        const collection_id = delete_collection_btn.getAttribute('data-id');

        try {
            const response = await fetch(`/collection/${collection_id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            });
            window.location.href = '/homepage';
        } catch (error) {
            ('Ops, something went wrong while trying to delete collection, please contact support.');
            location.reload();
        }
    })
</script>