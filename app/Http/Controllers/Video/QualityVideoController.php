<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\QualityVideoRequest;
use Illuminate\Support\Facades\File;

class QualityVideoController extends Controller
{
    public function __invoke(QualityVideoRequest $request)
    {
        $validate = $request->validated();

        $videoID = $validate['videoID'];
        $filePath = public_path();
        $pathMerge =   $filePath . "/$videoID.%(ext)s";
        $command = "yt-dlp --verbose -f 137+140 --merge-output-format mp4 'https://www.youtube.com/watch?v=$videoID' -o '$pathMerge'";

        shell_exec($command);
        $pathVideo = $filePath . "/$videoID.mp4";
        $filecontent = base64_encode(file_get_contents($pathVideo));

        if (file_exists($pathVideo)) {
            File::delete($pathVideo);
        }
        
        return response()->json([
            'id' =>   $videoID,
            "content" => $filecontent
        ]);
    }
}
