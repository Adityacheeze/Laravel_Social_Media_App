<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
     public function charts()
    {
        return view("charts-page");
    }

    public function getChartData1()
    {
        $data = [
            ["y" => 79.45, "label" => "Google"],
            ["y" => 7.31,  "label" => "Bing"],
            ["y" => 7.06,  "label" => "Baidu"],
            ["y" => 4.91,  "label" => "Yahoo"],
            ["y" => 1.26,  "label" => "Others"]
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function getChartData2()
    {
        $data = [
            ["y" => 300878, "label" => "Venezuela"],
            ["y" => 266455,  "label" => "Saudi"],
            ["y" => 169709,  "label" => "Canada"],
            ["y" => 158400,  "label" => "Iran"],
            ["y" => 142503,  "label" => "Iraq"],
            ["y" => 101500, "label" => "Kuwait"],
            ["y" => 97800,  "label" => "UAE"],
            ["y" => 80000,  "label" => "Russia"]
        ];

        return response()->json([
            'data' => $data
        ]);
    }
    public function getChartData3()
    {
        $data =  [
            [
                "x" => 39.6,
                "y" => 5.225,
                "z" => 1347,
                "name" => "China"
            ],
            [
                "x" => 3.3,
                "y" => 4.17,
                "z" => 21.49,
                "name" => "Australia"
            ],
            [
                "x" => 1.5,
                "y" => 4.043,
                "z" => 304.09,
                "name" => "US"
            ],
            [
                "x" => 17.4,
                "y" => 2.647,
                "z" => 2.64,
                "name" => "Brazil"
            ],
            [
                "x" => 8.6,
                "y" => 2.154,
                "z" => 141.95,
                "name" => "Russia"
            ],
            [
                "x" => 52.98,
                "y" => 1.797,
                "z" => 1190.86,
                "name" => "India"
            ],
            [
                "x" => 4.3,
                "y" => 1.735,
                "z" => 26.16,
                "name" => "Saudi Arabia"
            ],
            [
                "x" => 1.21,
                "y" => 1.41,
                "z" => 39.71,
                "name" => "Argentina"
            ],
            [
                "x" => 5.7,
                "y" => .993,
                "z" => 48.79,
                "name" => "SA"
            ],
            [
                "x" => 13.1,
                "y" => 1.02,
                "z" => 110.42,
                "name" => "Mexico"
            ],
            [
                "x" => 2.4,
                "y" => .676,
                "z" => 33.31,
                "name" => "Canada"
            ],
            [
                "x" => 2.8,
                "y" => .293,
                "z" => 64.37,
                "name" => "France"
            ],
            [
                "x" => 3.8,
                "y" => .46,
                "z" => 127.70,
                "name" => "Japan"
            ],
            [
                "x" => 40.3,
                "y" => .52,
                "z" => 234.95,
                "name" => "Indonesia"
            ],
            [
                "x" => 42.3,
                "y" => .197,
                "z" => 68.26,
                "name" => "Thailand"
            ],
            [
                "x" => 31.6,
                "y" => .35,
                "z" => 78.12,
                "name" => "Egypt"
            ],
            [
                "x" => 1.1,
                "y" => .176,
                "z" => 61.39,
                "name" => "U.K"
            ],
            [
                "x" => 3.7,
                "y" => .144,
                "z" => 59.83,
                "name" => "Italy"
            ],
            [
                "x" => 1.8,
                "y" => .169,
                "z" => 82.11,
                "name" => "Germany"
            ]
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function getChartData4()
    {
        $data = [
            [
                "x" => 'TEAM A',
                "y" => [65, 96]
            ],
            [
                "x" => 'TEAM B',
                "y" => [33, 78]
            ],
            [
                "x" => 'TEAM C',
                "y" => [23, 48],
            ],
            [
                "x" => 'TEAM D',
                "y" => [0, 78]
            ]
        ];
        $data2 = [
            [
                "x" => 'TEAM A',
                "y" => [23, 45]
            ],
            [
                "x" => 'TEAM B',
                "y" => [78, 99]
            ],
            [
                "x" => 'TEAM C',
                "y" => [3, 37],
            ],
            [
                "x" => 'TEAM D',
                "y" => [58, 83]
            ]
        ];

        return response()->json([
            'data' => [$data, $data2],
        ]);
    }
    public function getChartData5()
    {
        $data = [
            [
                "x" => "",
                "y" => [0, 78]
            ]
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
