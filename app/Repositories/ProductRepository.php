<?php

namespace App\Repositories;

use App\Product;
use Elasticsearch\Client;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{

    public function getProductHomePage($query)
    {
        $search = new SearchRepository();
        return $search->search($query);
    }

    public function saveProduct(Request $request)
    {
        $attributes = [
            'name' => $request->name,
            'price' => (double)$request->price,
            'alias' => makeAlias($request->name),
            'make' => $request->make,
            'model' => $request->model,
            'regist_date' => $request->regist_date,
            'engine' => $request->engine,
            'description' => $request->description,
            'category' => $request->category,
            'status' => (int)$request->status > 1 ? 0 : (int)$request->status
        ];

        if ($file = $request->file('file')) {
            $fileName = 'img_' . time() . '_' . strtolower($file->getClientOriginalName());
            $filePath = storage_path('app/public/images');
            if ($request->id) {
                $item = $this->find($request->id);
                if ($item && $item->image) {
                    $imageOld = $filePath . '/' . $item->image;
                    if (file_exists($imageOld)) {
                        unlink($imageOld);
                    }
                }
            }
            if ($file->move($filePath, $fileName)) {
                $attributes['image'] = $fileName;
            }
        }

        if ($request->id) {
            return $this->update($request->id, $attributes);
        }

        return $this->create($attributes);
    }

    public function getModel()
    {
        return Product::class;
    }
}
