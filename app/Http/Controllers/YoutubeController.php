<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function getVideo(Request $request)
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
                $videoUrl = $urls[0];
                $audioUrl = $urls[1];

                return response()->json([
                    "url_video" => $videoUrl,
                    'url_audio' => $audioUrl
                ]);
            } else {
                return response()->json(['error', "Error retrieving video and audio URLs."]);
            }
        }

        return response()->json(['status', 404]);
    }
}
