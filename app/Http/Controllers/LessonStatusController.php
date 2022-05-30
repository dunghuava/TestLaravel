<?php

namespace App\Http\Controllers;

use App\LessonStatus;
use App\Repositories\LessonStatusRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LessonStatusController extends Controller
{
    protected $lessonStatusRepo;

    protected $redirectTo = '/';

    public function __construct(LessonStatusRepository $lessonStatusRepo)
    {
        $this->lessonStatusRepo = $lessonStatusRepo;
    }

    public function index()
    {
        $data = [
            'items' => $this->lessonStatusRepo->getAll()
        ];
        return view('administrators.lesson.status-list', $data);
    }

    public function show(Request $request, $id = 0)
    {
        $data = [
            'lesson_status' => config('options.lesson_status'),
            'item' => $this->lessonStatusRepo->find($id)
        ];
        return view('administrators.lesson.status-add', $data);
    }

    public function store(Request $request)
    {
        try {
            $this->lessonStatusRepo->saveLessonStatus($request);

            session()->flash('notify', [
                'status' => 'success',
                'message' => 'Successfully'
            ]);

            return Redirect::route('admin.lesson_status');

        } catch (\Exception $exception) {
            session()->flash('notify', [
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
            return Redirect::back();
        }
    }

    public function destroy(Request $request, $id = 0)
    {
        $this->lessonStatusRepo->delete($id);
        session()->flash('notify', [
            'status' => 'success',
            'message' => 'Successfully'
        ]);
    }
}
