<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function getVideo(Request $request)
    {
        // try {
            if ($request->has('url')) {
                $videoUrl = $request->input('url');

                $command = getenv('Path_ytb_dl')." --verbose -g -e --get-thumbnail -f best 'https://www.youtube.com/watch?v=$videoUrl'";

                $output = shell_exec($command);

                $urls = explode(PHP_EOL, trim($output));

                if (count($urls)) {
                    $title = $urls[0];
                    $videoUrl = $urls[1];
                    $videothumbnail = $urls[2];

                    return response()->json([
                        'title' =>   $title,
                        "url_video" => $videoUrl,
                        'thumbnail' => $videothumbnail
                    ]);
                } else {
                    return response()->json(['error', "Error retrieving video and audio URLs."]);
                }
            }

            return response()->json(['status', 404]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status', 500,
        //         'error' => $e
        //     ]);
        // }
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
