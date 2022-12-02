@extends("layouts.app")


@section('wrapper')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0 text-primary">Edit User</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="name" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                class="form-control   @error('first_name') is-invalid @enderror" id="first_name">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last name" class="form-label">Last Name</label>
                            <input type="name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                class="form-control   @error('last_name') is-invalid @enderror" id="last_name">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-6">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control   @error('email') is-invalid @enderror" id="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" value=""
                                class="form-control   @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="col-md-6">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="number" name="zip" value="{{ old('zip', $user->zip) }}"
                                class="form-control   @error('zip') is-invalid @enderror" id="zip">
                            @error('zip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 pt-4">
                            @include('atoms.forms.input', [
                                'name' => 'status',
                                'label' => 'Status',
                                'value' => old('status', $user->status),
                                'type' => 'checkbox',
                            ])
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        $('.select-role-checkbox').on('click', function() {
            if ($(this).closest('.select-role-checkbox').find('.select-inner-role-checkbox:checked').length == $(
                    this).closest('.select-role-checkbox').find('.select-inner-role-checkbox').length) {

                $(this).closest('.select-role-checkbox').find('.select-all-checkbox').prop('checked', true);

            } else {

                $(this).closest('.select-role-checkbox').find('.select-all-checkbox').prop('checked', false);

            }
        });
        $('.select-role-checkbox .select-all-checkbox').on('click', function() {
            if (this.checked) {
                $(this).closest('.select-role-checkbox').find('.select-inner-role-checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(this).closest('.select-role-checkbox').find('.select-inner-role-checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        jQuery.each(jQuery('.select-role-checkbox'), function() {
            if ($(this).find('.select-inner-role-checkbox:checked').length == $(this).find(
                    '.select-inner-role-checkbox').length) {
                $(this).find('.select-all-checkbox').prop('checked', true);
            }

        });
    </script>
@endpush
