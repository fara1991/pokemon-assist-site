<?php

namespace App\Http\Controllers;

use App\BookList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RangeException;

class BookListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $request->validate([
            'versionId' => 'required|integer',
            'bookId' => 'required|integer',
        ]);

        $model = new BookList();
        $list = $model
            ->newQuery()
            ->where('version_id', $request->versionId)
            ->where('book_id', $request->bookId)
            ->select($model->camelColumnNameList())
            ->get();

        return response()->json($list);
    }

    /**
     * Display the specified resource.
     *
     * @param $bookNo
     * @return JsonResponse
     */
    public function show($bookNo)
    {
        if ($bookNo === 0) {
            throw new RangeException('図鑑Noを指定していない');
        }

        $model = new BookList();
        $list = $model->newQuery()
            ->where('version_id', 8)
            ->where('book_id', 1)
            ->where('book_no', $bookNo)
            ->select($model->camelColumnNameList())
            ->get();

        return response()->json($list);
    }
}
