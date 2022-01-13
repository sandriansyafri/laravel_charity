<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\returnSelf;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {
        $items = Campaign::orderBy('updated_at', 'desc')->get();
        return DataTables::of($items)
            ->addIndexColumn()
            ->addColumn('action', function ($items) {
                return '
                    <button onclick="editForm( `' . route('campaign.show', $items->id) . '`,`Edit Form`)"  type="button" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button onclick="deleteItem(`' . route('campaign.destroy', $items->id) . '`)" class="btn btn-xs btn-danger ">
                        <i class="fa fa-trash"></i>
                    </button>
                    ';
            })
            ->editColumn('path_image', function ($items) {
                return '<img class="img-fluid" src="' . asset('images/campaign/' . $items->path_image) . '" />';
            })
            ->editColumn('publish_date', function ($items) {
                return '<small class="lead">' . date('d F Y', strtotime($items->publish_date)) . '</small>';
            })
            ->editColumn('short_desc', function ($items) {
                return '<small class="lead">' . $items->short_desc . '</small>';
            })
            ->editColumn('status', function ($items) {
                return '<small class="lead">' . $items->status . '</small>';
            })
            ->editColumn('author.name', function ($items) {
                return '<small class="lead">' . $items->author->name . '</small>';
            })
            ->rawColumns(['action', 'path_image', 'publish_date', 'status', 'author.name', 'short_desc'])
            ->make();
    }
    public function index()
    {
        $categories = Category::pluck('name', 'id');
        return view('page.backend.campaign.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator =  Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required|array',
            'short_desc' => 'required',
            'body' => 'required',
            'status' => 'required',
            'publish_date' => 'required',
            'goal' => 'required',
            'end_date' => 'required',
            'note' => 'required',
            'receiver' => 'required',
            'path_image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'status' => 'error',
                'message' => 'Data gagal ditambahkan',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $data = $request->except('path_image');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);
        $data['path_image'] = upload_image('images/campaign', $request->file('path_image'), 'campaign');
        $campaign = Campaign::create($data);
        $campaign->campaign_category()->attach($request->category_id);

        return response()->json([
            'ok' => true,
            'status' => 'success',
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $campaign
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return response()->json([
            'ok' => true,
            'status' =>  'success',
            'message' => 'get',
            'data' => $campaign
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {

        $validator =  Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required|array',
            'short_desc' => 'required',
            'body' => 'required',
            'status' => 'required',
            'publish_date' => 'required',
            'goal' => 'required',
            'end_date' => 'required',
            'note' => 'required',
            'receiver' => 'required',
            'path_image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'status' => 'error',
                'message' => 'Data gagal ditambahkan',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except('path_image', 'category_id');
        $data['user_id'] = auth()->id();
        if ($request->title !== $campaign->title) {
            $data['slug'] = Str::slug($request->title);
        }
        if ($request->has('path_image')) {
            $data['path_image'] = upload_image('images/campaign', $request->file('path_image'), 'campaign');
        }
        $campaign->update($data);
        $campaign->campaign_category()->sync($request->category_id);

        return response()->json([
            'ok' => true,
            'status' => 'success',
            'message' => 'Data Berhasil Diupdate',
            'data' => $campaign
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $path = public_path('images/campaign');
        $path_image = $path . "/" . $campaign->path_image;
        if ($campaign->path_image) {
            if (file_exists($path_image)) {
                unlink($path_image);
            }
        }
        $campaign->delete();
        return response()->json([
            'ok' => true,
            'status' => 'success',
            'message' => 'Data Berhasil dihapus'
        ]);
    }
}
