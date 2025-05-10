<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil Compaction Test Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .row {
                display: flex !important;
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                align-items: center !important;
            }
            .col-md-3 {
                width: 50% !important;
                display: inline-block !important;
                text-align: right !important;
            }
            header, footer , nav, address {
                display: none !important;
            }
        }
        .report-header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            max-height: 80px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-table th, .report-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        .report-table thead {
            background-color: #f0f0f0;
        }
        .footer-section {
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .project-description {
            text-align: right;
            direction: rtl;
            margin-bottom: 20px;
        }

        .text-start {
            text-align: right !important;
        }
        .underline-text {
            text-decoration: underline;
        }
    </style>
</head>
<body>
@php
 //dd(get_print_image())
$imagePath = asset('images/' . get_print_image());
@endphp
<div class="container-fluid">
    <div class="row report-header">
        <div class="d-flex align-items-center">
            <div>
                <img src="<?=$imagePath?>" style="max-width: 300px; margin-top: 10px;" alt="Company Logo" class="logo">
            </div>
            <div class="ml-3">
                <h3 style="margin-bottom: 0; line-height: normal;"><span style="color: orange;">ALSHARQ</span> TESTS LABORATORY</h3>
                <p style="margin-bottom: 0; line-height: normal;">Registration No. under Iraqi accreditation system is (124)</p>
                <p style="margin-bottom: 0; line-height: normal;">Registration No. under Iraqi Engineer Union is (508)</p>
            </div>
        </div>

    </div>

    <div class="" dir="rtl">
        <div class="row">
            <div class="col-12 text-center">
                <strong>م / تقريــــــــر فحـص</strong>
            </div>
        </div>

        <div class="row d-flex flex-wrap" style="margin-top: 10px">
            <div class="col-md-3 text-start">
                <strong>رقم الصـــــــــــادر :</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{optional($all_data->sader)->num}}
            </div>
            <div class="col-md-3 text-end">
                <strong>تاريخ الصـادر :</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{optional($all_data->sader)->date}}
            </div>
        </div>

        <div class="row d-flex flex-wrap">
            <div class="col-md-3 text-start">
                <strong>التاريــــــــــــــــــــخ :</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{$all_data->talab_date ?? 'N/A'}}
            </div>
            <div class="col-md-3 text-end">
                <strong>رقم الفاتــورة  :</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{$all_data->test_code_st}}
            </div>
        </div>

        <div class="row ">
            <div class="col-12 text-start">
                <strong>جهــــــــة العمـــل :</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="text-decoration: underline;">
            {{$all_data->company ? $all_data->company->name : 'N/A'}}
        </span>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start">
                <strong>الشــركة المنفذة :</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="text-decoration: underline;">
            {{$all_data->company ? $all_data->company->name : 'N/A'}}
        </span>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start">
                <strong>المشــــــــــــــروع :</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="text-decoration: underline;">
            {{$all_data->project ? $all_data->project->project_name : 'N/A'}}
        </span>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start" style="margin-right: 30px">
                <strong>تحية طيبة …</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start">
                <p>اشارة لكتابكم المرقم ({{$all_data->talab_number}}) المؤرخ {{$all_data->talab_date}}, ندرج لكم ادناه نتائج الفحص لنقاط الحدل التي تم اخذها من الموقع للمشروع اعلاه راجين الاطلاع واتخاذ اللازم ..</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start" style="margin-right: 30px">
                <strong>المواصفات المعتمدة:</strong>&nbsp;&nbsp;&nbsp;&nbsp;مواصفة الطرق والجسور R5/R6
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start" style="margin-right: 30px">
                <strong>طريـقة الفحص:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{$compaction_test[0]->test_method}}
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start" style="margin-right: 30px">
                <strong>نـــوع الطبقة:</strong>&nbsp;&nbsp;&nbsp;&nbsp;{{$compaction_test[0]->material_desc}}
            </div>
        </div>
    </div>


    <table class="report-table"style="margin-top: 10px" dir="rtl">
        <thead>
        <tr>
            <th>م.ت</th>
            <th>موقع النقطة</th>
            <th>رقم الطبقة</th>
            <th>نسبة الرطوبة (%)</th>
            <th>الكثافة الجافة (جم/سم³)</th>
            <th>أقصى كثافة جافة (جم/سم³)</th>
            <th>نسبة الدمك (%)</th>
            <th>التقييم</th>
        </tr>

        </thead>
        <tbody>
        @if(!empty($compaction_test) && $compaction_test[0]->compaction_test_details->isNotEmpty())
            @foreach ($compaction_test[0]->compaction_test_details as $test)
        <tr>
            <td>{{$test->point}}</td>
            <td>{{$test->point_location}}</td>
            <td>{{$test->layer_number}}</td>
            <td>{{$test->moisture_content}}</td>
            <td>{{$test->dry_density}}</td>
            <td>{{$test->max_dry_density}}</td>
            <td>{{$test->compaction}}</td>
            <td class="text-success">{{$test->compaction > $test->req_compaction  ?  'نجاح' : 'فشل'}}</td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    <div class="row" style="padding-top: 10px;margin-top: 10px">
        <div class="col-4">
            <strong>Prepared By:</strong><br>
            Laboratory Technician
        </div>
        <div class="col-4 text-center">
            <strong>Reviewed By:</strong><br>
            Senior Engineer
        </div>
        <div class="col-4 text-end">
            <strong>Approved By:</strong><br>
            Lab Manager
        </div>
    </div>

    <div class="row footer-section">
       <p>
           Address:Dhiqar –Nasiriyah-Ur.,Behind the medical college building
           <br>
           Tel: 964 (0) 7824191337 , +964 (0) 7801121951.
           <br>
           Email:info.alsharqlab@gmail.com, alkaabi85@yahoo.com
       </p>
    </div>
    <script>
        window.onload = function() {
            setTimeout(() => {
                let css = '@media print { @page { margin: 0; } body { margin: 0; } header, footer, address { display: none !important; } }';
                let style = document.createElement('style');
                style.type = 'text/css';
                style.appendChild(document.createTextNode(css));
                document.head.appendChild(style);
                window.print();
            }, 500);
        };
    </script>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
