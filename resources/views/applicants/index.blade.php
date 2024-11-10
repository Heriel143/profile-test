@extends('layouts.app')

@section('content')

    <div class="container pt-3">


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class=" pb-3 d-flex justify-content-between">

            <h1>Applicants List</h1>


            <a href="{{ url('/applicants/create') }}" class="btn btn-primary">Create Applicant</a>
        </div>

        @if ($applicants->isEmpty())
            <p>No applicants found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr>
                            <td>{{ $applicant->full_name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->phone_number }}</td>
                            <td>
                                <a href="{{ url('/applicants', $applicant->id) }}" class="btn btn-primary">View Profile</a>
                                <form action="{{ url('/applicants', $applicant->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
