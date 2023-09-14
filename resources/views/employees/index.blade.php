    @extends('employees.layout')
    @section('content')

    <div class="container mt-5">
        <div class="row mb-4">
            <form method="GET" action="{{ route('employees.index') }}" class="col-md-12">
            <div class="row align-items-center">
        <div class="col-md-3">
            <h1>Employees</h1>
            <h5>There are {{ $employeeCount }} employees</h5>
        </div>
        <div class="col-md-3">
            <input type="text" id="employeeSearchInput" class="form-control" placeholder="Search">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary btn-purple-pill" type="submit" class="btn btn-primary">Search</button>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-primary btn-purple-pill" type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">
                New Employee
            </button>
        </div>
    </div>

        </form>
    </div>


        <table class="table ">
            <tbody>
                @foreach($employees as $employee)
                <tr data-toggle="modal" data-target="#editEmployeeModal-{{ $employee->id }}">
                    <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->contact_phone }}</td>
                </tr>

                <div class="modal fade" id="editEmployeeModal-{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Employee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('employees.update', $employee->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="first_name" class="form-control" placeholder="First name" required value="{{ old('first_name', $employee->first_name) }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="last_name" class="form-control" placeholder="Last name" required value="{{ old('last_name', $employee->last_name) }}">
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <input type="tel" name="contact_phone" class="form-control" placeholder="Contact Number" required value="{{ old('contact_phone', $employee->contact_phone) }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ old('email', $employee->email) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="date" name="dob" class="form-control" required value="{{ old('dob', $employee->dob) }}">
                                    </div>

                                    <h5>Address Info</h5>
                                    <div class="form-group">
                                        <input type="text" name="street_address" class="form-control" placeholder="Street Address" required value="{{ old('street_address', $employee->street_address) }}">
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="city" class="form-control" placeholder="City" required value="{{ old('city', $employee->city) }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" required value="{{ old('postal_code', $employee->postal_code) }}">
                                        </div>
                                        <div class="col">
                                            <select name="country" class="form-control">
                                                <option value="" disabled>Select Country</option>
                                                <option value="USA" {{ old('country', $employee->country) == 'USA' ? 'selected' : '' }}>USA</option>
                                                <option value="Canada" {{ old('country', $employee->country) == 'Canada' ? 'selected' : '' }}>Canada</option>
                                            </select>
                                        </div>
                                    </div>

                                    <h5 class="mt-3">Skills</h5>
                                    <div class="form-row">
                                        <div class="col">
                                            @php
                                            $employeeSkills = $employee->skills->pluck('name')->toArray();
                                            @endphp
                                            <select name="skills[]" multiple class="form-control">
                                                <option value="" disabled>Select skills...</option>
                                                <option value="PHP" {{ in_array('PHP', old('skills', $employeeSkills)) ? 'selected' : '' }}>PHP</option>
                                                <option value="Laravel" {{ in_array('Laravel', old('skills', $employeeSkills)) ? 'selected' : '' }}>Laravel</option>
                                                <option value="MySql" {{ in_array('MySql', old('skills', $employeeSkills)) ? 'selected' : '' }}>MySql</option>
                                                <option value="JavaScript" {{ in_array('JavaScript', old('skills', $employeeSkills)) ? 'selected' : '' }}>JavaScript</option>
                                                <option value="HTML" {{ in_array('HTML', old('skills', $employeeSkills)) ? 'selected' : '' }}>HTML</option>
                                                <option value="CSS" {{ in_array('CSS', old('skills', $employeeSkills)) ? 'selected' : '' }}>CSS</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-row">
                                    @php
                                        $years_exp = $employee->skills->first()->years_exp;  // Assuming each employee has only one skills record.
                                    @endphp
                                    <div class="col">
                                        <input type="number" name="years_exp" class="form-control" placeholder="Yrs Exp" required value="{{ old('years_exp', $years_exp) }}">
                                    </div>
                                        <div class="col">
                                        @php
                                            $level = $employee->skills->first()->level;  // Assuming each employee has only one skills record.
                                        @endphp
                                        
                                        <select name="level" class="form-control">
                                            <option value="" disabled>Level</option>
                                            @for ($i = 0; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('level', $level) == $i ? 'selected' : '' }}>{{ $i }} years</option>
                                            @endfor
                                        </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                <button class="btn btn-danger delete-btn mt-2" data-employee="{{ $employee->id }}">Delete</button>

                            </div>
                           
                        </div>
                    </div>
                </div>
                @endforeach

            </tbody>
        </table>


    </div>

    <div class="modal fade" id="employeeModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #B0C4DE; border-radius: 15px;">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="modal-header">
                    <h4 class="modal-title">New Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('employees.store') }}" method="post">
                        @csrf

                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="first_name" class="form-control" placeholder="First name" required value="{{ old('first_name') }}">
                            </div>
                            <div class="col">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" required value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <input type="tel" name="contact_phone" class="form-control" placeholder="Contact Number" required value="{{ old('contact_phone') }}">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" class="form-control" required value="{{ old('dob') }}">
                        </div>

                        <h5>Address Info</h5>
                        <div class="form-group">
                            <input type="text" name="street_address" class="form-control" placeholder="Street Address" required value="{{ old('street_address') }}">
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="city" class="form-control" placeholder="City" required value="{{ old('city') }}">
                            </div>
                            <div class="col">
                                <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" required value="{{ old('postal_code') }}">
                            </div>
                            <div class="col">
                                <select name="country" class="form-control">
                                    <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select Country</option>
                                    <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                    <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                </select>
                            </div>

                            <h5 class="mt-3">Skills</h5>
                            <div class="form-row">
                                <div class="col">
                                    <select name="skills[]" multiple>
                                        <option value="PHP" {{ in_array('PHP', old('skills', [])) ? 'selected' : '' }}>PHP</option>
                                        <option value="Laravel" {{ in_array('Laravel', old('skills', [])) ? 'selected' : '' }}>Laravel</option>
                                        <option value="MySql" {{ in_array('MySql', old('skills', [])) ? 'selected' : '' }}>MySql</option>
                                        <option value="JavaScript" {{ in_array('JavaScript', old('skills', [])) ? 'selected' : '' }}>JavaScript</option>
                                        <option value="HTML" {{ in_array('HTML', old('skills', [])) ? 'selected' : '' }}>HTML</option>
                                        <option value="CSS" {{ in_array('CSS', old('skills', [])) ? 'selected' : '' }}>CSS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <input type="number" name="years_experience" class="form-control" placeholder="Yrs Exp" required value="{{ old('years_experience') }}">
                            </div>
                            <div class="col">
                                <select name="level" class="form-control">
                                    <option value="" disabled {{ old('level') ? '' : 'selected' }}>Level</option>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('level') == $i ? 'selected' : '' }}>{{ $i }} years</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save New Employee</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    @endsection

    @push('scripts')
