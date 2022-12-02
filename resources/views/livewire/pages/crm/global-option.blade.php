<div>


    <!-- Modal -->

    <div wire:ignore.self class="modal fade " id="modalForm" tabindex="-1" role="dialog"
        aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-md " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $action == 'add' ? 'Add' : 'Update' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="save" autocomplete="false">

                    <div class="modal-body">
                        {{-- for adding new option --}}
                        @if ($action == 'add')
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Key</label>
                                        <input wire:model.defer="updateInputKey" type="text"
                                            class="form-control @error('updateInputKey') is-invalid @enderror"
                                            aria-describedby="emailHelp" placeholder="Enter Key">
                                        @error('updateInputKey')
                                            <small class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Value</label>
                                        <input wire:model.defer="updateInputValue" type="text"
                                            class="form-control @error('updateInputValue') is-invalid @enderror"
                                            aria-describedby="emailHelp" placeholder="Enter Value">
                                        @error('updateInputValue')
                                            <small class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea cols="30" rows="4" wire:model.defer="description" type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            aria-describedby="emailHelp" placeholder="Enter Description"></textarea>
                                        @error('description')
                                            <small class="form-text text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- for editing admin_email option --}}
                        @if ($updateInputKey == 'admin_email')
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control m-3" id="key" placeholder="Enter key"
                                        wire:model.defer="updateInputKey">
                                </div>
                                <div class="col-sm-12">
                                    <label for="">Value for <b>{{ $updateInputKey ?? '' }}</b></label>
                                    <input type="email" class="form-control" id="value" placeholder="Enter value"
                                        wire:model.defer="updateInputValue">
                                </div>
                            </div>
                        @endif


                        {{-- for editing restricted delivery dates option --}}
                        @if ($updateInputKey == 'restricted_delivery_dates')
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control m-3" id="key" placeholder="Enter key"
                                        wire:model.defer="updateInputKey">
                                </div>

                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="Pick the multiple dates"
                                        id="datepicker" autocomplete="off" wire:change>
                                    <input type="hidden" id="dateinput" class="form-control"
                                        wire:model.defer="updateInputValue">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit"
                            class="btn btn-primary">{{ $action == 'add' ? 'Add' : 'Update' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-6">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Options</li>
                        </ol>

                    </nav>

                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4">
            </div>
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                {{-- <div class="position-relative">
                    <form action="{{ route('nutritions.index') }}">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Nutritions" name="keyword" value="{{ request()->keyword }}">
                        <span class="position-absolute top-50 product-show translate-middle-y">
                        <i class="bx bx-search"></i>
                    </span>
                    </form>
                </div> --}}
                <div class="ms-auto">
                    <button wire:loading.remove wire:click='add' class="btn btn-primary radius-30 mt-2 mt-lg-0">
                        <i class="bx bxs-plus-square"></i>
                        Add Global Option
                    </button>

                    <div wire:loading wire:target="add" class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Attribute</th>
                            <th>Value</th>
                            <th>For</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody wire:loading.class="opacity-50">

                        @forelse ($options as $option)
                            <tr>
                                <td>
                                    {{ $option->id }}
                                </td>
                                <td>
                                    {{ $option->key }}
                                </td>
                                <td>
                                    @if ($option->key == 'restricted_delivery_dates')
                                        @if ($option->value != '[]' && $option->value != null && $option->value != '')
                                            @foreach ($r as $key => $value)
                                                {{ date('d-F-y', strtotime($value)) }} <br>
                                            @endforeach
                                        @else
                                            No restricted dates
                                        @endif
                                    @else
                                        {{ $option->value }}
                                    @endif
                                </td>
                                <td>
                                    {{ $option->description }}
                                </td>
                                <td>

                                    <button wire:loading.remove class="btn btn-success"
                                        wire:click="selectItem({{ $option->id }}, 'edit')">

                                        <div wire:target="selectItem({{ $option->id }}, 'edit')">
                                            Edit
                                        </div>

                                    </button>

                                    <div wire:loading wire:target="selectItem({{ $option->id }}, 'edit')">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </div>


                                    {{-- <button class="btn btn-danger"
                                        wire:click="selectItem({{ $option->id }}, 'delete')">delete</button> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h4 class="m-5 text-center">
                                        No records
                                    </h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <input type="text" id="datepicker" hidden>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $options->links('livewire::bootstrap') }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // var array = @this.restrictedDates;

            var array = {!! json_encode($r) !!};
            if (array == '') {
                array = null;
            }
            // $.each(array, function(index, value) {
            //     array[index] = new Date(value)
            // });
            $('#datepicker').multiDatesPicker({
                addDates: array,
                dateFormat: 'dd-mm-yy',
                onSelect: function(restrictdates) {
                    if (array == null) {
                        array = [];
                    }
                    var idx = $.inArray(restrictdates, array);
                    if (idx == -1) {
                        array.push(restrictdates);
                    } else {
                        array.splice(idx, 1);
                    }
                    @this.set('updateInputValue', array);
                }
            });
        });
    </script>
</div>
