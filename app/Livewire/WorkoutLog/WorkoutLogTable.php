<?php

namespace App\Livewire\WorkoutLog;

use App\Models\WorkoutLog;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class WorkoutLogTable extends Component
{
    use WithPagination;

    public $exercise_name = '';
    public $sets = 1;
    public $repetitions = 1;
    public $weight = 0;
    public $rest_interval = 60;
    public $workout_date;
    public $notes = '';

    public $editing = false;
    public $editId = null;

    protected $rules = [
        'exercise_name' => 'required|string|max:255',
        'sets' => 'required|integer|min:1',
        'repetitions' => 'required|integer|min:1',
        'weight' => 'required|numeric|min:0',
        'rest_interval' => 'required|integer|min:0',
        'workout_date' => 'required|date',
        'notes' => 'nullable|string',
    ];

    public function mount()
    {
        $this->workout_date = now()->format('Y-m-d');
    }

    public function render()
    {
        $workoutLogs = auth()->user()->workoutLogs()
            ->orderBy('workout_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.workout-log.workout-log-table', [
            'workoutLogs' => $workoutLogs,
        ]);
    }

    public function save()
    {
        $this->validate();

        if ($this->editing) {
            $workoutLog = WorkoutLog::findOrFail($this->editId);
            $workoutLog->update([
                'exercise_name' => $this->exercise_name,
                'sets' => $this->sets,
                'repetitions' => $this->repetitions,
                'weight' => $this->weight,
                'rest_interval' => $this->rest_interval,
                'workout_date' => $this->workout_date,
                'notes' => $this->notes,
            ]);
        } else {
            auth()->user()->workoutLogs()->create([
                'exercise_name' => $this->exercise_name,
                'sets' => $this->sets,
                'repetitions' => $this->repetitions,
                'weight' => $this->weight,
                'rest_interval' => $this->rest_interval,
                'workout_date' => $this->workout_date,
                'notes' => $this->notes,
            ]);
        }

        $this->reset(['exercise_name', 'sets', 'repetitions', 'weight', 'rest_interval', 'notes', 'editing', 'editId']);
        $this->workout_date = now()->format('Y-m-d');
    }

    public function edit($id)
    {
        $this->editing = true;
        $this->editId = $id;

        $workoutLog = WorkoutLog::findOrFail($id);

        $this->exercise_name = $workoutLog->exercise_name;
        $this->sets = $workoutLog->sets;
        $this->repetitions = $workoutLog->repetitions;
        $this->weight = $workoutLog->weight;
        $this->rest_interval = $workoutLog->rest_interval;
        $this->workout_date = $workoutLog->workout_date->format('Y-m-d');
        $this->notes = $workoutLog->notes;
    }

    public function delete($id)
    {
        WorkoutLog::findOrFail($id)->delete();
    }

    public function cancel()
    {
        $this->reset(['exercise_name', 'sets', 'repetitions', 'weight', 'rest_interval', 'notes', 'editing', 'editId']);
        $this->workout_date = now()->format('Y-m-d');
    }
}
