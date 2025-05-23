<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-4 bg-white dark:bg-zinc-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl font-bold mb-4">{{ __('app.welcome_to_gympro') }}</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('app.personal_fitness_platform') }}</p>

            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                    <div class="flex h-full flex-col items-center justify-center text-center">
                        <h3 class="text-xl font-semibold mb-2">{{ __('app.track_your_progress') }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('app.track_progress_desc') }}</p>
                    </div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                    <div class="flex h-full flex-col items-center justify-center text-center">
                        <h3 class="text-xl font-semibold mb-2">{{ __('app.stay_consistent') }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('app.stay_consistent_desc') }}</p>
                    </div>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
                    <div class="flex h-full flex-col items-center justify-center text-center">
                        <h3 class="text-xl font-semibold mb-2">{{ __('app.achieve_your_goals') }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ __('app.achieve_goals_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="workout-logs" class="h-full flex-1 overflow-hidden">
            @livewire('workout-log.workout-log-table')
        </div>
    </div>
</x-layouts.app>
