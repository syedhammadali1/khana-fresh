@extends("layouts.app")


@section('wrapper')

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <form class="row g-3" action="{{ route('pages.store') }}" method="POST">
        @csrf
        {{-- <input type="hidden" name="locale_parent_id" value="{{ request()->locale_parent_id }}">
        <input type="hidden" name="locale_id" value="{{ request()->locale_id }}"> --}}
        <input type="hidden" name="page_id" data-id="page_id" id="page_id" value="{{ $page->id }}">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Page</h5>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            @include('atoms.forms.textField',[
                            'label'=>'Title',
                            'model'=>$page,
                            'field'=>'title',
                            ])
                             <a class="" href="{{getValue($page,'frontend_url')}}">
                                {{getValue($page,'frontend_url')}}
                            </a>
                            {{-- <div class="slug-body d-flex align-items-center align-content-center">
                                <a class="" href="{{ route('dashboard') }}">
                                    {{ route('dashboard') }}/
                                </a>
                                <div class="slug-create">
                                    <input name="slug" type="text" />
                                    <button class="slug-generate-save">Save</button>
                                </div>
                                <div class="slug-edit">
                                    <button class="slug-generate-edit">Edit</button>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <div class="page-template-fields">
                    @if (old('template', $page->template))
                        @include('pages.templates.'.old('template',$page->template))
                    @else
                        @include('pages.templates.default-template')
                    @endif
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
                                    value="{{ $page->created_at->toDayDateTimeString() }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Status*</label>
                                <select id="inputState" class="form-select  @error('status') is-invalid @enderror"
                                    name="status">
                                    <option value="publish" @if (old('status', getValue($page, 'status')) == 'publish') selected @endif>Publish</option>
                                    <option value="draft" @if (old('status', getValue($page, 'status')) == 'draft') selected @endif>Draft</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-1">
                                <label for="inputState" class="form-label">Template*</label>
                                <select id="templates" class="form-select  @error('template') is-invalid @enderror"
                                    name="template">
                                    @foreach (getTemplates() as $key => $value)
                                        <option value="{{ $key }}" @if (old('template', getValue($page, 'template')) == $key) selected @endif>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('template')
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
                            <h5 class="mb-0 text-primary">Languages</h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 mt-1">
                                @foreach (getLanguages() as $language)
                                    @if ($page->locale_id !== $language->id)
                                        @if (in_array($language->id, $page->languages->pluck('locale_id')->toArray()))
                                            <a class="d-block"
                                                href="{{ route('pages.edit', [
                                                    'page' => $page->languages->where('locale_id', $language->id)->first()->id,
                                                    'locale_id' => $language->id,
                                                    'locale_parent_id' => $page->locale_parent_id,
                                                ]) }}">
                                                <i class="bx bxs-edit"></i>
                                                {{ $language->name }}
                                            </a>
                                        @else
                                            @php
                                                $local_parent_id = $page->languages->where('locale_id', request()->locale_id)->first();
                                                $locoale_parent_id = $local_parent_id ? $local_parent_id->locale_parent_id : $page->id;
                                            @endphp
                                            <a class="d-block"
                                                href="{{ route('pages.create', ['locale_parent_id' => $locoale_parent_id, 'locale_id' => $language->id]) }}">
                                                <i class="bx bxs-add-to-queue"></i>
                                                {{ $language->name }}
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-success">
                                            <i class="bx bxs-edit"></i>
                                            {{ $language->name }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection


@push('scripts')


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
