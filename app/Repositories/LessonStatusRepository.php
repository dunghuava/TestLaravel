<?php


namespace App\Repositories;


use App\LessonStatus;
use Illuminate\Http\Request;

class LessonStatusRepository extends BaseRepository
{

    public function saveLessonStatus(Request $request)
    {
        $id = (int)$request->id;
        $params = [
            'lesson_type' => $request->lesson_type,
            'name' => $request->name,
            'order_index' => (int)$request->order_index > 0 ? (int)$request->order_index : 0,
            'color' => $request->color,
            'color_alt_1' => $request->color_alt_1,
            'color_alt_2' => $request->color_alt_2,
            'default' => (int)$request->default
        ];

        if ($icon = $request->file('icon')) {
            $path = storage_path('/app/public/images/');
            $imgName = $icon->getClientOriginalName();
            if ($icon->move($path, $imgName)) {
                $params['icon_url'] = asset('/storage/images/' . $imgName);
                if ($request->icon_url) {
                    $baseName = basename($request->icon_url);
                    if (file_exists($path . $baseName)) {
                        unlink($path . $baseName);
                    }
                }
            }
        }

        if ($id) {
            return $this->update($id, $params);
        }
        return $this->create($params);
    }

    public function getModel()
    {
        return LessonStatus::class;
    }
}