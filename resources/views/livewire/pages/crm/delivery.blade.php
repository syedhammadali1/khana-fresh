<div>
    <div class="row" x-data="{
        open: true,
        datefiler: false
    }">

        <div class="col-6">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Today's Delivery</li>
                        </ol>

                    </nav>

                </div>
            </div>
        </div>
        <div class="col-6 text-end">


            {{-- filter-btn --}}
            <button :class="{'btn btn-primary' : open, 'btn btn-white' : !open}"
                @click="open = ! open,datefiler = false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter"
                    viewBox="0 0 16 16">
                    <path
                        d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg> Filter
            </button>
        </div>
        <div class="col-12 mb-3" x-show="open" x-transition:enter.duration.500ms x-transition:leave.duration.500ms>
            {{-- Date-Range --}}
            <button :class="{'btn btn-primary' : datefiler, 'btn btn-white' : !datefiler}"
                @click="datefiler = ! datefiler">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor"
                    class="bi bi-calendar-date" viewBox="0 0 16 16">
                    <path
                        d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z" />
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                </svg>
                Date-Range
            </button>

        </div>

        {{-- datepicker --}}
        <div class="col-12 card p-4" @click.outside="datefiler = false" x-show="datefiler"
            x-transition:enter.duration.500ms x-transition:leave.duration.500ms>
            <div class="row">
                <div class="col-6">
                    {{-- <input type="range" class="form-range" id="customRange1"> --}}
                    <div class="mb-3">
                        <label for="customRange1" class="form-label">From</label>
                        <input type="date" class="form-control" wire:model.defer="from" id="customRange1">
                    </div>

                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="customRange1" class="form-label">To</label>
                        <input type="date" class="form-control" wire:model.defer="to" id="customRange1">
                    </div>
                </div>
                <div class="col-12 mb-3 text-center">
                    <button class="btn btn-warning" wire:click='filterReset' x-show="datefiler"
                        x-transition:enter.duration.500ms x-transition:leave.duration.500ms wire:loading.attr="disabled"
                        wire:target="filterReset">
                        <div wire:loading wire:target="filterReset">
                            <div class="spinner-border h-w-15 text-dark" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        <div wire:loading.remove wire:target="filterReset">
                            Reset
                        </div>
                    </button>
                    <button class="btn btn-success" wire:click='filter' x-show="datefiler"
                        x-transition:enter.duration.500ms x-transition:leave.duration.500ms wire:loading.attr="disabled"
                        wire:target="filter">
                        <div wire:loading wire:target="filter">
                            <div class="spinner-border h-w-15" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        <div wire:loading.remove wire:target="filter">
                            Apply
                        </div>
                    </button>
                </div>
            </div>
        </div>

    </div>



    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Order-ID</th>
                            <th>User Name</th>
                            <th>User Plan</th>
                            <th>Week</th>
                            <th>Delivery Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody wire:loading.class="opacity-50">

                        @forelse ($plans as $item)
                            @php
                                $matchWeek = $item->matchWeek($from, $to);
                            @endphp
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>

                                    {{ $item->user->email }}
                                </td>
                                <td>
                                    {{ $item->plan->name }}
                                </td>
                                <td>
                                    @foreach ($matchWeek as $key => $v)
                                        {{ $key }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($matchWeek as $k => $value)
                                        {{ $value }} <br>
                                    @endforeach
                                </td>
                                {{-- <td>
                                    {{ $item->created_at->toDayDateTimeString() }}
                                </td> --}}
                                <td>
                                    <a class="btn btn-success"
                                        href="{{ route('pdf.generate', ['for' => 'userplan', 'id' => $item->id]) }}">
                                        <i class=' bx bxs-download'></i> PDF
                                    </a>

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

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $plans->links('livewire::bootstrap') }}
            </div>
        </div>
    </div>
</div>
