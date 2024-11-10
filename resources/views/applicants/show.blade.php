@extends('layouts.app')

@section('title', 'Edit Applicant')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Applicant</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="row" action="{{ route('applicants.update', $applicant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class=" col-md-6">


                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" name="full_name" id="full_name"
                        value="{{ old('full_name', $applicant->full_name) }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" readonly id="email"
                        value="{{ old('email', $applicant->email) }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number"
                        value="{{ old('phone_number', $applicant->phone_number) }}" required class="form-control">
                </div>

                <!-- Education History Section -->
                <div class="mb-3">
                    <label class="form-label">Education History</label>
                    <div id="education-fields">
                        @foreach ($applicant->educationHistory as $index => $education)
                            <div class="education-entry card card-body  mb-3">
                                <input type="number" name="education[{{ $index }}][id]"
                                    value="{{ $education['id'] }}" style="display: none">

                                <label for="institution" class="form-label">Institution</label>
                                <input type="text" name="education[{{ $index }}][institution]"
                                    class="form-control" placeholder="Institution Name"
                                    value="{{ old("education.$index.institution", $education['institution']) }}" required>
                                <br>
                                <label for="degree" class="form-label">Degree</label>
                                <input type="text" name="education[{{ $index }}][degree]" class="form-control"
                                    placeholder="Degree" value="{{ old("education.$index.degree", $education['degree']) }}"
                                    required><br>
                                <label for="year" class="form-label">Year</label>
                                <input type="text" name="education[{{ $index }}][year]" class="form-control"
                                    placeholder="Year" value="{{ old("education.$index.year", $education['year']) }}"
                                    required><br>
                                <button type="button" class="btn btn-outline-danger"
                                    onclick="removeEducationField(this)">Remove</button>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-outline-secondary" onclick="addEducationField()">Add
                            Education</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">


                <!-- Work Experience Section -->
                <div class="mb-3">
                    <label class="form-label">Work Experience</label>
                    <div id="work-fields">
                        @foreach ($applicant->workExperience as $index => $work)
                            <div class="work-entry card card-body  mb-3">

                                <input type="number" name="work_experience[{{ $index }}][id]"
                                    value="{{ $work['id'] }}" style="display: none">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" name="work_experience[{{ $index }}][company]"
                                    class="form-control" placeholder="Company Name"
                                    value="{{ old("work_experience.$index.company", $work['company']) }}" required><br>
                                <label for="role" class="form-label">Role</label>
                                <input type="text" name="work_experience[{{ $index }}][role]"
                                    class="form-control" placeholder="Role"
                                    value="{{ old("work_experience.$index.role", $work['role']) }}" required><br>
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="work_experience[{{ $index }}][start_date]"
                                    class="form-control"
                                    value="{{ old("work_experience.$index.start_date", $work['start_date']) }}"
                                    required><br>
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="work_experience[{{ $index }}][end_date]"
                                    class="form-control"
                                    value="{{ old("work_experience.$index.end_date", $work['end_date']) }}" required><br>
                                <button type="button" class="btn btn-outline-danger"
                                    onclick="removeWorkField(this)">Remove</button>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-outline-secondary" onclick="addWorkField()">Add Work
                            Experience</button>
                    </div>
                </div>



                <!-- Skills Section -->
                <div class="mb-3">
                    <label class="form-label">Skills</label>
                    <div id="skills-fields">
                        @foreach ($applicant->skills as $index => $skill)
                            <div class="input-group mb-2">
                                <input type="number" name="skills[{{ $index }}][id]"
                                    value="{{ $skill['id'] }}" style="display: none">
                                <input type="text" name="skills[{{ $index }}]" class="form-control"
                                    placeholder="Skill" value="{{ old("skills.$index", $skill['name']) }}">
                                <button type="button" class="btn btn-outline-danger"
                                    onclick="removeField(this)">Remove</button>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="addField('skills-fields', 'skills[]')">Add Skill</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Applicant</button>
        </form>
    </div>

    <script>
        // Function to add a new Education field set
        function addEducationField() {
            const educationFields = document.getElementById('education-fields');
            const index = educationFields.children.length - 1; // Dynamic index
            const newEducation = document.createElement('div');
            newEducation.classList.add('education-entry', 'card card-body', 'mb-3');

            newEducation.innerHTML = `
            <label for="institution" class="form-label">Institution</label>
            <input type="text" name="education[${index}][institution]" class="form-control" placeholder="Institution Name" required><br>
            <label for="degree" class="form-label">Degree</label>
            <input type="text" name="education[${index}][degree]" class="form-control" placeholder="Degree" required><br>
            <label for="year" class="form-label">Year</label>
            <input type="text" name="education[${index}][year]" class="form-control" placeholder="Year" required><br>
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">Remove</button>
        `;

            educationFields.insertBefore(newEducation, educationFields.lastElementChild); // Insert before Add button
        }

        // Function to add a new Work Experience field set
        function addWorkField() {
            const workFields = document.getElementById('work-fields');
            const index = workFields.children.length - 1; // Dynamic index
            const newWork = document.createElement('div');
            newWork.classList.add('work-entry', 'card card-body', 'mb-3');

            newWork.innerHTML = `
            <label for="company" class="form-label">Company</label>
            <input type="text" name="work_experience[${index}][company]" class="form-control" placeholder="Company Name" required><br>
            <label for="role" class="form-label">Role</label>
            <input type="text" name="work_experience[${index}][role]" class="form-control" placeholder="Role" required><br>
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="work_experience[${index}][start_date]" class="form-control" required><br>
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="work_experience[${index}][end_date]" class="form-control" required><br>
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">Remove</button>
        `;

            workFields.insertBefore(newWork, workFields.lastElementChild); // Insert before Add button
        }

        // Function to add a new Skills field
        function addField(containerId, fieldName) {
            const container = document.getElementById(containerId);
            const index = container.children.length - 1; // Dynamic index for skills
            const newSkill = document.createElement('div');
            newSkill.classList.add('input-group', 'mb-3');

            newSkill.innerHTML = `
            <input type="text" name="${fieldName}" class="form-control" placeholder="Skill" required>
            <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">Remove</button>
        `;

            container.insertBefore(newSkill, container.lastElementChild); // Insert before Add button
        }

        // Function to remove a specific field set
        function removeField(button) {
            button.parentElement.remove();
        }
    </script>

@endsection
