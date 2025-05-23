<div class="flex flex-col gap-4">
    <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
        <h2 class="mb-2 text-xl font-semibold">{{ $editing ? __('app.edit_workout_log') : __('app.add_workout_log') }}</h2>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">{{ __('app.record_workout_details') }}</p>

        <form wire:submit.prevent="save" class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Exercise Name -->
            <div class="col-span-full">
                <flux:label for="exercise_name" :value="__('app.exercise_name')" />
                <flux:input id="exercise_name" wire:model="exercise_name" type="text" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.exercise_name_help') }}</p>
                @error('exercise_name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Sets -->
            <div>
                <flux:label for="sets" :value="__('app.sets')" />
                <flux:input id="sets" wire:model="sets" type="number" min="1" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.sets_help') }}</p>
                @error('sets') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Repetitions -->
            <div>
                <flux:label for="repetitions" :value="__('app.repetitions')" />
                <flux:input id="repetitions" wire:model="repetitions" type="number" min="1" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.repetitions_help') }}</p>
                @error('repetitions') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Weight -->
            <div>
                <flux:label for="weight" :value="__('app.weight')" />
                <flux:input id="weight" wire:model="weight" type="number" min="0" step="0.01" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.weight_help') }}</p>
                @error('weight') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Rest Interval -->
            <div>
                <flux:label for="rest_interval" :value="__('app.rest_interval')" />
                <flux:input id="rest_interval" wire:model="rest_interval" type="number" min="0" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.rest_interval_help') }}</p>
                @error('rest_interval') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Workout Date -->
            <div>
                <flux:label for="workout_date" :value="__('app.workout_date')" />
                <flux:input id="workout_date" wire:model="workout_date" type="date" class="mt-1 block w-full" required />
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.workout_date_help') }}</p>
                @error('workout_date') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Notes -->
            <div class="col-span-full">
                <flux:label for="notes" :value="__('app.notes')" />
                <flux:textarea id="notes" wire:model="notes" class="mt-1 block w-full" rows="3"></flux:textarea>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.notes_help') }}</p>
                @error('notes') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Form Actions -->
            <div class="col-span-full flex justify-end gap-2">
                @if($editing)
                    <flux:button type="button" wire:click="cancel" variant="outline">{{ __('app.cancel') }}</flux:button>
                @endif
                <flux:button type="submit">{{ $editing ? __('app.update') : __('app.save') }}</flux:button>
            </div>
        </form>
    </div>

    <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
        <h2 class="mb-2 text-xl font-semibold">{{ __('app.workout_logs') }}</h2>
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">{{ __('app.view_workout_history') }}</p>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.exercise') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.sets') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.reps') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.weight') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.rest') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">{{ __('app.notes') }}</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($workoutLogs as $log)
                        <tr>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->exercise_name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->sets }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->repetitions }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->weight }} kg</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->rest_interval }} s</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $log->workout_date->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <div class="max-w-xs truncate">{{ $log->notes }}</div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:button wire:click="edit({{ $log->id }})" size="xs" variant="outline">
                                        {{ __('app.edit') }}
                                    </flux:button>
                                    <flux:button wire:click="delete({{ $log->id }})" wire:confirm="{{ __('app.delete_confirmation') }}" size="xs" variant="outline" class="text-red-600 hover:text-red-800">
                                        {{ __('app.delete') }}
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center">{{ __('app.no_workout_logs') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $workoutLogs->links() }}
        </div>
    </div>
</div>
