<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-2">
        <nav class="navbar navbar-dark bg-dark">
            <!-- Navbar content -->
            <div class="pull-left">
                <h2 class="text-white">List OrcId</h2>
            </div>
          </nav>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table id="id_table" class="table table-bordered">
            <thead>
                <tr>
                    <th width="380px">OrcId</th>
                    <th width="280px">Names</th>
                    <th width="280px">LastNames</th>
                    <th width="280px">Keywords</th>
                    <th width="100px">Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="id_tbody">
            </tbody>
        </table>
        <br>
        <div id="pagination-links" class="d-flex justify-content-center"></div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script type="text/javascript" src="js/app.js"></script>

</html>
