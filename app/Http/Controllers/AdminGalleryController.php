<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use DataTables;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of videos (DataTables AJAX).
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = \DB::table('tbl_gallery')
                ->select('id', 'video_title', 'video_url', 'video_type', 'video_duration', 'video_status', 'total_views', 'video_thumbnail', 'video_id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('thumbnail', function ($row) {
                    if (!empty($row->video_thumbnail)) {
                        $url = asset('video_image/' . $row->video_thumbnail);
                    } elseif ($row->video_type === 'youtube' && !empty($row->video_id)) {
                        $url = "https://img.youtube.com/vi/{$row->video_id}/mqdefault.jpg";
                    } else {
                        $url = 'https://via.placeholder.com/80x45/1a1a35/6c47ff?text=No+Image';
                    }
                    return '<img src="' . $url . '" style="width:80px;height:45px;object-fit:cover;border-radius:6px;" alt="">';
                })
                ->addColumn('type_badge', function ($row) {
                    $color = $row->video_type === 'youtube' ? '#ff5252' : '#43d9b4';
                    $label = $row->video_type === 'youtube' ? 'YouTube' : 'URL';
                    return '<span style="background:' . $color . ';color:#fff;padding:3px 10px;border-radius:20px;font-size:0.75rem;font-weight:700;">' . $label . '</span>';
                })
                ->addColumn('status_badge', function ($row) {
                    if ($row->video_status == 1) {
                        return '<span class="label label-success">Active</span>';
                    }
                    return '<span class="label label-danger">Inactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $editUrl   = url('admin/gallery/' . $row->id . '/edit');
                    $deleteUrl = url('admin/gallery/' . $row->id);
                    $token     = csrf_token();

                    $btn = '<div class="admin-table-action-block">
                        <a href="' . $editUrl . '" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delModal' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div id="delModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="delete-icon"></div>
                                </div>
                                <div class="modal-body text-center">
                                    <h4 class="modal-heading">Are You Sure?</h4>
                                    <p>Do you really want to delete this video? This cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="' . $deleteUrl . '">
                                        <input type="hidden" name="_token" value="' . $token . '">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['thumbnail', 'type_badge', 'status_badge', 'action'])
                ->make(true);
        }

        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new video.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created video.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_title'       => 'required|string|max:255',
            'video_url'         => 'required|string|max:500',
            'video_type'        => 'required|in:youtube,Url',
            'video_duration'    => 'nullable|string|max:20',
            'video_description' => 'nullable|string',
            'video_status'      => 'nullable',
            'cat_id'            => 'nullable|integer',
            'thumbnail'         => 'nullable|image|max:4096',
        ]);

        $data = [
            'cat_id'            => $request->cat_id ?? 1,
            'video_title'       => $request->video_title,
            'video_url'         => $request->video_url,
            'video_id'          => $this->extractVideoId($request->video_url, $request->video_type),
            'video_duration'    => $request->video_duration ?? '',
            'video_description' => $request->video_description ?? '',
            'video_type'        => $request->video_type,
            'video_status'      => $request->has('video_status') ? 1 : 0,
            'size'              => '',
            'total_views'       => 0,
            'video_thumbnail'   => '',
        ];

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(base_path('../ecommerce/upload/video_image'), $filename);
            $data['video_thumbnail'] = $filename;
        }

        Gallery::create($data);

        return redirect()->route('gallery.index')
            ->with('added', 'Video added successfully!');
    }

    /**
     * Show the form for editing a video.
     */
    public function edit($id)
    {
        $video = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('video'));
    }

    /**
     * Update the specified video.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'video_title'       => 'required|string|max:255',
            'video_url'         => 'required|string|max:500',
            'video_type'        => 'required|in:youtube,Url',
            'video_duration'    => 'nullable|string|max:20',
            'video_description' => 'nullable|string',
            'cat_id'            => 'nullable|integer',
            'thumbnail'         => 'nullable|image|max:4096',
        ]);

        $video = Gallery::findOrFail($id);

        $data = [
            'cat_id'            => $request->cat_id ?? $video->cat_id,
            'video_title'       => $request->video_title,
            'video_url'         => $request->video_url,
            'video_id'          => $this->extractVideoId($request->video_url, $request->video_type),
            'video_duration'    => $request->video_duration ?? '',
            'video_description' => $request->video_description ?? '',
            'video_type'        => $request->video_type,
            'video_status'      => $request->has('video_status') ? 1 : 0,
        ];

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(base_path('../ecommerce/upload/video_image'), $filename);
            $data['video_thumbnail'] = $filename;
        }

        $video->update($data);

        return redirect()->route('gallery.index')
            ->with('updated', 'Video updated successfully!');
    }

    /**
     * Remove the specified video.
     */
    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();

        return redirect()->route('gallery.index')
            ->with('deleted', 'Video deleted successfully!');
    }

    /**
     * Extract video_id from URL for YouTube videos.
     */
    private function extractVideoId(string $url, string $type): string
    {
        if ($type !== 'youtube') {
            return 'cda11up';
        }

        // Handle youtu.be short links
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        // Handle youtube.com/watch?v=
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        // Handle youtube.com/embed/
        if (preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }

        return '';
    }
}
