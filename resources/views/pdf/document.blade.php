<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Posts Report</title>
    <style>
        body {
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            vertical-align: top;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: left;
            color: #495057;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        b {
            font-weight: 700;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<table class="table table-bordered">
    <thead>
    <tr>
        <td class="text-center"><b>SN no</b></td>
        <td><b>Caption</b></td>
        <td><b>Text</b></td>
        <td class="text-center"><b>Image</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $index => $post)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $post->caption }}</td>
            <td>{{ $post->post_text }}</td>
            <td class="text-center">
                @if($post->post_image)
                    <img src="{{storage_path('/app/public/'.$post->post_image)}}" alt="">
                @else
                    No Image
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
