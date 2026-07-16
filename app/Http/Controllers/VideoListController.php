<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;

class VideoListController extends Controller
{
    /**
     * Display the public-facing video list page.
     */
    public function index(Request $request)
    {
        $search    = $request->input('search', '');
        $videoType = $request->input('type', '');
        $category  = $request->input('category', '');
        $perPage   = 12;

        $query = Gallery::where('video_status', 1)
            ->orderBy('total_views', 'desc')
            ->orderBy('date_time', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('video_title', 'like', "%{$search}%")
                  ->orWhere('video_description', 'like', "%{$search}%");
            });
        }

        if ($videoType) {
            $query->where('video_type', $videoType);
        }

        // Apply category mapping filters
        if ($category) {
            $query->where(function ($q) use ($category) {
                switch ($category) {
                    case 'nursery_rhymes':
                        $q->where('video_title', 'like', '%เพลงเด็ก%')
                          ->orWhere('video_title', 'like', '%เป็ดอาบน้ำ%')
                          ->orWhere('video_title', 'like', '%เพลงช้าง%')
                          ->orWhere('video_title', 'like', '%ช้าง ช้าง%')
                          ->orWhere('video_title', 'like', '%จับปูดำ%')
                          ->orWhere('video_title', 'like', '%ปูนา%')
                          ->orWhere('video_title', 'like', '%เต่า%')
                          ->orWhere('video_title', 'like', '%ตุ๊กแก%')
                          ->orWhere('video_title', 'like', '%ไก่กุ๊ก%')
                          ->orWhere('video_title', 'like', '%นกเขา%')
                          ->orWhere('video_title', 'like', '%ปรบมือ%')
                          ->orWhere('video_title', 'like', '%หนอนผีเสื้อ%')
                          ->orWhereIn('video_id', ['PlVV2QdudjA', 'yo1YpPSZgoc', 'XlR-V8JpKb8']);
                        break;
                    case 'stories':
                        $q->where('video_title', 'like', '%นิทาน%')
                          ->orWhere('video_title', 'like', '%กระต่ายกับเต่า%')
                          ->orWhere('video_title', 'like', '%เด็กเลี้ยงแกะ%')
                          ->orWhere('video_title', 'like', '%สิงโตกับหนู%');
                        break;
                    case 'thai_language':
                        $q->where('video_title', 'like', '%ก เอ๋ย%')
                          ->orWhere('video_title', 'like', '%ก ไก่%')
                          ->orWhere('video_title', 'like', '%พยัญชนะ%')
                          ->orWhere('video_title', 'like', '%ตัวอักษรไทย%')
                          ->orWhere('video_title', 'like', '%สระ%')
                          ->orWhere('video_title', 'like', '%ค ควาย%')
                          ->orWhereIn('video_id', ['TyuU2Yd1dLI', '1SU7P9KMXeA', 'AcLn892iPo0', '1Tk-x5KHJFI', 'DrPPWiC-LoI', 'rxDL7nLxIEI', 'cfNalhFb5o8', 'HLX4biTy7uY']);
                        break;
                    case 'english':
                        $q->where('video_title', 'like', '%ABC%')
                          ->orWhere('video_title', 'like', '%Alphabet%')
                          ->orWhere('video_title', 'like', '%Finger Family%')
                          ->orWhere('video_title', 'like', '%My Name%')
                          ->orWhere('video_title', 'like', '%อังกฤษ%')
                          ->orWhereIn('video_id', ['95EFNsXgRhQ', '87YwdWpCP-c', 'jYAWf8Y91hA']);
                        break;
                    case 'science':
                        $q->where('video_title', 'like', '%ผลไม้%')
                          ->orWhere('video_title', 'like', '%ฤดู%')
                          ->orWhere('video_title', 'like', '%กบเอย%')
                          ->orWhere('video_title', 'like', '%ไดโนเสาร์%')
                          ->orWhere('video_title', 'like', '%Dinosaur%')
                          ->orWhereIn('video_id', ['FjBBB58jBV0', 'i4QDksV1Jk8', 'P10p7ALXkcU']);
                        break;
                    case 'life_skills':
                        $q->where('video_title', 'like', '%สิทธิร่างกาย%')
                          ->orWhere('video_title', 'like', '%ไปโรงเรียน%')
                          ->orWhere('video_title', 'like', '%ออทิสติก%')
                          ->orWhere('video_title', 'like', '%ปกป้องตัวเอง%')
                          ->orWhereIn('video_id', ['mia51UBAx6c', 'cTqMRq_3RYA']);
                        break;
                }
            });
        }

        $videos = $query->paginate($perPage)->appends($request->all());

        $totalVideos  = Gallery::where('video_status', 1)->count();
        $youtubeCount = Gallery::where('video_status', 1)->where('video_type', 'youtube')->count();
        $urlCount     = Gallery::where('video_status', 1)->where('video_type', 'Url')->count();

        return view('videolist', compact('videos', 'search', 'videoType', 'category', 'totalVideos', 'youtubeCount', 'urlCount'));
    }

    /**
     * Increment the view counter of a specific video gallery item.
     */
    public function incrementView($id)
    {
        $video = Gallery::findOrFail($id);
        $video->total_views = ($video->total_views ?? 0) + 1;
        $video->save();

        return response()->json([
            'success'     => true,
            'total_views' => $video->total_views
        ]);
    }
}
