<div class="uk-first-column" style="">
    {{ \Carbon\CarbonImmutable::parse($this->week)->isoFormat('dddd D') }}
    <div>
        <div><span><span class="week-title">{{ ucfirst($for) }}</span></span></div>
    </div>
    @if ($canChange)
        <div x-data="{ open: false }">
            <div class="main-change" @click="open = ! open"><img src="{{ asset('assets/edit-icon.png') }}"
                    width="35" />
            </div>

            <div class="uk-text-center">
                <a class="edit-your " href= "{{ route('frontend.plan.product.edit', [
                    'user' => auth()->user()->email,
                    'plan' => $userplan->plan->name,
                ]) }}">
                    Edit Your Menu
                </a>
            </div>

            <div x-show="open" @click.outside="open = false">
                <input type="date" class="uk-input" min="{{ $wa }}" max="{{ $wb }}"
                    wire:model='week' name="" id="">
                @error('week')
                    <div class="alert alert-danger uk-text-center uk-mt-4">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="uk-text-center">
            <a class="edit-your "
                href="{{ route('frontend.plan.product.edit', [
                    'user' => auth()->user()->email,
                    'plan' => $userplan->plan->name,
                ]) }}">
                Edit Your Menu
            </a>
        </div>
    @else
        <div class="main-change"><img src="{{ asset('assets/cantedit-icon.png') }}" width="35" />
        </div>
    @endif

</div>
