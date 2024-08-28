<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Customer Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.form') }}">Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.view') }}">Customers View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.trashed') }}">Trashed Customers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="input-group mb-4">
            <input type="text" id="search" class="form-control" placeholder="Search customers...">
        </div>
        
        <!-- <form action="{{ route('customer.search') }}" method="POST" class="mb-4">
        @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search customers...">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="" class="btn btn-secondary" href="{{route('customer.view')}}">Reset</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
        @endif -->

        <div class="card">
            <div class="card-header">
                Customers List
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th class="px-5">DOB</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="customer-table-body">
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->dob }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', ['id' => $customer->id]) }}"
                                        class="btn btn-primary btn-sm my-2">Edit</a>
                                    <form action="{{ route('customer.softDelete', ['id' => $customer->id]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn my-2 btn-warning btn-sm"
                                            onclick="">Move
                                            to Trash</button>
                                    </form>
                                    <form action="{{ route('customer.delete', ['id' => $customer->id]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn my-2 btn-danger btn-sm"
                                            onclick="">Permanent
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/search.js') }}"></script>
</body>

</html>
