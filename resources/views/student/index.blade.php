<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Student Management</h2>

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        Add New Student
    </button>

    <table id="studentTable" class="display table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Class Teacher</th>
                <th>Admission Date</th>
                <th>Yearly Fees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="mb-3">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input type="text" class="form-control" id="class" name="class" required>
                    </div>
                    <div class="mb-3">
                        <label for="class_teacher_id" class="form-label">Class Teacher</label>
                        <select id="class_teacher_id" name="class_teacher_id" class="form-select" required>
                            <option value="">Select Teachers</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admission_date" class="form-label">Admission Date</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="yearly_fees" class="form-label">Yearly Fees</label>
                        <input type="number" class="form-control" id="yearly_fees" name="yearly_fees" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm">
                    <input type="hidden" id="edit_student_id" name="id">
                    <div class="mb-3">
                        <label for="edit_student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="edit_student_name" name="student_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_class" class="form-label">Class</label>
                        <input type="text" class="form-control" id="edit_class" name="class" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_class_teacher_id" class="form-label">Class Teacher</label>
                        <select id="edit_class_teacher_id" name="class_teacher_id" class="form-select" required>
                           <option value="">Select Teachers</option>
                           @foreach ($teachers as $teacher)
                           <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_admission_date" class="form-label">Admission Date</label>
                        <input type="date" class="form-control" id="edit_admission_date" name="admission_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_yearly_fees" class="form-label">Yearly Fees</label>
                        <input type="number" class="form-control" id="edit_yearly_fees" name="yearly_fees" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $('#studentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("students.index") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'student_name', name: 'student_name' },
                { data: 'class', name: 'class' },
                { data: 'teacher.name', name: 'teacher.name' },
                { data: 'admission_date', name: 'admission_date' },
                { data: 'yearly_fees', name: 'yearly_fees' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });


        $('#addStudentForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route("students.store") }}',
                data: formData,
                success: function (response) {
                    $('#addStudentModal').modal('hide');
                    $('#studentTable').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    alert('Error occurred while adding student');
                }
            });
        });


        $('body').on('click', '.edit-btn', function () {
            let studentId = $(this).data('id');
            $.get('{{ route("students.edit", ":id") }}'.replace(':id', studentId), function (data) {
                $('#edit_student_id').val(data.id);
                $('#edit_student_name').val(data.student_name);
                $('#edit_class').val(data.class);
                $('#edit_class_teacher_id').val(data.class_teacher_id);
                $('#edit_admission_date').val(data.admission_date);
                $('#edit_yearly_fees').val(data.yearly_fees);
                $('#editStudentModal').modal('show');
            });
        });


        $('#editStudentForm').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let studentId = $('#edit_student_id').val();

            $.ajax({
                type: 'PUT',
                url: '{{ route("students.update", ":id") }}'.replace(':id', studentId),
                data: formData,
                success: function (response) {
                    $('#editStudentModal').modal('hide');
                    $('#studentTable').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    alert('Error occurred while updating student');
                }
            });
        });

       
        $('body').on('click', '.delete-btn', function () {
            let studentId = $(this).data('id');
            if (confirm('Are you sure you want to delete this student?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("students.destroy", ":id") }}'.replace(':id', studentId),
                    success: function (response) {
                        $('#studentTable').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        alert('Error occurred while deleting student');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
