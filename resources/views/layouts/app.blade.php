<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional Custom CSS -->
    <style>
        body {
            padding-top: 60px;
        }
        .error {
            color: red;
        }   
    </style>
    <script>
        var _basePath = "{{ url('') }}/";
        var _token = "{{ csrf_token() }}";
        var baseUrl = "{{ isset($base_url)?$base_url:'' }}";
        var rand = "{{ rand() }}";
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Inventory System</a>
            <div>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/consumer') }}">Consumer</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/product') }}">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/transaction') }}">Transaction</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/report') }}">Report</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
    
    <script src="{{url('custom/paginate.js?v=')}}{{rand()}}"></script>
    <script src="{{url('custom/frm-submit.js?v=')}}{{rand()}}"></script>
    <script>
    function confirmDelete() {
      const confirmed = confirm("Are you sure you want to delete this?");
      /* if (confirmed) {
        // Add your deletion logic here
        alert("Item deleted successfully.");
      } */
    }
</script>
</body>
</html>