@extends('layouts.admin', [
    'page_header' => 'Students',
    'dash' => '',
    'quiz' => '',
    'users' => 'active',
    'questions' => '',
    'top_re' => '',
    'all_re' => '',
    'sett' => '',
])

@section('content')
    @if ($auth->role == 'A')
        <div class="margin-bottom">
            <button type="button" class="btn btn-wave" data-toggle="modal" data-target="#createModal">Add Student</button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AllDeleteModal">Delete All
                Students</button>
        </div>
        <!-- All Delete Button -->
        <div id="AllDeleteModal" class="delete-modal modal fade" role="dialog">
            <!-- All Delete Modal -->
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="modal-heading">Are You Sure ?</h4>
                        <p>Do you really want to delete "All these records"? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['method' => 'POST', 'action' => 'DestroyAllController@AllUsersDestroy']) !!}
                        {!! Form::reset('No', ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Modal -->
        <div id="createModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Student</h4>
                    </div>
                    {!! Form::open([
                        'files' => true,
                        'method' => 'POST',
                        'action' => 'UsersController@store',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', 'Student Name') !!}
                                    <span class="required">*</span>
                                    {!! Form::text('name', null, [
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'placeholder' => 'Enter Your Name',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    {!! Form::label('email', 'Email address') !!}
                                    <span class="required">*</span>
                                    {!! Form::email('email', null, [
                                        'class' => 'form-control email-input',
                                        'placeholder' => 'eg: info@example.com',
                                        'required' => 'required',
                                        'maxlength' => '60',
                                        'aria-label' => 'Email Address',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    {!! Form::label('password', 'Password') !!}
                                    <span class="required">*</span>
                                    <div class="input-group">
                                      <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required aria-label="Password">
                                      <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                      </span>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                    {!! Form::label('role', 'User Role') !!}
                                    <span class="required">*</span>
                                    <select name="role" id="" class="select2 form-control">
                                        <option value="S">Student</option>
                                        <option value="A">Admin</option>
                                    </select>
                                    <small class="text-danger">{{ $errors->first('role') }}</small>
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="image">Choose Profile Picture:</label>
                                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" aria-label="Profile Picture">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    {!! Form::label('mobile', 'Mobile No.') !!}
                                    {!! Form::text('mobile', null, ['class' => 'form-control mobile-input', 'placeholder' => 'eg: +911234567890', 'maxlength' => '15', 'pattern' => '[0-9+]{1,15}', 'aria-label' => 'Mobile Number']) !!}
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    {!! Form::label('city', 'Enter City') !!}
                                    {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Enter Your City']) !!}
                                    <small class="text-danger">{{ $errors->first('city') }}</small>
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::textarea('address', null, [
                                        'class' => 'form-control',
                                        'rows' => '5',
                                        'placeholder' => 'Enter Your address',
                                    ]) !!}
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            {!! Form::reset('Reset', ['class' => 'btn btn-default']) !!}
                            {!! Form::submit('Add', ['class' => 'btn btn-wave']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="content-block box">
            <div class="box-body table-responsive">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Image</th>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>User Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($users)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('/images/user/' . $user->image) }}" alt="User Image"
                                            width="100">
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->role == 'S' ? 'Student' : '-' }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                            data-target="#{{ $user->id }}EditModal"><i class="fa fa-edit"></i> Edit</a>
                                        <!-- Delete Button -->
                                        <a type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#{{ $user->id }}deleteModal"><i class="fa fa-close"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div id="{{ $user->id }}deleteModal" class="delete-modal modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="delete-icon"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h4 class="modal-heading">Are You Sure?</h4>
                                                <p>Do you really want to delete these records? This process cannot be
                                                    undone.
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                                                {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['App\Http\Controllers\UsersController@destroy', $user->id]]) !!} --}}
                                                {!! Form::reset('No', ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                                {!! Form::submit('Yes', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Modal -->
                                <div id="{{ $user->id }}EditModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit Student</h4>
                                            </div>
                                            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id],'enctype' => 'multipart/form-data']) !!}
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                            {!! Form::label('name', 'Name') !!}
                                                            <span class="required">*</span>
                                                            {!! Form::text('name', null, [
                                                                'class' => 'form-control',
                                                                'required' => 'required',
                                                                'placeholder' => 'Enter your name',
                                                            ]) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('name') }}</small>
                                                        </div>
                                                        <div
                                                            class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                            {!! Form::label('email', 'Email Address') !!}
                                                            <span class="required">*</span>
                                                            {!! Form::email('email', null, [
                                                                'class' => 'form-control email-input',
                                                                'placeholder' => 'eg: info@example.com',
                                                                'required' => 'required',
                                                                'maxlength' => '60',
                                                                'aria-label' => 'Email Address',
                                                            ]) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('email') }}</small>
                                                        </div>
                                                        <div
                                                            class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                            {!! Form::label('password', 'Password') !!}
                                                            <span class="required">*</span>

                                                            <div class="input-group">
                                                              <input type="password" name="password" class="form-control" placeholder="Change Your Password" aria-label="Password">
                                                              <span class="input-group-addon toggle-password-btn" style="cursor:pointer;" aria-label="Toggle password visibility">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                              </span>
                                                            </div>
                                                            <small
                                                                class="text-danger">{{ $errors->first('password') }}</small>
                                                        </div>
                                                        <div
                                                            class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                                            {!! Form::label('role', 'User Role') !!}
                                                            <span class="required">*</span>
                                                            {!! Form::select('role', ['S' => 'Student', 'A' => 'Administrator'], null, [
                                                                'class' => 'form-control select2',
                                                                'required' => 'required',
                                                            ]) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('role') }}</small>
                                                        </div>
                                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                                            <label for="image">Choose Profile Picture:</label>
                                                            <input type="file" class="form-control" name="image"
                                                                accept="image/jpeg,image/jpg,image/png,image/webp" aria-label="Profile Picture" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                            {!! Form::label('mobile', 'Mobile No.') !!}
                                                            {!! Form::text('mobile', null, ['class' => 'form-control mobile-input', 'placeholder' => 'eg: +911234567890', 'maxlength' => '15', 'pattern' => '[0-9+]{1,15}', 'aria-label' => 'Mobile Number']) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('mobile') }}</small>
                                                        </div>
                                                        <div
                                                            class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                                            {!! Form::label('city', 'Enter City') !!}
                                                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Enter Your City']) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('city') }}</small>
                                                        </div>
                                                        <div
                                                            class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                            {!! Form::label('address', 'Address') !!}
                                                            {!! Form::textarea('address', null, [
                                                                'class' => 'form-control',
                                                                'rows' => '5',
                                                                'placeholder' => 'Enter Your Address',
                                                            ]) !!}
                                                            <small
                                                                class="text-danger">{{ $errors->first('address') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group pull-right">
                                                    {!! Form::submit('Update', ['class' => 'btn btn-wave']) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(function() {

            var table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                scrollCollapse: true,


                ajax: "{{ route('users.index') }}",
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false
                    }
                ],
                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                order: [
                    [0, 'desc']
                ]
            });

        });
    </script>
@endsection
