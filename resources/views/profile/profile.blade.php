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
            <div class="w-full h-px bg-detail"></div>
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
                        <div class="w-full mt-5">
                            <div id="chartsContainer" class="mt-3">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 sm:gap-20 opacity-1 pointer-events-none transition-opacity duration-200 ease-in-out">
                                    <div>
                                        <h4 class="text-lg italic text-text_gray font-poppins mb-5">Goals analytics</h4>
                                        <canvas id="goalsChart"></canvas>
                                    </div>

                                    <div>
                                        <h4 class="text-lg italic text-text_gray font-poppins mb-5">Goals analytics over time</h4>
                                        <canvas id="goalsOverTimeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.sidebar-mobile />
</x-layouts.layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const goalsCompleted = <?= $current_statistics['current_goals_completed'] ?>;
    const goalsNotCompleted = <?= $current_statistics['current_goals'] - $current_statistics['current_goals_completed'] ?>;
    const goalsCompletedOverTime = <?= json_encode($current_statistics['goals_completed_over_time']) ?>;

    const ctxGoals = document.getElementById('goalsChart').getContext('2d');
    new Chart(ctxGoals, {
        type: 'bar',
        data: {
            labels: ['Completed', 'Not Completed'],
            datasets: [{
                label: 'Goals',
                data: [goalsCompleted, goalsNotCompleted],
                backgroundColor: [
                    'rgba(3, 218, 198, 1)',
                    'rgba(187, 134, 252, 1)',
                ],
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
                    },
                    grid: {
                        color: 'rgba(41, 41, 41, 0.3)',
                        borderColor: 'rgba(41, 41, 41, 0.3)',
                        borderWidth: 0.5,
                    },
                },
                x: {
                    grid: {
                        color: 'rgba(41, 41, 41, 0.3)',
                        borderColor: 'rgba(41, 41, 41, 0.3)',
                        borderWidth: 0.5
                    },
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

    const sortedDates = Object.keys(goalsCompletedOverTime).sort((a, b) => new Date(a) - new Date(b));
    const sortedData = sortedDates.map(date => goalsCompletedOverTime[date]);

    const ctxGoalsOverTime = document.getElementById('goalsOverTimeChart').getContext('2d');
    new Chart(ctxGoalsOverTime, {
        type: 'line',
        data: {
            labels: sortedDates, // Usando os dias como labels
            datasets: [{
                label: 'Goals Completed',
                data: sortedData,
                borderColor: 'rgba(3, 218, 198, 1)',
                backgroundColor: 'rgba(3, 218, 198, 0.2)',
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(41, 41, 41, 0.3)',
                        borderColor: 'rgba(41, 41, 41, 0.3)',
                    },
                },
                x: {
                    grid: {
                        color: 'rgba(41, 41, 41, 0.3)',
                        borderColor: 'rgba(41, 41, 41, 0.3)',
                    },
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