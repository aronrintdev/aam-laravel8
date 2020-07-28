<?php

use Illuminate\Database\Seeder;

class SportsIDsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode('[
        {
            "SportID": "GOLF",
                "Description": "Golf",
                "Pros": "PGA"
        },
        {
            "SportID": "BASE",
                "Description": "Baseball/Softball",
                "Pros": "MLB"
        },
        {
            "SportID": "BASK",
                "Description": "Basketball",
                "Pros": "NBA"
        },
        {
            "SportID": "ALL ",
                "Description": "All Sports",
                "Pros": null
        },
        {
            "SportID": "SKII",
                "Description": "Skiing",
                "Pros": null
        },
        {
            "SportID": "PHTH",
                "Description": "Physical Therapy",
                "Pros": null
        },
        {
            "SportID": "TENN",
                "Description": "Tennis",
                "Pros": "USTPA and USTA"
        },
        {
            "SportID": "SWIM",
                "Description": "Swimming",
                "Pros": null
        },
        {
            "SportID": "DIVE",
                "Description": "Diving",
                "Pros": null
        },
        {
            "SportID": "DISC",
                "Description": "Disc Golf",
                "Pros": "PDGA"
        },
        {
            "SportID": "BOWL",
                "Description": "Bowling",
                "Pros": "PBA"
        },
        {
            "SportID": "HCKY",
                "Description": "Hockey",
                "Pros": "NHL"
        },
        {
            "SportID": "NONE",
                "Description": "None",
                "Pros": null
        },
        {
            "SportID": "FOOT",
                "Description": "Football",
                "Pros": "NFL"
        },
        {
            "SportID": "SOFT",
                "Description": "Softball (Legacy)",
                "Pros": null
        },
        {
            "SportID": "KARA",
                "Description": "Karate",
                "Pros": null
        },
        {
            "SportID": "RUGB",
                "Description": "Rugby",
                "Pros": null
        },
        {
            "SportID": "CRKT",
                "Description": "Cricket",
                "Pros": "PCA"
        },
        {
            "SportID": "TRCK",
                "Description": "Track and Field",
                "Pros": null
        },
        {
            "SportID": "WRES",
                "Description": "Wrestling",
                "Pros": null
        },
        {
            "SportID": "BILL",
                "Description": "Billiards",
                "Pros": "WPBSA"
        },
        {
            "SportID": "GYMN",
                "Description": "Gymnastics",
                "Pros": null
        },
        {
            "SportID": "LACR",
                "Description": "Lacrosse",
                "Pros": "NLL"
        },
        {
            "SportID": "CURL",
                "Description": "Curling",
                "Pros": "CCA"
        },
        {
            "SportID": "BOXG",
                "Description": "Boxing",
                "Pros": "IBF and USBA"
        },
        {
            "SportID": "SOCC",
                "Description": "Soccer",
                "Pros": "FIFA"
        },
        {
            "SportID": "VOLL",
                "Description": "Volleyball",
                "Pros": null
        },
        {
            "SportID": "SNOW",
                "Description": "Snowboarding",
                "Pros": null
        },
        {
            "SportID": "FLYF",
                "Description": "Fly Fishing",
                "Pros": null
        },
        {
            "SportID": "SHOT",
                "Description": "Shooting",
                "Pros": null
        },
        {
            "SportID": "SQSH",
                "Description": "Squash",
                "Pros": null
        }
        ]');
        foreach ($data as $rec) {
            DB::table('SportsIDs')->insert([
                'SportID'     => $rec->SportID,
                'Description' => $rec->Description,
                'Pros'        => $rec->Pros,
            ]);
        }
    }
}
