<div>
    <label for="user_id" class="form-label pt-3">User</label>
    <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
        <option value="">Select User</option>
        @foreach ($users as $item)
            <option value="{{ $item->id }}">
                {{ $item->full_name }} - {{ $item->email }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <label for="plan_id" class="form-label pt-3">Plan</label>
    <select wire:click="checkPlan" wire:model="plan" class="form-select @error('plan_id') is-invalid @enderror"
        name="plan_id">
        <option style="user-select: auto;" value="">Select Plan</option>
        @foreach ($plans as $item)
            <option style="user-select: auto;" value="{{ $item->id }}">
                {{ $item->name }} - {{ $item->limit . ' Meals' }} -
                {{ 'Rs ' . $item->price . ' | per meal' }}
            </option>
        @endforeach
    </select>
    @error('plan_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="text-center {{ $producttoggle == true ? 'd-block' : 'd-none' }} mt-4">
        <div class="row">
            @if (!is_null($products))
                @foreach ($products as $item)
                    <div class="col-3">
                        <div class="card">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->description }}</p>
                                <input type="checkbox" @if (in_array($item->id, $this->checked)) checked @endif
                                    wire:click="checkproduct({{ $item->id }})">
                            </div>
                            @if (in_array($item->id, $this->checked))
                                <div class="row">
                                    <div class="col-3">
                                        <button type="button">-</button>
                                    </div>
                                    <div class="col-6">
                                        <input class="border-none" type="number"
                                            wire:model="quantity.{{ $item->id }}" name="" id="">
                                    </div>
                                    <div class="col-3">
                                        <button type="button">+</button>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    checkproducts:{{ var_export($checked) }}
    quantity:{{ var_export($quantity) }}

</div>
