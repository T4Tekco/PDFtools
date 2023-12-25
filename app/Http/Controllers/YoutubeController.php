<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class YoutubeController extends Controller
{
    public function getVideo(Request $request)
    {
        ini_set('max_execution_time', 300);

        if ($request->has('url')) {
            $videoUrl = $request->input('url');

            $yt = new YoutubeDl();
            $downloadPath = public_path('/storage');

            $collection = $yt->download(
                Options::create()
                    ->downloadPath($downloadPath)
                    ->format('mp4')
                    ->url($videoUrl)
            );
            foreach ($collection->getVideos() as $video) {
                if ($video->getError() !== null) {
                    return response()->json(['error' => "Error downloading video"]);
                } else {
                    $file = $video->getFile();
                    $fileContent = base64_encode(file_get_contents($file->getPathname()));
                    return response()->json([
                        'file_content' => $fileContent
                    ]);
                }
            }
        }

        return response()->json(['status', 404]);
    }


    public function getAudio(Request $request)
    {

        if ($request->has('url')) {
            $videoUrl = $request->input('url');

            $command = 'youtube-dl --verbose -g ' . $videoUrl;
            // Execute the command
            $output = shell_exec($command);

            // Split the output into an array of URLs
            $urls = explode(PHP_EOL, trim($output));

            // Now $urls should contain two URLs: video and audio
            if (count($urls) >= 2) {
                $audioUrl = $urls[1];

                return response()->json([
                    'url_audio' => $audioUrl
                ]);
            } else {
                return response()->json(['error', "Error retrieving video and audio URLs."]);
            }
        }

        return response()->json(['status', 404]);
    }
}