<script>
    const hasErrors = @json($errors->any());
    const employeeIdFromBlade = @json(isset($employee) ? $employee->id : null);
    const isEditAction = employeeIdFromBlade !== null;
    const formID = isEditAction ? `editEmployeeModal-${employeeIdFromBlade}` : 'createEmployeeModal';

    $(document).ready(function() {
        if (hasErrors) {
            $(`#${formID}`).modal('show');
        }

        handleFormLocalStorage(formID);
        handleDeleteAction();
        handleSearchInput();
    });

    function handleFormLocalStorage(formID) {
        const formData = localStorage.getItem(formID);

        if (formData) {
            populateForm(formID, JSON.parse(formData));
        }

        $(`#${formID} input, #${formID} select`).on('change', function() {
            storeFormData(formID);
        });
    }

    function storeFormData(formID) {
        const data = {};

        $(`#${formID} input, #${formID} select`).each(function() {
            if (this.name) {
                if (this.type === 'checkbox' || this.type === 'radio') {
                    data[this.name] = $(this).prop('checked');
                } else if (this.type === 'select-multiple') {
                    data[this.name] = $(this).val() || [];
                } else {
                    data[this.name] = $(this).val();
                }
            }
        });

        localStorage.setItem(formID, JSON.stringify(data));
    }

    function populateForm(formID, data) {
        $.each(data, function(key, value) {
            const elem = $(`#${formID} [name="${key}"]`);
            if (elem.is('input[type="checkbox"], input[type="radio"]')) {
                elem.prop('checked', value);
            } else if (elem.is('select[multiple]')) {
                elem.val(value).trigger('change');
            } else {
                elem.val(value);
            }
        });
    }

    function handleDeleteAction() {
        $('.delete-btn').click(function() {
            const employeeId = $(this).data('employee');
            if (confirm('Are you sure you want to delete this employee?')) {
                deleteEmployee(employeeId);
            }
        });
    }

    function deleteEmployee(employeeId) {
        $.ajax({
            url: `/employees/${employeeId}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.message) {
                    alert(response.message);
                }
                $('#employeeModal').modal('hide');
                showUndoNotification(employeeId);
            },
            error: function() {
                alert('Failed to delete the employee. Please try again.');
            }
        });
    }

    function showUndoNotification(employeeId) {
        const notification = $(`<div>Your item has been deleted. <a href="#" class="undo-btn" data-employee="${employeeId}">Undo</a></div>`);
        $('body').append(notification);

        $('.undo-btn').click(function(event) {
            event.preventDefault();
            restoreEmployee(employeeId);
        });
    }

    function restoreEmployee(employeeId) {
        $.ajax({
            url: `/employees/${employeeId}/restore`,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function() {
                alert('Employee restored successfully');
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX error: ", textStatus, errorThrown);
                alert('Failed to restore the employee. Please try again.');
            }
        });
    }

    function handleSearchInput() {
        $('#employeeSearchInput').on('input', function() {
            const searchValue = $(this).val().toLowerCase();
            $('#employeeList option').each(function() {
                const optionValue = $(this).text().toLowerCase();
                if (optionValue.includes(searchValue)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    }
</script>
@endpush
