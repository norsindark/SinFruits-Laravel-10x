<tr class="edit-items-row text-center" style="display: none;" id="edit-options-{{ $item->id }}">
    <td colspan="6">
        <table class="table align-items-center mb-0">

            <tbody>
                <tr>
                    <td>
                        IC {{ $item->id}}:
                    </td>
                    <td class="text-center">
                        <a class="btn btn-link text-dark px-3 mb-0 view-btn" href="#"
                            data-order-id="{{ $item->id }}">
                            <i class="fas fa-eye text-dark me-2"></i>Processing
                        </a>


                        <a class="btn btn-link text-dark px-3 mb-0"
                            href="{{ url('dashboard.orders.edit', $item->id) }}">
                            <i class="fas fa-money-bill text-dark me-2"></i>
                            </i>Paid
                        </a>

                        <a class="btn btn-link text-dark px-3 mb-0"
                            href="{{ url('dashboard.orders.edit', $item->id) }}">
                            <i class="fas fa-solid fa-check text-dark me-2"></i>
                            </i>Completed
                        </a>

                        <a href="javascript:;" class="btn btn-link text-danger text-gradient px-3 mb-0"
                            onclick="confirmRemove({{ $item->id }})">
                            <i class="far fa-trash-alt me-2"></i>Remove
                        </a>

                        <form id="deleteForm{{ $item->id }}"
                            action="{{ url('dashboard.orders.remove', $item->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>

                </tr>
            </tbody>
        </table>
    </td>
</tr>
