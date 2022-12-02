@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Coach</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('coaches.store') }}" method="POST">
        @csrf
        <input type="hidden" name="locale_parent_id" value="{{ request()->locale_parent_id }}">
        <input type="hidden" name="locale_id" value="{{ request()->locale_id }}">
        <input type="hidden" name="page_id" data-id="page_id" id="page_id" value="">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Add Coach</h5>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'First Name',
                                'model'=>$coach,
                                'field'=>'first_name',
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'Last Name',
                                'model'=>$coach,
                                'field'=>'last_name',
                                ])
                            </div>
                            @if (!request()->has('locale_parent_id'))
                                <div class="col-md-6">
                                    @include('atoms.forms.textField',[
                                    'label'=>'Email',
                                    'model'=>$coach,
                                    'field'=>'email',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('atoms.forms.textField',[
                                    'label'=>'Password',
                                    'model'=>$coach,
                                    'field'=>'password',
                                    ])
                                </div>
                            @endif
                        </div>

                    </div>
                </div>



                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Details</h5>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-12">
                                @include('atoms.mediaUpload',[
                                'image_id'=>getValue($coach, 'data.banner_image'),
                                'field'=>"data[banner_image]",
                                'label'=>'Avatar'
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'Designation',
                                'model'=>$coach,
                                'field'=>'designation',
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'Specialization',
                                'model'=>$coach,
                                'field'=>'specialization',
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'Website Url',
                                'model'=>$coach,
                                'field'=>'website_url',
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('atoms.forms.textField',[
                                'label'=>'Mobile No',
                                'model'=>$coach,
                                'field'=>'mobile_no',
                                ])
                            </div>
                            <div class="col-md-12">
                                @include('atoms.forms.tinymcy',[
                                'label'=>'Content',
                                'model'=>$coach,
                                'field'=>'content',
                                'id'=>'coach_detail',
                                'rows'=>15
                                ])
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Qualifications</h5>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-12 repeater">
                                <div data-repeater-list="qualifiactions">
                                    <div data-repeater-item>
                                        <div class="d-flex align-items-center">
                                            <div class="form-group w-100">
                                                <label for="userName">Qualification*</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="qualification"
                                                        placeholder="Qualifiaction..." aria-label="Qualifiaction"
                                                        aria-describedby="button-addon2">
                                                    <button data-repeater-delete class="btn btn-outline-danger"
                                                        type="button" id="button-addon2">Delete</button>
                                                </div>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-primary" value="Add" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Publish</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Create At</label>
                                <input type="text" class="form-control" readonly disabled
                                    value="{{ now()->toDayDateTimeString() }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Status*</label>
                                <select id="inputState" class="form-select  @error('status') is-invalid @enderror"
                                    name="status">
                                    <option value="publish" @if (old('status', isset($coach) && $coach->status) == 'publish') selected @endif>Publish</option>
                                    <option value="draft" @if (old('status', isset($coach) && $coach->status) == 'draft') selected @endif>Draft</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Coach Work Languages</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Coach Languages*</label>
                                <select multiple name="coach_langauges[]"
                                    class="form-select multiple-select   @error('coach_langauge') is-invalid @enderror"
                                    id="coach_langauges" name="coach_langauges">
                                </select>
                                @error('coach_langauge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">City/Country</h5>
                        </div>
                        <hr>
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label for="country_id" class="form-label">Select Country*</label>
                                <select class="form-select single-select   @error('country_id') is-invalid @enderror"
                                    placeholder="Select country" id="country_id" name="country_id">
                                    <option value="">Select country</option>
                                    @foreach (getCountries() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="state_id" class="form-label">Select State*</label>
                                <select class="form-select single-select  @error('state_id') is-invalid @enderror"
                                    id="state_id" name="state_id"></select>
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="city_id" class="form-label">Select City*</label>
                                <select class="form-select  single-select @error('city_id') is-invalid @enderror"
                                    id="city_id" name="city_id"></select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Languages</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mt-1">
                                @isset($coach)
                                    @foreach (getLanguages() as $language)
                                        @if ($coach->locale_id !== $language->id)
                                            @if (in_array($language->id, $coach->languages->pluck('locale_id')->toArray()))
                                                <a class="d-block"
                                                    href="{{ route('blogs.edit', [
                                                        'coach' => $coach->languages->where('locale_id', $language->id)->first()->id,
                                                        'locale_id' => $language->id,
                                                        'locale_parent_id' => $coach->locale_parent_id,
                                                    ]) }}">
                                                    <i class="bx bxs-edit"></i>
                                                    {{ $language->name }}
                                                </a>
                                            @else
                                                @php
                                                    $local_parent_id = $coach->languages->where('locale_id', request()->locale_id)->first();
                                                    $locoale_parent_id = $local_parent_id ? $local_parent_id->locale_parent_id : $coach->id;
                                                @endphp
                                                <a class="d-block"
                                                    href="{{ route('coaches.create', ['locale_parent_id' => $locoale_parent_id, 'locale_id' => $language->id]) }}">
                                                    <i class="bx bxs-add-to-queue"></i>
                                                    {{ $language->name }}
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                @endisset
                                <label for="inputState" class="form-label">Language*</label>
                                <select readonly disabled id="language" class="form-select" name="language">
                                    @foreach (getLanguages() as $key => $value)
                                        <option value="{{ $value->id }}" @if (old('language', request()->locale_id) == $value->id) selected @endif>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection


@push('scripts')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>
    <script>
        var $repeater = $('.repeater').repeater({
            isFirstItemUndeletable: true
        });

        @if (count(collect(old('qualifiaction', $coach))->toArray()) > 0)
            $repeater.setList(@json(old('qualifiaction', $coach)));
        @endif

        tinymce.init({
            selector: '#coach_detail',
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor forecolor  | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        $('#coach_langauges').select2({
            placeholder: 'Select coach languages',
            ajax: {
                url: '/api/list/coach-languages/',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        jQuery('#country_id').select2({
            placeholder: 'Select country',
        });
        jQuery('#state_id').select2({
            placeholder: 'Select state',
        });
        jQuery('#city_id').select2({
            placeholder: 'Select city',
        });

        $('#country_id').on('change', function() {
            var countryId = this.value;
            $('#state_id').select2('destroy');
            $('#city_id').select2('destroy');

            $.ajax({
                url: '{{ route('getStates') }}?country_id=' + countryId,
                type: 'get',
                success: function(res) {
                    $('#state_id').html('<option value="">Select State</option>');
                    $('#city_id').html('<option value="">Select City</option>');

                    $.each(res, function(key, value) {
                        $('#state_id').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                }
            });

            jQuery('#state_id').select2({
                placeholder: 'Select state',
            });
            jQuery('#city_id').select2({
                placeholder: 'Select city',
            });


        });
        $('#state_id').on('change', function() {
            var state_id = this.value;

            if ($('#city_id').hasClass("select2-hidden-accessible")) {
                $('#city_id').select2('destroy');
            }

            $.ajax({
                url: '{{ route('getCities') }}?state_id=' + state_id,
                type: 'get',
                success: function(res) {
                    $('#city_id').html('<option value="">Select City</option>');
                    $.each(res, function(key, value) {
                        $('#city_id').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                    jQuery('#city_id').select2({
                        placeholder: 'Select city',
                    });
                }
            });

        });
    </script>

@endpush
