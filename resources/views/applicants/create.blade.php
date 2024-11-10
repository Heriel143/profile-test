@extends('layouts.app')

@section('title', 'Create New Applicant')

@section('content')
    <div class="container pt-5">
        <h1 class="mb-4">Create New Applicant</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="col-6" action="{{ url('applicants') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required
                    class="form-control">
            </div>

            <!-- Education History Section -->
            <div class="mb-3">
                <label class="form-label">Education History</label>
                <div id="education-fields">
                    <div class="education-entry mb-2">
                        <input type="text" name="education[0][institution]" class="form-control"
                            placeholder="Institution Name" required> <br>
                        <input type="text" name="education[0][degree]" class="form-control" placeholder="Degree"
                            required><br>
                        <input type="text" name="education[0][year]" class="form-control" placeholder="Year"
                            required><br>
                        <button type="button" class="btn btn-outline-secondary" onclick="addEducationField()">Add</button>
                    </div>
                </div>
            </div>

            <!-- Work Experience Section -->
            <div class="mb-3">
                <label class="form-label">Work Experience</label>
                <div id="work-fields">
                    <div class="work-entry  mb-2">
                        <input type="text" name="work_experience[0][company]" class="form-control"
                            placeholder="Company Name" required><br>
                        <input type="text" name="work_experience[0][role]" class="form-control" placeholder="Role"
                            required><br>
                        <input type="date" name="work_experience[0][start_date]" class="form-control"
                            placeholder="Start Date" required><br>
                        <input type="date" name="work_experience[0][end_date]" class="form-control"
                            placeholder="End Date" required><br>
                        <button type="button" class="btn btn-outline-secondary" onclick="addWorkField()">Add</button>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="mb-3">
                <label class="form-label">Skills</label>
                <div id="skills-fields">
                    <div class="input-group mb-2">
                        <input type="text" name="skills[]" class="form-control" placeholder="Skill">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="addField('skills-fields', 'skills[]')">Add</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Applicant</button>
        </form>
    </div>

    <script>
        // Function to add a new set of education inputs (Institution, Degree, Year)
        function addEducationField() {
            const container = document.getElementById('education-fields');
            const newEntry = document.createElement('div');
            newEntry.className = 'education-entry mb-2';
            const currentIndex = container.getElementsByClassName('education-entry').length;

            newEntry.innerHTML = `
            <input type="text" name="education[${currentIndex}][institution]" class="form-control" placeholder="Institution Name" required><br>
            <input type="text" name="education[${currentIndex}][degree]" class="form-control" placeholder="Degree" required><br>
            <input type="text" name="education[${currentIndex}][year]" class="form-control" placeholder="Year" required><br>
            <button type="button" class="btn btn-outline-danger" onclick="removeEducationField(this)">Remove</button>
        `;

            container.appendChild(newEntry);
        }

        // Function to remove an education entry
        function removeEducationField(button) {
            button.parentElement.remove();
        }

        // Function to add a new set of work experience inputs (Company Name, Role, Start Date, End Date)
        function addWorkField() {
            const container = document.getElementById('work-fields');
            const newEntry = document.createElement('div');
            newEntry.className = 'work-entry  mb-2';
            const currentIndex = container.getElementsByClassName('work-entry').length;

            newEntry.innerHTML = `
            <input type="text" name="work_experience[${currentIndex}][company]" class="form-control" placeholder="Company Name" required><br>
            <input type="text" name="work_experience[${currentIndex}][role]" class="form-control" placeholder="Role" required><br>
            <input type="date" name="work_experience[${currentIndex}][start_date]" class="form-control" placeholder="Start Date" required><br>
            <input type="date" name="work_experience[${currentIndex}][end_date]" class="form-control" placeholder="End Date" required><br>
            <button type="button" class="btn btn-outline-danger" onclick="removeWorkField(this)">Remove</button>
        `;

            container.appendChild(newEntry);
        }

        // Function to remove a work experience entry
        function removeWorkField(button) {
            button.parentElement.remove();
        }

        // Function to add other fields like Skills
        function addField(containerId, fieldName) {
            const container = document.getElementById(containerId);
            const newField = document.createElement('div');
            newField.className = 'input-group mb-2';
            newField.innerHTML = `
            <input type="text" name="${fieldName}" class="form-control" placeholder="Enter more details">
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">Remove</button>
        `;
            container.appendChild(newField);
        }

        // Function to remove dynamically added fields
        function removeField(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
