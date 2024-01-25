{{-- view reason --}}

<tr class="view-items-row text-center" style="display: none;" id="view-options-{{ $item->id }}">
    <td colspan="6">
        <table class="table align-items-center mb-0">
            <h6 class="table mb-0">Cancel Orders Table</h6>
            <thead>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    ID Report
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Reason
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Action
                </th>
            </thead>
            <tbody>
                <tr>
                    @if ($item->orderCancellations->isNotEmpty())
                        <td>
                            {{ $item->orderCancellations->first()->id }}
                        </td>
                        <td class="text-center">
                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $item->orderCancellations->first()->cancel_reason }}"
                                style="display: inline-block; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ \Illuminate\Support\Str::limit($item->orderCancellations->first()->cancel_reason, 100, $end = '...') }}
                            </span>
                        </td>
                        <td>
                            {{-- Cancel --}}
                            <a href="javascript:;"
                                class="btn btn-link text-danger text-gradient px-3 mb-0 confirm-action"
                                data-action="Cancel" data-order-id="{{ $item->id }}">
                                <i class="far fa-trash-alt me-2"></i>Submit Cancel
                            </a>
                            {{-- form submit --}}
                            <form id="confirmForm{{ $item->id }}"
                                action="{{ route('dashboard.orders.confirm', $item->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                <input type="hidden" name="action" id="confirmAction{{ $item->id }}">
                            </form>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </td>
</tr>
