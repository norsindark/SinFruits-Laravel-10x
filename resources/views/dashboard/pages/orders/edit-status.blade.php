<tr class="edit-items-row text-center" style="display: none;" id="edit-options-{{ $item->id }}">
    <td colspan="6">
        <table class="table align-items-center mb-0">
            <h6 class="table text-center mb-0">Update Status</h6>

            <tbody>
                <tr>

                    @if ($item->status != 3)
                        <td>
                            IC {{ $item->id }}:
                        </td>
                        <td class="text-center">


                            {{-- Processing --}}
                            <a href="javascript:;" class="btn btn-link text-dark px-3 mb-0 confirm-action"
                                data-action="Processing" data-order-id="{{ $item->id }}">
                                <i class="fas fa-eye text-dark me-2"></i>Processing
                            </a>

                            {{-- Paid --}}
                            <a href="javascript:;" class="btn btn-link text-dark px-3 mb-0 confirm-action"
                                data-action="Paid" data-order-id="{{ $item->id }}">
                                <i class="fas fa-money-bill text-dark me-2"></i>Confirm Paid
                            </a>

                            {{-- Completed --}}
                            <a href="javascript:;" class="btn btn-link text-dark px-3 mb-0 confirm-action"
                                data-action="Completed" data-order-id="{{ $item->id }}">
                                <i class="fas fa-solid fa-check text-dark me-2"></i>Completed
                            </a>

                            {{-- Cancel --}}
                            <a href="javascript:;"
                                class="btn btn-link text-danger text-gradient px-3 mb-0 confirm-action"
                                data-action="Cancel" data-order-id="{{ $item->id }}">
                                <i class="far fa-trash-alt me-2"></i>Cancel
                            </a>


                            {{-- form submit --}}
                            <form id="confirmForm{{ $item->id }}"
                                action="{{ route('dashboard.orders.confirm', $item->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                <input type="hidden" name="action" id="confirmAction{{ $item->id }}">
                            </form>
                        </td>
                        <td>
                        @elseif($item->status == 3)
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
                    @endif


                </tr>
            </tbody>
        </table>
    </td>
</tr>
