var classes = [
    {
        "name": "App\\Http\\Controllers\\Admin\\GajiController",
        "interface": false,
        "abstract": false,
        "final": false,
        "methods": [
            {
                "name": "__construct",
                "role": "setter",
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "index",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "create",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "store",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "edit",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "update",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "destroy",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "unduhSlipGaji",
                "role": null,
                "public": true,
                "private": false,
                "_type": "Hal\\Metric\\FunctionMetric"
            },
            {
                "name": "validateGaji",
                "role": null,
                "public": false,
                "private": true,
                "_type": "Hal\\Metric\\FunctionMetric"
            }
        ],
        "nbMethodsIncludingGettersSetters": 9,
        "nbMethods": 8,
        "nbMethodsPrivate": 1,
        "nbMethodsPublic": 7,
        "nbMethodsGetter": 0,
        "nbMethodsSetters": 1,
        "wmc": 9,
        "ccn": 2,
        "ccnMethodMax": 2,
        "externals": [
            "App\\Http\\Controllers\\Controller",
            "App\\Services\\GajiService",
            "Illuminate\\Http\\Request",
            "App\\Models\\Gaji",
            "App\\Models\\Jabatan",
            "Carbon\\Carbon",
            "App\\Models\\Pegawai",
            "App\\Models\\Pegawai",
            "App\\Models\\MasterTunjangan",
            "App\\Models\\MasterPotongan",
            "Illuminate\\Http\\Request",
            "App\\Models\\Gaji",
            "App\\Models\\Pegawai",
            "App\\Models\\MasterTunjangan",
            "App\\Models\\MasterPotongan",
            "Illuminate\\Http\\Request",
            "App\\Models\\Gaji",
            "App\\Models\\Gaji",
            "App\\Models\\Gaji",
            "Barryvdh\\DomPDF\\Facade\\Pdf",
            "Illuminate\\Http\\Request"
        ],
        "parents": [
            "App\\Http\\Controllers\\Controller"
        ],
        "implements": [],
        "lcom": 6,
        "length": 167,
        "vocabulary": 64,
        "volume": 1002,
        "difficulty": 6.02,
        "effort": 6028.98,
        "level": 0.17,
        "bugs": 0.33,
        "time": 335,
        "intelligentContent": 166.53,
        "number_operators": 25,
        "number_operands": 142,
        "number_operators_unique": 5,
        "number_operands_unique": 59,
        "cloc": 24,
        "loc": 86,
        "lloc": 62,
        "mi": 76.12,
        "mIwoC": 39.62,
        "commentWeight": 36.5,
        "kanDefect": 0.22,
        "relativeStructuralComplexity": 961,
        "relativeDataComplexity": 0.28,
        "relativeSystemComplexity": 961.28,
        "totalStructuralComplexity": 8649,
        "totalDataComplexity": 2.53,
        "totalSystemComplexity": 8651.53,
        "package": "App\\Http\\Controllers\\Admin\\",
        "pageRank": 1,
        "afferentCoupling": 0,
        "efferentCoupling": 10,
        "instability": 1,
        "violations": {}
    }
]