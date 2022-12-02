<tr>
    <td>{{ $item->plan->name }}</td>
    <td>{{ $item->created_at->format('d-m-y') }}</td>
    <td>{{ $item->expire_at->format('d-m-y') }}</td>
    <td>
        <button type="button"
            class="{{ $item->status == 3 ? 'Inactive' : config('enum.plan_status')[$item->status] }}">{{ config('enum.plan_status')[$item->status] }}
        </button>
    </td>
    <td>
        @if ($item->status == 0 || $item->status == 3)
            <button class="renew" wire:click='renew'>
                <div wire:target="renew" wire:loading.remove>
                    Renew
                </div>
                <div wire:loading wire:target="renew">
                    <i class="fa fa-spinner fa-spin" style="font-size:15px"></i>
                </div>
            </button>
        @endif
        @if ($item->status == 1 || $item->status == 2)
            <button class="{{ $item->status == 1 ? 'In-Queue' : 'cancel' }}" wire:click='cancel'>
                <div wire:target="cancel" wire:loading.remove>
                    Cancel Or Update
                </div>
                <div wire:loading wire:target="cancel">
                    <i class="fa fa-spinner fa-spin" style="font-size:15px"></i>
                </div>
            </button>
        @endif

    </td>
    <td style="padding-top: 13px;">
        <a class="hoverwhite"
            href="{{ route('frontend.plan.details', [
                'user' => auth()->user()->email,
                'plan' => $item->plan->name,
            ]) }}" style="padding: 6px 17px;text-decoration:none; ">View</a>
    </td>
</tr>
