@extends('admin.master')

@section('title', 'Logs List')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Logs</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table id="logsTable" class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Phone Number</th>
                    <th>Data Type</th>
                    <th>Message</th>
                    <th>Country</th>
                    <th>Logged At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td>{{ $log->phone_number ?? '—' }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst($log->type) }}
                        </span>
                    </td>
                    <td>{{ $log->message }}</td>
                      <td>{{ $log->country }}</td>
                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- jQuery (must come before DataTables) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables CSS + JS with Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#logsTable').DataTable({
            responsive: true,
        });
    });
</script>
@endsection
