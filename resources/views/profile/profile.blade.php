<x-layouts.layout>
    <style>
        .achievement {
            position: relative;
        }

        .achievement:hover::after {
            content: attr(data-tooltip);
            font-family: 'Poppins', sans-serif;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 0 8px;
            border-radius: 8px;
            font-size: 0.75rem;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 1;
            visibility: visible;
            z-index: 10;
            transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
        }

        .achievement::after {
            content: '';
            position: absolute;
            opacity: 0;
            visibility: hidden;
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
            <div class="flex justify-between items-center mb-6 sm:mb-12">
                <div class="text-3xl">
                    <div class="sm:flex sm:items-center gap-5 sm:gap-8">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile-picture-default.jpg') }}"
                            class="w-28 h-28 sm:w-60 sm:h-60 object-cover rounded-full border-4 border-detail bg-bg_black">
                        <div class="flex flex-col font-poppins">
                            <div class="mt-2 sm:mt-0 flex gap-5 items-baseline">
                                <h3 class="font-bold text-xl sm:text-3xl">{{ Auth::user()->name }}</h3>
                                <a href="/profile/edit" class="text-base text-text_gray font-roboto mt-3 underline">Edit
                                    Profile<i class="fa fa-edit ml-3"></i></a>
                            </div>
                            <span class="text-lg sm:text-xl font-bold text-text_gray">{{ Auth::user()->nickname }}</span>
                            <p class="text-base mt-2 sm:mt-4 max-w-[600px] text-text_gray font-roboto">{{ Auth::user()->bio }}
                            </p>
                            <span class="text-lg sm:text-xl font-roboto font-light mt-4">Joined at
                                {{ Auth::user()->created_at->format('Y/m/d') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="sm:hidden w-full h-px bg-detail"></div> -->
            <div class="w-full h-px bg-detail"></div>
            <!-- <div class="flex flex-col-reverse md:flex-row gap-10 md:gap-20">
                <div class="mt-0 sm:mt-10 max-w-full md:max-w-96">
                    <h3 class="font-poppins font-bold text-xl sm:text-4xl flex items-center gap-3">Achievements <a href="/achievements"><i class="fa-solid fa-circle-info text-base sm:text-lg text-text_gray hover:text-white transition-all duration-200 ease-in-out"></i></a></h3>
                    <div class="mt-5 sm:mt-8 flex justify-center sm:justify-normal gap-3 flex-wrap">
                        @if(empty($achievements))
                        <p class="font-roboto text-lg text-text_gray italic">No achievements yet...</p>
                        @else
                        @foreach($achievements as $achievement)
                        <p data-tooltip="{{ $achievement['title'] }}" class="achievement w-12 h-12 flex items-center justify-center cursor-default {{ $achievement['type'] == 'beginner' ? 'text-primary' : '' }} text-3xl hover:scale-125 transition-all duration-200 ease-in-out">
                            <i class="fa-solid {{ $achievement['icon'] }}"></i>
                        </p>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="hidden sm:block w-px h-80 bg-detail"></div> -->
            <div class="mt-5 sm:mt-10">
                <h3 class="font-poppins font-bold text-xl sm:text-4xl">Current Statistics</h3>
                <div class="mt-5 sm:mt-8 flex items-start flex-col sm:flex-row gap-20">
                    <div class="flex gap-5 sm:gap-10 flex-wrap">
                        <div class="flex gap-3 items-end">
                            @if($current_statistics['current_collections'] > 9)
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">{{ $current_statistics['current_collections'] }}</h3>
                            @else
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">0{{ $current_statistics['current_collections'] }}</h3>
                            @endif
                            <p class="text-text_gray italic font-poppins font-semibold text-lg">Collections</p>
                        </div>
                        <div class="flex gap-3 items-end">
                            @if($current_statistics['current_goals'] > 9)
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">{{ $current_statistics['current_goals'] }}</h3>
                            @else
                            <h3 class="text-4xl sm:text-6xl font-poppins font-bold text-text_gray">0{{ $current_statistics['current_goals'] }}</h3>
                            @endif
                            <p class="text-text_gray italic font-poppins font-semibold text-lg">Goals</p>
                        </div>
                        <div class="w-full min-w-fit mt-5">
                            <!-- <div class="text-text_gray flex justify-between text-lg mb-4">
                                <ul class="hidden sm:flex mb-10 mt-5 gap-3 font-roboto text-base">
                                    <li>
                                        <a href="/profile/{{Auth::user()->id}}" class="text-white opacity-100 bg-bg_gray border-2 border-detail px-5 py-1.5 rounded-full">Current Statistics</a>
                                    </li>
                                    <li>
                                        <a href="/profile/{{Auth::user()->id}}" class="opacity-50 text-text_gray bg-bg_gray border-2 border-detail hover:opacity-75 transition-all duration-200 ease-in-out px-5 py-1.5 rounded-full">General Statistics</a>
                                    </li>
                                </ul>
                                <div class="flex items-center gap-3 cursor-pointer">
                                    <p id="toggleBtn" class="underline">Hide charts</p>
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                            </div> -->

                            <div id="chartsContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-10 sm:gap-20 opacity-1 pointer-events-none transition-opacity duration-200 ease-in-out">
                                <div>
                                    <h4 class="text-xl text-detail font-poppins font-bold mb-4">Collections</h4>
                                    <canvas id="collectionsChart"></canvas>
                                </div>

                                <div>
                                    <h4 class="text-xl text-detail font-poppins font-bold mb-4">Goals</h4>
                                    <canvas id="goalsChart"></canvas>
                                </div>
                            </div>

                            <script>
                                document.getElementById('toggleBtn').addEventListener('click', function() {
                                    const chartsContainer = document.getElementById('chartsContainer');
                                    const toggleBtn = document.getElementById('toggleBtn');

                                    if (chartsContainer.classList.contains('opacity-0')) {
                                        chartsContainer.classList.remove('opacity-0', 'pointer-events-none');
                                        chartsContainer.classList.add('opacity-100');
                                        toggleBtn.textContent = 'Hide charts';
                                    } else {
                                        chartsContainer.classList.remove('opacity-100');
                                        chartsContainer.classList.add('opacity-0', 'pointer-events-none');
                                        toggleBtn.textContent = 'Show charts';
                                    }
                                });
                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <x-app.sidebar-mobile />
</x-layouts.layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const collectionsCompleted = <?= $current_statistics['current_collections_completed'] ?>;
    const collectionsInProgress = <?= $current_statistics['current_collections_in_progress'] ?>;
    const collectionsExpired = <?= $current_statistics['current_collections_expired'] ?>;
    const goalsCompleted = <?= $current_statistics['current_goals_completed'] ?>;
    const goalsNotCompleted = <?= $current_statistics['current_goals'] - $current_statistics['current_goals_completed'] ?>;

    const ctxCollections = document.getElementById('collectionsChart').getContext('2d');

    new Chart(ctxCollections, {
        type: 'bar',
        data: {
            labels: ['Completed', 'In Progress', 'Expired'],
            datasets: [{
                label: 'Collections',
                data: [collectionsCompleted, collectionsInProgress, collectionsExpired],
                backgroundColor: [
                    'rgba(3, 218, 198, 0.4)',
                    'rgba(187, 134, 252, 0.4)',
                    'rgba(255, 65, 129, 0.4)',
                ],
                borderColor: [
                    'rgba(3, 218, 198, 0.8)',
                    'rgba(187, 134, 252, 0.8)',
                    'rgba(255, 65, 129, 0.8)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: (tooltipItem) => `${tooltipItem.raw} Collections`,
                    }
                }
            }
        }
    });

    const ctxGoals = document.getElementById('goalsChart').getContext('2d');
    new Chart(ctxGoals, {
        type: 'bar',
        data: {
            labels: ['Completed', 'Not Completed'],
            datasets: [{
                label: 'Goals',
                data: [goalsCompleted, goalsNotCompleted],
                backgroundColor: [
                    'rgba(3, 218, 198, 0.4)',
                    'rgba(187, 134, 252, 0.4)',
                ],
                borderColor: [
                    'rgba(3, 218, 198, 0.8)',
                    'rgba(187, 134, 252, 0.8)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: (tooltipItem) => `${tooltipItem.raw} Goals`,
                    }
                }
            }
        }
    });
</script>